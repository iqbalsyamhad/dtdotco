<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function cekadmin()
{
    if($this->session->userdata('idadmin')=="")
    {
        redirect('ngadimin/sign');
    }
}

function cekuser()
{
    if($this->session->userdata('iduser')=="")
    {
        redirect('sign');
    }
}

function antiInjections($string) {
    $string = stripslashes($string);
    $string = strip_tags($string);
    $string = mysql_real_escape_string($string);
    return $string;
}

function tanggal($tanggal) {

    if(substr($tanggal, 5, 2)=="00") return "";

    $array_bulan = array("Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "November", "Desember");

    $tanggalnya = substr($tanggal, 8, 2);
    $bulannya = $array_bulan[ceil(substr($tanggal, 5, 2)) - 1];
    $tahunnya = substr($tanggal, 0, 4);
    $jamnya = substr($tanggal, 11, 2);
    $menitnya = substr($tanggal, 14, 2);
    $detiknya = substr($tanggal, 17, 2);
    if( $jamnya!=""){
        $tglsekarang = $tanggalnya . " " . $bulannya . " " . $tahunnya . " " . $jamnya . ":" . $menitnya . " WIB";
    }else{
        $tglsekarang = $tanggalnya . " " . $bulannya . " " . $tahunnya;
    }

    return $tglsekarang;
}

function tanggalsingkat($tanggal) {

    if(substr($tanggal, 5, 2)=="00") return "";

    $array_bulan = array("JAN", "FEB", "MAR",
        "APR", "MEI", "JUN",
        "JUL", "AGU", "SEP",
        "OKT", "NOV", "DES");

    $tanggalnya = substr($tanggal, 8, 2);
    $bulannya = $array_bulan[ceil(substr($tanggal, 5, 2)) - 1];
    $tahunnya = substr($tanggal, 0, 4);
    $jamnya = substr($tanggal, 11, 2);
    $menitnya = substr($tanggal, 14, 2);
    $detiknya = substr($tanggal, 17, 2);
    if( $jamnya!=""){
        $tglsekarang = $tanggalnya . " " . $bulannya . " " . $tahunnya . " " . $jamnya . ":" . $menitnya . " WIB";
    }else{
        $tglsekarang = $tanggalnya . " " . $bulannya . " " . substr($tahunnya, 2, 2);
    }

    return $tglsekarang;
}

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }           
    return $hasil;
}

function tbulan($tanggal) {

$array_bulan = array("Januari", "Februari", "Maret",
    "April", "Mei", "Juni",
    "Juli", "Agustus", "September",
    "Oktober", "November", "Desember");

$bulannya = $array_bulan[substr($tanggal, 5, 2) - 1];

return $bulannya;
}

function rupiah($uang) {
    $rp = "";
    $digit = strlen($uang);

    while ($digit > 3) {
        $rp = "." . substr($uang, -3) . $rp;
        $lebar = strlen($uang) - 3;
        $uang = substr($uang, 0, $lebar);
        $digit = strlen($uang);
    }
    $rp = $uang . $rp . ",-";
    return "Rp" . $rp;
}

function bulan($bln) {

    $array_bulan = array("Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "Nopember", "Desember");

    $bulannya = $array_bulan[ceil($bln) - 1];

    return $bulannya;
}

function roomtype($jns){
    if($jns == 2)
        return 'Double';
    else if($jns == 3)
        return 'Triple';
    else if($jns == 4)
        return 'Quad';
    else
        return '-';
}
?>