<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Trainer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function viewHome()
    {
        $galleries = Gallery::all();
        $trainers = Trainer::all();
        $about  = About::all();
        $banner = Banner::all();

        return view('/home' , compact('galleries', 'trainers' , 'about' , 'banner'));
    }
}
