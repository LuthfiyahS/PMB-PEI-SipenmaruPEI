<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = "pembayaran";
    protected $fillable = ["id_pembayaran","bukti_pembayaran","status_pembayaran","tgl_pembayaran","id_pendaftaran"];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey= "id_pembayaran";

    public static function id()
    {
    	$kode = DB::table('pembayaran')->max('id_pembayaran');
    	$addNol = '';
    	$kode = str_replace("PAY", "", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
    		$addNol = "000";
    	} elseif (strlen($kode) == 2) {
    		$addNol = "00";
    	} elseif (strlen($kode) == 3) {
    		$addNol = "0";
        } 
    	$kodeBaru = "PAY".$addNol.$incrementKode;
    	return $kodeBaru;
    }
}
