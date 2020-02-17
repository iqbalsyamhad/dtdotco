<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formumroh_model extends CI_Model
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


		public function simpan_keberangkatan()
		{	
		$data = array(
			
			'tanggal' => $this->input->post('tanggal'),
			);

		$query = $this->db->insert('form_keberangkatan',$data);
		return $query;
		}

		public function list_keberangkatan(){
			$query=$this->db->query('SELECT * FROM form_keberangkatan group by id desc ');
			return $query->result();
		}
		

		public function simpan_ubah_keberangkatan()
		{
		$data['tanggal'] = $_POST['tanggal'];

		$this->db->where('id',$_POST['id']);
		$this->db->update('form_keberangkatan',$data);
		}

		public function hapus_keberangkatan($id)
		{
		$this->db->where('id',$id);
		$this->db->delete('form_keberangkatan');
		}

		// start for jamaah
		public function simpan_jamaah()
		{
		$data['id_keberangkatan'] = $_POST['id_keberangkatan'];
		$data['tipe_kamar'] = $_POST['tipe_kamar'];
		$data['nama'] = $_POST['nama'];
		$data['nama_ayah'] = $_POST['nama_ayah'];
		$data['jenis_kelamin'] = $_POST['jenis_kelamin'];
		$data['tempat_lahir'] = $_POST['tempat_lahir'];
		$data['tgl_lahir'] = $_POST['tgl_lahir'];
		$data['kwn'] = $_POST['kwn'];
		$data['alamat'] = $_POST['alamat'];
		$data['rt'] = $_POST['rt'];
		$data['rw'] = $_POST['rw'];
		$data['kelurahan'] = $_POST['kelurahan'];
		$data['kecamatan'] = $_POST['kecamatan'];
		$data['kode_pos'] = $_POST['kode_pos'];
		$data['domisili'] = $_POST['domisili'];
		$data['alamat_surat'] = $_POST['alamat_surat'];
		$data['telp'] = $_POST['telp'];
		$data['hp'] = $_POST['hp'];
		$data['no_wa'] = $_POST['no_wa'];
		$data['pin_bb'] = $_POST['pin_bb'];
		$data['email'] = $_POST['email'];
		$data['pekerjaan'] = $_POST['pekerjaan'];
		$data['nama_mahram'] = $_POST['nama_mahram'];
		$data['hubungan_mahram'] = $_POST['hubungan_mahram'];
		$data['ktp'] = $_POST['ktp'];
		$data['buku_nikah'] = $_POST['buku_nikah'];
		$data['kk'] = $_POST['kk'];
		$data['akta'] = $_POST['akta'];
		$data['passport'] = $_POST['passport'];
		$data['kartu_kuning'] = $_POST['kartu_kuning'];
		$data['pas_foto'] = $_POST['pas_foto'];
		$data['biaya_perlengkapan'] = $_POST['biaya_perlengkapan'];

		$query = $this->db->insert('form_jamaah',$data);
		return $query;
		}

		public function simpan_jamaah_deposit()
		{	
		$max ="select max(id) as max
		from form_jamaah";
		$maxquery= mysql_query($max);
		while($row = mysql_fetch_assoc($maxquery)) {
			$id_max=$row['max'];}

		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'dp_ke' => $this->input->post('dp_ke'),
			'nominal' => $this->input->post('nominal'),
			'id_jamaah' => $id_max,
		);

		$query = $this->db->insert('form_deposit',$data);
		return $query;
		}

		public function simpan_deposit()
		{	
		$deposit= $this->input->post('deposits_ke');
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'dp_ke' => $deposit,
			'nominal' => $this->input->post('nominal'),
			'id_jamaah' => $this->input->post('deposit_ke'),
		);

		$query = $this->db->insert('form_deposit',$data);
		return $query;
		}

		public function simpan_ubah_jamaah1()
		{
		$data['id_keberangkatan'] = $_POST['id_keberangkatan'];
		$data['tipe_kamar'] = $_POST['tipe_kamar'];
		$data['nama'] = $_POST['nama'];
		$data['nama_ayah'] = $_POST['nama_ayah'];
		$data['jenis_kelamin'] = $_POST['jenis_kelamin'];
		$data['tempat_lahir'] = $_POST['tempat_lahir'];
		$data['tgl_lahir'] = $_POST['tgl_lahir'];
		$data['kwn'] = $_POST['kwn'];
		$data['alamat'] = $_POST['alamat'];
		$data['rt'] = $_POST['rt'];
		$data['rw'] = $_POST['rw'];
		$data['kelurahan'] = $_POST['kelurahan'];
		$data['kecamatan'] = $_POST['kecamatan'];
		$data['kode_pos'] = $_POST['kode_pos'];
		$data['domisili'] = $_POST['domisili'];
		$data['alamat_surat'] = $_POST['alamat_surat'];
		$data['telp'] = $_POST['telp'];
		$data['hp'] = $_POST['hp'];
		$data['no_wa'] = $_POST['no_wa'];
		$data['pin_bb'] = $_POST['pin_bb'];
		$data['email'] = $_POST['email'];
		$data['pekerjaan'] = $_POST['pekerjaan'];
		$data['nama_mahram'] = $_POST['nama_mahram'];
		$data['hubungan_mahram'] = $_POST['hubungan_mahram'];
		$data['ktp'] = $_POST['ktp'];
		$data['buku_nikah'] = $_POST['buku_nikah'];
		$data['kk'] = $_POST['kk'];
		$data['akta'] = $_POST['akta'];
		$data['passport'] = $_POST['passport'];
		$data['kartu_kuning'] = $_POST['kartu_kuning'];
		$data['pas_foto'] = $_POST['pas_foto'];
		$data['biaya_perlengkapan'] = $_POST['biaya_perlengkapan'];

		$this->db->where('id',$_POST['id']);
		$this->db->update('form_jamaah',$data);
		}

		public function list_jamaah(){
			$query=$this->db->query('SELECT j.id as id, nama, tanggal, hp, email FROM form_jamaah j, form_keberangkatan k WHERE j.id_keberangkatan = k.id group by j.id desc');
			return $query->result();
		}

		public function cari_jamaah(){
			$query=$this->db->query("SELECT j.id as id, nama, tanggal, hp, email FROM form_jamaah j, form_keberangkatan k WHERE j.id_keberangkatan = '$_GET[tanggal]' and j.id_keberangkatan = k.id group by nama");
			return $query->result();
		}

		public function cari_keberangkatan(){
			$tahun = $_GET['tahun'];
			$bulan = $_GET['bulan'];
			$tanggal = '$tahun_$bulan___';
			$query=$this->db->query("SELECT * FROM form_keberangkatan k WHERE tanggal LIKE '$_GET[tahun]_$_GET[bulan]___'  ");
			return $query->result();
		}

		public function hapus_jamaah($id)
		{
		$this->db->where('id_jamaah',$id);
		$this->db->delete('form_deposit');
		}

		public function hapus_deposit($id)
		{
		$this->db->where('id',$id);
		$this->db->delete('form_jamaah');
		}

		public function birthday(){
		date_default_timezone_set('Asia/Jakarta');
		$month=date("m");
		$date=date("d");
		$query=$this->db->query("SELECT j.id as id, nama, tanggal, hp, email FROM form_jamaah j, form_keberangkatan k WHERE j.id_keberangkatan = k.id and EXTRACT(MONTH FROM tgl_lahir) = '$month' AND EXTRACT(DAY FROM tgl_lahir) = '$date' ORDER BY tgl_lahir ");
		return $query->result();
    	}

		public function print_lobc(){
			$id = $this->input->get('id');

			$query=$this->db->query("SELECT * FROM lobc where id = '$id' group by id desc ");
			return $query->result();
		}

		public function lobc_simpan_ubah(){
			$data = array(
				'id_lobc' => $this->input->post('id_lobc'),
				'deposit_no'=> $this->input->post('deposit_no'),
				'deposit' => $this->input->post('deposit'),
				);
			$query = $this->db->insert('lobc_deposit',$data);
		return $query;
		}


		public function charterx_tambah($data)
		{
			$query = $this->db->insert('carterx_pemesanan',$data);
			return $query;
		}
	} 