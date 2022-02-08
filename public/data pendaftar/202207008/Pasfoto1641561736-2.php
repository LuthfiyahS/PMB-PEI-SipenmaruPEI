<html>
<head>
    <title>Latihan 1 PHP - Muhammad Dwiki Yudhistira</title>
</head>
<body>
<center><h1>Hasil Output Kartu Tanda Penduduk</h1></center>

<?php
$nik = $_POST["nik"];
$nama = $_POST["nama"];
$ttl = $_POST["lahir"];
$jk = $_POST["kelamin"];
$alamat = $_POST["alamat"];
$rtw = $_POST["rtw"];
$kel = $_POST["kel"];
$kec = $_POST["kec"];
$agama = $_POST["agama"];
$status = $_POST["status"];
$pekerjaan = $_POST["kerja"];
$kewarga = $_POST["kewarga"];
$berlaku = $_POST["berlaku"];
?>

<table align="center" cellspacing="0px" cellpadding="0px" border="1">
        <tr align="center"><td><h3><b>PROVINSI JAWA BARAT<br>KABUPATEN PURWAKARTA</b></h3></td></tr>
        <tr><td>
            <table width="450" border="0" cellpadding="0" cellspacing="10" align="center">
        <tr>
            <td width="160px">1. NIK</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $nik ?></td>
        </tr>
        <tr>
            <td width="160px">2. Nama</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $nama ?></td>
        </tr>
        <tr>
            <td width="160px">3. Tempat/Tgl Lahir</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $ttl ?></td>
        </tr>
        <tr>
            <td width="160px">4. Jenis Kelamin</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $jk ?></td>
        </tr>
        <tr>
            <td width="160px">5. Alamat</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $alamat ?></td>
        </tr>
        <tr>
            <td width="160px">6. RT/RW</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $rtw ?></td>
        </tr>
        <tr>
            <td width="160px">7. Kel/Desa</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $kel ?></td>
        </tr>
        <tr>
            <td width="160px">8. Kecamatan</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $kec ?></td>
        </tr>
        <tr>
            <td width="160px">9. Agama</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $agama ?></td>
        </tr>
        <tr>
            <td width="160px">10. Status Perkawinan</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $status ?></td>
        </tr>
        <tr>
            <td width="160px">11. Pekerjaan</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $pekerjaan ?></td>
        </tr>
        <tr>
            <td width="160px">12. Kewarganegaraan</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $kewarga ?></td>
        </tr>
        <tr>
            <td width="160px">13. Berlaku Hingga</td>
            <td width="6px">:</td>
            <td width="324px">
            <?php echo $berlaku ?></td>
        </tr>
        </table></table>
</body></html>

<!--moch_dwiki -->