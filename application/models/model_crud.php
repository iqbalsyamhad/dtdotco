<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_crud extends CI_Model 
{
		public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

         /* olah file */
        function uploadGambar($nama_file='',$folder='') {
            $this->pathgambar= realpath(APPPATH . "../$folder");
            $config = array(
		'allowed_types' => 'jpg|png|gif|jpeg',
                'upload_path' => $this->pathgambar
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload($nama_file);
            $file_data = $this->upload->data();
            $nama_file = $file_data['file_name'];
            return $nama_file;
        }

        function uploadVideo($nama_file='',$folder='') {
            $this->pathgambar= realpath(APPPATH . "../$folder");
            $config = array(
        'allowed_types' => 'mp4|ogg|webm',
                'upload_path' => $this->pathgambar
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload($nama_file);
            $file_data = $this->upload->data();
            $nama_file = $file_data['file_name'];
            return $nama_file;
        }

        function uploadArsip($nama_file='',$folder='') {
            $this->pathgambar= realpath(APPPATH . "../$folder");
            $config = array(
        'allowed_types' => 'zip|rar',
                'upload_path' => $this->pathgambar
            );
            $this->load->library('upload', $config);
            $upload = $this->upload->do_upload($nama_file);
            $file_data = $this->upload->data();
            $nama_file = $file_data['file_name'];
            if($upload){
                return $nama_file;
            }else{
                return false;
            }
            
        }

        function uploadFile($nama_file='',$folder='') {
            $this->pathgambar= realpath(APPPATH . "../$folder");
            $config = array(
        'allowed_types' => 'jpg|png|gif|jpeg|zip|rar|doc|pdf|docx|xls|xlsx',
                'upload_path' => $this->pathgambar
            );
            $this->load->library('upload', $config);
            $this->upload->do_upload($nama_file);
            $file_data = $this->upload->data();
            $nama_file = $file_data['file_name'];
            return $nama_file;
        }

        function namaGambar($tabel='',$where='',$id = ''){
            $data = array();
            $this->db->select("*");
            $this->db->from($tabel);
            $this->db->where($where,$id);
            $hasil = $this->db->get();
            if($hasil->num_rows() > 0){
                return $hasil->row_array();
            }
        } 

        function deleteFile($namagambar='',$folder=''){
            $this->pathgambar = realpath(APPPATH . "../$folder");
            unlink($this->pathgambar."/".$namagambar);
        }
        /* end olah file */

	    function cekData($tablename="",$where=""){
	    	$cek = $this->db->query("SELECT * FROM ".$tablename." ".$where); 
	    	return $cek->num_rows();
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

	    function saveData($tablename="",$field="",$value=""){
	    	$this->db->query("insert into ".$tablename."(".$field.") values(".$value.")");

	    	return $this->db->affected_rows();
	    }

	    function updateData($tablename="",$dataupdate="",$where=""){
	    	$this->db->query("update ".$tablename." set ".$dataupdate." where ".$where);

	    	return $this->db->affected_rows();
	    }

	    function deleteData($tablename="",$where=""){
	    	if (empty($where)) {
                $this->db->query("Delete from ".$tablename);
            } else {
                $this->db->query("Delete from ".$tablename." where ".$where);
            }

            return $this->db->affected_rows();
	    }


	    function newId($tbl="",$field="")
	    {
	    	$this->db->select_max($field,'id');
			$query = $this->db->get($tbl);
			$id = $query->row()->id+1;
			return $id;
	    }

	    function simpan($tabel="",$data=""){
            return $this->db->insert($tabel, $data);
        }

        function update($tabel="",$data="",$where="",$id=""){

            $this->db->where($where, $id);
            return $this->db->update($tabel, $data);
        }
        
        function getData($tabel="",$field="",$where="",$id=""){
            $data = array();
            if (empty($field)) {
                $this->db->select("*");
            } else {
                $this->db->select($field);
            }
            $this->db->from($tabel);
            if (!empty($where)) {
                $this->db->where($where, $id);
            }
            $hasil = $this->db->get();
            
            if($hasil->num_rows() > 0){
                return $hasil->row_array();
            }
        }
        
        function selectData($tabel="",$field="",$where="",$id="",$orderby="",$ascdesc=""){
            $data = array();
            if (empty($field)) {
                $this->db->select("*");
            } else {
                $this->db->select($field);
            }
            $this->db->from($tabel);
            if (!empty($where)) {
                $this->db->where($where, $id);
            }
            if (!empty($orderby)) {
                $this->db->order_by($orderby,$ascdesc);
            }
            return  $hasil = $this->db->get();
        }

        function delete($tabel="",$where="",$id=""){
            $this->db->where($where,$id);
            return $this->db->delete($tabel);
        }

        function GetValue($tbl="",$field="",$where="",$vwhere="")
        {
            $q = $this->db->query('select '.$field.' from '.$tbl.' where '.$where.'='.$vwhere.'');
            foreach ($q->result() as $r) {
                return $r->$field;
            }
        }

        function GetValueLike($tbl="",$field="",$where="",$vwhere="")
        {
            $q = $this->db->query('select '.$field.' from '.$tbl.' where '.$where.' '.$vwhere.'');
            foreach ($q->result() as $r) {
                return $r->$field;
            }
        }

        function newInv(){
            $waktu = date('Y').date('m');
            $digit = 0;
            $q = $this->db->query('SELECT RIGHT(idinvoice,3) as data FROM ol_invoice WHERE idinvoice LIKE "DTT-'.$waktu.'%" ORDER BY idinvoice DESC LIMIT 1');
            if($q->num_rows() > 0){
                foreach ($q->result() as $r) {
                    $digit = ((int)$r->data+1);
                }
            }
            else{
                $digit = 1;
            }
            
            return 'DTT-'.$waktu.str_pad($digit, 3, '0', STR_PAD_LEFT);
        }   

        function newPayId($idinvoice){
            $digit = 0;
            $q = $this->db->query('SELECT RIGHT(idpayment,2) as data FROM ol_invoice_payment WHERE idpayment LIKE "'.$idinvoice.'-%" ORDER BY idpayment DESC LIMIT 1');
            if($q->num_rows() > 0){
                foreach ($q->result() as $r) {
                    $digit = ((int)$r->data+1);
                }
            }
            else{
                $digit = 1;
            }
            
            return $idinvoice.'-'.str_pad($digit, 2, '0', STR_PAD_LEFT);
        }       
}
?>