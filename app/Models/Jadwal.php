<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwal_kegiatan";
    protected $primaryKey= "id";
    protected $fillable = ["nama_kegiatan","jenis_kegiatan","tgl_mulai","tgl_akhir"];
    public $timestamps = false;

    public function pendaftaran(){
        return $this->hasOne(Pendaftaran::class,'pendaftaran','id_Sekolah');
    }
}
