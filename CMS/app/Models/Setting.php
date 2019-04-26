<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SettingTranslation;

/**
* Class Setting
*/
class Setting extends Model
{
    protected $table = 'setting';

    protected $primaryKey = 'setting_id';

    public $timestamps = true;

    protected $fillable = [
        'lat',
        'long',
        'email',
        'tel',
        'address',
        'company_name',
        'logo',
        'fav',
    ];
    protected $guarded = [];
    public function translations($lang,$id)
    {
        return SettingTranslation::where(['locale'=>$lang,'setting_id'=>$id])->first();
    }


}
