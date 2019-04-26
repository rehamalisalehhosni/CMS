<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use Mail;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Services;
use App\Models\AboutUsTranslation;
use App\Models\ServicesTranslation;


class AboutUsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $aboutUs= AboutUsTranslation::where('locale',$locale)->orderBy('sort','ASC')->get();
    $services= ServicesTranslation::where('locale',$locale)->orderBy('sort','ASC')->get();
    return view('Front/AboutUs.index',compact('aboutUs','services'));
  }


}
