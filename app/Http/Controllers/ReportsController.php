<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    public function index(string $hashtag)
    {
        $users = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$hashtag)->get();

        
        return view('welcome')->with('data', $users);
        // return view('welcome');
    }
}
