<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kuesioner_model extends CI_Model
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

	
	public function kuesioner_simpan()
	{	
		$jumlah = count($_POST["satu"]);
		for($i=0; $i < $jumlah; $i++) 
		{
			$satu=$_POST["satu"][$i];
			$keberangkatan=$_POST["keberangkatan"];
			$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('1','.$satu.','.$keberangkatan.')";
			$this->db->query($q);
		}

		$jumlah = count($_POST["dua"]);
		for($i=0; $i < $jumlah; $i++) 
		{
			$dua=$_POST["dua"][$i];
			$keberangkatan=$_POST["keberangkatan"];
			$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('2','.$dua.','.$keberangkatan.')";
			$this->db->query($q);
		}

		$jumlah = count($_POST["tiga"]);
		for($i=0; $i < $jumlah; $i++) 
		{
			$tiga=$_POST["tiga"][$i];
			$keberangkatan=$_POST["keberangkatan"];
			$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('3','.$tiga.','.$keberangkatan.')";
			$this->db->query($q);
		}


		$jumlah = count($_POST["empat"]);
		for($i=0; $i < $jumlah; $i++) 
		{
			$empat=$_POST["empat"][$i];
			$keberangkatan=$_POST["keberangkatan"];
			$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('4','.$empat.','.$keberangkatan.')";
			$this->db->query($q);
		}


		$lima=$_POST['lima'];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('5','$lima','.$keberangkatan.')";
		$this->db->query($q);

		$enam=$_POST["enam"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('6','.$enam.','.$keberangkatan.')";
		$this->db->query($q);

		$tujuh=$_POST["tujuh"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('7','.$tujuh.','.$keberangkatan.')";
		$this->db->query($q);

		$delapan0=$_POST["delapan0"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('8','.$delapan0.','.$keberangkatan.')";
		$this->db->query($q);

		$delapan=$_POST["delapan"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('9','.$delapan.','.$keberangkatan.')";
		$this->db->query($q);

		$sembilan=$_POST["sembilan"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('10','.$sembilan.','.$keberangkatan.')";
		$this->db->query($q);

		$sepuluh=$_POST["sepuluh"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('11','.$sepuluh.','.$keberangkatan.')";
		$this->db->query($q);

		$sebelas=$_POST["sebelas"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('12','.$sebelas.','.$keberangkatan.')";
		$this->db->query($q);

		$duabelas=$_POST["duabelas"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('13','.$duabelas.','.$keberangkatan.')";
		$this->db->query($q);

		$tigabelas=$_POST["tigabelas"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('14','.$tigabelas.','.$keberangkatan.')";
		$this->db->query($q);

		$empatbelas=$_POST["empatbelas"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('15','.$empatbelas.','.$keberangkatan.')";
		$this->db->query($q);

		$limabelas=$_POST["limabelas"];
		$keberangkatan=$_POST["keberangkatan"];
		$q = "insert into koesioner_jawaban(soal, jawaban, id_keberangkatan) VALUES ('16','.$limabelas.','.$keberangkatan.')";
		$this->db->query($q);




		//$query = $this->db->insert('kuesioner_jawaban',$data);
		//return $query;
	}

	public function keberangkatan_simpan()
	{
		$data = array(
			'tanggal_keberangkatan' => $this->input->post('tanggal'),
			'tour_leader' => $this->input->post('tour_leader'),
			
			);

		$query = $this->db->insert('kuesioner_keberangkatan',$data);
		return $query;
	}

	public function charterx_tambah($data)
	{
		$query = $this->db->insert('carterx_pemesanan',$data);
		return $query;
	}
} 