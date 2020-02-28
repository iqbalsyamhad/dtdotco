<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model
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

	public function tampilUser()
	{
		$query=$this->db->query('SELECT *
			FROM user
			JOIN level
			WHERE user.user_level = level.level_id
			ORDER BY user_level');
		return $query->result();
	}

	public function tampilManifest()
	{
		$query=$this->db->query('SELECT *
			FROM manifest
			JOIN user
			WHERE manifest.user_id = user.user_id');
		return $query->result();
	}

	public function tampilLevel()
	{
		$query=$this->db->get('level');
		return $query->result();
	}

	public function tampilMenu()
	{
		$query=$this->db->get('menu');
		return $query->result();
	}

	public function tampilTransaksiGM($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('user','transaksi.user_id = user.user_id');
		$this->db->order_by('tanggal','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilTransaksiVP($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('user','transaksi.user_id = user.user_id');
		$this->db->order_by('tanggal','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilTransaksiAc()
	{
		$query = $this->db->query('SELECT *
			FROM transaksi
			JOIN user
			WHERE user.user_id = transaksi.user_id 
			AND transaksi.aggrement_gm = "YES"
			AND transaksi.aggrement_vp = "YES"
			AND transaksi.approval_gm = "YES"
			AND transaksi.approval_vp = "YES"');
		return $query->result();
	}

	public function tampilTransaksiCus()
	{
		$query = $this->db->query('SELECT *
			FROM transaksi
			JOIN user
			WHERE user.user_id = transaksi.user_id');
		return $query->result();
	}

	public function tampilTransaksiSE($perPage,$uri)
	{
		$id = $this->session->userdata('user_id');

		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('user','transaksi.user_id = user.user_id');
		$this->db->order_by('tanggal','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilTransaksiSM($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('user','transaksi.user_id = user.user_id');
		$this->db->order_by('tanggal','DESC');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function hapusSales($id_transaksi)
	{
		$this->db->where('id_transaksi',$id_transaksi);
  		$this->db->delete('transaksi');
	}

	public function tampilVisa($perPage,$uri)
	{
		$this->db->select('*');
		$this->db->from('visa');
		$this->db->join('user','visa.user_id = user.user_id');
		$this->db->order_by('tanggal','DESC');
		$this->db->where('id_visa > 1489');
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilReport()
	{
		$query = $this->db->query('SELECT *
			FROM report
			JOIN user
			WHERE report.user_id = user.user_id');
		return $query->result();
	}

	public function tampilTicket()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM ticket
			JOIN user
			WHERE ticket.user_id = user.user_id
			AND user.user_id = '.$id);
		return $query->result();
	}

	public function tampilTicket1()
	{
		$query = $this->db->query('SELECT *
			FROM ticket
			JOIN user
			WHERE ticket.user_id = user.user_id');
		return $query->result();
	}

	public function tampilPerusahaan()
	{
		$query = $this->db->get('perusahaan');
		return $query->result();
	}

	public function tampilPerusahaan1()
	{
		$query = $this->db->query('SELECT *
			FROM perusahaan
			WHERE keterangan_perusahaan = "Diterima"');
		return $query->result();
	}

	public function tampilPerusahaan2()
	{
		$query = $this->db->query('SELECT *
			FROM perusahaan
			WHERE keterangan_perusahaan = "Belum Diterima"');
		return $query->result();
	}

	public function tambahTransaksiSE()
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'background' => $this->input->post('background'),
   				'address' => $this->input->post('address'),
   				'phone' => $this->input->post('phone'),
   				'pic' => $this->input->post('pic'),
   				'credit_facilities' => $this->input->post('credit_facilities'),
   				'tanggal' => $this->input->post('tanggal'),
   				'sales_month' => $this->input->post('sales_month'),
   				'credit_limit' => $this->input->post('credit_limit'),
   				'comments' => $this->input->post('comments'),
   				'aggrement_gm' => $this->input->post('aggrement_gm'),
   				'aggrement_vp' => $this->input->post('aggrement_vp'),
   				'approval_gm' => $this->input->post('approval_gm'),
   				'approval_vp' => $this->input->post('approval_vp')
  				);

		$query = $this->db->insert('transaksi',$data);
		return $query;
	}

	public function tambahReport()
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'month' => $this->input->post('month'),
   				'year' => $this->input->post('year'),
   				'sales' => $this->input->post('sales')
  				);

		$query = $this->db->insert('report',$data);
		return $query;
	}

	public function tambahTransaksiSM()
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'background' => $this->input->post('background'),
   				'address' => $this->input->post('address'),
   				'phone' => $this->input->post('phone'),
   				'pic' => $this->input->post('pic'),
   				'credit_facilities' => $this->input->post('credit_facilities'),
   				'tanggal' => $this->input->post('tanggal'),
   				'sales_month' => $this->input->post('sales_month'),
   				'credit_limit' => $this->input->post('credit_limit'),
   				'comments' => $this->input->post('comments'),
   				'aggrement_gm' => $this->input->post('aggrement_gm'),
   				'aggrement_vp' => $this->input->post('aggrement_vp'),
   				'approval_gm' => $this->input->post('approval_gm'),
   				'approval_vp' => $this->input->post('approval_vp')
  				);

		$query = $this->db->insert('transaksi',$data);
		return $query;
	}

	public function tambahVisa()
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'tanggal' => $this->input->post('tanggal'),
   				'nama_travel' => $this->input->post('nama_travel'),
   				'no_group' => $this->input->post('no_group'),
   				'provider' => $this->input->post('provider'),
   				'jumlah_pax' => $this->input->post('jumlah_pax'),
   				'status' => $this->input->post('status'),
   				'kedutaan' => $this->input->post('kedutaan'),
   				'input_visa' => $this->input->post('input_visa'),
   				'comment' => $this->input->post('comment'),
   				'tgl_berangkat' => $this->input->post('tgl_berangkat'),
   				'manifest' => $this->input->post('manifest'),
   				'paspor_masuk' => $this->input->post('paspor_masuk'),
   				'barcode' => $this->input->post('barcode'),
   				'paket_informasi' => $this->input->post('paket_informasi')
  				);

		$query = $this->db->insert('visa',$data);
		return $query;
	}

	public function tambahPerusahaan()
	{
		$data = array(
   				'nama_perusahaan' => $this->input->post('nama_perusahaan'),
   				'keterangan_perusahaan' => $this->input->post('keterangan_perusahaan')
  				);

		$query = $this->db->insert('perusahaan',$data);
		return $query;
	}

	public function tambahUser()
	{
		$user_nama = $_POST['user_nama'];
		$user_username = $_POST['user_username'];
		$user_password = $_POST['user_password'];
		$user_level = $_POST['user_level'];

		$query = "INSERT into user (user_nama,user_username,user_password,user_level) VALUES ('$user_nama','$user_username',MD5('$user_password'),'$user_level')";
		$result = $this->db->query($query);
		return $result;
	}

	public function ubahPassword()
	{
		$data['user_password'] = MD5($_POST['user_password']);

		$this->db->where('user_id',$_POST['user_id']);
		$this->db->update('user',$data);
	}

	public function tambahLevel()
	{
		$data = array(
   				'level_nama' => $this->input->post('level_nama')
  				);

		$query = $this->db->insert('level',$data);
		return $query;
	}

	public function tambahMenu()
	{
		$data = array(
   				'menu_nama' => $this->input->post('menu_nama'),
   				'menu_uri' => $this->input->post('menu_uri'),
   				'menu_allowed' => $this->input->post('menu_allowed')
  				);

		$query = $this->db->insert('menu',$data);
		return $query;
	}

	public function terimaPerusahaan($id_perusahaan)
	{
		$query = $this->db->query('UPDATE perusahaan 
			SET keterangan_perusahaan="Diterima"
			WHERE id_perusahaan='.$id_perusahaan);
	}

	public function ubahTransaksiGM()
	{
		// $data['corporate_name'] = $_POST['corporate_name'];
		// $data['background'] = $_POST['background'];
		// $data['credit_facilities'] = $_POST['credit_facilities'];
		// $data['tanggal'] = $_POST['tanggal'];
		// $data['sales_month'] = $_POST['sales_month'];
		// $data['credit_limit'] = $_POST['credit_limit'];
		$data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		$data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_transaksi',$_POST['id_transaksi']);
		$this->db->update('transaksi',$data);
	}

	public function ubahTransaksiSM()
	{
		$data['corporate_name'] = $_POST['corporate_name'];
		$data['background'] = $_POST['background'];
		$data['address'] = $_POST['address'];
		$data['phone'] = $_POST['phone'];
		$data['pic'] = $_POST['pic'];
		$data['credit_facilities'] = $_POST['credit_facilities'];
		$data['tanggal'] = $_POST['tanggal'];
		$data['sales_month'] = $_POST['sales_month'];
		$data['credit_limit'] = $_POST['credit_limit'];
		$data['comments'] = $_POST['comments'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_transaksi',$_POST['id_transaksi']);
		$this->db->update('transaksi',$data);
	}

	public function ubahTransaksiSE()
	{
		$data['corporate_name'] = $_POST['corporate_name'];
		$data['background'] = $_POST['background'];
		$data['address'] = $_POST['address'];
		$data['phone'] = $_POST['phone'];
		$data['pic'] = $_POST['pic'];
		$data['credit_facilities'] = $_POST['credit_facilities'];
		$data['tanggal'] = $_POST['tanggal'];
		$data['sales_month'] = $_POST['sales_month'];
		$data['comments'] = $_POST['comments'];
		// $data['credit_limit'] = $_POST['credit_limit'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_transaksi',$_POST['id_transaksi']);
		$this->db->update('transaksi',$data);
	}

	public function ubahVisa()
	{
		$data['nama_travel'] = $_POST['nama_travel'];
		$data['tgl_berangkat'] = $_POST['tgl_berangkat'];
		$data['jumlah_pax'] = $_POST['jumlah_pax'];
		$data['paspor_masuk'] = $_POST['paspor_masuk'];
		$data['comment'] = $_POST['comment'];
		$data['manifest'] = $_POST['manifest'];
		$data['no_group'] = $_POST['no_group'];
		$data['provider'] = $_POST['provider'];
		$data['pengambilan_paspor'] = $_POST['pengambilan_paspor'];
		$data['input_visa'] = $_POST['input_visa'];
		$data['barcode'] = $_POST['barcode'];
		$data['kedutaan'] = $_POST['kedutaan'];
		$data['paket_informasi'] = $_POST['paket_informasi'];

		$this->db->where('id_visa',$_POST['id_visa']);
		$this->db->update('visa',$data);
	}

	public function ubahVisa1()
	{
		$data['nama_travel'] = $_POST['nama_travel'];
		$data['tgl_berangkat'] = $_POST['tgl_berangkat'];
		$data['jumlah_pax'] = $_POST['jumlah_pax'];
		$data['paspor_masuk'] = $_POST['paspor_masuk'];
		$data['comment'] = $_POST['comment'];
		$data['manifest'] = $_POST['manifest'];
		$data['no_group'] = $_POST['no_group'];
		$data['provider'] = $_POST['provider'];
		$data['pengambilan_paspor'] = $_POST['pengambilan_paspor'];
		$data['input_visa'] = $_POST['input_visa'];
		$data['barcode'] = $_POST['barcode'];
		$data['kedutaan'] = $_POST['kedutaan'];
		$data['status'] = $_POST['status'];
		$data['paket_informasi'] = $_POST['paket_informasi'];

		$this->db->where('id_visa',$_POST['id_visa']);
		$this->db->update('visa',$data);
	}

	public function ubahVisa2()
	{
		// $data['nama_travel'] = $_POST['nama_travel'];
		// $data['no_group'] = $_POST['no_group'];
		// $data['provider'] = $_POST['provider'];
		// $data['jumlah_pax'] = $_POST['jumlah_pax'];
		// $data['status'] = $_POST['status'];
		$data['manifest'] = $_POST['manifest'];
		$data['comment'] = $_POST['comment'];
		// $data['no_group'] = $_POST['no_group'];
		// $data['provider'] = $_POST['provider'];
		$data['input_visa'] = $_POST['input_visa'];
		$data['barcode'] = $_POST['barcode'];
		$data['kedutaan'] = $_POST['kedutaan'];
		$data['paket_informasi'] = $_POST['paket_informasi'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_visa',$_POST['id_visa']);
		$this->db->update('visa',$data);
	}

	public function ubahVisa3()
	{
		// $data['nama_travel'] = $_POST['nama_travel'];
		// $data['no_group'] = $_POST['no_group'];
		// $data['provider'] = $_POST['provider'];
		// $data['jumlah_pax'] = $_POST['jumlah_pax'];
		// $data['status'] = $_POST['status'];
		$data['kedutaan'] = $_POST['kedutaan'];
		$data['comment'] = $_POST['comment'];
		// $data['no_group'] = $_POST['no_group'];
		// $data['provider'] = $_POST['provider'];
		// $data['input_visa'] = $_POST['input_visa'];
		// $data['barcode'] = $_POST['barcode'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_visa',$_POST['id_visa']);
		$this->db->update('visa',$data);
	}

	public function ubahVisa4()
	{
		$data['nama_travel'] = $_POST['nama_travel'];
		$data['tgl_berangkat'] = $_POST['tgl_berangkat'];
		$data['jumlah_pax'] = $_POST['jumlah_pax'];
		$data['paspor_masuk'] = $_POST['paspor_masuk'];
		$data['kedutaan'] = $_POST['kedutaan'];
		$data['input_visa'] = $_POST['input_visa'];
		$data['comment'] = $_POST['comment'];
		$data['no_group'] = $_POST['no_group'];
		$data['provider'] = $_POST['provider'];
		$data['status'] = $_POST['status'];
		$data['manifest'] = $_POST['manifest'];
		$data['barcode'] = $_POST['barcode'];
		$data['pengambilan_paspor'] = $_POST['pengambilan_paspor'];
		$data['paket_informasi'] = $_POST['paket_informasi'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_visa',$_POST['id_visa']);
		$this->db->update('visa',$data);
	}

	public function ubahVisa5()
	{
		$data['input_visa'] = $_POST['input_visa'];
		$data['comment'] = $_POST['comment'];
		$data['manifest'] = $_POST['manifest'];
		$data['barcode'] = $_POST['barcode'];
		$data['kedutaan'] = $_POST['kedutaan'];
		$data['pengambilan_paspor'] = $_POST['pengambilan_paspor'];
		$data['paspor_masuk'] = $_POST['paspor_masuk'];
		$data['paket_informasi'] = $_POST['paket_informasi'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_visa',$_POST['id_visa']);
		$this->db->update('visa',$data);
	}

	public function terimaAggrementGM($id_transaksi){
		$query = $this->db->query('Update transaksi set aggrement_gm="YES" WHERE id_transaksi='.$id_transaksi);
	}

	public function terimaAggrementVP($id_transaksi){
		$query = $this->db->query('Update transaksi set aggrement_vp="YES" WHERE id_transaksi='.$id_transaksi);
	}

	public function terimaApprovalGM($id_transaksi){
		$query = $this->db->query('Update transaksi set approval_gm="YES" WHERE id_transaksi='.$id_transaksi);
	}

	public function terimaApprovalVP($id_transaksi){
		$query = $this->db->query('Update transaksi set approval_vp="YES" WHERE id_transaksi='.$id_transaksi);
	}

	public function terimaVisa($id_visa){
		$query = $this->db->query('Update visa set status="PAID" WHERE id_visa='.$id_visa);
	}

	function tambahManifest($nama_file) {
		$user_id = $this->input->post('user_id');
		$judul = $this->input->post('judul');
		
		$query = "INSERT INTO manifest (user_id , judul, file) 
					VALUES ('$user_id','$judul','$nama_file')";
		$this->db->query($query);
	}

	public function tambahManifest1($data)
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'judul' => $this->input->post('judul'),
   				'file' => $this->input->post('file')
  				);

		$query = $this->db->insert('manifest',$data);
		return $query;
	}

	function tambahTicket($nama_file) {
		$user_id = $this->input->post('user_id');
		$dari_tgl = $this->input->post('dari_tgl');
		$sampai_tgl = $this->input->post('sampai_tgl');
		
		$query = "INSERT INTO ticket (user_id , dari_tgl , sampai_tgl , file) 
					VALUES ('$user_id','$dari_tgl','$sampai_tgl','$nama_file')";
		$this->db->query($query);
	}

	public function tambahTicket1($data)
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'dari_tgl' => $this->input->post('dari_tgl'),
   				'sampai_tgl' => $this->input->post('sampai_tgl'),
   				'file' => $this->input->post('file')
  				);

		$query = $this->db->insert('ticket',$data);
		return $query;
	}

	public function tampilumrah1()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=1
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah2()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=2
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah3()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=3
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah4()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=4
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	
	public function tampilUmrah5()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=5
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah6()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=6
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah7()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=7
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah8()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=8
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah9()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=9
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tampilUmrah10()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=10
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	
	public function tampilUmrah11()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter=11
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	
	public function tampilUmrah12()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= "12"
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah13()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 13
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah14()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 14
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah15()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 15
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	//start 2016
	public function tampilUmrah16()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 16
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah17()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 17
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah18()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 18
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah19()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 19
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah20()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 20
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah21()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 21
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah22()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 22
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah23()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 23
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah24()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 24
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah25()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 25
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah26()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 26
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah27()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 27
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah28()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 28
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah29()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 29
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah30()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 30
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah31()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 31
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah32()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 32
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah33()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 33
			AND umrah.user_id = user.user_id');
		return $query->result();
	}
	public function tampilUmrah34()
	{
		$id = $this->session->userdata('user_id');
		$query = $this->db->query('SELECT *
			FROM umrah 
			JOIN user 
			WHERE kloter= 34
			AND umrah.user_id = user.user_id');
		return $query->result();
	}

	public function tambahUmrah1()
	{
		$where['nama'] = $this->input->post('nama');
                            $a = $this->db->get_where('customer_contact',$where)->row();
                            $dua = $data['customer_contact'] = $a->id_contact;

		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'nama' => $this->input->post('nama'),
   				'status' => $this->input->post('status'),
   				'deposit' => $this->input->post('deposit'),
   				'paid' => $this->input->post('paid'),
   				'perlengkapan' => $this->input->post('perlengkapan'),
   				'kloter' => $this->input->post('kloter'),
   				'comment' => $this->input->post('comment'),
   				'sumber' => $this->input->post('sumber'),
   				'id_contact' => $dua,
  				);

		$query = $this->db->insert('umrah',$data);
		return $query;
	}

	public function tambahUmrah2()
	{
		$where['nama'] = $this->input->post('nama');
                            $a = $this->db->get_where('customer_contact',$where)->row();
                            $dua = $data['customer_contact'] = $a->id_contact;

		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'nama' => $this->input->post('nama'),
   				'status' => $this->input->post('status'),
   				'deposit' => $this->input->post('deposit'),
   				'paid' => $this->input->post('paid'),
   				'perlengkapan' => $this->input->post('perlengkapan'),
   				'kloter' => $this->input->post('kloter'),
   				'comment' => $this->input->post('comment'),
   				'sumber' => $this->input->post('sumber'),
   				'id_contact' => $dua
  				);

		$query = $this->db->insert('umrah',$data);
		return $query;
	}

	public function tambahUmrah3()
	{
		$where['nama'] = $this->input->post('nama');
                            $a = $this->db->get_where('customer_contact',$where)->row();
                            $dua = $data['customer_contact'] = $a->id_contact;

		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'nama' => $this->input->post('nama'),
   				'status' => $this->input->post('status'),
   				'deposit' => $this->input->post('deposit'),
   				'paid' => $this->input->post('paid'),
   				'perlengkapan' => $this->input->post('perlengkapan'),
   				'kloter' => $this->input->post('kloter'),
   				'id_contact' => $dua,
   				'comment' => $this->input->post('comment'),
   				'sumber' => $this->input->post('sumber'),
  				);

		$query = $this->db->insert('umrah',$data);
		return $query;
	}

	public function hapusUmrah($id_umrah)
	{
		$this->db->where('id_umrah',$id_umrah);
  		$this->db->delete('umrah');
	}
	
	public function hapusUmrahContact($id_umrah)
	{
		$where['id_umrah'] = $id_umrah;
                            $a = $this->db->get_where('umrah',$where)->row();
                            $dua = $da['umrah'] = $a->id_contact;

        $this->db->where('id_contact',$dua);
  		$this->db->delete('customer_contact');


	}

	public function hapusVisa($id_visa)
	{
		$this->db->where('id_visa',$id_visa);
  		$this->db->delete('visa');
	}

	public function ubahUmrahContact(){
		if ($_POST['id_contact']==0) {
			$data = array(
				'nama' => $this->input->post('nama'),
				'hp' => $this->input->post('hp'),
				'tgl_lahir' => $this->input->post('lahir'),
				'email' => $this->input->post('email'),
				'lokasi' => $this->input->post('lokasi'),
				'jenis_kelamin' => $this->input->post('kelamin'),
				'jenis' => "1",
				);

			$query = $this->db->insert('customer_contact',$data);
			return $query;
		}
		if ($_POST['id_contact']<>0){
			$data = array(
				'nama' => $this->input->post('nama'),
				'hp' => $this->input->post('hp'),
				'tgl_lahir' => $this->input->post('lahir'),
				'email' => $this->input->post('email'),
				'lokasi' => $this->input->post('lokasi'),
				'jenis_kelamin' => $this->input->post('kelamin'),
				'jenis' => "1",
				);

			$this->db->where('id_contact',$_POST['id_contact']);
			$this->db->update('customer_contact',$data);
		}
	}

	public function ubahUmrah(){
		$where['nama'] = $this->input->post('nama');
		$a = $this->db->get_where('customer_contact',$where)->row();
		$dua = $dataa['customer_contact'] = $a->id_contact;

		$data['nama'] = $_POST['nama'];
		$data['status'] = $_POST['status'];
		$data['deposit'] = $_POST['deposit'];
		$data['paid'] = $_POST['paid'];
		$data['perlengkapan'] = $_POST['perlengkapan'];
		$data['sumber'] = $_POST['sumber'];
		$data['comment'] = $_POST['comment'];
		$data['id_contact'] = $dua;
		// var_dump($data);
		$this->db->where('id_umrah',$_POST['id_umrah']);
		$this->db->update('umrah',$data);
	}
	
	public function jumlahAlfauzan(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_alfauzan from visa where provider="AL FAUZAN" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahAlaa(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_alaa from visa where provider="ALAA" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahEdi(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_edipeni from visa where provider="EDI PENI" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahMazaya(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_mazaya from visa where provider="MAZAYA" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahAlwan(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_alwan from visa where provider="ALWAN" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahNebras(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_nebras from visa where provider="NEBRAS" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahRazek(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_razek from visa where provider="RAZEK" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahWaisam(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_waisam from visa where provider="AL WAISAM" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahAmanah(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_amanah from visa where provider="AMANAH" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahTunsi(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_tunsi from visa where provider="AL TUNSI" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahElaf(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_elaf from visa where provider="ELAF" AND id_visa > 1489');
		return $query->result();
	}

	public function jumlahAlmassa(){
		$query = $this->db->query('SELECT SUM(jumlah_pax) as j_almassa from visa where provider="AL MASSA" AND id_visa > 1489');
		return $query->result();
	}

	public function cariVisa(){
		$query=$this->db->query("SELECT *
			FROM visa JOIN user WHERE visa.user_id = user.user_id
			AND visa.nama_travel LIKE '%$_GET[q]%'
			ORDER BY (visa.tanggal) DESC");
		return $query->result();
	}

	public function cariVisa1(){
		$query=$this->db->query("SELECT *
			FROM visa JOIN user WHERE visa.user_id = user.user_id
			AND visa.no_group LIKE '%$_GET[q]%'
			ORDER BY (visa.tanggal) DESC");
		return $query->result();
	}

	public function cariSales(){
		$query=$this->db->query("SELECT *
			FROM transaksi JOIN user WHERE transaksi.user_id = user.user_id
			AND transaksi.corporate_name LIKE '%$_GET[q]%'
			ORDER BY (transaksi.tanggal) DESC");
		return $query->result();
	}

	public function tambahLembur()
	{
		$jam_mulai =  $this->input->post('jam_mulai');
		$jam_selesai =  $this->input->post('jam_selesai');
		$total_jam = round((strtotime($jam_selesai) - strtotime($jam_mulai))/3600, 1);
		$data = array(
			'user_lembur' => $this->input->post('user_lembur'),
			'tanggal' => $this->input->post('tanggal'),
			'jam_mulai' => $this->input->post('jam_mulai'),
			'jam_selesai' => $this->input->post('jam_selesai'),
			'permintaan' => $this->input->post('permintaan'),
			'intruksi' => $this->input->post('intruksi'),
			'uraian' => $this->input->post('uraian'),
			'total_jam' => $total_jam
			);

		$query = $this->db->insert('lembur',$data);
		return $query;
	}

	public function tampilLembur()
	{
		$query=$this->db->query('SELECT * from lembur_user where jenis !="visa" ORDER BY nama');
		return $query->result();
	}

	public function tampilDataLembur()
	{
		$query=$this->db->query('SELECT id_lembur, nama, tanggal, jam_mulai, jam_selesai, (select timediff(jam_selesai,jam_mulai)) as jumlah_jam, uraian FROM lembur
			JOIN lembur_user
			WHERE lembur.user_lembur = lembur_user.user_lembur
			AND tanggal BETWEEN "2016-05-25' AND '2016-06-24"
			ORDER BY lembur_user.nama ASC, tanggal ASC');
		return $query->result();
	}

	public function tampilTotalLembur()
	{
		$query=$this->db->query('SELECT nama, TIME( SUM( TIMEDIFF( jam_selesai, jam_mulai ) ) ) as total
			FROM lembur
			JOIN lembur_user
			WHERE lembur.user_lembur = lembur_user.user_lembur
			AND tanggal BETWEEN "2016-05-25' AND '2016-06-24"
			GROUP BY nama
			ORDER BY nama ASC');
		return $query->result();
	}

	public function tampilDataTugas()
	{
		$query=$this->db->query('SELECT id_tugas, nama, tanggal, uraian, pelaksanaan, hasil, status
			FROM tugas
			JOIN lembur_user
			WHERE tugas.user_lembur = lembur_user.user_lembur
			ORDER BY nama ASC');
		return $query->result();
	}
	
	public function ubahStatusTugas($id_tugas){
		$query = $this->db->query('update tugas set status="DONE" where id_tugas='.$id_tugas);
	}

	public function ubahTugas()
	{
		$data['uraian'] = $_POST['uraian'];
		$data['pelaksanaan'] = $_POST['pelaksanaan'];
		$data['hasil'] = $_POST['hasil'];
		$data['status'] = $_POST['status'];

		$this->db->where('id_tugas',$_POST['id_tugas']);
		$this->db->update('tugas',$data);
	}

	public function hapusTugas($id_tugas){
		$this->db->where('id_tugas',$id_tugas);
  		$this->db->delete('tugas');
	}

	public function tampilDataAbsen()
	{
		$query=$this->db->query('SELECT id_absen, nama, nilai, bulan
			FROM absen
			JOIN lembur_user
			WHERE absen.user_lembur = lembur_user.user_lembur
			ORDER BY nama ASC');
		return $query->result();
	}

	public function ubahLembur()
	{
		$data['tanggal'] = $_POST['tanggal'];
		$data['jam_mulai'] = $_POST['jam_mulai'];
		$data['jam_selesai'] = $_POST['jam_selesai'];
		$data['uraian'] = $_POST['uraian'];
		// $data['user_lembur'] = $_POST['user_lembur'];
		// $data['aggrement_gm'] = $_POST['aggrement_gm'];
		// $data['aggrement_vp'] = $_POST['aggrement_vp'];
		// $data['approval_gm'] = $_POST['approval_gm'];
		// $data['approval_vp'] = $_POST['approval_vp'];

		$this->db->where('id_lembur',$_POST['id_lembur']);
		$this->db->update('lembur',$data);
	}

	public function tambahKaryawan()
	{
		$data = array(
   				'user_lembur' => $this->input->post('user_lembur'),
   				'tanggal' => $this->input->post('tanggal'),
   				'uraian' => $this->input->post('uraian'),
   				'pelaksanaan' => $this->input->post('pelaksanaan'),
   				'hasil' => $this->input->post('hasil'),
   				'status' => $this->input->post('status')
  				);

		$query = $this->db->insert('tugas',$data);
		return $query;
	}

	public function tambahAbsen()
	{
		$data = array(
   				'user_lembur' => $this->input->post('user_lembur'),
   				'bulan' => $this->input->post('bulan'),
   				'nilai' => $this->input->post('nilai')
  				);

		$query = $this->db->insert('absen',$data);
		return $query;
	}
	
	// start calender

		public function calender1(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 1');
		return $query->result();
		}

		public function calender2(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 2');
		return $query->result();
		}

		public function calender3(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 3');
		return $query->result();
		}

		public function calender4(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 4');
		return $query->result();
		}

		public function calender5(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 5');
		return $query->result();
		}

		public function calender6(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 6');
		return $query->result();
		}

		public function calender7(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 7');
		return $query->result();
		}

		public function calender8(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 8');
		return $query->result();
		}
		public function calender9(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 9');
		return $query->result();
		}

		public function calender10(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 10');
		return $query->result();
		}

		public function calender11(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan =11');
		return $query->result();
		}

		public function calender12(){
			$query = $this->db->query('SELECT *
			FROM calender
			WHERE id_bulan = 12');
		return $query->result();
		}

		// create
		function tambah_calender($data){
		$data = array(
   				'target' => $this->input->post('target'),
   				'uraian' => $this->input->post('uraian'),
   				'id_bulan' => $this->input->post('id_bulan'),
   				'appointment' => $this->input->post('appoinment'),
   				'tahun' => $this->input->post('tahun')
  				);

		$query = $this->db->insert('calender',$data);
		return $query;
	}

	//delete
	function hapus_calender($id_calender){
		$this->db->where('id_calender',$id_calender);
  		$this->db->delete('calender');

	}

	public function tampilDataEO()
	{
		$query=$this->db->query('SELECT * FROM eo
			JOIN user 
			WHERE user.user_id = eo.user_id');
		return $query->result();
	}

	public function tambah_transaksi_eo(){
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'tanggal' => $this->input->post('tanggal'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'pic' => $this->input->post('pic'),
   				'pelaksanaan' => $this->input->post('pelaksanaan'),
   				'uraian' => $this->input->post('uraian')
  				);

		$query = $this->db->insert('eo',$data);
		return $query;
	}
	
	
	//update calender
	public function ubahCalender(){
		$data['target'] = $_POST['target'];
		$data['uraian'] = $_POST['uraian'];
		$data['appointment'] = $_POST['appointment'];
		$data['id_bulan'] = $_POST['id_bulan'];
		$data['status'] = $_POST['status'];

		$this->db->where('id_calender',$_POST['id_calender']);
		$this->db->update('calender',$data);
	}
	
		public function ubahStatusCalender($id_calender){
		$query= $this->db->query('update calender set status="done" where id_calender='.$id_calender);
	}
	
	//delete EO
	public function hapus_Eo($id_eo){
		$this->db->where('id_eo',$id_eo);
  		$this->db->delete('eo');
	}

	//edit EO
	public function ubah_Eo(){
		$data['corporate_name'] = $_POST['corporate_name'];
		$data['pic'] = $_POST['pic'];
		$data['pelaksanaan'] = $_POST['pelaksanaan'];
		$data['uraian'] = $_POST['uraian'];
		$data['status'] = $_POST['status'];

		$this->db->where('id_eo',$_POST['id_eo']);
		$this->db->update('eo',$data);
	}

	//ubah status Eo
	public function ubahStatusEo($id_eo){
		$query= $this->db->query('update eo set status="done" where id_eo='.$id_eo);
	}

	public function carter1_1_tambah($data)
	{
		$query = $this->db->insert('carter_pemesanan',$data);
		return $query;
	}

	public function tampilContact($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact');

		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}
	
	public function tampilContactumrah1($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=1');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah2($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=2');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah3($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=3');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah4($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=4');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah5($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=5');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah6($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=6');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah7($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=7');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah8($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=8');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah9($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=9');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah10($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=10');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function tampilContactumrah11($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
AND u.user_id = h.user_id and kloter=11');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}
	
	public function tampilContactumrah12($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=12');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah13($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=13');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah14($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=14');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}
	
	public function tampilContactumrah15($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=15');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}
	//start for 2016
	public function tampilContactumrah16($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=16');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah17($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=17');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah18($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=18');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah19($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=19');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah20($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=20');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah21($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=21');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah22($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=22');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah23($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=23');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah24($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=24');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah25($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=25');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah26($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=26');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah27($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=27');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah28($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=28');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah29($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=29');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah30($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=30');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah31($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=31');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah32($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=32');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah33($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=33');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}

	public function tampilContactumrah34($perPage,$uri){

		$this->db->select('*');
		$this->db->from('customer_contact c, user u, umrah h');
		$this->db->where('c.id_contact = h.id_contact
			AND u.user_id = h.user_id and kloter=34');
		
		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
			return $getData->result();
		else
			return null;
	}
	
	public function hapus_contact($id_contact){
		$this->db->where('id_contact',$id_contact);
  		$this->db->delete('customer_contact');
	}

	
	public function simpanContactUmrah(){
		$data = array(
   				'nama' => $this->input->post('nama'),
   				'hp' => $this->input->post('hp'),
   				'tgl_lahir' => $this->input->post('lahir'),
   				'email' => $this->input->post('email'),
   				'lokasi' => $this->input->post('lokasi'),
   				'grade' => $this->input->post('grade'),
   				'jenis' => "1",
  				);

		$query = $this->db->insert('customer_contact',$data);
		return $query;
	}

	public function simpanContact(){
		$data = array(
   				'nama' => $this->input->post('nama'),
   				'hp' => $this->input->post('hp'),
   				'tgl_lahir' => $this->input->post('lahir'),
   				'email' => $this->input->post('email'),
   				'lokasi' => $this->input->post('lokasi'),
   				'grade' => $this->input->post('grade'),
   				'jenis' => "2",
  				);

		$query = $this->db->insert('customer_contact',$data);
		return $query;
	}

	public function update_contact(){
		$data['nama'] = $_POST['nama'];
		$data['hp'] = $_POST['hp'];
		$data['tgl_lahir'] = $_POST['lahir'];
		$data['email'] = $_POST['email'];
		$data['lokasi'] = $_POST['lokasi'];
		$data['grade'] = $_POST['grade'];

		$this->db->where('id_contact',$_POST['id_contact']);
		$this->db->update('customer_contact',$data);
	}

	public function cariContact(){
		$query=$this->db->query("SELECT *
			FROM customer_contact WHERE nama LIKE '%$_GET[q]%' or lokasi LIKE '%$_GET[q]%' or grade LIKE '%$_GET[q]%' ");
		return $query->result();

		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}

	public function birthday(){
		date_default_timezone_set('Asia/Jakarta');
		$month=date("m");
		$date=date("d");
		$query=$this->db->query("SELECT *
			FROM customer_contact WHERE EXTRACT(MONTH FROM tgl_lahir) = '$month' AND EXTRACT(DAY FROM tgl_lahir) = '$date' ORDER BY tgl_lahir ");
		return $query->result();

		$getData = $this->db->get('', $perPage, $uri);
		if($getData->num_rows() > 0)
		return $getData->result();
		else
		return null;
	}
	
	//start calender cuti

	//for cari asli
	public function caricuti(){
		$query=$this->db->query("SELECT *
			FROM lembur_user WHERE user_lembur LIKE '%$_GET[id_user]%' ");
		return $query->result();
	}

	//for simpan
	public function caricuti1(){
		$id_user=$this->input->post('id_user');
		$query=$this->db->query("SELECT *
			FROM lembur_user WHERE user_lembur LIKE '%$id_user%' ");
		return $query->result();
	}

	//for index
	public function caricuti2(){
		$q = mysql_query("SELECT * FROM  `calender_cuti` WHERE id_cal_cuti = ( SELECT MAX( id_cal_cuti ) FROM  `calender_cuti` )");
                if ($row1 = mysql_fetch_array($q)){
                  $id_user=$row1['id_user'];}

		$query=$this->db->query("SELECT *
			FROM lembur_user WHERE user_lembur LIKE '%$id_user%' ");
		return $query->result();
	}

	function tambah_cuti($data){
		$data = array(
   				'id_user' => $this->input->post('id_user'),
   				'tanggal' => $this->input->post('tanggal'),
   				'status' => $this->input->post('status')
  				);

		$query = $this->db->insert('calender_cuti',$data);
		return $query;
	}
	
	public function hapus_cuti($id_cal_cuti){
		$this->db->where('id_cal_cuti',$id_cal_cuti);
  		$this->db->delete('calender_cuti');
	}

	public function ubahCuti(){
		$data['tanggal'] = $_POST['tanggal'];
		$data['status'] = $_POST['status'];

		$this->db->where('id_cal_cuti',$_POST['id_cal_cuti']);
		$this->db->update('calender_cuti',$data);
	}
	
			
			//lembur jilid 2
			//public tanggalawal1 = "2015-06-30";

			public function approveBod()
					{		
				//$tanggalawal=$this->tanggalawal1;			  	 
				//$tanggalahir=$this->tanggalahir2; 
						$bln=getdate(); 
						$bln=$bln[0];
						$bulan = date('Y-m-',$bln);             

						$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
						if ($row1 = mysql_fetch_array($q)){
							$tanggalawal=$row1['nama'];}

							$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
							if ($row1 = mysql_fetch_array($q)){
								$tanggalahir=$row1['nama'];
							}

							$query=$this->db->query("SELECT * FROM lembur 
								JOIN user 
								WHERE user.user_id = lembur.user_lembur 
								AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
								ORDER BY user_nama, tanggal ASC");
							return $query->result();
						}

						public function approveHr()
					{		
				//$tanggalawal=$this->tanggalawal1;			  	 
				//$tanggalahir=$this->tanggalahir2; 
						$bln=getdate(); 
						$bln=$bln[0];
						$bulan = date('Y-m-',$bln);             

						$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
						if ($row1 = mysql_fetch_array($q)){
							$tanggalawal=$row1['nama'];}

							$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
							if ($row1 = mysql_fetch_array($q)){
								$tanggalahir=$row1['nama'];
							}

							$query=$this->db->query("SELECT * FROM lembur 
								JOIN user 
								WHERE user.user_id = lembur.user_lembur AND lembur.bod =  'done'
								AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
								ORDER BY user_nama, tanggal ASC");
							return $query->result();
						}

						public function ubahStatusBod($id_lembur){
							$query= $this->db->query('update lembur set bod="done" where id_lembur='.$id_lembur);
						}

						public function approveManager()
						{
							$bln=getdate(); 
							$bln=$bln[0];
							$bulan = date('Y-m-',$bln);             

							$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
							if ($row1 = mysql_fetch_array($q)){
								$tanggalawal=$row1['nama'];}

								$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
								if ($row1 = mysql_fetch_array($q)){
									$tanggalahir=$row1['nama'];
								} 

								$query=$this->db->query("SELECT * FROM lembur 
									JOIN user 
									WHERE user.user_id = lembur.user_lembur 
									AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
									ORDER BY user_nama, tanggal ASC");
								return $query->result(); 
							}

							public function approveManagerTiket()
							{
								$bln=getdate(); 
								$bln=$bln[0];
								$bulan = date('Y-m-',$bln);             

								$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
								if ($row1 = mysql_fetch_array($q)){
									$tanggalawal=$row1['nama'];}

									$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
									if ($row1 = mysql_fetch_array($q)){
										$tanggalahir=$row1['nama'];
									} 

									$query=$this->db->query("SELECT * FROM lembur 
										JOIN user 
										WHERE user.user_id = lembur.user_lembur 
										AND (user.divisi = 'tiket' or user.divisi ='it') AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
										ORDER BY user_nama, tanggal ASC");
									return $query->result();
								}

								public function approveManagerSales()
								{
									$bln=getdate(); 
									$bln=$bln[0];
									$bulan = date('Y-m-',$bln);             

									$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
									if ($row1 = mysql_fetch_array($q)){
										$tanggalawal=$row1['nama'];}

										$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
										if ($row1 = mysql_fetch_array($q)){
											$tanggalahir=$row1['nama'];
										}

										$query=$this->db->query("SELECT * FROM lembur 
											JOIN user 
											WHERE user.user_id = lembur.user_lembur 
											AND (user.divisi = 'sales' or user.divisi = 'it' or user.divisi ='ta') AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
											ORDER BY user_nama, tanggal ASC");
										return $query->result();
									}

									public function approveManagerBusdev()
									{
										$bln=getdate(); 
										$bln=$bln[0];
										$bulan = date('Y-m-',$bln);             

										$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
										if ($row1 = mysql_fetch_array($q)){
											$tanggalawal=$row1['nama'];}

											$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
											if ($row1 = mysql_fetch_array($q)){
												$tanggalahir=$row1['nama'];
											} 

											$query=$this->db->query("SELECT * FROM lembur 
												JOIN user 
												WHERE user.user_id = lembur.user_lembur 
												AND (user.divisi = 'busdev' or user.divisi ='it') AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
												ORDER BY user_nama, tanggal ASC");
											return $query->result();
										}

										public function approveManagerHoliday()
										{
											$bln=getdate(); 
											$bln=$bln[0];
											$bulan = date('m',$bln);            
											$tahun = date('Y',$bln);             

											$q = mysql_query("SELECT '$tahun.-.$bulan.-.25' - INTERVAL '1' MONTH as nama ");
											if ($row1 = mysql_fetch_array($q)){
												$tanggalawal=$row1['nama'];}

												$q = mysql_query("SELECT '$tahun.-.$bulan.-.24' - INTERVAL '0' MONTH as nama ");
												if ($row1 = mysql_fetch_array($q)){
													$tanggalahir=$row1['nama'];
												} 

												$query=$this->db->query("SELECT * FROM lembur 
													JOIN user 
													WHERE user.user_id = lembur.user_lembur 
													AND (user.divisi = 'holiday' or user.divisi ='it') AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
													ORDER BY user_nama, tanggal ASC");
												return $query->result();
											}

											public function approveManagerAkunting()
											{
												$bln=getdate(); 
												$bln=$bln[0];
												$bulan = date('Y-m-',$bln);             

												$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
												if ($row1 = mysql_fetch_array($q)){
													$tanggalawal=$row1['nama'];}

													$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
													if ($row1 = mysql_fetch_array($q)){
														$tanggalahir=$row1['nama'];
													} 

													$query=$this->db->query("SELECT * FROM lembur 
														JOIN user 
														WHERE user.user_id = lembur.user_lembur 
														AND (user.divisi = 'akunting' or user.divisi ='it') AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
														ORDER BY user_nama, tanggal ASC");
													return $query->result();
												}

												public function approveManagerPatty()
												{
											$bln=getdate(); 
											$bln=$bln[0];
											$bulan = date('m',$bln);            
											$tahun = date('Y',$bln);             

											$q = mysql_query("SELECT '$tahun.-.$bulan.-.25' - INTERVAL '1' MONTH as nama ");
											if ($row1 = mysql_fetch_array($q)){
												$tanggalawal=$row1['nama'];}

												$q = mysql_query("SELECT '$tahun.-.$bulan.-.24' - INTERVAL '0' MONTH as nama ");
												if ($row1 = mysql_fetch_array($q)){
													$tanggalahir=$row1['nama'];
												} 

												$query=$this->db->query("SELECT * FROM lembur 
													JOIN user 
													WHERE user.user_id = lembur.user_lembur 
													AND (user.divisi = 'tiket' or user.divisi ='it' or user.divisi='sales') AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
													ORDER BY user_nama, tanggal ASC");
												return $query->result();
											}


													public function ubahStatusManager($id_lembur){
														$query= $this->db->query('update lembur set manager="done" where id_lembur='.$id_lembur);
													}

													public function carinama(){
														$bln=getdate(); 
														$bln=$bln[0];
														$bulan = date('Y-m-',$bln);             

														$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
														if ($row1 = mysql_fetch_array($q)){
															$tanggalawal=$row1['nama'];}

															$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
															if ($row1 = mysql_fetch_array($q)){
																$tanggalahir=$row1['nama'];
															}

															$query=$this->db->query("SELECT * FROM lembur 
																JOIN user 
																WHERE user.user_id = lembur.user_lembur 
																AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
																AND user.user_id
																LIKE '$_GET[id_user]'
																AND tanggal BETWEEN '2018-09-25' AND '2018-10-25'
																ORDER BY user_nama, tanggal ASC");
															return $query->result();
														}

														public function lemburanku()
														{	$bln=getdate(); 
															$bln=$bln[0];
															$bulan = date('Y-m-',$bln);             

															$q = mysql_query("SELECT '$bulan-25' - INTERVAL '2' MONTH as nama ");
															if ($row1 = mysql_fetch_array($q)){
																$tanggalawal=$row1['nama'];}

																$q = mysql_query("SELECT '$bulan-24' - INTERVAL '1' MONTH as nama ");
																if ($row1 = mysql_fetch_array($q)){
																	$tanggalahir=$row1['nama'];
																}

																$user_id = $this->session->userdata('user_id');
																$query=$this->db->query("SELECT * FROM lembur
																	JOIN user 
																	WHERE user.user_id = lembur.user_lembur AND tanggal BETWEEN '2018-09-25' AND '2018-10-25' and user.user_id='$user_id' ORDER BY user_nama, tanggal ASC");
																return $query->result();
															}

															public function hapusNol()
															{
																$this->db->where('user_lembur',0);
																$this->db->delete('lembur');
															}
				
		//start for member
		public function cek_bemember(){
			$where['nama'] = $this->input->post('nama');
			$a = $this->db->get_where('customer_contact',$where)->row();
			$dua = $da['customer_contact'] = $a->id_contact;

			$data['nama'] = $_POST['nama'];
			$data['tgl_lahir'] = $_POST['tgl_lahir'];
			$data['hp'] = $_POST['hp'];
			$data['email'] = $_POST['email'];
			$data['lokasi'] = $_POST['lokasi'];
			$this->db->where('id_contact',$_POST['id_contact']);
			$this->db->update('customer_contact',$data);
		}

		public function tampilContactMember($perPage,$uri){

			$query = $this->db->query('SELECT * FROM customer_contact WHERE id_contact NOT IN (SELECT id_contact FROM tb_poin_member)');
			return $query->result();

			$getData = $this->db->get('', $perPage, $uri);
			if($getData->num_rows() > 0)
				return $getData->result();
			else
				return null;
		}

		public function simpanMember(){ //untuk yang sudah jadi customer
			//$max="SELECT count(id_member)+1 as num FROM tb_poin_member";
			//$maxquery= mysql_query($max) or die (died);
			//while($row = mysql_fetch_assoc($maxquery)) {
			//	$urut=$row['num'];}

			$max ="select max(id_member) as max
			from tb_poin_member";
			$maxquery= mysql_query($max);
			while($row = mysql_fetch_assoc($maxquery)) {
				$uruts=$row['max'];}

				$urut = "select urut from tb_poin_member
				where id_member = '$uruts' ";
				$urut1= mysql_query($urut);
				while($row = mysql_fetch_assoc($urut1)) {
					$urut2=$row['urut'];}
					if ($urut2==9999) {
						$urut2=0+1;
					} else{
						$urut2=$urut2+1;
					}

					$bulan = '0'.$_POST['bulan'];
					$tanggal = $_POST['tanggal'].$bulan.$_POST['tahun'];
					$urut = $urut2;
					$id_contact = $_POST['id_contact'];
					$poin = $_POST['poin'];
					$kategori = $_POST['kategori'];

					$data2 = array($kategori, $tanggal, $urut, $id_contact, $poin);

					$sql = "INSERT INTO tb_poin_member (kategori_transaksi, tanggal, urut, id_contact, poin) 
					VALUES (".$kategori.", ".$tanggal.", ".$urut.", ".$id_contact.", ".$poin.")";

					$this->db->query($sql);
				}


			// untuk yang tambah baru bukan dari data contact
				public function simpanContactMember(){
					$data = array(
						'nama' => $this->input->post('nama'),
						'hp' => $this->input->post('hp'),
						'tgl_lahir' => $this->input->post('lahir'),
						'tempat_lahir' => $this->input->post('empat_lahir'),
						'email' => $this->input->post('email'),
						'lokasi' => $this->input->post('lokasi'),
						'grade' => $this->input->post('grade'),
						'jenis' => "2",
						);

					$query = $this->db->insert('customer_contact',$data);
					return $query;
				}

			public function simpanMember1(){ //untuk yang baru belum jadi customer dari menu tambah mamber

				$max="SELECT max(id_contact) num FROM customer_contact"; //untuk mengambil id_contact yang diinsert barusan
				$maxquery= mysql_query($max) or die (died);
				while($row = mysql_fetch_assoc($maxquery)) {
					$urut=$row['num'];
					$maxid=$urut;
				};


			//$max="SELECT count(id_member)+1 as num FROM tb_poin_member"; // untuk urutan member yang hanya bisa menangnani sampai 9999
			//$maxquery= mysql_query($max) or die (died);
			//while($row = mysql_fetch_assoc($maxquery)) {
			//	$urut=$row['num'];}

			// untuk urutan tanpa batas
				$max ="select max(id_member) as max
				from tb_poin_member";
				$maxquery= mysql_query($max);
				while($row = mysql_fetch_assoc($maxquery)) {
					$uruts=$row['max'];}

					$urut = "select urut from tb_poin_member
					where id_member = '$uruts' ";
					$urut1= mysql_query($urut);
					while($row = mysql_fetch_assoc($urut1)) {
						$urut2=$row['urut'];}
						if ($urut2==9999) {
							$urut2=0+1;
						} else{
							$urut2=$urut2+1;
						}

						$bulan = '0'.$_POST['bulan'];
						$tanggal = $_POST['tanggal'].$bulan.$_POST['tahun'];
						$urut = $urut2;
						$id_contact = $maxid;
						$poin = $_POST['poin'];
						$kategori = $_POST['kategori'];

						$data2 = array($kategori, $tanggal, $urut, $id_contact, $poin);

						$sql = "INSERT INTO tb_poin_member (kategori_transaksi, tanggal, urut, id_contact, poin) 
						VALUES (".$kategori.", ".$tanggal.", ".$urut.", ".$id_contact.", ".$poin.")";

						$this->db->query($sql);
					}

					public function tampilMember($perPage,$uri){
						$this->db->select('*');
						$this->db->from('customer_contact c, tb_poin_member p');
						$this->db->where('c.id_contact = p.id_contact');

						$getData = $this->db->get('', $perPage, $uri);
						if($getData->num_rows() > 0)
							return $getData->result();
						else
							return null;
					}

					public function cariMember($perPage,$uri){
						$query=$this->db->query("SELECT *
							FROM customer_contact c, tb_poin_member p  WHERE (c.id_contact = p.id_contact and nama LIKE '$_GET[q]') or (c.id_contact = p.id_contact and (select concat(kategori_transaksi,tanggal,urut)) LIKE '$_GET[q]') ");
						return $query->result();

						$getData = $this->db->get('', $perPage, $uri);
						if($getData->num_rows() > 0)
							return $getData->result();
						else
							return null;
					}

					public function cariContactMember($perPage,$uri){
						$query=$this->db->query("SELECT *
							FROM customer_contact WHERE nama LIKE '%$_GET[q]%' and id_contact NOT IN (SELECT id_contact FROM tb_poin_member) ");
						return $query->result();

						$getData = $this->db->get('', $perPage, $uri);
						if($getData->num_rows() > 0)
							return $getData->result();
						else
							return null;
					}

					public function cariNamaMember(){
						$query=$this->db->query("SELECT *
							FROM customer_contact c, tb_poin_member p  WHERE (c.id_contact = p.id_contact and (select concat(kategori_transaksi,tanggal,urut)) LIKE '$_GET[q]') ");
						return $query->result();
					}

					public function simpanTambahPoin(){
						date_default_timezone_set('Asia/Jakarta');
						$tanggal=date("Y-m-d H:i:s"); 
						$data = array(
							'id_poin_member' => $this->input->post('id_poin_member'),
							'poin' => $this->input->post('poin'),
							'transaksi' => $this->input->post('transaksi'),
							'kode_transaksi' => '+',
							'time' => $tanggal
							);

						$query = $this->db->insert('tb_poin_transaksi',$data);
						return $query;
					}

					public function simpanRedeemPoin(){
						date_default_timezone_set('Asia/Jakarta');
						$tanggal=date("Y-m-d H:i:s"); 

						$data = array(
							'id_poin_member' => $this->input->post('id_poin_member'),
							'poin' => $this->input->post('poin'),
							'transaksi' => $this->input->post('transaksi'),
							'kode_transaksi' => '-',
							'time' => $tanggal
							);

						$query = $this->db->insert('tb_poin_transaksi',$data);
						return $query;
					}

					public function updateTambahPoin(){
						$id_poin_member = $this->input->post('id_poin_member');
						$poin = $this->input->post('poin');

						$q = mysql_query("SELECT poin from tb_poin_member where (select concat(kategori_transaksi,tanggal,urut)) =  '$id_poin_member' ");
						if ($row1 = mysql_fetch_array($q)){
							$poin1=$row1['poin'];
						}
						$poinbaru = $poin1 + $poin;


						$query = $this->db->query("Update tb_poin_member set poin = '$poinbaru' WHERE (select concat(kategori_transaksi,tanggal,urut)) = '$id_poin_member' ");
						return $query;
					}

					public function updateRedeemPoin(){
						$id_poin_member = $this->input->post('id_poin_member');
						$poin = $this->input->post('poin');

						$q = mysql_query("SELECT poin from tb_poin_member where (select concat(kategori_transaksi,tanggal,urut)) =  '$id_poin_member' ");
						if ($row1 = mysql_fetch_array($q)){
							$poin1=$row1['poin'];
						}
						$poinbaru = $poin1 - $poin;


						$query = $this->db->query("Update tb_poin_member set poin = '$poinbaru' WHERE (select concat(kategori_transaksi,tanggal,urut)) = '$id_poin_member' ");
						return $query;
					}

					public function historyMember(){
						$query=$this->db->query("SELECT *
							FROM tb_poin_member , tb_poin_transaksi 
							WHERE (select concat(kategori_transaksi,tanggal,urut)) = id_poin_member and id_poin_member LIKE '%$_GET[q]%' 
							and time BETWEEN '$_GET[awal]' and '$_GET[akhir]'");
						return $query->result();
					}

					// SALES REPORT

					public function sales_report(){
						$query=$this->db->query('SELECT *
							FROM tb_sales_report
							JOIN user
							WHERE tb_sales_report.user_id = user.user_id
							ORDER BY id_sales_report');
						return $query->result();
					}

					public function sales_report_cari(){
						$query=$this->db->query("SELECT *
							FROM tb_sales_report
							JOIN user
							WHERE tb_sales_report.user_id = user.user_id
							AND bulan ='$_GET[bulan]'
							AND tahun = '$_GET[tahun]'
							ORDER BY id_sales_report");
						return $query->result();
					}

					public function poin_sales_report(){
						$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
							FROM tb_sales_report
							JOIN user
							WHERE tb_sales_report.user_id = user.user_id							
							AND bulan ='$_GET[bulan]'
							AND tahun = '$_GET[tahun]'
							GROUP BY tb_sales_report.user_id");
						return $query->result();
					}

					public function poin_sales_report_after_tambah(){
						$bln=getdate(); 
				        $bln=$bln[0];
				        $bulan = date('m',$bln);                          
				        $tahun = date('Y',$bln);
						$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
							FROM tb_sales_report
							JOIN user
							WHERE tb_sales_report.user_id = user.user_id							
							AND bulan ='$bulan'
							AND tahun = '$tahun'
							GROUP BY tb_sales_report.user_id");
						return $query->result();
					}	

					public function sales_report_after_tambah(){
						$bln=getdate(); 
				        $bln=$bln[0];
				        $bulan = date('m',$bln);                          
				        $tahun = date('Y',$bln);
						$query=$this->db->query("SELECT *
							FROM tb_sales_report
							JOIN user
							WHERE tb_sales_report.user_id = user.user_id
							AND bulan ='$bulan'
							AND tahun = '$tahun'
							ORDER BY id_sales_report");
						return $query->result();
					}

					public function ubahSalesReport(){

						$cekpoint = $this->input->post('paket');
						$jamaah = $this->input->post('jml_jamaah');
						$bod = $_POST['bod'];

								 if ($cekpoint == "Umroh Exclusive Series" and $bod == "yes") {
								$point = 2.5;
							} elseif ($cekpoint == "Umroh Exclusive Series" and $bod == "no") {
								$point = 5;
							} elseif ($cekpoint == "Umroh DTT Series" and $bod == "yes") {
								$point = 1.5;
							} elseif ($cekpoint == "Umroh DTT Series" and $bod == "no") {
								$point = 3;
							} elseif ($cekpoint == "Tiket" and $bod == "yes") {
								$point = 0.25;
							} elseif ($cekpoint == "Tiket" and $bod == "no") {
								$point = 1;
							} elseif ($cekpoint == "LA" and $bod == "yes") {
								$point = 0.5;
							} elseif ($cekpoint == "LA" and $bod == "no") {
								$point = 1;
							} elseif ($cekpoint == "Full Pacakage" and $bod == "yes") {
								$point = 1.5;
							} elseif ($cekpoint == "Full Pacakage" and $bod == "no") {
								$point = 3;
							} elseif ($cekpoint == "Umroh Plus Exclusive" and $bod == "yes") {
								$point = 3.5;
							} elseif ($cekpoint == "Umroh Plus Exclusive" and $bod == "no") {
								$point = 7;
							} elseif ($cekpoint == "Holiday - International" and $bod == "yes") {
								$point = 1.5;
							} elseif ($cekpoint == "Holiday - International" and $bod == "no") {
								$point = 3;
							} elseif ($cekpoint == "Holiday - Domestik" and $bod == "yes") {
								$point = 1;
							} elseif ($cekpoint == "Holiday - Domestik" and $bod == "no") {
								$point = 2;
							} elseif ($cekpoint == "Haji / Visa Ziarah" and $bod == "yes") {
								$point = 5;
							} elseif ($cekpoint == "Haji / Visa Ziarah" and $bod == "no") {
								$point = 10;
							}

						$total_poin = $jamaah*$point;


						$data['paket'] = $_POST['paket'];
						$data['tgl_berangkat'] = $_POST['tgl_berangkat'];
						$data['jml_jamaah'] = $_POST['jml_jamaah'];
						$data['total_poin'] = $total_poin;
						$data['keterangan'] = $_POST['keterangan'];

						$this->db->where('id_sales_report',$_POST['id_sales_report']);
						$this->db->update('tb_sales_report',$data);
					}

					public function hapusSalesReport($id_sales_report)
					{
						$this->db->where('id_sales_report',$id_sales_report);
						$this->db->delete('tb_sales_report');
					}

					public function tambahSalesReport()
					{	
						$cekpoint = $this->input->post('paket');
						$jamaah = $this->input->post('jml_jamaah');
						$bod = $_POST['bod'];

								 if ($cekpoint == "Umroh Exclusive Series" and $bod == "yes") {
								$point = 2.5;
							} elseif ($cekpoint == "Umroh Exclusive Series" and $bod == "no") {
								$point = 5;
							} elseif ($cekpoint == "Umroh DTT Series" and $bod == "yes") {
								$point = 1.5;
							} elseif ($cekpoint == "Umroh DTT Series" and $bod == "no") {
								$point = 3;
							} elseif ($cekpoint == "Tiket" and $bod == "yes") {
								$point = 0.25;
							} elseif ($cekpoint == "Tiket" and $bod == "no") {
								$point = 1;
							} elseif ($cekpoint == "LA" and $bod == "yes") {
								$point = 0.5;
							} elseif ($cekpoint == "LA" and $bod == "no") {
								$point = 1;
							} elseif ($cekpoint == "Full Pacakage" and $bod == "yes") {
								$point = 1.5;
							} elseif ($cekpoint == "Full Pacakage" and $bod == "no") {
								$point = 3;
							} elseif ($cekpoint == "Umroh Plus Exclusive" and $bod == "yes") {
								$point = 3.5;
							} elseif ($cekpoint == "Umroh Plus Exclusive" and $bod == "no") {
								$point = 7;
							} elseif ($cekpoint == "Holiday - International" and $bod == "yes") {
								$point = 1.5;
							} elseif ($cekpoint == "Holiday - International" and $bod == "no") {
								$point = 3;
							} elseif ($cekpoint == "Holiday - Domestik" and $bod == "yes") {
								$point = 1;
							} elseif ($cekpoint == "Holiday - Domestik" and $bod == "no") {
								$point = 2;
							} elseif ($cekpoint == "Haji / Visa Ziarah" and $bod == "yes") {
								$point = 5;
							} elseif ($cekpoint == "Haji / Visa Ziarah" and $bod == "no") {
								$point = 10;
							}

						$total_poin = $jamaah*$point;

						$data = array(
				   				'user_id' => $this->input->post('user_id'),
				   				'paket' => $this->input->post('paket'),
				   				'tgl_berangkat' => $this->input->post('tgl_berangkat'),
				   				'jml_jamaah' => $this->input->post('jml_jamaah'),
				   				'total_poin' => $total_poin,
				   				'keterangan' => $this->input->post('keterangan'),
				   				'bulan' => $this->input->post('bulan'),
				   				'tahun' => $this->input->post('tahun')
				  				);

						$query = $this->db->insert('tb_sales_report',$data);
						return $query;
					}

					// CEK POIN

					public function cekPoin()
					{
						$query=$this->db->query("SELECT user_nama, SUM(total_poin) as total_poin
							FROM tb_sales_report
							JOIN user
							WHERE tb_sales_report.user_id = user.user_id
							AND tb_sales_report.user_id LIKE '%$_GET[q]%' ");
						return $query->result();
					}






					function ambilData($tablename="",$listfield="",$where="")
					{
						$query=null;
						if (empty($listfield)) {
							if (empty($where)) {
								$query = $this->db->query("select * from ".$tablename);
							} else {
								$query = $this->db->query("select * from ".$tablename." where ".$where);
							}
						} else {
							if (empty($where)) {
								$query = $this->db->query("select ".$listfield." from ".$tablename);
							} else {
								$query = $this->db->query("select ".$listfield." from ".$tablename." where ".$where);
							}
						}
				
						return $query->result();
					}

}