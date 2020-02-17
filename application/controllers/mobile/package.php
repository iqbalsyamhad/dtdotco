<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_crud');
	}

	public function getExclusivePackages()
	{
		$paket = $this->db->query("select * from ol_paketumroh a join ol_pemberangkatan b on a.idpaketumroh = b.idpaketumroh where jenis = 'exclusive' group by a.idpaketumroh order by a.idpaketumroh desc");
		$jsondata = array();
		foreach ($paket->result() as $r) {
			array_push($jsondata, array(
				'id' => $r->idpaketumroh,
				'type' => 'Exclusive',
				'name' => $r->nmpaketumroh,
				'description' => strip_tags($r->overview),
				'detail' => str_replace("<?php echo base_url()?>", "https://dreamtour.co/", $r->rincian),
				'perjalanan' => '',
				'price' => rupiah($r->hrgquad),
				'airlines' => 'airlines',
				'hotel' => 'hotel',
				'persyaratan' => $r->pandp,
				'informasi_lanjut' => $r->moreinfo,
				'photo' => $r->imgpaketumroh,
				'termasuk' => $r->termasuk,
				'tdktermasuk' => $r->tdktermasuk,
				'updated_at' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s')
			));
		}

		echo json_encode($jsondata);
		//print_r($jsondata);
	}

	public function getExclusivePlusPackages()
	{
		$paket = $this->db->query("select * from ol_paketumroh a join ol_pemberangkatan b on a.idpaketumroh = b.idpaketumroh where jenis = 'plus' group by a.idpaketumroh order by a.idpaketumroh desc");
		$jsondata = array();
		foreach ($paket->result() as $r) {
			array_push($jsondata, array(
				'id' => $r->idpaketumroh,
				'type' => 'Exclusive',
				'name' => $r->nmpaketumroh,
				'description' => strip_tags($r->overview),
				'detail' => str_replace("<?php echo base_url()?>", "https://dreamtour.co/", $r->rincian),
				'perjalanan' => '',
				'price' => rupiah($r->hrgquad),
				'airlines' => 'airlines',
				'hotel' => 'hotel',
				'persyaratan' => $r->pandp,
				'informasi_lanjut' => $r->moreinfo,
				'photo' => $r->imgpaketumroh,
				'termasuk' => $r->termasuk,
				'tdktermasuk' => $r->tdktermasuk,
				'updated_at' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s')
			));
		}

		echo json_encode($jsondata);
	}

	public function getHolidayPackages(){
		$paket = $this->db->query("select * from ol_paketumroh a join ol_pemberangkatan b on a.idpaketumroh = b.idpaketumroh where jenis = 'holiday' group by a.idpaketumroh order by a.idpaketumroh desc");
		$jsondata = array();
		foreach ($paket->result() as $r) {
			array_push($jsondata, array(
				'id' => $r->idpaketumroh,
				'type' => 'Exclusive',
				'name' => $r->nmpaketumroh,
				'description' => strip_tags($r->overview),
				'detail' => str_replace("<?php echo base_url()?>", "https://dreamtour.co/", $r->rincian),
				'perjalanan' => '',
				'price' => rupiah($r->hrgquad),
				'airlines' => 'airlines',
				'hotel' => 'hotel',
				'persyaratan' => $r->pandp,
				'informasi_lanjut' => $r->moreinfo,
				'photo' => $r->imgpaketumroh,
				'termasuk' => $r->termasuk,
				'tdktermasuk' => $r->tdktermasuk,
				'updated_at' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s')
			));
		}

		echo json_encode($jsondata);
	}
}