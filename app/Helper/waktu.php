<?php

function hari_tanggal($tanggal, $cetak_hari = false)
{
    $hari = array ( 1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu' );
    $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    $split    = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}
function hari_tanggal_waktu($tanggal, $cetak_hari = false)
{
    $hari = array ( 1 => 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu' );
    $bulan = array (1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    $split    = explode('-', $tanggal);
    $waktu    = substr($tanggal, '10');
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    $tgl_indo = substr($tgl_indo, 9);

    if ($cetak_hari) {
        $num = date('N', strtotime($tgl_indo));
        return $hari[$num] . ', ' . $tgl_indo. ' - '. $waktu;
    }
    return $tgl_indo;
}