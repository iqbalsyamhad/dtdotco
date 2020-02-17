<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formumroh extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('fpdf');
		$this->load->model('Usermodel');
		$this->load->model('Formumroh_model');
	}

	public function index()
	{
		if($this->auth->is_logged_in() == false)
		{
			$this->login();
		}
		else
		{
			// load model 'usermodel'
			$this->load->model('formumroh_model');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->formumroh_model->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('formumroh/dashboard',$data);
			$this->load->view('formumroh/awal');
		}
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">', '</span>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->template->set('title','Login Form | DreamTour.co');
			$this->load->view('formumroh/login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('formumroh');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('formumroh/login',$data);		
			}
		}
	}
	public function logout()
	{
		if($this->auth->is_logged_in() == true)
		{
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();
		}
		// larikan ke halaman utama
		redirect('formumroh');
	}

	
	public function keberangkatan()
	{	
		$this->auth->restrict();
		$data['list'] = $this->Formumroh_model->list_keberangkatan();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List Keberangkatan');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_keberangkatan',$data);
	}


	public function tambah_keberangkatan()
	{	
		$this->auth->restrict();
		$this->template->set('title','Tambah Keberangkatan');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/tambah_keberangkatan');
	}

	
	public function simpan_keberangkatan()
	{	
		$this->auth->restrict();
		$this->Formumroh_model->simpan_keberangkatan();
		
		redirect ('formumroh/keberangkatan');		
	}

	public function edit_keberangkatan($id){
		$this->auth->restrict();
		$this->load->model('Formumroh_model');
		$where['id'] = $id;
		$a=$this->db->get_where('form_keberangkatan',$where)->row();
		$data['id']=$id;
		$data['tanggal_ubah']=$a->tanggal;  

		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/ubah_keberangkatan',$data);

    // $data = $this->input->post('ds');
	}

	public function simpan_ubah_keberangkatan()
	{
		$this->Formumroh_model->simpan_ubah_keberangkatan();

		$data['list'] = $this->Formumroh_model->list_keberangkatan();

		$this->template->set('title','List Keberangkatan');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_keberangkatan',$data);
	}

	public function cari_keberangkatan(){
		$this->auth->restrict();
		$data['list'] = $this->Formumroh_model->cari_keberangkatan();

		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_keberangkatan',$data);
	}

	public function cari_jamaah(){
		$this->auth->restrict();
		$data['list'] = $this->Formumroh_model->cari_jamaah();

		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_jamaah',$data);
	}

	public function hapus_keberangkatan($id){
		$this->auth->restrict();
		$this->Formumroh_model->hapus_keberangkatan($id);
		$data['list'] = $this->Formumroh_model->list_keberangkatan();


		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_keberangkatan',$data);
	}

	// start for deposit
	public function tambah_deposit($id)
	{
		$this->load->model('Formumroh_model');
		$where['id'] = $id;
		$a=$this->db->get_where('form_jamaah',$where)->row();
		$data['id']=$id; 
		$data['nama'] =$a->nama;
		$this->template->set('title','Tambah Deposit');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/tambah_deposit',$data);
	}

	public function simpan_deposit(){
		$this->auth->restrict();
		$this->Formumroh_model->simpan_deposit();

		$data['list'] = $this->Formumroh_model->list_jamaah();

		$this->template->set('title','List Jamaah');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_jamaah',$data);
	}

	// start for jamaah

	public function jamaah()
	{	
		$this->auth->restrict();
		$data['list'] = $this->Formumroh_model->list_jamaah();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List Jamaah');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_jamaah',$data);
	}

	public function tambah_jamaah()
	{
		$this->auth->restrict();
		$this->template->set('title','Tambah Jamaah');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/tambah_jamaah');
	}

	public function simpan_jamaah()
	{	
		$this->auth->restrict();
		$this->Formumroh_model->simpan_jamaah();
		$this->Formumroh_model->simpan_jamaah_deposit();
		
		$data['list'] = $this->Formumroh_model->list_jamaah();
		redirect ('formumroh/jamaah');		
	}

	public function edit_jamaah($id){
		$this->auth->restrict();
		$this->load->model('Formumroh_model');
		$where['id'] = $id;
		$a=$this->db->get_where('form_jamaah',$where)->row();
		$data['id']=$id; 
		$data['id_keberangkatan'] =$a->id_keberangkatan;
		$data['tipe_kamar'] =$a->tipe_kamar;
		$data['nama'] =$a->nama;
		$data['nama_ayah'] =$a->nama_ayah;
		$data['jenis_kelamin'] = $a->jenis_kelamin;
		$data['tempat_lahir'] = $a->tempat_lahir;
		$data['tgl_lahir'] = $a->tgl_lahir;
		$data['kwn'] = $a->kwn;
		$data['alamat'] = $a->alamat;
		$data['rt'] = $a->rt;
		$data['rw'] = $a->rw;
		$data['kelurahan'] = $a->kelurahan;
		$data['kecamatan'] =$a->kecamatan;
		$data['kode_pos'] = $a->kode_pos;
		$data['domisili'] = $a->domisili;
		$data['alamat_surat'] = $a->alamat_surat;
		$data['telp'] = $a->telp;
		$data['hp'] = $a->hp;
		$data['no_wa'] = $a->no_wa;
		$data['pin_bb'] = $a->pin_bb;
		$data['email'] = $a->email;
		$data['pekerjaan'] = $a->pekerjaan;
		$data['nama_mahram'] = $a->nama_mahram;
		$data['hubungan_mahram'] =$a->hubungan_mahram;
		$data['ktp'] = $a->ktp;
		$data['buku_nikah'] = $a->buku_nikah;
		$data['kk'] = $a->kk;
		$data['akta'] = $a->akta;
		$data['passport'] = $a->passport;
		$data['kartu_kuning'] = $a->kartu_kuning;
		$data['pas_foto'] = $a->pas_foto;
		$data['biaya_perlengkapan'] = $a->biaya_perlengkapan;

		$where1['id'] = $a->id_keberangkatan;
		$a=$this->db->get_where('form_keberangkatan',$where1)->row();
		$data['tanggal']=$a->tanggal;  
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/ubah_jamaah',$data);
	}

	public function simpan_ubah_jamaah(){
		$this->Formumroh_model->simpan_ubah_jamaah1();

		$data['list'] = $this->Formumroh_model->list_jamaah();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List Jamaah');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_jamaah',$data);
	}

	public function hapus_jamaah($id){
		$this->auth->restrict();
		$this->Formumroh_model->hapus_jamaah($id);
		$this->Formumroh_model->hapus_deposit($id);
		$data['list'] = $this->Formumroh_model->list_jamaah();


		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/list_jamaah',$data);
	}

	public function birthday(){
		$this->auth->restrict();
		$data['list'] = $this->Formumroh_model->birthday();

		$this->template->set('title',' Jamaah Ulangtahun');
		$this->load->view('formumroh/dashboard');
		$this->load->view('formumroh/birthday',$data);
	}

	public function form_pdf($id){
		$this->auth->restrict();
		$this->load->model('Formumroh_model');
		$where['id'] = $id;
		$a=$this->db->get_where('form_jamaah',$where)->row();
		$data['id_jamaah']=$id; 
		$data['id_keberangkatan'] =$a->id_keberangkatan;
		$data['nama'] =$a->nama;
		$data['tipe_kamar'] =$a->tipe_kamar;
		$data['nama_ayah'] =$a->nama_ayah;
		$data['jenis_kelamin'] = $a->jenis_kelamin;
		$data['tempat_lahir'] = $a->tempat_lahir;
		$data['tgl_lahir'] = $a->tgl_lahir;
		$data['kwn'] = $a->kwn;
		$data['alamat'] = $a->alamat;
		$data['rt'] = $a->rt;
		$data['rw'] = $a->rw;
		$data['kelurahan'] = $a->kelurahan;
		$data['kecamatan'] =$a->kecamatan;
		$data['kode_pos'] = $a->kode_pos;
		$data['domisili'] = $a->domisili;
		$data['alamat_surat'] = $a->alamat_surat;
		$data['telp'] = $a->telp;
		$data['hp'] = $a->hp;
		$data['no_wa'] = $a->no_wa;
		$data['pin_bb'] = $a->pin_bb;
		$data['email'] = $a->email;
		$data['pekerjaan'] = $a->pekerjaan;
		$data['nama_mahram'] = $a->nama_mahram;
		$data['hubungan_mahram'] =$a->hubungan_mahram;
		$data['ktp'] = $a->ktp;
		$data['buku_nikah'] = $a->buku_nikah;
		$data['kk'] = $a->kk;
		$data['akta'] = $a->akta;
		$data['passport'] = $a->passport;
		$data['kartu_kuning'] = $a->kartu_kuning;
		$data['pas_foto'] = $a->pas_foto;
		$data['biaya_perlengkapan'] = $a->biaya_perlengkapan;

		$where1['id'] = $a->id_keberangkatan;
		$a=$this->db->get_where('form_keberangkatan',$where1)->row();
		$data['tanggal']=$a->tanggal;

		$this->load->view('formumroh/form_pdf',$data);
	}

	

	public function surat($id){

		$this->auth->restrict();
		$where['id'] = $id;
		$a=$this->db->get_where('lobc',$where)->row();
		$id=$id;
		$no=$a->no;
		$flight=$a->flight;
		$to=$a->to;
		$dalamat=$a->alamat;
		$hp=$a->hp;
		$tanggal_berangkat=$a->tanggal_berangkat;
		$tanggal_pulang=$a->tanggal_pulang;
		$flight_no_berangkat=$a->flight_no_berangkat;
		$flight_no_pulang=$a->flight_no_pulang;
		$class_berangkat=$a->class_berangkat;
		$class_pulang=$a->class_pulang;
		$dep_berangkat=$a->dep_berangkat;
		$dep_pulang=$a->dep_pulang;
		$arr_berangkat=$a->arr_berangkat;
		$arr_pulang=$a->arr_pulang;
		$etd_berangkat=$a->etd_berangkat;
		$etd_pulang=$a->etd_pulang;
		$eta_berangkat=$a->eta_berangkat;
		$eta_pulang=$a->eta_pulang;
		$pnr_berangkat=$a->pnr_berangkat;
		$pnr_pulang=$a->pnr_pulang;
		$seat_booked=$a->seat_booked;
		$rate=$a->rate;


		$this->fpdf->Open();
        $this->fpdf->AddPage();
        //$this->fpdf->Image('assets/images/logo.png',170,5,33);
        $this->fpdf->SetFont('Arial','B',10);
        //Move to the right
        //$this->fpdf->Cell(80);
        //Title
        //$this->fpdf->Ln(5);
        //$this->fpdf->Cell(30,10,'Report Controllers',0,0,'L');
        //$this->fpdf->Cell(30,10,'Customer',0,0,'L');
        $y = $this->fpdf->GetY(); //Need the current Y value to reset it after the next line, as multicell automatically moves down after write
        $x = $this->fpdf->GetX();
		$this->fpdf->setFont('Arial','',10);
		$this->fpdf->setFillColor(255,255,255);
		$this->fpdf->cell(00,6,'LATTER OF BOOKING CONFIRMATION' .$id ,1,0,'C',1);

		$this->fpdf->Ln(6);
		$this->fpdf->setFont('Arial','',10);
		$this->fpdf->setFillColor(255,255,255);
		$this->fpdf->cell(95 ,6,'Alamat  : '.$alamat ,1,0,'L',0);
		$this->fpdf->Ln(6);
		$this->fpdf->cell(95 ,6,'To      : '.$to ,1,0,'L',0);
 
        //Line break
        $this->fpdf->Ln(20);
        $this->fpdf->SetY(0); //reset the Y to the original, since we moved it down to write INVOICE
        $this->fpdf->SetFont('Arial','',7);
        $this->fpdf->SetDrawColor(255,255,255);
        $this->fpdf->SetFillColor(0,0,0); //Set background of the cell to be that grey color
        $this->fpdf->SetTextColor(255,255,255);
        $this->fpdf->SetY(30);
 
        $this->fpdf->Ln(0);
        $this->fpdf->Cell(20,8,"Device Type ",1,0,'C',true);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'true' tells it to fill the cell with the color specified
        $this->fpdf->Cell(40,8,"Module",1,0,'C',true);  //Write a cell 20 wide, 12 high, filled and bordered, with Order # centered inside, last argument 'true' tells it to fill the cell with the color specified
        $this->fpdf->Cell(60,8,"Remote Addr",1,0,'C',true);
        $this->fpdf->Cell(40,8,"Date",1,0,'C',true);
 
        $this->fpdf->Ln(8);
        $this->fpdf->SetDrawColor(0,0,0);
        $this->fpdf->SetFillColor(224,224,224);
        $this->fpdf->SetTextColor(0,0,0);
 
 
        $this->fpdf->Cell(20,8,"Device typenyaDevice",1,0,'C');
        $this->fpdf->Cell(40,8,"Modulenya",1,0,'C');
        $this->fpdf->Cell(60,8,"remote addressnya ",1,0,'C');
        $this->fpdf->Cell(40,8,"datenya",1,0,'C');
        $this->fpdf->Ln(8);
 
        $this->fpdf->Output('output.pdf','D');
	}

	public function pdf() { 
		$this->auth->restrict();      
		$this->load->view('lembur/coba_pdf');
	}

}