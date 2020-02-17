<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sewamobil_model extends CI_Model
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

	public function tarif_sewa(){
	$query=$this->db->query("SELECT car_rental_tarif.id as id, kota, jenis_kendaraan, gambar, transfer
		FROM car_rental_kota, car_rental_tarif, car_rental_kendaraan
		WHERE kota = '$_GET[kota]' AND car_rental_kota.id = car_rental_tarif.id_kota AND car_rental_tarif.id_kendaraan = car_rental_kendaraan.id");
		return $query->result();
	}

	public function cari_kota(){
	$query=$this->db->query("SELECT count(kota) as kondisi 
		FROM `car_rental_kota` 
		WHERE kota = '$_GET[kota]' ");
		return $query->result();
	}

	public function detail($id){
  		$query=$this->db->query("SELECT id_kota, kota, jenis_kendaraan, gambar, transfer, full_day, additional, highlight
		FROM car_rental_kota, car_rental_tarif, car_rental_kendaraan
		WHERE car_rental_tarif.id = '$id' AND car_rental_kota.id = car_rental_tarif.id_kota AND car_rental_tarif.id_kendaraan = car_rental_kendaraan.id");
		return $query->result();
	}

	
	
	} 