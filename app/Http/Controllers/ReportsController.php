<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    public function index(string $hashtag)
    {
        $users = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$hashtag)->get()->unique('postUrl');

        //get top 4 most liked comment
        $mostLiked = DB::table('social_posts_data_v2')
            ->select('postUrl', 'profileUrl', 'name', 'likeCount', 'commentCount' )
            ->where('query','=' ,'#'.$hashtag)->orderByRaw('likeCount  DESC')->limit(4)->get();
        //echo json_encode($mostLiked);

        $result[] = ['liked' => $mostLiked];

        return view('report')->with('data', $result);
        // return view('welcome');
    }
}
