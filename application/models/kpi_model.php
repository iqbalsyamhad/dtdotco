<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kpi_model extends CI_Model
{
	public function get_menu_for_level($user_level)
	{
		$this->db->from('menu');
		$this->db->like('menu_allowed','+'.$user_level.'+');
		$result = $this->db->get();
		return $result;
	}
	function get_array_menu($id)
	{
		$this->db->select('menu_allowed');
		$this->db->from('menu');
		$this->db->where('menu_id',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			$row = $data->row();
			$level = $row->menu_allowed;
			$arr = explode('+',$level);
			return $arr;
		}
		else
		{
			die();
		}
	}

	
	public function updateperformabod_simpan()
	{	
		$satu1=$_POST['satu1'];
		$satu2=$_POST['satu2'];
		$satu3=$_POST['satu3'];
		$satu4=$_POST['satu4'];
		$satu5=$_POST['satu5'];

		$bln=$_POST['bulan'];
		$thn=$_POST['tahun'];

		$tiga=$_POST['tiga'];

		$lima=$_POST['lima'];

		

		$karyawan=$_POST['karyawan'];
		$penilai=$_POST['penilai'];
		$q = "insert into kpi_jawaban
			(soal, jawaban, bulan, tahun, karyawan, penilai) 
			VALUES 
			('1','$satu1','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('2','$satu2','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('3','$satu3','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('4','$satu4','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('5','$satu5','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('8','$tiga','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('10','$lima','.$bln.','.$thn.','.$karyawan.','.$penilai.')";
		$this->db->query($q);

		//$query = $this->db->insert('kuesioner_jawaban',$data);
		//return $query;
	}

	public function updateperformahr_simpan()
	{	
		$satu1=$_POST['satu1'];
		$satu2=$_POST['satu2'];
		$satu3=$_POST['satu3'];
		$satu4=$_POST['satu4'];
		$satu5=$_POST['satu5'];

		$dua1=$_POST['dua1'];
		$dua2=$_POST['dua2'];

		$bln=$_POST['bulan'];
		$thn=$_POST['tahun'];

		$karyawan=$_POST['karyawan'];


		$count ="select count(id) as count
			from kpi_absen where karyawan = '$karyawan' and tanggal BETWEEN '$thn-$bln-01' AND '$thn-$bln-31' ";
			$maxquery= mysql_query($count);
			while($row = mysql_fetch_assoc($maxquery)) {
				$empat1=$row['count'];}

		$empat2=$_POST['empat2'];


		
		$karyawan=$_POST['karyawan'];
		$penilai=$_POST['penilai'];
		$q = "insert into kpi_jawaban
			(soal, jawaban, bulan, tahun, karyawan, penilai) 
			VALUES 
			('1','$satu1','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('2','$satu2','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('3','$satu3','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('4','$satu4','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('5','$satu5','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('6','$dua1','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('7','$dua2','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('9','$empat1','.$bln.','.$thn.','.$karyawan.','.$penilai.'),
			('11','$empat2','.$bln.','.$thn.','.$karyawan.','.$penilai.')";
		$this->db->query($q);

		//$query = $this->db->insert('kuesioner_jawaban',$data);
		//return $query;
	}

	public function lihatperforma()
	{
		$query=$this->db->query("SELECT nama, user_lembur, karyawan, bulan, tahun
			FROM kpi_jawaban JOIN lembur_user WHERE karyawan = user_lembur
			AND bulan = '$_POST[bulan]' AND tahun = '$_POST[tahun]' group by nama order by nama asc ");
		return $query->result();
	}

	public function listkaryawan()
	{
		$query=$this->db->query(" SELECT * , ((YEAR(CURDATE())-YEAR(tanggal_masuk))) as tahun , (MONTH(CURDATE())-MONTH(tanggal_masuk)) as bulan FROM lembur_user group by nama");
		return $query->result();
	}

	public function tambahkaryawan_simpan()
	{
		$data = array(
   				'nama' => $this->input->post('nama'),
   				'jenis' => $this->input->post('divisi'),
   				'level' => $this->input->post('level'),
   				'tanggal_masuk' => $this->input->post('tanggal_masuk')
  				);

		$query = $this->db->insert('lembur_user',$data);
		return $query;
	}

	public function updateabsen_simpan()
	{
		$data = array(
   				'karyawan' => $this->input->post('karyawan'),
   				'tanggal' => $this->input->post('tanggal'),
   				'alasan' => $this->input->post('satu1'),
   				'surat' => $this->input->post('satu2')
  				);

		$query = $this->db->insert('kpi_absen',$data);
		return $query;
	}

	public function lihatabsensi()
	{
		$query=$this->db->query("SELECT nama, tanggal, alasan, surat 
			FROM kpi_absen JOIN lembur_user WHERE karyawan = user_lembur
			AND ((tanggal BETWEEN '$_POST[tanggal_awal]' AND '$_POST[tanggal_akhir]' AND user_lembur = '$_POST[karyawan]') OR (tanggal BETWEEN '$_POST[tanggal_awal]' AND '$_POST[tanggal_akhir]'))  ORDER BY nama asc
			");
		return $query->result();
	}

	} 