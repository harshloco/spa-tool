<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Spa extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $users = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$request->id)->get()->unique('postUrl');

        //get top 4 most liked comment
        //get top 4 most liked comment
        $mostLiked = DB::table('social_posts_data_v2')
            ->select('postUrl', 'profileUrl', 'name', 'likeCount', 'commentCount' )
            ->where('query','=' ,'#'.$request->id)->orderByRaw('likeCount  DESC')->limit(4)->get();
        //echo json_encode($mostLiked);

        // $result[] = ['liked' => $mostLiked];

        $mostCommented = DB::table('social_posts_data_v2')
            ->select('postUrl', 'profileUrl', 'name', 'likeCount', 'commentCount' )
            ->where('query','=' ,'#'.$request->id)->orderByRaw('commentCount  DESC')->limit(4)->get();

        $names  = [];
        $likeCount = [];
        foreach($mostLiked as $liked){
            // echo $liked->postUrl;
            $names[] = $liked->name;
            $likeCount[] = $liked->likeCount;
        }
       // $result[] = ['liked' => $mostLiked];

        return Chartisan::build()
            ->labels([$names])
            ->dataset('names', [$likeCount]);
           // ->dataset('Sample 2', [3, 2, 1]);
    }
}
