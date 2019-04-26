<?php

namespace App\Http\Controllers\front;
use App;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\ServicesTranslation;


class OurServicesController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $locale = App::getLocale();
    $services= ServicesTranslation::where('locale',$locale)->orderBy('sort','ASC')->get()->toArray();
    return view('Front/OurServices.index',compact('services'));
  }


}
