<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonusmodel extends CI_Model
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


	public function tambahSalesReport()
	{	
		$cekpoint = $this->input->post('paket');
		$jamaah = $this->input->post('jml_jamaah');
		$bod = $_POST['bod'];

		if ($cekpoint == "Umroh Exclusive Series" and ($bod == "1" or $bod == "2")) {
			$point = 2.5;
		} elseif ($cekpoint == "Umroh Exclusive Series" ) {
			$point = 5;
		} elseif ($cekpoint == "Umroh DTT Series" and ($bod == "1" or $bod == "2")) {
			$point = 1.5;
		} elseif ($cekpoint == "Umroh DTT Series") {
			$point = 3;
		} elseif ($cekpoint == "Full Pacakage Insentif" and ($bod == "1" or $bod == "2")) {
			$point = 1.5;
		} elseif ($cekpoint == "Full Pacakage Insentif") {
			$point = 3;
		} elseif ($cekpoint == "Full Pacakage Agen" and ($bod == "1" or $bod == "2")) {
			$point = 1;
		} elseif ($cekpoint == "Full Pacakage Agen") {
			$point = 2;
		} elseif ($cekpoint == "Umroh Plus Exclusive" and ($bod == "1" or $bod == "2")) {
			$point = 3.5;
		} elseif ($cekpoint == "Umroh Plus Exclusive") {
			$point = 7;
		} elseif ($cekpoint == "Holiday" and ($bod == "1" or $bod == "2")) {
			$point = 1.5;
		} elseif ($cekpoint == "Holiday") {
			$point = 3;
		}

		$total_poin = $jamaah*$point;

		$bulans = $this->input->post('bulan');
		$bulan = substr($bulans,0,-5);
		$tahun = substr($bulans, 3);
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'paket' => $this->input->post('paket'),
			'tgl_berangkat' => $this->input->post('tgl_berangkat'),
			'jml_jamaah' => $this->input->post('jml_jamaah'),
			'total_poin' => $total_poin,
			'keterangan' => $this->input->post('keterangan'),
			'bulan' => $bulan,
			'tahun' => $tahun,
			'referensi' => $this->input->post('bod')
			);

		$query = $this->db->insert('tb_sales_report',$data);
		return $query;
	}

	public function poin_sales_report_after_tambah(){

		$bln=getdate(); 
		$bln=$bln[0];
		$bulan = date('m',$bln);                          
		$tahun = date('Y',$bln);
		$user_id = $this->session->userdata('user_id');

		if ($user_id != 55) {
			$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
				FROM tb_sales_report
				JOIN user
				WHERE tb_sales_report.user_id = user.user_id
				AND user.user_id = '$user_id'
				AND bulan ='$bulan'
				AND tahun = '$tahun'
				AND approve = '1'
				GROUP BY tb_sales_report.user_id");
			return $query->result();
		} elseif ($user_id == 55){
			$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
				FROM tb_sales_report
				JOIN user
				WHERE tb_sales_report.user_id = user.user_id
				AND bulan ='$bulan'
				AND tahun = '$tahun'
				AND approve = '1'
				GROUP BY tb_sales_report.user_id");
			return $query->result();
		} 
	}	

	public function sales_report_after_tambah(){

		$bln=getdate(); 
		$bln=$bln[0];
		$bulan = date('m',$bln);                          
		$tahun = date('Y',$bln);
		$user_id = $this->session->userdata('user_id');

		if ($user_id == 55) {
			$query=$this->db->query("SELECT *
				FROM tb_sales_report, user, tb_poin_master_referensi
				WHERE tb_sales_report.user_id = user.user_id
				AND tb_poin_master_referensi.id_referensi = tb_sales_report.referensi
				AND bulan ='$bulan'
				AND tahun = '$tahun'
				ORDER BY user_nama");
			return $query->result();
		} elseif ($user_id != 55){
			$query=$this->db->query("SELECT *
				FROM tb_sales_report, user, tb_poin_master_referensi
				WHERE tb_sales_report.user_id = user.user_id
				AND tb_poin_master_referensi.id_referensi = tb_sales_report.referensi
				AND user.user_id = '$user_id'
				AND bulan ='$bulan'
				AND tahun = '$tahun'
				ORDER BY id_sales_report");
			return $query->result();
		}
		
	}

	public function sales_report_cari(){	
		$user_id = $this->session->userdata('user_id');

		if ($user_id == 55) {
			$query=$this->db->query("SELECT *
				FROM tb_sales_report, user, tb_poin_master_referensi
				WHERE tb_sales_report.user_id = user.user_id
				AND tb_poin_master_referensi.id_referensi = tb_sales_report.referensi
				AND bulan ='$_GET[bulan]'
				AND tahun = '$_GET[tahun]'
				ORDER BY user_nama");
			return $query->result();
		} elseif ($user_id != 55){
			$query=$this->db->query("SELECT *
				FROM tb_sales_report, user, tb_poin_master_referensi
				WHERE tb_sales_report.user_id = user.user_id
				AND tb_poin_master_referensi.id_referensi = tb_sales_report.referensi
				AND user.user_id = '$user_id'
				AND bulan ='$_GET[bulan]'
				AND tahun = '$_GET[tahun]'
				ORDER BY id_sales_report");
			return $query->result();
		}
	}

	public function poin_sales_report(){
		$user_id = $this->session->userdata('user_id');

		if ($user_id != 55) {
			$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
				FROM tb_sales_report
				JOIN user
				WHERE tb_sales_report.user_id = user.user_id
				AND user.user_id = '$user_id'
				AND bulan ='$_GET[bulan]'
				AND tahun = '$_GET[tahun]'
				AND approve = '1'
				GROUP BY tb_sales_report.user_id");
			return $query->result();
		} elseif ($user_id == 55){
			$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
				FROM tb_sales_report
				JOIN user
				WHERE tb_sales_report.user_id = user.user_id
				AND bulan ='$_GET[bulan]'
				AND tahun = '$_GET[tahun]'
				AND approve = '1'
				GROUP BY tb_sales_report.user_id");
			return $query->result();
		} 
	}

	public function hapusSalesReport($id_sales_report)
	{
		$this->db->where('id_sales_report',$id_sales_report);
		$this->db->delete('tb_sales_report');
	}

	public function ubah_approve($id_sales_report)
	{
		$query = $this->db->query('update tb_sales_report set approve="1" where id_sales_report='.$id_sales_report);
	}

} 