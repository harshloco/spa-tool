<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    public function index()
    {
        $users = DB::table('social_posts_data-v2')->get();



        return view('welcome')->with('data', $users);
        // return view('welcome');
    }
}
