<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Prodi extends Model
{
    use HasFactory;
    protected $table = "program_studi";
    protected $primaryKey= "id_prodi";
    protected $fillable = ["id_prodi","nama_prodi"];
    public $timestamps = false;
    public $incrementing = false;

    public static function id()
    {
    	$kode = DB::table('program_studi')->max('id_prodi');
    	$addNol = '';
    	$kode = str_replace("PR", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "0";
        }
    	$kodeBaru = "PR".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
