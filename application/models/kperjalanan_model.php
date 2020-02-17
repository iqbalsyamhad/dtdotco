<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kperjalanan_model extends CI_Model
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


	public function kperjalanan_simpan()
	{	
		$data = array(
			'tgl_berangkat' => $this->input->post('tanggal_berankat'),
			'tgl_pulang' => $this->input->post('tanggal_pulang'),
			'group' => $this->input->post('group'),
			'berempat' => $this->input->post('berempat'),
			'bertiga' => $this->input->post('bertiga'),
			'berdua' => $this->input->post('berdua'),
			'creator' => $this->input->post('user_id'),
			);

		$query = $this->db->insert('kperjalanan',$data);
		return $query;	
	}

		public function kperjalanan_flight_simpan(){
			$max ="select max(id_kperjalanan) as max
			from kperjalanan";
			$maxquery= mysql_query($max);
			while($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['max'];}

			$jumlah = $this->input->post('jumlah_flight');

			for ($i=1; $i <= $jumlah ; $i++) { 
				$data = array(
					'id_kperjalanan'=> $id_max,
					'tanggal' => $this->input->post('tanggalFlight'.$i), 
					'flight_no' => $this->input->post('flightFlight'.$i), 
					'dep-arr' => $this->input->post('depFlight'.$i), 
					'etd-eta' => $this->input->post('etdFlight'.$i), 
					'pnr' => $this->input->post('pnrFlight'), 

					);

				$query = $this->db->insert('kperjalanan_flight',$data);

			}
			return $query;
		}

		public function kperjalanan_hotel_simpan(){
			$max ="select max(id_kperjalanan) as max
			from kperjalanan";
			$maxquery= mysql_query($max);
			while($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['max'];}

			$awal = $this->input->post('jumlah_hotel');
			$jumlah = str_replace("total_hotel_",'', $awal);

			for ($i=1; $i <= $jumlah ; $i++) { 
				$data = array(
					'id_kperjalanan'=> $id_max,
					'kota' => $this->input->post('kotaHotel'.$i), 
					'jml_malam' => $this->input->post('malamHotel'.$i), 
					'nama_hotel' => $this->input->post('hotelHotel'.$i), 
					);

				$query = $this->db->insert('kperjalanan_hotel',$data);

			}
			return $query;
		}

		public function kperjalanan_hari_simpan(){
			$max ="select max(id_kperjalanan) as max
			from kperjalanan";
			$maxquery= mysql_query($max);
			while($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['max'];}

			$awal = $this->input->post('jumlah_hari');
			$jumlah = str_replace("total_hari_",'', $awal);

			for ($i=1; $i <= $jumlah ; $i++) { 
				$data = array(
					'id_kperjalanan'=> $id_max,
					'hari' => $this->input->post('h_'.$i), 
					'jadwal' => $this->input->post('hari'.$i), 
					);

				$query = $this->db->insert('kperjalanan_hari',$data);

			}
			return $query;
		}

		public function kperjalanan_inc_exc(){
			$max ="select max(id_kperjalanan) as max
			from kperjalanan";
			$maxquery= mysql_query($max);
			while($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['max'];}

			$jumlah = count($_POST["inc"]);
			for($i=0; $i < $jumlah; $i++) 
			{
			$satu=$_POST["inc"][$i];
			$q = "insert into kperjalanan_incexc(id_kperjalanan, id_inc_exc) VALUES ('.$id_max.','.$satu.')";
			$this->db->query($q);
		}
		}

		public function list_kperjalanan(){
			$query=$this->db->query('SELECT * FROM kperjalanan , user where user_id = creator group by id_kperjalanan desc ');
			return $query->result();
		}

		public function print_kperjalanan(){
			$id = $this->input->get('id');

			$query=$this->db->query("SELECT * FROM kperjalanan where id = '$id' group by id desc ");
			return $query->result();
		}

		public function kperjalanan_simpan_ubah(){
			$data = array(
				'id_kperjalanan' => $this->input->post('id_kperjalanan'),
				'deposit' => $this->input->post('deposit'),
				);
			$query = $this->db->insert('kperjalanan_deposit',$data);
			return $query;
		}

		public function charterx_tambah($data)
		{
			$query = $this->db->insert('carterx_pemesanan',$data);
			return $query;
		}
	} 