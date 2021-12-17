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

       // $result[] = ['liked' => $mostLiked];

        $mostCommented = DB::table('social_posts_data_v2')
            ->select('postUrl', 'profileUrl', 'name', 'likeCount', 'commentCount' )
            ->where('query','=' ,'#'.$hashtag)->orderByRaw('commentCount  DESC')->limit(4)->get();

        $names  = [];
        $likeCount = [];
        foreach($mostLiked as $liked){
           // echo $liked->postUrl;
            $names[] = $liked->name;
            $likeCount[] = $liked->likeCount;
        }

        $totalLiked = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$hashtag)->sum('likeCount');
        $totalCommented = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$hashtag)->sum('commentCount');
        $totalPosts = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$hashtag)->count('id');
        $totalPosts = DB::table('social_posts_data_v2')->where('query','=' ,'#'.$hashtag)->count('id');

        return view('report', [
            'data' => $hashtag,
            'mostLiked' => $mostLiked,
            'mostComment' => $mostCommented,
            'totalLiked' => $totalLiked,
            'totalCommented' => $totalCommented,
            'totalPosts' => $totalPosts,
        ]);

    }
}
