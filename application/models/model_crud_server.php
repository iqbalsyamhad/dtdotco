<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_crud_server extends CI_Model 
{
	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    function ambilData($tablename="",$listfield="",$where="")
    {
        $sbseries = $this->load->database('sbseries', TRUE);

        $query=null;
        if (empty($listfield)) {
            if (empty($where)) {
                $query = $sbseries->query("select * from ".$tablename);
            } else {
                $query = $sbseries->query("select * from ".$tablename." where ".$where);
            }
        } else {
            if (empty($where)) {
                $query = $sbseries->query("select ".$listfield." from ".$tablename);
            } else {
                $query = $sbseries->query("select ".$listfield." from ".$tablename." where ".$where);
            }
        }

        return $query->result();
    }

    function simpan($tabel="",$data=""){
        $sbseries = $this->load->database('sbseries', TRUE);
        return $sbseries->insert($tabel, $data);
    }

    function newId($tbl="",$field="")
    {
        $sbseries = $this->load->database('sbseries', TRUE);

        $sbseries->select_max($field,'id');
        $query = $sbseries->get($tbl);
        $id = $query->row()->id+1;
        return $id;
    }

    function newIdjamaah(){
        $sbseries = $this->load->database('sbseries', TRUE);

        $waktu = date('y').date('m');
        $digit = 0;
        $q = $sbseries->query('SELECT RIGHT(idjamaah,4) as data FROM ol_jamaah_master WHERE idjamaah LIKE "J-'.$waktu.'%" ORDER BY idjamaah DESC LIMIT 1');
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $digit = ((int)$r->data+1);
            }
        }
        else{
            $digit = 1;
        }
        
        return "J-".$waktu.str_pad($digit, 4, '0', STR_PAD_LEFT);
    }   

    function newIdjamaahTrx(){
        $sbseries = $this->load->database('sbseries', TRUE);

        $waktu = date('y').date('m');
        $digit = 0;
        $q = $sbseries->query('SELECT RIGHT(idtrxjamaah,4) as data FROM ol_jamaah_transaksi WHERE idtrxjamaah LIKE "'.$waktu.'%" ORDER BY idtrxjamaah DESC LIMIT 1');
        if($q->num_rows() > 0){
            foreach ($q->result() as $r) {
                $digit = ((int)$r->data+1);
            }
        }
        else{
            $digit = 1;
        }
        
        return $waktu.str_pad($digit, 4, '0', STR_PAD_LEFT);
    }   

    function logfiles($siapa, $ngapain, $target){
        $logfile = APPPATH . '/logfiles/'.date('Y-m-d').'.txt';
        file_put_contents($logfile, "\n".'::'.date('d-m-Y H:i:s').' => '.$siapa.' '.$ngapain.' '.$target.'!', FILE_APPEND);
    }

    function sendtoseries($idinvoice){
        $berhasil = 1;
        $djamaah = array();
        $indeks = 0;
        $this->load->model('model_crud');
        $invoiceq = $this->model_crud->ambilData('ol_invoice', '*', 'idinvoice = "'.$idinvoice.'"');
        foreach ($invoiceq as $r) {
            $paketq = $this->model_crud->ambilData('ol_paketumroh a join ol_pemberangkatan b on a.idpaketumroh = b.idpaketumroh', 'hrgperlengkapan, idpembadmin', 'idpemberangkatan = '.$r->idpemberangkatan);
            foreach ($paketq as $rp) {
                $sidebside['idpemberangkatan'] = $rp->idpembadmin;
                $hrgplkpn = $rp->hrgperlengkapan;
            }
            
            $sidebside['pic'] = 6;
            $sidebside['keterangan'] = 'Daftar dari website';
            $sidebside['hexcolor'] = sprintf('%06X', mt_rand(0, 0xFFFFFF));
            $sidebside['isGroup'] = 1;
            $sidebside['sbs_creatby'] = 6;
            $sidebside['sbs_updatby'] = 6;
            $sidebside['sbs_creatat'] = date('Y-m-d H:i:s');
            $sidebside['sbs_updatat'] = date('Y-m-d H:i:s');
            $sidebside['cancelin'] = date('Y-m-d H:i:s', strtotime('+2 days', strtotime($sidebside['sbs_creatat'])));

            $nohape = $r->nohp;
        }

        $jamaahq = $this->model_crud->ambilData('ol_invoice_lineitems', '*', 'idinvoice = "'.$idinvoice.'"');
        foreach ($jamaahq as $rj) {
            if($indeks == 0){
                $sidebside['nmsidebside'] = $rj->jamaah;
                $leadstat = 1;
                $nohptmp = $nohape;
            }
            else{
                $leadstat = 0;
                $nohptmp = '';
            }
            array_push($djamaah, array(
                'nmjamaah' => $rj->jamaah,
                'hpjamaah' => $nohptmp,
                'gender' => $rj->gender,
                'koper' => 0,
                'hrgperlengkapan' => $hrgplkpn,
                'seat' => 'ECO',
                'roomtype' => $rj->roomtype,
                'isCnb' => 0,
                'isLead' => $leadstat,
                'hrgpaket' => $rj->unitprice,
                'idpemberangkatan' => $sidebside['idpemberangkatan'],
                'created_by' => 6,
                'updated_by' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                )
            );

            $indeks++;
        }

        if($indeks > 0){
            $sidebside['idsidebside'] = $this->newId('ol_sidebside', 'idsidebside');
            $simpan = $this->simpan('ol_sidebside', $sidebside);
            if($simpan){
                for ($i=0; $i < ($indeks-1); $i++) { 
                    $mjamaah['nmjamaah'] = $djamaah[$i]['nmjamaah'];
                    $mjamaah['hpjamaah'] = $djamaah[$i]['hpjamaah'];
                    $mjamaah['gender'] = $djamaah[$i]['gender'];
                    $mjamaah['idjamaah'] = $this->newIdjamaah();

                    $simpanm = $this->simpan('ol_jamaah_master', $mjamaah);
                    if($simpanm){
                        $jamaahtrx['idjamaah'] = $mjamaah['idjamaah'];
                        $jamaahtrx['koper'] = $djamaah[$i]['koper'];
                        $jamaahtrx['hrgperlengkapan'] = $djamaah[$i]['hrgperlengkapan'];
                        $jamaahtrx['seat'] = $djamaah[$i]['seat'];
                        $jamaahtrx['roomtype'] = $djamaah[$i]['roomtype'];
                        $jamaahtrx['isCnb'] = $djamaah[$i]['isCnb'];
                        $jamaahtrx['hrgpaket'] = $djamaah[$i]['hrgpaket'];
                        $jamaahtrx['isLead'] = $djamaah[$i]['isLead'];
                        $jamaahtrx['idsidebside'] = $sidebside['idsidebside'];
                        $jamaahtrx['idpemberangkatan'] = $djamaah[$i]['idpemberangkatan'];
                        $jamaahtrx['created_by'] = $djamaah[$i]['created_by'];
                        $jamaahtrx['updated_by'] = $djamaah[$i]['updated_by'];
                        $jamaahtrx['created_at'] = $djamaah[$i]['created_at'];
                        $jamaahtrx['updated_at'] = $djamaah[$i]['updated_at'];
                        
                        $jamaahtrx['idtrxjamaah'] = $this->newIdjamaahTrx();

                        $simpanjamaahtrx = $this->simpan('ol_jamaah_transaksi', $jamaahtrx);
                        if($simpanjamaahtrx){
                            $this->logfiles('', 'Jamaah transaksi '.$jamaahtrx['idtrxjamaah'].' berhasil.', '');
                        }
                        else{
                            break;
                            $berhasil = 0;
                            $this->logfiles('', 'Gagal unggah Jamaah transaksi '.$jamaahtrx['idjamaah'], '');
                        }
                    }
                    else{
                        break;
                        $berhasil = 0;
                        $this->logfiles('', 'Gagal unggah Jamaah master '.$mjamaah['nmjamaah'], '');
                    }
                }
            }
            else{
                $berhasil = 0;
                $this->logfiles('', 'Gagal unggah SBS '.$sidebside['nmsidebside'], '');
            }

            if($berhasil == 1){
                $sukses['isMigrated'] = 1;
                $updsukses = $this->model_crud->update('ol_invoice', $sukses, 'idinvoice', $idinvoice);
                if($updsukses){
                    $this->logfiles('', $idinvoice.' DONE!!', '');
                }
                else{
                    $this->logfiles('', 'Gagal update status sukses '.$idinvoice, '');
                }
            }
        }
        else{
            $berhasil = 0;
            $this->logfiles('', 'Data '.$idinvoice.' tidak ditemukan', '');
        }
    }
}
?>