<?php

namespace App\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App;


class HomeController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $slider= SliderTranslation::where('locale',$locale)->orderBy('slider_id','Desc')->get();
    return view('Front/Home.index',compact('slider'));
  }


}
