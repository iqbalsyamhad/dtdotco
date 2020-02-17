<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kperjalanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('fpdf');
		$this->load->model('Usermodel');
		$this->load->model('Kperjalanan_model');
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
			$this->load->model('kperjalanan_model');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->kperjalanan_model->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			$this->load->view('kperjalanan/dashboard',$data);
			$this->load->view('kperjalanan/awal');
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
			$this->load->view('kperjalanan/login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('kperjalanan');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('kperjalanan/login',$data);		
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
		redirect('kperjalanan');
	}

	
	public function list_kperjalanan()
	{	
		$this->auth->restrict();
		$data['list'] = $this->Kperjalanan_model->list_kperjalanan();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List kperjalanan');
		$this->load->view('kperjalanan/dashboard');
		$this->load->view('kperjalanan/list_kperjalanan',$data);
	}


	public function tambah()
	{	
		$this->auth->restrict();
		$this->template->set('title','Tambah kperjalanan');
		$this->load->view('kperjalanan/dashboard');
		$this->load->view('kperjalanan/tambah_kperjalanan');
	}

	
	public function kperjalanan_simpan()
	{	
		$this->Kperjalanan_model->kperjalanan_simpan();
		$this->Kperjalanan_model->kperjalanan_flight_simpan();
		$this->Kperjalanan_model->kperjalanan_hotel_simpan();
		$this->Kperjalanan_model->kperjalanan_hari_simpan();
		$this->Kperjalanan_model->kperjalanan_inc_exc();

		redirect ('kperjalanan/tambah');		
	}

	public function editkperjalanan($id_kperjalanan){
		$this->auth->restrict();
		$this->load->model('Kperjalanan_model');
		$where['id_kperjalanan'] = $id_kperjalanan;
		$a=$this->db->get_where('kperjalanan',$where)->row();
		$data['id_kperjalanan']=$id_kperjalanan;
		$data['group']=$a->group;
		$data['tgl_berangkat']=$a->tgl_berangkat;
		$data['tgl_pulang']=$a->tgl_pulang;
		$data['creator']=$a->creator;
		$data['berempat']=$a->berempat;
		$data['bertiga']=$a->bertiga;
		$data['berdua']=$a->berdua;

		
		$this->load->view('kperjalanan/dashboard');
		$this->load->view('kperjalanan/ubah_kperjalanan',$data);

    // $data = $this->input->post('ds');
	}

	public function kperjalanan_simpan_ubah(){
		$this->auth->restrict();
		$this->Kperjalanan_model->kperjalanan_simpan_ubah();

		$id = $this->input->post('id_kperjalanan');

		$this->load->model('kperjalanan_model');
		$where['id'] = $id;
		$a=$this->db->get_where('kperjalanan',$where)->row();
		$data['id']=$id;
		$data['no']=$a->no;
		$data['flight']=$a->flight;
		$data['to']=$a->to;
		$data['tanggal']=$a->tanggal;
		$data['alamat']=$a->alamat;
		$data['hp']=$a->hp;
		$data['tanggal_berangkat']=$a->tanggal_berangkat;
		$data['tanggal_pulang']=$a->tanggal_pulang;
		$data['flight_no_berangkat']=$a->flight_no_berangkat;
		$data['flight_no_pulang']=$a->flight_no_pulang;
		$data['class_berangkat']=$a->class_berangkat;
		$data['class_pulang']=$a->class_pulang;
		$data['dep_berangkat']=$a->dep_berangkat;
		$data['dep_pulang']=$a->dep_pulang;
		$data['arr_berangkat']=$a->arr_berangkat;
		$data['arr_pulang']=$a->arr_pulang;
		$data['etd_berangkat']=$a->etd_berangkat;
		$data['etd_pulang']=$a->etd_pulang;
		$data['eta_berangkat']=$a->eta_berangkat;
		$data['eta_pulang']=$a->eta_pulang;
		$data['pnr_berangkat']=$a->pnr_berangkat;
		$data['pnr_pulang']=$a->pnr_pulang;
		$data['seat_booked']=$a->seat_booked;
		$data['rate']=$a->rate;
		$data['visa']=$a->visa;

		$this->load->view('kperjalanan/dashboard');
		$this->load->view('kperjalanan/ubah_kperjalanan',$data);
	}

	public function surat_pdf($id_kperjalanan){
		$this->auth->restrict();
		$this->load->model('Kperjalanan_model');
		$where['id_kperjalanan'] = $id_kperjalanan;
		$a=$this->db->get_where('kperjalanan',$where)->row();
		$data['id_kperjalanan']=$id_kperjalanan;
		$data['group']=$a->group;
		$data['tgl_berangkat']=$a->tgl_berangkat;
		$data['tgl_pulang']=$a->tgl_pulang;
		$data['creator']=$a->creator;
		$data['berempat']=$a->berempat;
		$data['bertiga']=$a->bertiga;
		$data['berdua']=$a->berdua;

		$res['data'] = $this->Kperjalanan_model->list_kperjalanan();
		$this->load->view('kperjalanan/surat_pdf',$data);

	}

	public function surat($id){

		$this->auth->restrict();
		$where['id'] = $id;
		$a=$this->db->get_where('kperjalanan',$where)->row();
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