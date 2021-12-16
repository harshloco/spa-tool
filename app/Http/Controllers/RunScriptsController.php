<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class RunScriptsController
{

    public function index()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.phantombuster.com/api/v2/agents/launch');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            '{"id":"1362320075177748","argument":{"firstCircle":true,"secondCircle":true,"thirdCircle":true,"category":"Content","numberOfLinesPerLaunch":10,"sessionCookie":"AQEDAQ322PsEjesiAAABemASMJUAAAF91j8nCU4ANyP5MREGLe9DqJeBJlA2ikAS0D5e-JPlgsGIaYpFHt4U5a2e82Hcb5JOpGnoP8aCnCbuJvsqkDkJIz4_tf-rwgNV7CbLQs8DsUdBYpFqIWAdGQ2V","search":"#css","numberOfResultsPerSearch":10,"numberOfResultsPerLaunch":10}}');

        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Phantombuster-Key: '.env('PHANTOM_API_KEY');

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:'.curl_error($ch);
        }
        curl_close($ch);

        $containerId = json_decode($result, true)['containerId'];
        echo '$containerId '.$containerId;

        sleep(60); ///give some time to phantom to search and create csv

        if (strlen($containerId) > 0) {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET',
                'https://api.phantombuster.com/api/v2/containers/fetch-output?id='.$containerId.'&mode=raw', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'X-Phantombuster-Key' => env('PHANTOM_API_KEY'),
                    ],
                ]);
            $start = 'CSV saved at';
            $end = 'csv';
            echo 'response body '.$response->getBody();
            $pattern = sprintf(
                '/%s(.+?)%s/ims',
                preg_quote($start, '/'), preg_quote($end, '/')
            );

            $csvFile = '';
            if (preg_match($pattern, $response->getBody(), $matches)) {
                [, $match] = $matches;
                $csvFile = trim($match).'csv';
            }

            if (strlen($csvFile) > 0) {
                echo '$csvFile '.$csvFile;
                $file = $csvFile;

                $fileData = fopen($file, 'r');
                $count = 0;
                while (($line = fgetcsv($fileData)) !== false) {
                    $count++;
                    if ($count == 1) {
                        continue;
                    }

                    $likeCount = 0;
                    if (isset($line[6])) {
                        $likeCount = strlen($line[6]) > 0 ? $line[6] : 0;
                    }

                    $commentCount = 0;
                    if (isset($line[7])) {
                        $commentCount = strlen($line[7]) > 0 ? $line[7] : 0;
                    }

                    DB::insert('insert into social_posts_data_v2 (postURL, profileUrl, fullName, title, postDate, textContent, likeCount, commentCount, name, query, category, timestamp) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                        [
                            (string)$line[0] ?? '',
                            (string)$line[1] ?? '',
                            (string)$line[2] ?? '',
                            (string)$line[3] ?? '',
                            (string)$line[4] ?? '',
                            '',
                            $likeCount,
                            $commentCount,
                            (string)$line[8] ?? '',
                            (string)$line[9] ?? '',
                            (string)$line[10] ?? '',
                            now(),
                        ]);
                }
            }
        }
    }
}
