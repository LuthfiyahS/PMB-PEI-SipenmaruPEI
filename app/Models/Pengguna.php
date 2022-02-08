<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = "profile_user";
    protected $fillable = ["Id_user","Nama","Email","Foto","Tempat_lahir","Tanggal_lahir","Gender","No_Hp","Alamat","Instagram"];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey= "Id_user";

    public static function id()
    {
    	$kode = DB::table('profile_user')->max('Id_user');
    	$addNol = '';
    	$kode = str_replace("USR", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "00000";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0000";
    	} elseif (strlen($kode) == 3) {
    		$addNol = "000";
        } elseif (strlen($kode) == 4) {
            $addNol = "00";
        } elseif (strlen($kode) == 5) {
            $addNol = "0";
        }
    	$kodeBaru = "USR".$addNol.$incrementKode;
    	return $kodeBaru;
    }

    public function user(){
        return $this->hasMany(Pengguna::class,'id');
      }

}
