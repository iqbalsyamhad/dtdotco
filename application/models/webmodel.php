<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webmodel extends CI_Model
{

	// ADMIN

	//TOUR
	public function adm_tour()
	{
		$query = $this->db->query('SELECT *
			FROM tb_tour
			JOIN tb_tour_kategori
			WHERE tb_tour.id_tour_kategori = tb_tour_kategori.id_tour_kategori
			ORDER BY id_tour');
		return $query->result();
	}

	public function tour_tambah($data)
	{
		$query = $this->db->insert('tb_tour',$data);
		return $query;
	}

	function tour_tambah_1($nama_file) {
		$id_tour_kategori = $this->input->post('id_tour_kategori');
		$nama_tour = $this->input->post('nama_tour');
		$ket1 = $this->input->post('ket1');
		$ket2 = $this->input->post('ket2');
		$link = $this->input->post('link');
		
		$query = "INSERT INTO tb_tour (id_tour_kategori , gambar, nama_tour, ket1, ket2, link) 
					VALUES ('$id_tour_kategori','$nama_file','$nama_tour','$ket1','$ket2','$link')";
		$this->db->query($query);
	}

	public function tour_hapus($id_tour)
	{
		$this->db->where('id_tour',$id_tour);
  		$this->db->delete('tb_tour');
	}

	public function tour_edit()
	{
		$data['id_tour_kategori'] = $_POST['id_tour_kategori'];
		$data['gambar'] = $_POST['gambar'];
		$data['nama_tour'] = $_POST['nama_tour'];
		$data['ket1'] = $_POST['ket1'];
		$data['ket2'] = $_POST['ket2'];
		$data['link'] = $_POST['link'];

		$this->db->where('id_tour',$_POST['id_tour']);
		$this->db->update('tb_tour',$data);
	}

	// TOUR KATEGORI
	public function adm_tour_kategori()
	{
		$query = $this->db->query('SELECT *
			FROM tb_tour_kategori');
		return $query->result();
	}

	public function tour_kategori_tambah($data)
	{
		$query = $this->db->insert('tb_tour_kategori',$data);
		return $query;
	}

	public function tour_kategori_hapus($id_tour_kategori)
	{
		$this->db->where('id_tour_kategori',$id_tour_kategori);
  		$this->db->delete('tb_tour_kategori');
	}

	public function tour_kategori_edit()
	{
		$data['nama_kategori'] = $_POST['nama_kategori'];

		$this->db->where('id_tour_kategori',$_POST['id_tour_kategori']);
		$this->db->update('tb_tour_kategori',$data);
	}

	// TOUR DETAIL
	public function adm_tour_detail()
	{
		$query = $this->db->query('SELECT *
			FROM tb_tour_detail
			JOIN tb_tour
			JOIN tb_itinerary
			WHERE tb_tour_detail.id_tour = tb_tour.id_tour
			AND tb_tour_detail.id_itinerary = tb_itinerary.id_itinerary');
		return $query->result();
	}

	public function tour_detail_tambah($data)
	{
		$query = $this->db->insert('tb_tour_detail',$data);
		return $query;
	}

	function tour_detail_tambah_1($nama_file) {
		$id_tour = $this->input->post('id_tour');
		$id_itinerary = $this->input->post('id_itinerary');
		$include = $this->input->post('include');
		$exclude = $this->input->post('exclude');
		$term = $this->input->post('term');
		$highlight = $this->input->post('highlight');
		
		$query = "INSERT INTO tb_tour_detail (id_tour, gambar_detail, id_itinerary, include, exclude, term, highlight) 
					VALUES ('$id_tour','$nama_file','$id_itinerary','$include','$exclude','$term','$highlight')";
		$this->db->query($query);
	}

	public function tour_detail_hapus($id_tour_detail)
	{
		$this->db->where('id_tour_detail',$id_tour_detail);
  		$this->db->delete('tb_tour_detail');
	}

	public function tour_detail_edit()
	{
		$data['id_tour'] = $_POST['id_tour'];
		$data['gambar_detail'] = $_POST['gambar_detail'];
		$data['id_itinerary'] = $_POST['id_itinerary'];
		$data['include'] = $_POST['include'];
		$data['exclude'] = $_POST['exclude'];
		$data['term'] = $_POST['term'];
		$data['highlight'] = $_POST['highlight'];

		$this->db->where('id_tour_detail',$_POST['id_tour_detail']);
		$this->db->update('tb_tour_detail',$data);
	}

	// ITINERARY
	public function adm_itinerary()
	{
		$query = $this->db->query('SELECT *
			FROM tb_itinerary');
		return $query->result();
	}

	public function itinerary_tambah($data)
	{
		$query = $this->db->insert('tb_itinerary',$data);
		return $query;
	}

	function itinerary_tambah_1($nama_file) {
		$id_itinerary = $this->input->post('id_itinerary');
		$id_tour = $this->input->post('id_tour');
		$nama_itinerary = $this->input->post('nama_itinerary');
		$tour_highlight = $this->input->post('tour_highlight');
		
		$query = "INSERT INTO tb_itinerary (id_itinerary, file_itinerary, nama_itinerary, id_tour, tour_highlight) 
					VALUES ('$id_itinerary','$nama_file','$nama_itinerary','$id_tour','$tour_highlight')";
		$this->db->query($query);
	}

	public function itinerary_hapus($id_itinerary)
	{
		$this->db->where('id_itinerary',$id_itinerary);
  		$this->db->delete('tb_itinerary');
	}

	public function itinerary_edit()
	{
		$data['file_itinerary'] = $_POST['file_itinerary'];
		$data['id_tour'] = $_POST['id_tour'];
		$data['nama_itinerary'] = $_POST['nama_itinerary'];
		$data['id_itinerary'] = $_POST['id_itinerary'];
		$data['tour_highlight'] = $_POST['tour_highlight'];

		$this->db->where('id_itinerary',$_POST['id_itinerary']);
		$this->db->update('tb_itinerary',$data);
	}

	// DETAIL ITINERARY
	public function adm_detail_itinerary()
	{
		$query = $this->db->query('SELECT *
			FROM tb_detail_itinerary
			JOIN tb_itinerary
			WHERE tb_detail_itinerary.id_itinerary = tb_itinerary.id_itinerary');
		return $query->result();
	}

	public function detail_itinerary_tambah($data)
	{
		$query = $this->db->insert('tb_detail_itinerary',$data);
		return $query;
	}

	public function detail_itinerary_hapus($id_detail_itinerary)
	{
		$this->db->where('id_detail_itinerary',$id_detail_itinerary);
  		$this->db->delete('tb_detail_itinerary');
	}

	public function detail_itinerary_edit()
	{
		$data['id_tour'] = $_POST['id_tour'];
		$data['hari'] = $_POST['hari'];
		$data['kegiatan'] = $_POST['kegiatan'];

		$this->db->where('id_detail_itinerary',$_POST['id_detail_itinerary']);
		$this->db->update('tb_detail_itinerary',$data);
	}


	// WEB
	public function tampil_tour()
	{
		$query = $this->db->query('SELECT * 
			FROM tb_tour
			JOIN tb_tour_kategori
			WHERE tb_tour.id_tour_kategori = tb_tour_kategori.id_tour_kategori and tb_tour.link LIKE  "%indo%"');
		return $query->result();
	}

	public function tampil_tour_internasional()
	{
		$query = $this->db->query('SELECT * 
			FROM tb_tour
			JOIN tb_tour_kategori
			WHERE tb_tour.id_tour_kategori = tb_tour_kategori.id_tour_kategori and tb_tour.link 
			not in (select link from tb_tour where link like "%indo%") ');
		return $query->result();
	}
	//STATUS
	public function adm_tour_status()
	{
		$data['id_status_web'] = $_POST['tour' ];

		$this->db->where('id_status',$_POST['id_status']);
		$this->db->update('status',$data);	
	}
	
	// MEMBER
	public function cekPoin()
	{
		$query=$this->db->query("SELECT *
			FROM customer_contact c, tb_poin_member p  
			WHERE (c.id_contact = p.id_contact 
				and (select concat(kategori_transaksi,tanggal,urut)) LIKE '$_GET[q]') ");
		return $query->result();
	}

	public function historyMember(){
		$query=$this->db->query("SELECT *
			FROM tb_poin_member , tb_poin_transaksi 
			WHERE (select concat(kategori_transaksi,tanggal,urut)) = id_poin_member and id_poin_member LIKE '$_GET[q]' 
			ORDER BY id_transaksi desc limit 10");
		return $query->result();
	}
}