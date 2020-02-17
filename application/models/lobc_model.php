<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lobc_model extends CI_Model
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


	public function lobc_simpan()
	{		
		//	
			$bln=$this->input->post('tanggal'); 
			$bln=$bln[0];
			$tahun = date('Y'); 
			$bulan = date('m'); 
			$bln = date('M'); 
			$to = $_POST['to'];
			$pnr = $this->input->post('pnr');

			$count ="select count(lobc.id) as count
			from lobc
			join lobc_customer
			where lobc.to = lobc_customer.id and lobc.bulan ='$bulan' and lobc.tahun = '$tahun' ";
			$maxquery= mysql_query($count);
			if ($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['count'];
			$max=$id_max + 1; }
			else {
			$max = 1 ;
			}

			// customer name
			$to = $this->input->post('to');
			$where['id'] = $to;
			$a=$this->db->get_where('lobc_customer',$where)->row();
			$customer=$a->customer;

			// tanggal berangkat
			 $q = mysql_query("SELECT * FROM `lobc_pnr` where id = '$pnr' "); //choose the city from indonesia only
                while ($row1 = mysql_fetch_array($q)){ 
               // $pnr = $row1['pnr'];
                $total_seat =  $row1['kuota_seat'];
                $tanggal_berangkat =  $row1['tanggal_berangkat'];}
                $bulan1 = substr($tanggal_berangkat,5,-3);
                $hari = substr($tanggal_berangkat,8);
                //$kalimat = str_replace("-","",$sub_kalimat);
		
			//$no =  "LOBC ".$max."/".$customer."/".$bln;
			$no = "LOBC.00".$max.".".$to.".".$hari.$bulan1;
			$tanggal = $this->input->post('tanggal');
			$to = $this->input->post('to');
			$seat_booked = $this->input->post('seat_booked');
			$rate = $this->input->post('rate');
			$materializes = $this->input->post('materializes');
			$visa = $this->input->post('visa');
			$creator = $this->input->post('user_id');
		
		//insert to db LOBC
		$data = array(
				'no' => $no,
				'tanggal' => $tanggal,
				'pnr' => $pnr,
				'to' => $to,
				'seat_booked' => $seat_booked,
				'rate' => $rate,
				'materializes' => $materializes,
				'visa' => $visa,
				'creator' => $creator,
				'bulan' => $bulan,
				'tahun' => $tahun,
				);
		$query = $this->db->insert('lobc',$data);
			return $query;				
	}

	public function lobc_deposit_simpan(){
		$max ="select max(id) as max
		from lobc";
		$maxquery= mysql_query($max);
		while($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['max'];}

			$data = array(
				'id_lobc'=> $id_max,
				'deposit_no'=> $this->input->post('deposit_no'),
				'deposit' => $this->input->post('deposit'),
				);

			$query = $this->db->insert('lobc_deposit',$data);
			return $query;
		}

		public function list_lobc(){
			$query=$this->db->query('SELECT no,tanggal, user_nama, customer, seat_booked, tanggal_berangkat, lobc.id, approve_tl_issued, approve_tl_deposit, lobc_pnr.pnr as pnr, flight_no_berangkat, flight_no_pulang, flight_no_rute2 FROM lobc , user , lobc_customer, lobc_pnr where lobc_pnr.id = lobc.pnr and user_id = creator and lobc_customer.id = lobc.to ORDER BY tanggal desc ');
			return $query->result();
		}

		public function lihat_lobc(){
			$query=$this->db->query("SELECT no,tanggal, user_nama, customer, seat_booked, tanggal_berangkat, lobc.id, approve_tl_issued, approve_tl_deposit, lobc_pnr.pnr as pnr, flight_no_berangkat, flight_no_pulang, flight_no_rute2 FROM lobc , user , lobc_customer, lobc_pnr where lobc_pnr.id = lobc.pnr and user_id = creator and lobc_customer.id = lobc.to AND
				((tanggal BETWEEN '$_POST[tanggal_awal]' AND '$_POST[tanggal_akhir]') OR (lobc.to = '$_POST[to]') OR (lobc_pnr.flight = '$_POST[flight]'))
				 ORDER BY tanggal desc ");
			return $query->result();
		}

		public function lihat_lobc_dep(){
			$query=$this->db->query("SELECT no,tanggal, user_nama, customer, seat_booked, tanggal_berangkat, lobc.id, approve_tl_issued, approve_tl_deposit, lobc_pnr.pnr as pnr, flight_no_berangkat, flight_no_pulang, flight_no_rute2 FROM lobc , user , lobc_customer, lobc_pnr where lobc_pnr.id = lobc.pnr and user_id = creator and lobc_customer.id = lobc.to AND
				dep_berangkat = '$_POST[dep]'
				 ORDER BY tanggal desc ");
			return $query->result();
		}

		public function print_lobc(){
			$id = $this->input->get('id');

			$query=$this->db->query("SELECT * FROM lobc where id = '$id' group by id desc ");
			return $query->result();
		}

		public function lobc_simpan_ubah(){
			$data = array(
				'seat_booked' => $this->input->post('seat_booked'),
				);
			$id = $this->input->post('id');

			$this->db->where('id',$id);
			$this->db->update('lobc',$data);
		}

		public function lobc_simpan_ubah_deposit(){
			$data = array(
				'id_lobc' => $this->input->post('id_lobc'),
				'deposit_no'=> $this->input->post('deposit_no'),
				'deposit' => $this->input->post('deposit'),
				);
			$query = $this->db->insert('lobc_deposit',$data);
			return $query;
		}

		public function ubahStatusDeposit($id){
			$query= $this->db->query('update lobc set approve_tl_deposit="done" where id='.$id);
		}

		public function ubahStatusIssued($id){
			$query= $this->db->query('update lobc set approve_tl_issued="done" where id='.$id);
		}

		// PNR
		public function list_pnr(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by tanggal_berangkat desc ');
			return $query->result();
		}

		public function pnr_flight(){
			$query=$this->db->query("SELECT * FROM lobc_pnr where flight = '$_POST[flight]' order by tanggal_berangkat desc ");
			return $query->result();
		}

		public function pnr_dep(){
			$query=$this->db->query("SELECT * FROM lobc_pnr where dep_berangkat = '$_POST[dep]' order by tanggal_berangkat desc ");
			return $query->result();
		}


		public function lihat_pnr(){
			$query=$this->db->query("SELECT * FROM lobc_pnr where 
				tanggal_berangkat BETWEEN '$_POST[tanggal_awal]' AND '$_POST[tanggal_akhir]' order by tanggal_berangkat desc ");
			return $query->result();
		}

		public function lihat_seat_tersedia(){
			$query=$this->db->query("SELECT * FROM lobc_pnr, view_seat where kuota_seat > sum and lobc_pnr.id = view_seat.pnr order by tanggal_berangkat  ");
			//$query=$this->db->query("SELECT lobc_pnr.pnr, id, flight, kuota_seat,tanggal_berangkat, tanggal_pulang FROM lobc_pnr, view_seat where kuota_seat > sum and lobc_pnr.id = view_seat.pnr order by tanggal_berangkat  ");
			return $query->result();
		}

		public function lihat_seat_terpakai(){
			$query=$this->db->query("SELECT * FROM lobc_pnr, view_seat where kuota_seat <= sum and lobc_pnr.id = view_seat.pnr order by tanggal_berangkat  ");
			//$query=$this->db->query("SELECT lobc_pnr.pnr, id, flight, kuota_seat,tanggal_berangkat, tanggal_pulang FROM lobc_pnr, view_seat where kuota_seat <= sum and lobc_pnr.id = view_seat.pnr order by tanggal_berangkat  ");
			return $query->result();
		}

		public function simpan_pnr(){
			$data = array(
				'pnr'=> $this->input->post('pnr'),
				'flight' => $this->input->post('flight'),
				'type' => $this->input->post('type'),
				'program' => $this->input->post('program'),
				'kuota_seat' => $this->input->post('kuota_seat'),
				'tanggal_berangkat' => $this->input->post('tanggal_berangkat'),
				'tanggal_pulang' => $this->input->post('tanggal_pulang'),
				'flight_no_berangkat' => $this->input->post('flight_no_berangkat'),
				'flight_no_pulang' => $this->input->post('flight_no_pulang'),
				'class_berangkat' => $this->input->post('class_berangkat'),
				'class_pulang' => $this->input->post('class_pulang'),
				'dep_berangkat' => $this->input->post('dep_berangkat'),
				'dep_pulang' => $this->input->post('dep_pulang'),
				'arr_berangkat' => $this->input->post('arr_berangkat'),
				'arr_pulang' => $this->input->post('arr_pulang'),
				'etd_berangkat' => $this->input->post('etd_berangkat'),
				'etd_pulang' => $this->input->post('etd_pulang'),
				'eta_berangkat' => $this->input->post('eta_berangkat'),
				'eta_pulang' => $this->input->post('eta_pulang'),

				'tanggal_rute1' => $this->input->post('tanggal_rute1'),
				'tanggal_rute2' => $this->input->post('tanggal_rute2'),
				'flight_no_rute1' => $this->input->post('flight_no_rute1'),
				'flight_no_rute2' => $this->input->post('flight_no_rute2'),
				'class_rute1' => $this->input->post('class_rute1'),
				'class_rute2' => $this->input->post('class_rute2'),
				'dep_rute1' => $this->input->post('dep_rute1'),
				'dep_rute2' => $this->input->post('dep_rute2'),
				'arr_rute1' => $this->input->post('arr_rute1'),
				'arr_rute2' => $this->input->post('arr_rute2'),
				'etd_rute1' => $this->input->post('etd_rute1'),
				'etd_rute2' => $this->input->post('etd_rute2'),
				'eta_rute1' => $this->input->post('eta_rute1'),
				'eta_rute2' => $this->input->post('eta_rute2'),
				);
			$query = $this->db->insert('lobc_pnr',$data);
		}

		public function simpan_pnr_ubah(){
			$data = array(
				'pnr' => $this->input->post('pnr'),
				'flight' => $this->input->post('flight'),
				'program' => $this->input->post('program'),
				'kuota_seat' => $this->input->post('kuota_seat'),
				'tanggal_berangkat' => $this->input->post('tanggal_berangkat'),
				'tanggal_pulang' => $this->input->post('tanggal_pulang'),
				'flight_no_berangkat' => $this->input->post('flight_no_berangkat'),
				'flight_no_pulang' => $this->input->post('flight_no_pulang'),
				'class_berangkat' => $this->input->post('class_berangkat'),
				'class_pulang' => $this->input->post('class_pulang'),
				'dep_berangkat' => $this->input->post('dep_berangkat'),
				'dep_pulang' => $this->input->post('dep_pulang'),
				'arr_berangkat' => $this->input->post('arr_berangkat'),
				'arr_pulang' => $this->input->post('arr_pulang'),
				'etd_berangkat' => $this->input->post('etd_berangkat'),
				'etd_pulang' => $this->input->post('etd_pulang'),
				'eta_berangkat' => $this->input->post('eta_berangkat'),
				'eta_pulang' => $this->input->post('eta_pulang'),

				'tanggal_rute1' => $this->input->post('tanggal_rute1'),
				'tanggal_rute2' => $this->input->post('tanggal_rute2'),
				'flight_no_rute1' => $this->input->post('flight_no_rute1'),
				'flight_no_rute2' => $this->input->post('flight_no_rute2'),
				'class_rute1' => $this->input->post('class_rute1'),
				'class_rute2' => $this->input->post('class_rute2'),
				'dep_rute1' => $this->input->post('dep_rute1'),
				'dep_rute2' => $this->input->post('dep_rute2'),
				'arr_rute1' => $this->input->post('arr_rute1'),
				'arr_rute2' => $this->input->post('arr_rute2'),
				'etd_rute1' => $this->input->post('etd_rute1'),
				'etd_rute2' => $this->input->post('etd_rute2'),
				'eta_rute1' => $this->input->post('eta_rute1'),
				'eta_rute2' => $this->input->post('eta_rute2'),
				);

			$this->db->where('id',$_POST['id']);
			$this->db->update('lobc_pnr',$data);
		}

		public function pnr_up(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by pnr desc');
			return $query->result();
		}

		public function pnr_down(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by pnr asc');
			return $query->result();
		}

		public function dep_up(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by dep_berangkat desc');
			return $query->result();
		}

		public function dep_down(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by dep_berangkat asc');
			return $query->result();
		}

		public function tanggal_up(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by tanggal_berangkat desc');
			return $query->result();
		}

		public function tanggal_down(){
			$query=$this->db->query('SELECT * FROM lobc_pnr order by tanggal_berangkat asc');
			return $query->result();
		}


		// CUSTOMER

		public function lobc_customer_view()
		{
			$query=$this->db->query('SELECT *
			FROM lobc_customer
			ORDER BY id');
			return $query->result();
		}

		public function lobc_customer_insert()
		{
			$data = array(
			'customer' => $this->input->post('customer'),
			'alamat' => $this->input->post('alamat'),
			'hp' => $this->input->post('hp')
			);

			$query = $this->db->insert('lobc_customer',$data);
			return $query;
		}


		public function lobc_customer_edit()
		{
			$data['id'] = $_POST['id'];
			$data['customer'] = $_POST['customer'];
			$data['alamat'] = $_POST['alamat'];
			$data['hp'] = $_POST['hp'];

			$this->db->where('id',$_POST['id']);
			$this->db->update('lobc_customer',$data);
		}

		public function lobc_customer_delete($id)
		{
			$this->db->where('id',$id);
	  		$this->db->delete('lobc_customer');
		}


		public function charterx_tambah($data)
		{
			$query = $this->db->insert('carterx_pemesanan',$data);
			return $query;
		}
	} 