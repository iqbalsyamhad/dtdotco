<?php
$logfile = date('Y-m-d').'-forcedelete.txt';
$con = mysqli_connect("localhost","dreamtou_sales","Oktober250","dreamtou_telsel");
$conserv = mysqli_connect("localhost","dreamtou_sales","Oktober250","dreamtou_dblockseat");
if (mysqli_connect_errno()){
	file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' = Error connect to Database!', FILE_APPEND);
}
else{
	$localpemb = mysqli_query($con, "SELECT idpembadmin FROM ol_pemberangkatan");
	while ($rpemb = mysqli_fetch_assoc($localpemb)) {
		$pembserv = mysqli_query($conserv, "SELECT idpemberangkatan FROM ol_pemberangkatan WHERE idpemberangkatan = ".$rpemb['idpembadmin']);
		if(mysqli_num_rows($pembserv) > 0){
			file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$rpemb['idpembadmin'].' okee', FILE_APPEND);
		}
		else{
			$deletelocal = mysqli_query($con, "DELETE FROM ol_pemberangkatan WHERE idpembadmin = ".$rpemb['idpembadmin']);
			if($deletelocal){
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$rpemb['idpembadmin'].' DIAPUSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS!', FILE_APPEND);
			}
			else{
				file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => Pemberangkatan '.$rpemb['idpembadmin'].' GAGAL DIAPUS!', FILE_APPEND);
			}
		}
	}
}