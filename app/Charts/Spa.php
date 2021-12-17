<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class Spa extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $data = $request->data;
        var_dump($data);
        return Chartisan::build()
            ->labels(['Adam', 'Lucy', 'Peter'])
            ->dataset('', [10, 16, 20]);
           // ->dataset('Sample 2', [3, 2, 1]);
    }
}
