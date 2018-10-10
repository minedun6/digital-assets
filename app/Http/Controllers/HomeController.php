<?php

namespace App\Http\Controllers;

use App\Enums\AssetIcon;
use App\Enums\AssetType;
use App\LibraryFile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getTree()
    {
        if(request()->has('id') && request('id') == 'root') {
            return response()->json(
                [auth()->user()->rootFolder->load('children', 'user')]
            );
        } else {
            return response()->json(
                LibraryFile::with(['children', 'user'])->find(request('id'))->children()->orderBy('type_id')->get()
            );
        }
    }

}
