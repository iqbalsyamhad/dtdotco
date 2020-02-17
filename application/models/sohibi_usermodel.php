<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sohibi_usermodel extends CI_Model
{
	public function get_menu_for_level($user_level)
	{
		$this->db->from('menu');
		$this->db->like('menu_allowed','+'.$user_level.'+');
		$this->db->order_by("menu_nama", "asc"); 
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

	//CALON JAMAAH
	public function tampilCalonJamaah()
	{
		$id = $this->session->userdata('user_id');
		$query=$this->db->query('SELECT *
			FROM tb_calon_jamaah
			JOIN user
			WHERE tb_calon_jamaah.user_id = user.user_id
			AND tb_calon_jamaah.user_id = '.$id.'
			ORDER BY id DESC');
		return $query->result();
	}

	public function tambahCalonJamaah($data)
	{
		$query = $this->db->insert('tb_calon_jamaah',$data);
		return $query;
	}

	public function tambahCalonJamaah1($nama_file)
	{
		$tanggal = $this->input->post('tanggal');
		$id = $this->input->post('id');
		$user_id = $this->input->post('user_id');
		$no_paspor = $this->input->post('no_paspor');
		$nama = $this->input->post('nama');
		$status = $this->input->post('status');
		$komisi = $this->input->post('komisi');
		$status_tabungan_cash = $this->input->post('status_tabungan_cash');

		$query = "INSERT INTO tb_calon_jamaah (tanggal, id, user_id, no_paspor, scan_paspor, nama, status, komisi, status_tabungan_cash)
					VALUES ('$tanggal','$id','$user_id','$no_paspor','$nama_file','$nama','$status','$komisi','$status_tabungan_cash') ";
		$this->db->query($query);
	}

	public function hapusCalonJamaah($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tb_calon_jamaah');
	}	

	public function ubahCalonJamaah(){
		$data['no_paspor'] = $_POST['no_paspor'];
		$data['nama'] = $_POST['nama'];

		$this->db->where('id',$_POST['id']);
		$this->db->update('tb_calon_jamaah',$data);
	}

	public function ubahKomisiUmroh($id){
		$query= $this->db->query('update tb_calon_jamaah set komisi="Tabungan Umroh", status_tabungan_cash="-" where id='.$id);
	}

	public function ubahKomisiCash($id){
		$query= $this->db->query('update tb_calon_jamaah set komisi="Tabungan Cash", status_tabungan_cash="Belum Ditransfer" where id='.$id);
	}

	// ADMIN	

	public function tampilAdminCalonJamaah()
	{
		$query=$this->db->query('SELECT *
			FROM tb_calon_jamaah
			JOIN user
			WHERE tb_calon_jamaah.user_id = user.user_id
			ORDER BY id');
		return $query->result();
	}

	public function adminUbahStatus($id){
		$query= $this->db->query('update tb_calon_jamaah set status="Confirmed" where id='.$id);
	}

	public function tampilAdminKomisiSohibi()
	{
		$query=$this->db->query('SELECT *
			FROM tb_calon_jamaah
			JOIN user
			WHERE tb_calon_jamaah.user_id = user.user_id
			AND status = "Confirmed"
			GROUP BY tb_calon_jamaah.user_id');
		return $query->result();
	}

	// KOMISI

	public function tampilCalonJamaahConfirmed()
	{
		$id = $this->session->userdata('user_id');
		$query=$this->db->query('SELECT *
			FROM tb_calon_jamaah
			JOIN user
			WHERE tb_calon_jamaah.user_id = user.user_id
			AND status = "Confirmed"
			AND tb_calon_jamaah.user_id = '.$id.'
			ORDER BY id DESC');
		return $query->result();
	}
}