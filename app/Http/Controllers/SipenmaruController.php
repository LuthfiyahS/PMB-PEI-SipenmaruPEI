<?php

namespace App\Http\Controllers;
use App\Models\Pengguna;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Sekolah;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Pengumuman;
use App\Models\Timeline;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Carbon;
use File;
use Alert;

class SipenmaruController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }

    public function login(){
        return view('login');
    }

    public function proslogin(Request $a){
        $message = [
            'email.required' => 'Email yang tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];
        $cek = $a -> validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ],$message);

        if (Auth::attempt($cek)){
            $a -> session() -> regenerate();


            return redirect()->intended('/index');
        }
        return back()->with('loginError', 'Maaf Username atau Password Salah');
    }

    public function logout(Request $a){
        Auth::logout();

        $a->session()->invalidate();
        $a->session()->regenerateToken();
        return redirect('/login');
    }

    public function register(){
        return view('register');
    }

    public function insertRegis(Request $a){
        try{
        $validate = $a->validate([
            'name' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255'
        ]);
        //dd('Regist Berhasil');
        $usersid=Pengguna::id();
        $validate['password'] = Hash::make($validate['password']);
        User::create([
            'name' => $a->name,
            'email' => $a->email,
            'password' => $validate['password'] ,
            'role' => 'Calon Mahasiswa',
            'id_user' => $usersid
        ]);
        $usersid=Pengguna::id();

        Pengguna::create([
            'Id_user' => $usersid,
            'Nama' => $a->name,
            'Email' => $a->email,
            'Tanggal_lahir' => "2000-01-01",
        ]);
        Timeline::create([
            'id_user' => $usersid,
            'status' => "Bergabung"
        ]);
        //return request()->all();
        return redirect('/login')->with('success', 'Berhasil Register!');
    }catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Tersimpan!');
    }
    }



    public function dashboard(){
        $dataPendaftar = Pendaftaran::select( DB::raw('count(*) as jmlpendaftar'),'tahun_masuk')
        ->groupBy('tahun_masuk')->get();
        $data = Pendaftaran::select('status_pendaftaran', DB::raw('count(*) as jumlah'),)
        ->groupBy('status_pendaftaran')->get();
        $pendaftar = Pendaftaran::all();
        $jmlpendaftar = Pendaftaran::all()->count();
        $dataUser = Pengguna::all();
        $timeline = Timeline::all()->sortBy('desc');
        $jmluser = Pengguna::all()->count();
        $jmlbayar = Pembayaran::where('status_pembayaran',"Dibayar")->count();
        $jmlpendaftarperprodi =  Pendaftaran::select('pil1',  DB::raw('count(*) as jmldaftarprodi'),)
        ->groupBy('pil1')->get();
        $jmlpengumuman =  Pengumuman::select('hasil_seleksi', DB::raw('count(*) as jumlah'),)
        ->groupBy('hasil_seleksi')->get();
        $prodi = Prodi::all();
        return view ('dashboard',['timeline' => $timeline,'viewDataUser' => $dataUser,'viewTotal'=>$data,'viewTahunini'=>$dataPendaftar,'pendaftar'=>$pendaftar,'jmlpengumuman'=>$jmlpengumuman,'jmlpendaftar'=>$jmlpendaftar,'jmlpendaftarprodi'=>$jmlpendaftarperprodi,'jmluser'=>$jmluser,'prodi'=>$prodi,'jmlbayar'=>$jmlbayar]);
    }
    //profil
    public function dataprofil(){
        $dataUser = Pengguna::all();
        $kode = User::all();
        return view ('profil',['viewDataUser' => $dataUser,'viewData' => $dataUser,'id'=>$kode]);
    }

    //
    public function editprofil(Request $a){
            $dataUser = Pengguna::all();
            $message = [
                'tempat.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
                'jk.required' => 'Jenis Kelamin harus dipilih',
                'hp.required' => 'Family card cannot be empty',
                'alamat.required' => 'School name must be filled',
                'ig.required' => 'Major must be filled',
            ];

            $cekValidasi = $a->validate([
                'tempat' => 'required',
                'tanggal' => 'required',
                'jk' => 'required',
                'hp' => 'required',
                'alamat' => 'required',
                'ig' => 'required'
            ], $message);

            $file = $a->file('foto');
            if(file_exists($file)){
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move($namaFolder,$nama_file);
                $pathFoto = $namaFolder."/".$nama_file;
            } else {
                $pathFoto = $a->pathFoto;
            }

            Pengguna::where("Id_user", $a->id)->update([
                'Foto' => $pathFoto,
                'Tempat_lahir' => $a->tempat,
                'Tanggal_lahir' => $a->tanggal,
                'Gender' => $a->jk,
                'No_Hp' => $a->hp,
                'Alamat' => $a->alamat,
                'Instagram' => $a->ig
            ]);

            Timeline::create([
                'id_user' => $a->userid,
                'status' => "Mengedit profilnya"
            ]);
            return redirect('/profile')->with("toastr-success",'data berhasil disimpan');

    }

    public function editakun(Request $a){
        $dataUser = Pengguna::all();
        $message = [
            //'name.required' => 'Nama tidak boleh kosong',
           // 'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $cekValidasi = $a->validate([
           // 'name' => 'required|min:3|max:255|unique:users',
            //'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255'
        ], $message);

        $cekValidasi['password'] = Hash::make($cekValidasi['password']);
        //Pengguna::where("Id_user", $a->Id_user)->update([
           // 'Nama' => $a->nama,
            //'Email' => $a->email,
        //]);
        User::where("id", $a->id)->update([
            //'nama' => $a->nama,
            //'email' => $a->email,
            'password' => $cekValidasi['password']
        ]);
        Timeline::create([
            'id_user' => $a->userid,
            'status' => "Mengedit kata sandinya"
        ]);
        return redirect('/profile')->with("toastr-success",'data berhasil disimpan');
    }


    //data user
    public function datauser(){
        $dataUser = Pengguna::all();
        $kode = Pengguna::id();
        return view ('data-user-admin',['viewDataUser' => $dataUser,'viewData' => $dataUser,'id'=>$kode]);
    }

    public function simpanuser(Request $a)
    {
        //dd('Regist Berhasil');
        //return redirect('/data-user')->with('berhasil','data berhasil disimpanI');
    try{
        $a->password = Hash::make($a->password);
        $usersid=Pengguna::id();
        User::create([
            'name' => $a->nama,
            'email' => $a->email,
            'password' => $a->password,
            'role' => $a->level,
            'id_user'=>$usersid,
        ]);
    	$file = $a->file('foto');
            if(file_exists($file)){
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move($namaFolder,$nama_file);
                $pathFoto = $namaFolder."/".$nama_file;
            } else {
                $pathFoto = $a->pathFoto;
            }
        Pengguna::create([
            'Id_user' => $usersid,
            'Nama' => $a->nama,
            'Email' => $a->email,
            'Tanggal_lahir' => "2000-01-01",
            'Gender' => $a->gender,
            'No_Hp' => $a->nohp,
            'Foto' => $pathFoto
        ]);
        Timeline::create([
            'id_user' => $a->userid,
            'status' => "Membuat user baru"
        ]);
        return redirect('/data-user')->with('success', 'Data Tersimpan!');
    }catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Tersimpan!');
    }
    }

    public function edituser($id_user)
    {
        $dataUser = Pengguna::all();
        $dataUserbyId = Pengguna::find($id_user);
        return view('data-user-detail',['viewDataUser' => $dataUser,'viewData'=>$dataUserbyId]);
    }


    public function updateuser($nim,Request $a)
    {
     try{
        $dataUser = Pengguna::all();
            $message = [
                'tempat.required' => 'Tempat lahir tidak boleh kosong',
                'tanggal.required' => 'Tanggal lahir tidak boleh kosong',
                'jk.required' => 'Jenis Kelamin harus dipilih',
                'hp.required' => 'Family card cannot be empty',
                'alamat.required' => 'School name must be filled',
                'ig.required' => 'Major must be filled',
            ];

            $cekValidasi = $a->validate([
                'tempat' => 'required',
                'tanggal' => 'required',
                'jk' => 'required',
                'hp' => 'required',
                'alamat' => 'required',
                'ig' => 'required'
            ], $message);

            $file = $a->file('foto');
            if(file_exists($file)){
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move($namaFolder,$nama_file);
                $pathFoto = $namaFolder."/".$nama_file;
            } else {
                $pathFoto = $a->pathFoto;
            }

            Pengguna::where("Id_user", $a->id)->update([
                'Foto' => $pathFoto,
                'Tempat_lahir' => $a->tempat,
                'Tanggal_lahir' => $a->tanggal,
                'Gender' => $a->jk,
                'No_Hp' => $a->hp,
                'Alamat' => $a->alamat,
                'Instagram' => $a->ig
            ]);
            Timeline::create([
                'id_user' => $a->userid,
                'status' => "Mengedit User"
            ]);
            return redirect('/data-user')->with("success",'Data Berhasil Diubah');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapususer($Id_user){
        //$dataUser = Pengguna::all();
    try{
        $dataPengguna = Pengguna::find($Id_user);
        $id=$dataPengguna['Email'];
        $dataUser = User::where('email',$id);
        $dataPengguna->delete();
        $dataUser->delete();
        return redirect('/data-user')->with("success",'Data Berhasil Dihapus');
    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
    }
    }


    //data kegiatan kompliit
    public function datajadwal(){
        $dataJadwal = Jadwal::all();
        $dataUser = Pengguna::all();
        return view ('data-jadwal',['viewDataUser' => $dataUser,'viewData' => $dataJadwal]);
    }

    public function simpanjadwal(Request $a)
    {
        //$dataUser = Pengguna::all();
        try {
            Jadwal::create([
                'nama_kegiatan' => $a->nama,
                'jenis_kegiatan' => $a->jenis,
                'tgl_mulai' => $a->mulai,
                'tgl_akhir' => $a->selesai
            ]);
            return redirect('/data-jadwal')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
        //return redirect('/data-school')->with('berhasil','data berhasil disimpanI');
    }
    public function updatejadwal(Request $a, $id){
        //$dataUser = Pengguna::all();
    try{
        Jadwal::where("id", "$id")->update([
            'nama_kegiatan' => $a->nama,
            'jenis_kegiatan' => $a->jenis,
            'tgl_mulai' => $a->mulai,
            'tgl_akhir' => $a->selesai
        ]);
        return redirect('/data-jadwal')->with('success', 'Data Terubah!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapusjadwal($id){
        //$dataUser = Pengguna::all();
    try{
        $data = Jadwal::find($id);
        $data->delete();
        return redirect('/data-jadwal')->with('success', 'Data Terhapus!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Terhapus!');
    }
    }

    //data sekolah kompliit
    public function datasekolah(){
        $dataUser = Pengguna::all();
        $dataSekolah = Sekolah::all();
        return view ('data-school-admin',['viewDataUser' => $dataUser,'viewData' => $dataSekolah]);
    }

    public function simpansekolah(Request $a)
    {
        //$dataUser = Pengguna::all();
        try {
            Sekolah::create([
                'NPSN' => $a->id,
                'nama_sekolah' => $a->nama,
                'alamat' => $a->Address,
                'kota' => $a->kota

            ]);
            return redirect('/data-school')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
        //return redirect('/data-school')->with('berhasil','data berhasil disimpanI');
    }
    public function updatesekolah(Request $a, $NPSN){
        //$dataUser = Pengguna::all();
    try{
        Sekolah::where("NPSN", "$NPSN")->update([
            'nama_sekolah' => $a->nama,
            'alamat' => $a->Address,
            'kota' => $a->kota
        ]);
        return redirect('/data-school')->with('success', 'Data Terubah!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapussekolah($NPSN){
        //$dataUser = Pengguna::all();
    try{
        $dataSekolah = Sekolah::find($NPSN);
        $dataSekolah->delete();
        return redirect('/data-school')->with('success', 'Data Terhapus!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Terhapus!');
    }
    }

    //data prodi kompliit
    public function dataprodi(){
        $dataUser = Pengguna::all();
        $data = Prodi::all();
        return view ('data-studyProgram-admin',['viewDataUser' => $dataUser,'viewData' => $data]);
    }

    public function simpanprodi(Request $a)
    {
        try{
            $dataUser = Pengguna::all();
            $kode=Prodi::id();
            Prodi::create([
                'id_prodi' => $kode,
                'nama_prodi' => $a->nama
        ]);
            return redirect('/data-studyProgram')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updateprodi(Request $a, $id_prodi){
        //$dataUser = Pengguna::all();
        try{
            Prodi::where("id_prodi", "$id_prodi")->update([
                'nama_prodi' => $a->nama
        ]);
            return redirect('/data-studyProgram')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapusprodi($id_prodi){
        //$dataUser = Pengguna::all();
        try{
            $data = Prodi::find($id_prodi);
            $data->delete();
            return redirect('/data-studyProgram')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }

    //data pendaftaran kompliit
    public function datapendaftaran(){
        $dataUser = Pengguna::all();
        $data = Pendaftaran::all();
        $datapembayaran = Pembayaran::all();
        return view ('data-pendaftaran-admin',['viewDataPembayaran' => $datapembayaran, 'viewDataUser' => $dataUser,'viewData' => $data]);
    }

    public function inputpendaftaran(){
        $dataUser = Pengguna::all();
        $dataprod = Prodi::all();
        $datenow = date('Y-m-d');
        $dataJadwal = Jadwal::where("tgl_mulai","<","$datenow")->where("tgl_akhir",">","$datenow")->where("jenis_kegiatan","Pendaftaran")->get();
        $dataSekolah = Sekolah::all();
        return view ('data-pendaftaran-input-admin',['viewDataJadwal' => $dataJadwal,'viewDataUser' => $dataUser,'viewSekolah' => $dataSekolah,'viewProdi' => $dataprod]);
    }

    public function simpanpendaftaran(Request $a)
    {
        try{
        $dataUser = Pengguna::all();
        $message = [
            'nisn.required' => 'NISN must be filled',
            'nik.required' => 'NIK must be filled',
            'nama.required' => 'Name must be filled',
            'jk.required' => 'Gender must be filled',
            'foto.required' => 'Photo cannot be empty',
            'tempatlahir.required' => 'Birthplace must be filled',
            'tanggallahir.required' => 'Date of birth must be filled',
            'agama.required' => 'Religion must be filled',
            'alamat.required' => 'Address must be filled',
            'email.required' => 'Email must be filled',
            'nohp.required' => 'Mobile phone must be filled',
            'gelombang.required' => 'Batch must be filled',
            'pil1.required' => 'Prodi choice must be filled',
            'pil2.required' => 'Prodi choice must be filled',
            'ayah.required' => 'Father`s name must be filled',
            'ibu.required' => 'Mother`s name must be filled',
            'pekerjaanayah.required' => 'Father`s occupation must be filled',
            'pekerjaanibu.required' => 'Mother`s occupation must be filled',
            'noayah.required' => 'Father`s phone number must be filled',
            'noibu.required' => 'Mother`s phone number must be filled',
            'gaji.required' => 'PaySlip must be filled',
            'tanggungan.required' => 'Family dependents must be filled',
            'ftgaji.required' => 'PaySlip cannot be empty',
            'ftkk.required' => 'Family card cannot be empty',
            'id_sekolah.required' => 'School name must be filled',
            'jurusan.required' => 'Major must be filled',
            'smt1.required' => 'Semester 1 must be filled',
            'smt2.required' => 'Semester 2 must be filled',
            'smt3.required' => 'Semester 3 must be filled',
            'smt4.required' => 'Semester 4 must be filled',
            'smt5.required' => 'Semester 5 must be filled',
            'ftraport.required' => 'Raport cannot be empty',
        ];

        $cekValidasi = $a->validate([
            //'id_pendaftaran' => 'required',
            //'id_user' => 'required',
            'nisn' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'foto' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'gelombang' => 'required',
            'pil1' => 'required',
            'pil2' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'pekerjaanayah' => 'required',
            'pekerjaanibu' => 'required',
            'noayah' => 'required',
            'noibu' => 'required',
            'gaji' => 'required',
            'tanggungan' => 'required',
            'ftgaji' => 'required',
            'ftkk' => 'required',
            'id_sekolah' => 'required',
            'jurusan' => 'required',
            'smt1' => 'required',
            'smt2' => 'required',
            'smt3' => 'required',
            'smt4' => 'required',
            'smt5' => 'required',
            'ftraport' => 'required'
        ], $message);

        $kodependaftaran = Pendaftaran::id();

        $file = $a->file('foto');
        $nama_file = "Pasfoto".time() . "-" . $file->getClientOriginalName();
        $namaFolder = 'data pendaftar/'.$kodependaftaran;
        $file->move($namaFolder,$nama_file);
        $pathFoto = $namaFolder."/".$nama_file;

        $fileftgaji = $a->file('ftgaji');
        $nama_fileftgaji = "Slipgaji".time() . "-" . $fileftgaji->getClientOriginalName();
        $namaFolderftgaji = 'data pendaftar/'.$kodependaftaran;
        $fileftgaji->move($namaFolderftgaji,$nama_fileftgaji);
        $pathGaji = $namaFolderftgaji."/".$nama_fileftgaji;

        $fileftkk = $a->file('ftkk');
        $nama_fileftkk = "KartuKeluarga".time() . "-" . $fileftkk->getClientOriginalName();
        $namaFolderftkk = 'data pendaftar/'.$kodependaftaran;
        $fileftkk->move($namaFolderftkk,$nama_fileftkk);
        $pathKK = $namaFolderftkk."/".$nama_fileftkk;

        $fileftraport = $a->file('ftraport');
        $nama_fileftraport = "Pasfoto".time() . "-" . $fileftraport->getClientOriginalName();
        $namaFolderftraport = 'data pendaftar/'.$kodependaftaran;
        $fileftraport->move($namaFolderftraport,$nama_fileftraport);
        $pathRaport = $namaFolderftraport."/".$nama_fileftraport;

        $fileftprestasi = $a->file('ftprestasi');
        if(file_exists($fileftprestasi)){
            $nama_fileftprestasi = "Prestasi".time() . "-" . $fileftprestasi->getClientOriginalName();
            $namaFolderftprestasi = 'data pendaftar/'.$kodependaftaran;
            $fileftprestasi->move($namaFolderftprestasi,$nama_fileftprestasi);
            $pathPrestasi = $namaFolderftprestasi."/".$nama_fileftprestasi;
        } else {
            $pathPrestasi = null;
        }

        $fileftijazah = $a->file('ftijazah');
        if(file_exists($fileftijazah)){
            $nama_fileftijazah = "Ijazah".time() . "-" . $fileftijazah->getClientOriginalName();
            $namaFolderftijazah = 'data pendaftar/'.$kodependaftaran;
            $fileftijazah->move($namaFolderftijazah,$nama_fileftijazah);
            $pathIjazah = $namaFolderftijazah."/".$nama_fileftijazah;
        } else {
            $pathIjazah = null;
        }

        Pendaftaran::create([
            'id_pendaftaran' => $kodependaftaran,
            'id_user' => $a->id_user,
            'nisn' => $a->nisn,
            'nik' => $a->nik,
            'nama_siswa' => $a->nama,
            'jenis_kelamin' => $a->jk,
            'pas_foto' => $pathFoto,
            'tempat_lahir' => $a->tempatlahir,
            'tanggal_lahir' => $a->tanggallahir,
            'agama' => $a->agama,
            'alamat' => $a->alamat,
            'email' => $a->email,
            'nohp' => $a->nohp,
            'gelombang' => $a->gelombang,
            'tahun_masuk' => '2022',
            'pil1' => $a->pil1,
            'pil2' => $a->pil2,
            'nama_ayah' => $a->ayah,
            'nama_ibu' => $a->ibu,
            'pekerjaan_ayah' => $a->pekerjaanayah,
            'pekerjaan_ibu' => $a->pekerjaanibu,
            'nohp_ayah' => $a->noayah,
            'nohp_ibu' => $a->noibu,
            'gaji' => $a->gaji,
            'tanggungan' => $a->tanggungan,
            'slip_gaji' =>  $pathGaji,
            'kk' => $pathKK,
            'id_Sekolah' => $a->id_sekolah,
            'jurusan' => $a->jurusan,
            'smt1' => $a->smt1,
            'smt2' => $a->smt2,
            'smt3' => $a->smt3,
            'smt4' => $a->smt4,
            'smt5' => $a->smt5,
            'nilairaport' => $pathRaport,
            'ijazah' => $pathIjazah,
            'prestasi' => $pathPrestasi,
            'status_pendaftaran' => 'Belum Terverifikasi'

        ]);

        //tambah insert
        $kodepembayaran = Pembayaran::id();
        Pembayaran::create([
            'id_pembayaran' => $kodepembayaran,
            //'bukti_pembayaran' => "NULL",
            'status_pembayaran'=> "Belum Bayar",
            'id_pendaftaran' =>$kodependaftaran
        ]);

        $kodepengumuman = Pengumuman::id();
        Pengumuman::create([
            'id_pengumuman' => $kodepengumuman,
            'id_pendaftaran' => $kodependaftaran,
            'hasil_seleksi' => "Belum Seleksi",
            'prodi_penerima' => "Belum Tersedia",
        ]);

        Timeline::create([
            'id_user' => $a->id_user,
            'status' => "Melakukan pendaftaran penerimaan mahasiswa baru"
        ]);

        $rolenow = User::find($a->id);
        return redirect('/data-registration')->with('success', 'Data Tersimpan!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Tersimpan!');
    }
        //if ($rolenow->role=="Administrator"){
            //return redirect('/data-registration')->with('berhasil','data berhasil disimpan');
        //}
        //elseif($rolenow->role=="Calon Mahasiswa"){

        //return redirect('/detail-registration'.'/'.$a->kodependaftaran)->with('berhasil','data berhasil disimpan');
        //}
    }

    public function verifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = Pengguna::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Terverifikasi"
        ]);
        Timeline::create([
            'id_user' => $id_pendaftaran,
            'status' => "di verifikasi"
        ]);
        return redirect('/data-registration');
    }

    public function notverifikasistatuspendaftaran($id_pendaftaran){
        //$dataUser = Pengguna::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Belum Terverifikasi"
        ]);
        Timeline::create([
            'id_user' => $id_pendaftaran,
            'status' => "belum di verifikasi"
        ]);
        return redirect('/data-registration');
    }

    public function invalidstatuspendaftaran($id_pendaftaran){
        //$dataUser = Pengguna::all();
        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'status_pendaftaran' => "Tidak Sah"
        ]);
        Timeline::create([
            'id_user' => $id_pendaftaran,
            'status' => "tidak sah"
        ]);
        return redirect('/data-registration');
    }


    public function editpendaftaran($id_pendaftaran)
    {
        $dataUser = Pengguna::all();
        $dataprod = Prodi::all();
        $dataSekolah = Sekolah::all();
        $datenow = date('Y-m-d');
        $dataJadwal = Jadwal::where("tgl_mulai","<","$datenow")->where("tgl_akhir",">","$datenow")->where("jenis_kegiatan","Pendaftaran")->get();
        $data = Pendaftaran::find($id_pendaftaran);
        return view('data-pendaftaran-edit-admin', ['viewDataJadwal' => $dataJadwal,'viewDataUser' => $dataUser,'viewData' => $data,'viewSekolah' => $dataSekolah,'viewProdi' => $dataprod]);
    }

    public function updatependaftaran(Request $a, $id_pendaftaran){

        try{
        $dataUser = Pengguna::all();
        $message = [
            'nisn.required' => 'NISN must be filled',
            'nik.required' => 'NIK must be filled',
            'nama.required' => 'Name must be filled',
            'jk.required' => 'Gender must be filled',
            'foto.required' => 'Photo cannot be empty',
            'tempatlahir.required' => 'Birthplace must be filled',
            'tanggallahir.required' => 'Date of birth must be filled',
            'agama.required' => 'Religion must be filled',
            'alamat.required' => 'Address must be filled',
            'email.required' => 'Email must be filled',
            'nohp.required' => 'Mobile phone must be filled',
            'gelombang.required' => 'Batch must be filled',
            'pil1.required' => 'Prodi choice must be filled',
            'pil2.required' => 'Prodi choice must be filled',
            'ayah.required' => 'Father`s name must be filled',
            'ibu.required' => 'Mother`s name must be filled',
            'pekerjaanayah.required' => 'Father`s occupation must be filled',
            'pekerjaanibu.required' => 'Mother`s occupation must be filled',
            'noayah.required' => 'Father`s phone number must be filled',
            'noibu.required' => 'Mother`s phone number must be filled',
            'gaji.required' => 'PaySlip must be filled',
            'tanggungan.required' => 'Family dependents must be filled',
            'ftgaji.required' => 'PaySlip cannot be empty',
            'ftkk.required' => 'Family card cannot be empty',
            'id_sekolah.required' => 'School name must be filled',
            'jurusan.required' => 'Major must be filled',
            'smt1.required' => 'Semester 1 must be filled',
            'smt2.required' => 'Semester 2 must be filled',
            'smt3.required' => 'Semester 3 must be filled',
            'smt4.required' => 'Semester 4 must be filled',
            'smt5.required' => 'Semester 5 must be filled',
            'ftraport.required' => 'Raport cannot be empty'
        ];

        $cekValidasi = $a->validate([
            'nisn' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'foto' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'gelombang' => 'required',
            'pil1' => 'required',
            'pil2' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'pekerjaanayah' => 'required',
            'pekerjaanibu' => 'required',
            'noayah' => 'required',
            'noibu' => 'required',
            'gaji' => 'required',
            'tanggungan' => 'required',
            'ftgaji' => 'required',
            'ftkk' => 'required',
            'id_sekolah' => 'required',
            'jurusan' => 'required',
            'smt1' => 'required',
            'smt2' => 'required',
            'smt3' => 'required',
            'smt4' => 'required',
            'smt5' => 'required',
            'ftraport' => 'required'
        ], $message);

        $kodependaftaran = Pendaftaran::id();

        $file = $a->file('foto');
        if(file_exists($file)){
            $nama_file = "Pasfoto".time() . "-" . $file->getClientOriginalName();
            $namaFolder = 'data pendaftar/'.$kodependaftaran;
            $file->move($namaFolder,$nama_file);
            $pathFoto = $namaFolder."/".$nama_file;
        } else {
            $pathFoto = $a->pathFoto;
        }

        $fileftgaji = $a->file('ftgaji');
        if(file_exists($fileftgaji)){
            $nama_fileftgaji = "Slipgaji".time() . "-" . $fileftgaji->getClientOriginalName();
            $namaFolderftgaji = 'data pendaftar/'.$kodependaftaran;
            $fileftgaji->move($namaFolderftgaji,$nama_fileftgaji);
            $pathGaji = $namaFolderftgaji."/".$nama_fileftgaji;
        } else {
            $pathGaji = $a->pathGaji;
        }

        $fileftkk = $a->file('ftkk');
        if(file_exists($fileftkk)){
            $nama_fileftkk = "KartuKeluarga".time() . "-" . $fileftkk->getClientOriginalName();
            $namaFolderftkk = 'data pendaftar/'.$kodependaftaran;
            $fileftkk->move($namaFolderftkk,$nama_fileftkk);
            $pathKK = $namaFolderftkk."/".$nama_fileftkk;
        } else {
            $pathKK = $a->pathKk;
        }

        $fileftraport = $a->file('ftraport');
        if(file_exists($fileftraport)){
            $nama_fileftraport = "Raport".time() . "-" . $fileftraport->getClientOriginalName();
            $namaFolderftraport = 'data pendaftar/'.$kodependaftaran;
            $fileftraport->move($namaFolderftraport,$nama_fileftraport);
            $pathRaport = $namaFolderftraport."/".$nama_fileftraport;
        } else {
            $pathRaport = $a->pathRaport;
        }

        $fileftprestasi = $a->file('ftprestasi');
        if(file_exists($fileftprestasi)){
            $nama_fileftprestasi = "Prestasi".time() . "-" . $fileftprestasi->getClientOriginalName();
            $namaFolderftprestasi = 'data pendaftar/'.$kodependaftaran;
            $fileftprestasi->move($namaFolderftprestasi,$nama_fileftprestasi);
            $pathPrestasi = $namaFolderftprestasi."/".$nama_fileftprestasi;
        } else {
            $pathPrestasi = $a->pathPrestasi;
        }

        $fileftijazah = $a->file('ftijazah');
        if(file_exists($fileftijazah)){
            $nama_fileftijazah = "Ijazah".time() . "-" . $fileftijazah->getClientOriginalName();
            $namaFolderftijazah = 'data pendaftar/'.$kodependaftaran;
            $fileftijazah->move($namaFolderftijazah,$nama_fileftijazah);
            $pathIjazah = $namaFolderftijazah."/".$nama_fileftijazah;
        } else {
            $pathIjazah = $a->pathIjazah;
        }

        Pendaftaran::where("id_pendaftaran", "$id_pendaftaran")->update([
            'nisn' => $a->nisn,
            'nik' => $a->nik,
            'nama_siswa' => $a->nama,
            'jenis_kelamin' => $a->jk,
            'pas_foto' => $pathFoto,
            'tempat_lahir' => $a->tempatlahir,
            'tanggal_lahir' => $a->tanggallahir,
            'agama' => $a->agama,
            'alamat' => $a->alamat,
            'email' => $a->email,
            'nohp' => $a->nohp,
            'gelombang' => $a->gelombang,
            'tahun_masuk' => '2021',
            'pil1' => $a->pil1,
            'pil2' => $a->pil2,
            'nama_ayah' => $a->ayah,
            'nama_ibu' => $a->ibu,
            'pekerjaan_ayah' => $a->pekerjaanayah,
            'pekerjaan_ibu' => $a->pekerjaanibu,
            'nohp_ayah' => $a->noayah,
            'nohp_ibu' => $a->noibu,
            'gaji' => $a->gaji,
            'tanggungan' => $a->tanggungan,
            'slip_gaji' =>  $pathGaji,
            'kk' => $pathKK,
            'id_Sekolah' => $a->id_sekolah,
            'jurusan' => $a->jurusan,
            'smt1' => $a->smt1,
            'smt2' => $a->smt2,
            'smt3' => $a->smt3,
            'smt4' => $a->smt4,
            'smt5' => $a->smt5,
            'nilairaport' => $pathRaport,
            'ijazah' => $pathIjazah,
            'prestasi' => $pathPrestasi
        ]);
        Timeline::create([
            'id_user' => $a->userid,
            'status' => "Mengedit Pendaftaran"
        ]);
        return redirect('/data-registration')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapuspendaftaran($id_pendaftaran){
        //$dataUser = Pengguna::all();
        try{
            $data = Pendaftaran::find($id_pendaftaran);
            File::delete($data->foto);
            File::delete($data->slip_gaji);
            File::delete($data->kk);
            File::delete($data->nilai_raport);
            File::delete($data->ijazah);
            File::delete($data->prestasi);
            $data->delete();
            $dataPembayaran = Pembayaran::where("id_pendaftaran",$id_pendaftaran)->get();
            foreach($dataPembayaran as $x){
                if($x->id_pendaftaran==$id_pendaftaran){
                    $dataPembayaranhapus = Pembayaran::find($x->id_pembayaran);
                    File::delete($dataPembayaranhapus->bukti_pembayaran);
                    $dataPembayaranhapus->delete();
                }
            }
            $dataPengumuman = Pengumuman::where("id_pendaftaran",$id_pendaftaran)->get();
            foreach($dataPengumuman as $x){
                if($x->id_pendaftaran==$id_pendaftaran){
                    $dataPengumumanhapus = Pengumuman::find($x->id_pengumuman);
                    $dataPengumumanhapus->delete();
                }
            }
            return redirect('/data-registration')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }

    public function detailpendaftaran($id_pendaftaran)
    {
        $dataUser = Pengguna::all();
        $dataprod = Prodi::all();
        $dataSekolah = Sekolah::all();
        $datPembayaran = Pembayaran::where("id_pendaftaran",$id_pendaftaran)->get();
        $no=1;
        foreach($datPembayaran as $x){
            if($no==1){
                $dataPembayaran = Pembayaran::find($x->id_pembayaran);
            }
            $no++;
        }
        
        $data = Pendaftaran::find($id_pendaftaran);
        $datapembayaran = Pendaftaran::where("id_pendaftaran", $id_pendaftaran)->get();
        return view('data-pendaftaran-detail', ['viewDataUser' => $dataUser,'viewDataPembayaran' => $dataPembayaran,'viewDataPembayaran' => $datapembayaran,'viewData' => $data,'viewSekolah' => $dataSekolah,'viewProdi' => $dataprod]);
    }

    public function kartupendaftaran($id_pendaftaran)
    {
        $dataUser = Pengguna::all();
        $dataprod = Prodi::all();
        $dataSekolah = Sekolah::all();
        $data = Pendaftaran::find($id_pendaftaran);
        return view('data-pendaftaran-kartu-admin', ['viewDataUser' => $dataUser,'viewData' => $data,'viewSekolah' => $dataSekolah,'viewProdi' => $dataprod]);
    }

    //data pembayaran komplit
    public function datapembayaran(){
        $dataUser = Pengguna::all();
        $data = Pembayaran::all();
        $dataid = Pendaftaran::all();
        return view ('data-pembayaran-admin',['viewDataUser' => $dataUser,'viewData' => $data,'viewIdPendaftaran' => $dataid]);
    }

    public function simpanpembayaran(Request $a)
    {
        try{
        //$dataUser = Pengguna::all();
        $kode = Pembayaran::id();
        $file = $a->file('bukti');
        $kodependaftaran = $a->id_pendaftaran;
        $nama_file = "payment-".time() . "-" . $file->getClientOriginalName();
        $namaFolder = 'data pendaftar/'.$kodependaftaran;
        $file->move($namaFolder,$nama_file);
        $pathBukti = $namaFolder."/".$nama_file;
        Pembayaran::create([
            'id_pembayaran' => $kode,
            'bukti_pembayaran' => $pathBukti,
            'status_pembayaran'=> $a->status,
            'id_pendaftaran' =>$a->id_pendaftaran
        ]);
        Timeline::create([
            'id_user' => $a->userid,
            'status' => "Memperbaharui Pembayaran"
        ]);
        return redirect('/data-payment')->with('success', 'Data Tersimpan!!');
    } catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
    }
    }
    public function updatepembayaran(Request $a, $id_pembayaran){
        //$dataUser = Pengguna::all();
        try{
            $file = $a->file('bukti');
            if(file_exists($file)){
                $kodependaftaran = $a->id_pendaftaran;
                $nama_file = "payment-".time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'data pendaftar/'.$kodependaftaran;
                $file->move($namaFolder,$nama_file);
                $pathBukti = $namaFolder."/".$nama_file;
            } else {
                $pathBukti = $a->pathnya;
            }
            
            Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
                'bukti_pembayaran' => $pathBukti,
                'status_pembayaran'=> $a->status,
                'id_pendaftaran' =>$a->id_pendaftaran
            ]);
            Timeline::create([
                'id_user' => $a->userid,
                'status' => "Memperbaharui Pembayaran"
            ]);
            return redirect('/data-payment')->with('success', 'Data Terubah!!');
        

        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }
    public function updatebuktipembayaran(Request $a){
        //$dataUser = Pengguna::all();
        try{
            $file = $a->file('pem');
            //if(file_exists($file)){
                $kodependaftaran = $a->id_pendaftaran;
                $nama_file = "payment-".time()."-".$file->getClientOriginalName();
                $namaFolder = 'data pendaftar/'.$kodependaftaran;
                $file->move($namaFolder,$nama_file);
                $pathBukti = $namaFolder."/".$nama_file;
            //} else {
              //  $pathBukti = $a->pathnya;
            //}
            $dataSaatini=Pembayaran::where("id_pendaftaran", "$a->id_pendaftaran")->get();
            foreach($dataSaatini as $x){
                if($x->id_pendaftaran==$a->id_pendaftaran){
                    Pembayaran::where("id_pembayaran", "$x->id_pembayaran")->update([
                        'bukti_pembayaran' => $pathBukti,
                        'status_pembayaran'=> "Dibayar",
                        'id_pendaftaran' =>$x->id_pendaftaran
                    ]);
                    Timeline::create([
                        'id_user' => $a->userid,
                        'status' => "Mengupload bukti pembayaran"
                    ]);
                }
            }
            
            return redirect('/detail-registration'.'/'.$a->id_pendaftaran)->with('success', 'Data Terubah!!');
        

        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapuspembayaran($id_pembayaran){
        //$dataUser = Pengguna::all();
        try{
            $data = Pembayaran::find($id_pembayaran);
            $data->delete();
            return redirect('/data-payment')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }

    public function verifikasipembayaran($id_pembayaran){
        //$dataUser = Pengguna::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status_pembayaran' => "Dibayar"
        ]);

        Timeline::create([
            'id_user' => $id_pembayaran,
            'status' => "Melakukan verifikasi pembayaran"
        ]);
        return redirect('/data-payment');
    }

    public function belumbayar($id_pembayaran){
        //$dataUser = Pengguna::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status_pembayaran' => "Belum Bayar"
        ]);

        Timeline::create([
            'id_user' => $id_pembayaran,
            'status' => "Mengganti status Pembayaran"
        ]);
        return redirect('/data-payment');
    }

    public function invalidbayar($id_pembayaran){
        //$dataUser = Pengguna::all();
        Pembayaran::where("id_pembayaran", "$id_pembayaran")->update([
            'status_pembayaran' => "Tidak Sah"
        ]);

        Timeline::create([
            'id_user' => $id_pembayaran,
            'status' => "Mengganti status Pembayaran"
        ]);
        return redirect('/data-payment');
    }


    //data pengumuman kompliit
    public function datapengumuman()
    {
        $dataUser = Pengguna::all();
        $data = Pengumuman::all();
        $dataid = Pendaftaran::all();
        $dataprod = Prodi::all();
        return view ('data-pengumuman-admin',['viewDataUser' => $dataUser,'viewData' => $data,'viewIdPendaftaran' => $dataid,'viewProdi' => $dataprod]);
    }

    public function lihatpengumuman(Request $a)
    {
        $dataUser = Pengguna::all();
        $dataditemukan = Pengumuman::where("id_pendaftaran", $a->id_pendaftaran)->LIMIT(1);
        $data = Pengumuman::all();
        $dataid = Pendaftaran::find($a->id_pendaftaran);
        $dataprod = Prodi::all();
        $dataskl = Sekolah::all();
        return view ('data-pengumuman-view',['viewDataUser' => $dataUser,'viewData' => $data,'viewIdPendaftaran' => $dataid,'viewProdi' => $dataprod,'viewID' => $dataditemukan,'viewSekolah' => $dataskl]);
    }


    public function simpanpengumuman(Request $a)
    {
        try{
        //$dataUser = Pengguna::all();
            $kode = Pengumuman::id();
            Pengumuman::create([
                'id_pengumuman' => $kode,
                'id_pendaftaran' => $a->id_pendaftaran,
                'hasil_seleksi' => $a->hasil,
                'prodi_penerima' => $a->penerima,
                'nilai_interview' => $a->interview,
                'nilai_test' => $a->test
            ]);
            Timeline::create([
                'id_user' => $a->userid,
                'status' => "Membuat pengumuman"
            ]);
            return redirect('/data-announcement')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updatepengumuman(Request $a, $id_pengumuman){
        //$dataUser = Pengguna::all();
        try{
            Pengumuman::where("id_pengumuman", "$id_pengumuman")->update([
                'id_pendaftaran' => $a->id_pendaftaran,
                'hasil_seleksi' => $a->hasil,
                'prodi_penerima' => $a->prodi,
                'nilai_interview' => $a->interview,
                'nilai_test' => $a->test,
            ]);
            if($a->hasil =="LULUS" || $a->hasil =="TIDAK LULUS"){
                Pendaftaran::where("id_pendaftaran", "$a->id_pendaftaran")->update([
                    "status_pendaftaran"=>"Selesai"
                ]);
            }
            Timeline::create([
                'id_user' => $a->userid,
                'status' => "Mengupdate pengumuman"
            ]);
            return redirect('/data-announcement')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }
    

    public function hapuspengumuman($id_pengumuman){
        //$dataUser = Pengguna::all();
        try{
            $data = Pengumuman::find($id_pengumuman);
            $data->delete();
            return redirect('/data-announcement')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }
}
