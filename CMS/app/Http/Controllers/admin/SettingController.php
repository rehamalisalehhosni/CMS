<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Languages;
use App\Models\SettingTranslation;

class SettingController extends Controller
{
  function __construct()
  {
//$this->middleware('permission:setting-list');
       $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $id=1;
    $item = Setting::find($id);
    $languages=Languages::all();
    return view('Backend/Setting.edit',compact('item','languages'));

  }
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function updateDatMain($request,$lang,$id){
    $setting = Setting::find($id);
    $setting->lat = $request->input('lat_'.$lang);
    $setting->long = $request->input('long_'.$lang);
    $setting->email = $request->input('email_'.$lang);
    $setting->address = $request->input('address_'.$lang);
    $setting->tel = $request->input('tel_'.$lang);
    $setting->company_name = $request->input('company_name_'.$lang);
    if($file = $request->hasFile('logo_'.$lang)) {
      $file = $request->file('logo_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/setting/logo/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $setting->logo = $fileName ;
    }
    if($file = $request->hasFile('fav_'.$lang)) {
      $file = $request->file('fav_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/setting/fav/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      $file->move($destinationPath,$fileName);
      $setting->fav = $fileName ;
    }
    $setting->update();
    return $setting;
  }
  public function updateDataLanguage($request,$lang,$data,$settingId){
    $id=$request->input('setting_translations_id_'.$lang);
    $settingTranslation = SettingTranslation::find($id);
    if($settingTranslation){
      $exists=true;
      $settingTranslation = SettingTranslation::find($id);
    }else{
      $exists=false;
    //  $settingTranslation = SettingTranslation::find($id);
      $settingTranslation = new SettingTranslation;
    }//$id
    $settingTranslation->lat = $request->input('lat_'.$lang);
    $settingTranslation->long = $request->input('long_'.$lang);
    $settingTranslation->email = $request->input('email_'.$lang);
    $settingTranslation->address = $request->input('address_'.$lang);
    $settingTranslation->tel = $request->input('tel_'.$lang);
    $settingTranslation->company_name = $request->input('company_name_'.$lang);
    if($file = $request->hasFile('logo_'.$lang)) {
      $file = $request->file('logo_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/setting/logo/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      if($lang=='en'){
        $settingTranslation->logo=$data->logo;
      }else{
        $file->move($destinationPath,$fileName);
        $settingTranslation->logo=$fileName ;
      }
    }
    if($file = $request->hasFile('fav_'.$lang)) {
      $file = $request->file('fav_'.$lang) ;
      $extension = $file->getClientOriginalExtension();
      $fileName =explode('.', $file->getClientOriginalName())[0].time().'.'.$extension;
      $fileName = str_replace(' ', '', $fileName);
      //$fileName = $file->getClientOriginalName() ;
      $destinationPath = public_path().'/Uploads/setting/fav/'.$lang ;
      if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
      }
      if($lang=='en'){
        $settingTranslation->fav=$data->fav;
      }else{
        $file->move($destinationPath,$fileName);
        $settingTranslation->fav=$fileName ;
      }
    }
    if($exists){
//      $settingTranslation = SettingTranslation::find($id);
      $settingTranslation->update() ;
    }else{
    //  $settingTranslation = SettingTranslation::find($id);
      $settingTranslation->locale=$lang ;
      $settingTranslation->setting_id=$settingId ;

      $settingTranslation->save() ;
    }

  }
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
    $this->validate($request, [
      'lat_en' => 'required',
      'company_name_en' => 'required',
      'long_en' => 'required',
      'email_en' => 'required|email',
      'address_en' => 'required',
      'tel_en' => 'required',
      'logo_en' => 'mimes:jpg,png,jepg,gif|max:50048',
      'fav_en' => 'mimes:jpg,png,jepg,gif,ico|max:50048',
    ]);
    $Languages=Languages::get();
    foreach ($Languages as $key => $item) {
      if($key==0){
        $data=$this->updateDatMain($request,$item->code,$id);
      }
      $this->updateDataLanguage($request,$item->code,$data,$id);
      // code...
    }
//$this->updateDataLanguage($request,'ar',$data);
    return redirect()->route('setting.edit',1)
    ->with('success','Setting updated successfully');
  }

}
