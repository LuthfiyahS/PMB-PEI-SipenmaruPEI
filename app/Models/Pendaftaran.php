<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
Use Illuminate\Support\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = "pendaftaran";
    protected $fillable = ["id_pendaftaran","id_user","nisn","nik","nama_siswa","jenis_kelamin","pas_foto","tempat_lahir","tanggal_lahir","agama","alamat","email","nohp","gelombang","tahun_masuk","pil1","pil2","nama_ayah","nama_ibu","pekerjaan_ayah","pekerjaan_ibu","nohp_ayah","nohp_ibu","gaji","tanggungan","slip_gaji","kk","id_Sekolah","jurusan","smt1","smt2","smt3","smt4","smt5","nilairaport","ijazah","prestasi","status_pendaftaran"];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey= "id_pendaftaran";





    public static function id()
    {
    	$kode = DB::table('pendaftaran')->count();
    	$addNol = '';
        $waktu = now()->format('Y');
    	$kode = str_replace($waktu,"", $kode);
    	$kode = (int) $kode + 1;
        $incrementKode = $kode;

    	if (strlen($kode) == 1) {
            $tgl = now()->format('j');
            if (strlen($tgl) == 1) {
                $addNol = "0".now()->format('j')."00";
            } elseif (strlen($tgl) == 2) {
                $addNol = now()->format('j')."00";
            } 
    	} elseif (strlen($kode) == 2) {
    		$addNol = now()->format('h')."0";
    	} elseif (strlen($kode) == 3) {
    		$addNol = "00";
        } elseif (strlen($kode) == 4) {
    		$addNol = "0";
        }
    	$kodeBaru = $waktu.$addNol.$incrementKode;
    	return $kodeBaru;
    }
    public function sekolah(){
        return $this->belongsToMany(Sekolah::class,'sekolah','NPSN');
    }
}
