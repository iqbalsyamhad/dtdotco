<?php
$logfile = date('Y-m-d').'-seat.txt';
$con = mysqli_connect("localhost","root","","dbtelsel");
$conserv = mysqli_connect("localhost","root","","dblockonlineseat");
if (mysqli_connect_errno()){
	file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' = Error connect to Database!', FILE_APPEND);
}
else{
	$pembserv = mysqli_query($conserv, "SELECT idpemberangkatan, a.idpaketumroh, dari_tanggal, a.hrgdouble, a.hrgtriple, a.hrgquad, max_slot, filled_slot FROM ol_pemberangkatan a JOIN ol_paketumroh b ON a.idpaketumroh = b.idpaketumroh WHERE dari_tanggal > \"".date('Y-m-d')."\" AND flag = \"dream\" AND a.executed = 0");
	while ($r = mysqli_fetch_assoc($pembserv)) {
		$update = mysqli_query($con, "INSERT INTO ol_pemberangkatan (
			idpemberangkatan,
			idpembadmin,
			idpaketumroh,
			dari_tanggal,
			hrgdouble,
			hrgtriple,
			hrgquad,
			max_slot,
			filled_slot) VALUES(
			".$r['idpemberangkatan'].",
			".$r['idpemberangkatan'].",
			".$r['idpaketumroh'].",
			\"".$r['dari_tanggal']."\",
			\"".$r['hrgdouble']."\",
			\"".$r['hrgtriple']."\",
			\"".$r['hrgquad']."\",
			".$r['max_slot'].",
			".$r['filled_slot'].") ON DUPLICATE KEY UPDATE
			idpaketumroh = ".$r['idpaketumroh'].",
			dari_tanggal = \"".$r['dari_tanggal']."\",
			hrgdouble = \"".$r['hrgdouble']."\",
			hrgtriple = \"".$r['hrgtriple']."\",
			hrgquad = \"".$r['hrgquad']."\",
			max_slot = ".$r['max_slot'].",
			filled_slot = ".$r['filled_slot']);
		if($update){
			$updateserv = mysqli_query($conserv, "UPDATE ol_pemberangkatan SET executed = 1 WHERE idpemberangkatan = ".$r['idpemberangkatan']);
			if($updateserv){
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$r['idpemberangkatan'].' updated!', FILE_APPEND);
			}
			else{
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$r['idpemberangkatan'].' updated! GAGAL set flag exec!', FILE_APPEND);
			}
		}
		else{
			file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$r['idpemberangkatan'].' FAILED to update!', FILE_APPEND);
		}
	}

	$paketserv = mysqli_query($conserv, "SELECT * FROM ol_paketumroh WHERE flag = \"dream\" AND executed = 0");
	while ($s = mysqli_fetch_assoc($paketserv)) {
		$pupdate = mysqli_query($con, "INSERT INTO ol_paketumroh (
			idpaketumroh,
			nmpaketumroh,
			imgpaketumroh,
			overview,
			rincian,
			termasuk,
			tdktermasuk,
			pandp,
			moreinfo,
			itinerary,
			hrgquad,
			hrgtriple,
			hrgdouble,
			hrgperlengkapan,
			jenis) VALUES(
			".$s['idpaketumroh'].",
			\"".$s['nmpaketumroh']."\",
			\"".$s['imgpaketumroh']."\",
			\"".addslashes($s['overview'])."\",
			\"".addslashes($s['rincian'])."\",
			\"".addslashes($s['termasuk'])."\",
			\"".addslashes($s['tdktermasuk'])."\",
			\"".addslashes($s['pandp'])."\",
			\"".addslashes($s['moreinfo'])."\",
			\"".$s['itinerary']."\",
			\"".$s['hrgquad']."\",
			\"".$s['hrgtriple']."\",
			\"".$s['hrgdouble']."\",
			\"".$s['hrgperlengkapan']."\",
			\"".$s['jenis']."\") ON DUPLICATE KEY UPDATE
			nmpaketumroh = \"".$s['nmpaketumroh']."\",
			imgpaketumroh = \"".$s['imgpaketumroh']."\",
			overview = \"".addslashes($s['overview'])."\",
			rincian = \"".addslashes($s['rincian'])."\",
			termasuk = \"".addslashes($s['termasuk'])."\",
			tdktermasuk = \"".addslashes($s['tdktermasuk'])."\",
			pandp = \"".addslashes($s['pandp'])."\",
			moreinfo = \"".addslashes($s['moreinfo'])."\",
			itinerary = \"".$s['itinerary']."\",
			hrgquad = \"".$s['hrgquad']."\",
			hrgtriple = \"".$s['hrgtriple']."\",
			hrgdouble = \"".$s['hrgdouble']."\",
			hrgperlengkapan = \"".$s['hrgperlengkapan']."\",
			jenis = \"".$s['jenis']."\"") or die(mysqli_error($con));;
		if($pupdate){
			$pupdateserv = mysqli_query($conserv, "UPDATE ol_paketumroh SET executed = 1 WHERE idpaketumroh = ".$s['idpaketumroh']);
			if($pupdateserv){
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Paket '.$s['idpaketumroh'].' updated!', FILE_APPEND);
			}
			else{
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Paket '.$s['idpaketumroh'].' updated! GAGAL set flag exec!', FILE_APPEND);
			}
		}
		else{
			file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Paket '.$s['idpaketumroh'].' FAILED to update!', FILE_APPEND);
		}
	}

	//DELETE

	$delpembserv = mysqli_query($conserv, "SELECT idpemberangkatan FROM ol_pemberangkatan_del");
	while ($sdel = mysqli_fetch_assoc($delpembserv)) {
		$deletepemb = mysqli_query($con, "DELETE FROM ol_pemberangkatan WHERE idpembadmin = ".$sdel['idpemberangkatan']);
		if($deletepemb){
			$deleteserv = mysqli_query($conserv, "DELETE FROM ol_pemberangkatan_del WHERE idpemberangkatan = ".$sdel['idpemberangkatan']);
			if($deleteserv){
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$sdel['idpemberangkatan'].' deleted!', FILE_APPEND);
			}
			else{
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$sdel['idpemberangkatan'].' deleted! GAGAL set flag exec!', FILE_APPEND);
			}
		}
		else{
			file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$sdel['idpemberangkatan'].' FAILED to deleted!', FILE_APPEND);
		}
	}

	$delpaketserv = mysqli_query($conserv, "SELECT idpaketumroh, flag FROM ol_paketumroh_del WHERE flag = \"dream\"");
	while ($rdel = mysqli_fetch_assoc($delpaketserv)) {
		$deletepaket = mysqli_query($con, "DELETE FROM ol_paketumroh WHERE idpaketumroh = ".$rdel['idpaketumroh']);
		if($deletepaket){
			$deleteserv = mysqli_query($conserv, "DELETE FROM ol_paketumroh_del WHERE idpaketumroh = ".$rdel['idpaketumroh']);
			if($deleteserv){
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Paket '.$rdel['idpaketumroh'].' deleted!', FILE_APPEND);
			}
			else{
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Paket '.$rdel['idpaketumroh'].' deleted! GAGAL set flag exec!', FILE_APPEND);
			}
		}
		else{
			file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Paket '.$rdel['idpaketumroh'].' FAILED to deleted!', FILE_APPEND);
		}
	}
}