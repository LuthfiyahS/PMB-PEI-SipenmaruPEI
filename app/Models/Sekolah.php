<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = "sekolah";
    protected $primaryKey= "NPSN";
    protected $fillable = ["NPSN","nama_sekolah","alamat","kota"];
    public $timestamps = false;
    public $incrementing = false;

    public function pendaftaran(){
        return $this->hasOne(Pendaftaran::class,'pendaftaran','id_Sekolah');
    }
}
