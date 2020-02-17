<?php
$logfile = date('Y-m-d').'-seat.txt';
$con = mysqli_connect("localhost","root","","dbtelsel");
$conserv = mysqli_connect("localhost","root","","dblockonlineseat");
if (mysqli_connect_errno()){
	file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' = Error connect to Database!', FILE_APPEND);
}
else{
	$query = mysqli_query($con, "SELECT idpemberangkatan, idpembadmin FROM ol_pemberangkatan where dari_tanggal > \"".date('Y-m-d')."\" AND idpembadmin != 0");

	while ($r = mysqli_fetch_assoc($query)) {
		$qseat = mysqli_query($conserv, "SELECT idpemberangkatan, max_slot, filled_slot FROM ol_pemberangkatan where idpemberangkatan = ".$r['idpembadmin']);
		while ($q = mysqli_fetch_assoc($qseat)) {
			$update = mysqli_query($con, "UPDATE ol_pemberangkatan SET max_slot = ".$q['max_slot'].", filled_slot = ".$q['filled_slot']." WHERE idpembadmin = ".$q['idpemberangkatan']);
			if($update){
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$r['idpemberangkatan'].' updated!', FILE_APPEND);
			}
			else{
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$r['idpemberangkatan'].' FAILED to update!', FILE_APPEND);
			}
		}
	}
}