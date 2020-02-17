<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model
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

	public function listproject()
	{
		$query=$this->db->query("SELECT * FROM employee_project where jenis <> 'abadi' group by nama order by id_project desc");
		return $query->result();
	}

	public function tambahkaryawan_simpan()
	{
		$data = array(
   				'nama' => $this->input->post('nama'),
   				'email' => $this->input->post('email'),
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

	public function hapusKaryawan($user_lembur)
	{
		$this->db->where('user_lembur',$user_lembur);
  		$this->db->delete('lembur_user');
	}

	// Project
	public function tambahproject_simpan()
	{
		$data = array(
   				'nama ' => $this->input->post('nama_project'),
   				'jenis' => $this->input->post('jenis_project'),
   				'jumlah_jam' => $this->input->post('jumlah_jam'),
   				'jam_sisa' => $this->input->post('jumlah_jam')
  				);

		$query = $this->db->insert('employee_project',$data);
		return $query;
	}

	public function hapusProject($id_project)
	{
		$this->db->where('id_project',$id_project);
  		$this->db->delete('employee_project');
	}
	// team project
	public function updateproject_simpan()
	{	
		$data['jenis'] = $_POST['jenis_project'];
		$data['nama'] = $_POST['nama_project'];
		$data['jumlah_jam'] = $_POST['jumlah_jam'];

		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_project',$_POST['id_project']);
		$this->db->update('employee_project',$data);
	}
	//simpan team project
	public function tambahteam_simpan()
	{	
		//$id_project = $this->input->post('project');

		//$count ="select max(id_project) as max
		//	from employee_project";
		//	$maxquery= mysql_query($count);
		//	while($row = mysql_fetch_assoc($maxquery)) {
		//		$maxid=$row['max'];
		//		$maxid=$maxid+1; }

		//if ($id_project == "0"){
		//	$id_project = $maxid; 
		//} else{
		//	$id_project = $this->input->post('id_project'); 
		//}

		$data = array(
   				'id_project' => $this->input->post('id_project'),
   				'id_user' => $this->input->post('id_user')
  				);

		$query = $this->db->insert('employee_team',$data);
		return $query;
	}

	public function hapusTeam($id)
	{
		$this->db->where('id',$id);
  		$this->db->delete('employee_team');
	}


	public function hapusEvent($id_event)
	{
		$this->db->where('id_event',$id_event);
  		$this->db->delete('employee_event');
	}

	public function listevent()
	{
		$query=$this->db->query("SELECT * FROM employee_event group by id_event order by tanggal desc");
		return $query->result();
	}

	public function tambahevent_simpan()
	{
		$data = array(
   				'nama' => $this->input->post('nama'),
   				'tanggal' => $this->input->post('tanggal')
  				);

		$query = $this->db->insert('employee_event',$data);
		return $query;
	}

	public function updateevent_simpan()
	{
		$data['nama'] = $_POST['nama'];
		$data['tanggal'] = $_POST['tanggal'];

		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_event',$_POST['id_event']);
		$this->db->update('employee_event',$data);
	}

	public function editKaryawan()
		{
			$data['nama'] = $_POST['nama'];
			$data['jenis'] = $_POST['jenis'];
			$data['level'] = $_POST['level'];
			$data['tanggal_masuk'] = $_POST['tanggal_masuk'];

			$this->db->where('user_lembur',$_POST['user_lembur']);
			$this->db->update('lembur_user',$data);
		}
	//information
	public function listinformation()
	{
		$query=$this->db->query("SELECT * FROM employee_information group by id_information order by tanggal_buat desc");
		return $query->result();
	}	

	public function tambahinformation_simpan()
	{
		$data = array(
   				'tanggal_buat' => $this->input->post('tanggal_buat'),
   				'information' => $this->input->post('information')
  				);

		$query = $this->db->insert('employee_information',$data);
		return $query;
	}

	public function hapusinformation($id_information)
	{
		$this->db->where('id_information',$id_information);
  		$this->db->delete('employee_information');
	}

	public function updateinformation_simpan()
	{
		$data['information'] = $_POST['information'];

		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_information',$_POST['id_information']);
		$this->db->update('employee_information',$data);
	}

	// start for employee
	public function absentsenin()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project and  DAYNAME(tanggal) = 'monday' order by tanggal desc");
		return $query->result();		
	}

	public function absentselasa()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project and DAYNAME(tanggal) = 'tuesday' order by tanggal desc");
		return $query->result();		
	}

	public function absentrabu()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project and DAYNAME(tanggal) = 'wednesday' order by tanggal desc");
		return $query->result();		
	}

	public function absentkamis()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project and DAYNAME(tanggal) = 'thursday' order by tanggal desc");
		return $query->result();		
	}

	public function absentjumat()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project and DAYNAME(tanggal) = 'friday' order by tanggal desc");
		return $query->result();		
	}

	public function absentsabtu()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project and DAYNAME(tanggal) = 'saturday' order by tanggal desc");
		return $query->result();		
	}

	public function absentminggu()
	{	
		$user_id = $this->session->userdata('user_id');
		$query=$this->db->query("select employee_absent.tanggal as tanggal, employee_absent.jam as jam, employee_project.nama as nama from employee_absent, employee_project where  employee_absent.user_lembur = $user_id and employee_absent.id_project = employee_project.id_project  and DAYNAME(tanggal) = 'sunday' order by tanggal desc");
		return $query->result();		
	}

	public function simpantambahabsent()
	{	
		$tanggal = $this->input->post('tanggal');
		$project = $this->input->post('project');
		$id_user = $this->input->post('id_user');

		if ($project == '300') {
			for ($i=9; $i <=17 ; $i++) { 
				$j=$i+1;
                $waktu = $i.'.00-'.$j.'.00';

            $data = array(
   				'tanggal' => $tanggal,
   				'jam' => $waktu,
   				'id_project' => $project,
   				'user_lembur' => $id_user,
  				);
			$query = $this->db->insert('employee_absent',$data);}
		}if ($project == '301') {
			for ($i=9; $i <=17 ; $i++) { 
				$j=$i+1;
                $waktu = $i.'.00-'.$j.'.00';

            $data = array(
   				'tanggal' => $tanggal,
   				'jam' => $waktu,
   				'id_project' => $project,
   				'user_lembur' => $id_user,
  				);
			$query = $this->db->insert('employee_absent',$data);}
		} if ($project == '302') {
			for ($i=9; $i <=17 ; $i++) { 
				$j=$i+1;
                $waktu = $i.'.00-'.$j.'.00';

            $data = array(
   				'tanggal' => $tanggal,
   				'jam' => $waktu,
   				'id_project' => $project,
   				'user_lembur' => $id_user,
  				);
			$query = $this->db->insert('employee_absent',$data);}
		} if ($project == '303') {
			for ($i=9; $i <=17 ; $i++) { 
				$j=$i+1;
                $waktu = $i.'.00-'.$j.'.00';

            $data = array(
   				'tanggal' => $tanggal,
   				'jam' => $waktu,
   				'id_project' => $project,
   				'user_lembur' => $id_user,
  				);
			$query = $this->db->insert('employee_absent',$data);}
		}else{
			$data = array(
   				'tanggal' => $tanggal,
   				'jam' => $this->input->post('jam'),
   				'id_project' => $project,
   				'user_lembur' => $id_user,
  				);
			$query = $this->db->insert('employee_absent',$data);    
			}
		// or $project <> '301' or $project <> '302' or $project <> '303'
		//memasukkan id_project kedalam variabel
		//$project = $this->input->post('project');
		//simpan absen
		//$data = array(
   		//		'tanggal' => $this->input->post('tanggal'),
   		//		'jam' => $this->input->post('jam'),
   		//		'id_project' => $this->input->post('project'),
   		//		'user_lembur' => $this->input->post('id_user'),
  		//		);
		//$query = $this->db->insert('employee_absent',$data);
		
		

		
	}
	public function updatesisajam()
	{	
		$project = $this->input->post('project');
		
		//menghitung jumlah jam terpakai
		$count ="select count(id_absent) as count
			from employee_absent where id_project = '$project'";
			$maxquery= mysql_query($count);
			while($row = mysql_fetch_assoc($maxquery)) {
			$terpakai=$row['count'];}
		// jumlah jam
		$jumlah_jam ="select jumlah_jam as jam
			from employee_project where id_project = '$project'";
			$maxquery= mysql_query($jumlah_jam);
			while($row = mysql_fetch_assoc($maxquery)) {
			$jam=$row['jam'];}
		// sisa jumlah jam
		$sisajam = $jam - ($terpakai);

		// update sisa jam
		$data = array(
			'jam_sisa' => $sisajam
		);
		$this->db->where('id_project','project');
		$query = $this->db->update('employee_project',$data);
		return $query;
	}

	} 