<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Lobc extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('fpdf');
		$this->load->model('Usermodel');
		$this->load->model('Lobc_model');
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
			$this->load->model('lobc_model');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->lobc_model->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu 
			redirect('lobc/list_lobc');
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
			$this->load->view('lobc/login');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('lobc');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('lobc/login',$data);		
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
		redirect('lobc');
	}

	public function test_print()
	{
		$this->load->view('lobc/test_print');
	}

	public function oke()
	{
		$this->load->view('lobc/new_dash');
	}

	
	public function list_lobc()
	{	
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->list_lobc();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List LOBC');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_lobc',$data);
	}

	public function lihat_lobc(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->lihat_lobc();

		$this->template->set('title','List LOBC');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_lobc',$data);
	}

	public function lihat_lobc_dep(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->lihat_lobc_dep();

		$this->template->set('title','List LOBC');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_lobc',$data);
	}


	public function tambah()
	{	
		$this->auth->restrict();
		$this->template->set('title','Tambah LOBC');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/tambah_lobc');
	}

	
	public function lobc_simpan()
	{	
		$this->auth->restrict();
		$this->Lobc_model->lobc_simpan();
		$this->Lobc_model->lobc_deposit_simpan();
		
		$data['list'] = $this->Lobc_model->list_lobc();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List LOBC');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/notif_sukses_tambah');	
		$this->load->view('lobc/list_lobc',$data);	
	}

	public function editLOBC($id){
		$this->auth->restrict();
		$this->load->model('Lobc_model');
		$where['id'] = $id;
		$a=$this->db->get_where('lobc',$where)->row();
		$data['id']=$id;
		$data['no']=$a->no;
		$data['to']=$a->to;	
		$data['tanggal']=$a->tanggal;
		$data['pnr']=$a->pnr;
		$data['seat_booked']=$a->seat_booked;
		$data['visa']=$a->visa;
		$data['rate']=$a->rate;
		$data['creator']=$a->creator;

		$to=$a->to;
		$where['id'] = $to;
		$b=$this->db->get_where('lobc_customer',$where)->row();
		$data['alamat']=$b->alamat;
		$data['hp']=$b->hp;
		$data['customer']=$b->customer;

		$pnr=$a->pnr;
		$where['id'] = $pnr;
		$c=$this->db->get_where('lobc_pnr',$where)->row();
		$data['flight']=$c->flight;	

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/ubah_lobc',$data);

    // $data = $this->input->post('ds');
	}

	public function lobc_simpan_ubah_deposit(){
		$this->Lobc_model->lobc_simpan_ubah_deposit();

		$id = $this->input->post('id_lobc');

		$this->load->model('Lobc_model');
		$where['id'] = $id;
		$a=$this->db->get_where('lobc',$where)->row();
		$data['id']=$id;
		$data['no']=$a->no;
		$data['to']=$a->to;	
		$data['tanggal']=$a->tanggal;
		$data['pnr']=$a->pnr;
		$data['seat_booked']=$a->seat_booked;
		$data['visa']=$a->visa;
		$data['rate']=$a->rate;
		$data['creator']=$a->creator;

		$to=$a->to;
		$where['id'] = $to;
		$b=$this->db->get_where('lobc_customer',$where)->row();
		$data['alamat']=$b->alamat;
		$data['hp']=$b->hp;
		$data['customer']=$b->customer;

		$pnr=$a->pnr;
		$where['id'] = $pnr;
		$c=$this->db->get_where('lobc_pnr',$where)->row();
		$data['flight']=$c->flight;

		$data['list'] = $this->Lobc_model->list_lobc();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','List LOBC');
		$this->load->view('lobc/notif_sukses_ubah');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_lobc',$data);
	}
	

	public function lobc_simpan_ubah1(){
		$this->auth->restrict();
		$this->Lobc_model->lobc_simpan_ubah();
		$this->Lobc_model->lobc_simpan_ubah_deposit();
		
		$id = $this->input->post('id');

		$this->load->model('Lobc_model');
		$where['id'] = $id;
		$a=$this->db->get_where('lobc',$where)->row();
		$data['id']=$id;
		$data['no']=$a->no;
		$data['to']=$a->to;	
		$data['tanggal']=$a->tanggal;
		$data['pnr']=$a->pnr;
		$data['seat_booked']=$a->seat_booked;
		$data['visa']=$a->visa;
		$data['rate']=$a->rate;
		$data['creator']=$a->creator;

		
		$where['id'] = $to;
		$b=$this->db->get_where('lobc_customer',$where)->row();
		$data['alamat']=$b->alamat;
		$data['hp']=$b->hp;
		$data['customer']=$b->customer;

		$pnr=$a->pnr;
		$where['id'] = $pnr;
		$c=$this->db->get_where('lobc_pnr',$where)->row();
		$data['flight']=$c->flight;

		$data['list'] = $this->Lobc_model->list_lobc();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)

		$this->template->set('title','List LOBC');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/notif_sukses_ubah');
		$this->load->view('lobc/list_lobc',$data);
	}

	public function lobc_simpan_ubah(){
		$this->auth->restrict();
		$this->Lobc_model->lobc_simpan_ubah();
		$this->Lobc_model->lobc_simpan_ubah_deposit();
		
		redirect('lobc/list_lobc');
		$this->load->view('lobc/notif_sukses_ubah');
	}

	public function ubah_status_deposit($id){
		$this->auth->restrict();
		$this->id = $id;
		$this->Lobc_model->ubahStatusDeposit($id);

		redirect('lobc/list_lobc');
		} 

	public function ubah_status_issued($id){
		$this->auth->restrict();
		$this->id = $id;
		$this->Lobc_model->ubahStatusIssued($id);

		redirect('lobc/list_lobc');
		} 

	// Start PNR
	public function list_pnr(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->list_pnr();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function detailPNR($id){
		$this->auth->restrict();
		$this->load->model('Lobc_model');
		$where['id'] = $id;
		$a=$this->db->get_where('lobc_pnr',$where)->row();
		$data['id']=$id;
		$data['pnr']=$a->pnr;
		$data['program']=$a->program;
		$data['flight']=$a->flight;
		$data['kuota_seat']=$a->kuota_seat;
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

		$data['tanggal_rute1']=$a->tanggal_rute1;
		$data['tanggal_rute2']=$a->tanggal_rute2;
		$data['flight_no_rute1']=$a->flight_no_rute1;
		$data['flight_no_rute2']=$a->flight_no_rute2;
		$data['class_rute1']=$a->class_rute1;
		$data['class_rute2']=$a->class_rute2;
		$data['dep_rute1']=$a->dep_rute1;
		$data['dep_rute2']=$a->dep_rute2;
		$data['arr_rute1']=$a->arr_rute1;
		$data['arr_rute2']=$a->arr_rute2;
		$data['etd_rute1']=$a->etd_rute1;
		$data['etd_rute2']=$a->etd_rute2;
		$data['eta_rute1']=$a->eta_rute1; 
		$data['eta_rute2']=$a->eta_rute2;

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/detail_pnr',$data);
	}

	public function tambah_pnr(){
		$this->auth->restrict();

		$this->template->set('title','Tambah PNR');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/tambah_pnr');
	}

	public function simpan_pnr(){
		$this->auth->restrict();
		$this->Lobc_model->simpan_pnr();
		$data['list'] = $this->Lobc_model->list_pnr();

		$this->template->set('title','List PNR');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function editPNR($id){
		$this->auth->restrict();
		$this->load->model('Lobc_model');
		$where['id'] = $id;
		$a=$this->db->get_where('lobc_pnr',$where)->row();
		$data['id']=$id;
		$data['pnr']=$a->pnr;
		$data['flight']=$a->flight;
		$data['program']=$a->program;
		$data['kuota_seat']=$a->kuota_seat;
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

		$data['tanggal_rute1']=$a->tanggal_rute1;
		$data['tanggal_rute2']=$a->tanggal_rute2;
		$data['flight_no_rute1']=$a->flight_no_rute1;
		$data['flight_no_rute2']=$a->flight_no_rute2;
		$data['class_rute1']=$a->class_rute1;
		$data['class_rute2']=$a->class_rute2;
		$data['dep_rute1']=$a->dep_rute1;
		$data['dep_rute2']=$a->dep_rute2;
		$data['arr_rute1']=$a->arr_rute1;
		$data['arr_rute2']=$a->arr_rute2;
		$data['etd_rute1']=$a->etd_rute1;
		$data['etd_rute2']=$a->etd_rute2;
		$data['eta_rute1']=$a->eta_rute1; 
		$data['eta_rute2']=$a->eta_rute2;

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/ubah_pnr',$data);
	}

	public function simpan_pnr_ubah(){
		$this->auth->restrict();
		$this->Lobc_model->simpan_pnr_ubah();
		$data['list'] = $this->Lobc_model->list_pnr();

		$this->template->set('title','List PNR');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/notif_sukses_ubah');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function lihat_pnr(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->lihat_pnr();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function pnr_flight(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->pnr_flight();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function pnr_dep(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->pnr_dep();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function pnr_up(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->pnr_up();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function pnr_down(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->pnr_down();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function dep_up(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->dep_up();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function dep_down(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->dep_down();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function tanggal_up(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->tanggal_up();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function tanggal_down(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->tanggal_down();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function lihat_seat_tersedia(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->lihat_seat_tersedia();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}

	public function lihat_seat_terpakai(){
		$this->auth->restrict();
		$data['list'] = $this->Lobc_model->lihat_seat_terpakai();

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/list_pnr',$data);
	}


	// CUSTOMER

	public function view_customer()
	{
		$this->auth->restrict();
		$data['customer'] = $this->Lobc_model->lobc_customer_view();
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','VIEW CUSTOMER');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/view_customer',$data);
	}

	public function tambah_customer()
	{	
		$this->auth->restrict();
		$this->template->set('title','Tambah Customer');
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/tambah_customer');
	}

	
	public function customer_simpan()
	{	
		$this->auth->restrict();
		$this->Lobc_model->lobc_customer_insert();
		
		$data['customer'] = $this->Lobc_model->lobc_customer_view();
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/notif_sukses_tambah');	
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','VIEW CUSTOMER');
		$this->load->view('lobc/view_customer',$data);		
	}

	public function ubah_customer($id)
	{
		$where['id'] = $id;
		$a = $this->db->get_where('lobc_customer',$where)->row();
		$data['id'] = $id;
		$data['customer'] = $a->customer;
		$data['alamat'] = $a->alamat;
		$data['hp'] = $a->hp;

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/ubah_customer',$data);
	}

	public function ubah_simpan_customer()
	{
		$this->Lobc_model->lobc_customer_edit();

		$data['customer'] = $this->Lobc_model->lobc_customer_view();
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/notif_sukses_ubah');		
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','VIEW CUSTOMER');
		$this->load->view('lobc/view_customer',$data);			
	}

	public function hapus_customer($id){
		$this->id = $id;
		$this->Lobc_model->lobc_customer_delete($id);

		$data['customer'] = $this->Lobc_model->lobc_customer_view();
		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/notif_sukses_hapus');		
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','VIEW CUSTOMER');
		$this->load->view('lobc/view_customer',$data);
	}


	public function surat_pdf($id){
		$this->auth->restrict();
		$this->load->model('Lobc_model');
		// db lobc
		$where['id'] = $id;
		$a=$this->db->get_where('lobc',$where)->row();
		$data['id']=$id;
		$data['no']=$a->no;
		$data['to']=$a->to;	
		$data['tanggal']=$a->tanggal;
		$data['seat_booked']=$a->seat_booked;
		$data['visa']=$a->visa;
		$data['rate']=$a->rate;
		$data['creator']=$a->creator;
		// db lobc_customer
		$to=$a->to;
		$where['id'] = $to;
		$b=$this->db->get_where('lobc_customer',$where)->row();
		$data['alamat']=$b->alamat;
		$data['hp']=$b->hp;
		$data['customer']=$b->customer;

		$pnr=$a->pnr;
		$where['id'] = $pnr;
		$c=$this->db->get_where('lobc_pnr',$where)->row();
		$data['flight']=$c->flight;
		$data['pnr']=$c->pnr;
		$data['tanggal_berangkat']=$c->tanggal_berangkat;
		$data['tanggal_pulang']=$c->tanggal_pulang;
		$data['flight_no_berangkat']=$c->flight_no_berangkat;
		$data['flight_no_pulang']=$c->flight_no_pulang;
		$data['class_berangkat']=$c->class_berangkat;
		$data['class_pulang']=$c->class_pulang;
		$data['dep_berangkat']=$c->dep_berangkat;
		$data['dep_pulang']=$c->dep_pulang;
		$data['arr_berangkat']=$c->arr_berangkat;
		$data['arr_pulang']=$c->arr_pulang;
		$data['etd_berangkat']=$c->etd_berangkat;
		$data['etd_pulang']=$c->etd_pulang;
		$data['eta_berangkat']=$c->eta_berangkat;
		$data['eta_pulang']=$c->eta_pulang;
		

		//$res['data'] = $this->Lobc_model->list_lobc();
		//$data['data'] = $this->Lobc_model->list_lobc();
		$this->load->view('lobc/coba_pdf',$data);

	}

	public function ubah_password($user_id)
	{	$this->auth->restrict();
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(10);
		$where['user_id'] = $user_id;
		$a = $this->db->get_where('user',$where)->row();
		$data['user_id'] = $user_id;
		$data['user_nama'] = $a->user_nama;
		$data['user_username'] = $a->user_username;
		$data['user_password'] = $a->user_password;
		$data['user_level'] = $a->user_level;

		$this->load->view('lobc/new_dash');
		$this->load->view('lobc/ubah_password',$data);
	}

	public function ubahSimpanPassword()
	{	$this->auth->restrict();
		$this->Usermodel->ubahPassword();
		
		$this->template->set('title','Login Form | DreamTour.co');
		$this->template->load('template','linventori');	
	}

	public function surat($id){

		$this->auth->restrict();
		$where['id'] = $id;
		$a=$this->db->get_where('lobc',$where)->row();
		$id=$id;
		$no=$a->no;
		$to=$a->to;	
		$tanggal=$a->tanggal;
		$seat_booked=$a->seat_booked;
		$visa=$a->visa;
		$rate=$a->rate; 
		$materializes=$a->materializes; 
		$creator=$a->creator;
		// db lobc_customer
		$to=$a->to;
		$where['id'] = $to;
		$b=$this->db->get_where('lobc_customer',$where)->row();
		$alamat=$b->alamat;
		$hp=$b->hp;
		$customer=$b->customer;

		$pnr=$a->pnr;
		$where['id'] = $pnr;
		$c=$this->db->get_where('lobc_pnr',$where)->row();
		$flight=$c->flight;
		$pnr=$c->pnr;
		$tanggal_berangkat=$c->tanggal_berangkat;
		$tanggal_pulang=$c->tanggal_pulang;
		$flight_no_berangkat=$c->flight_no_berangkat;
		$flight_no_pulang=$c->flight_no_pulang;
		$class_berangkat=$c->class_berangkat;
		$class_pulang=$c->class_pulang;
		$dep_berangkat=$c->dep_berangkat;
		$dep_pulang=$c->dep_pulang;
		$arr_berangkat=$c->arr_berangkat;
		$arr_pulang=$c->arr_pulang;
		$etd_berangkat=$c->etd_berangkat;
		$etd_pulang=$c->etd_pulang;
		$eta_berangkat=$c->eta_berangkat;
		$eta_pulang=$c->eta_pulang;

		$tanggal_rute1=$c->tanggal_rute1;
		$tanggal_rute2=$c->tanggal_rute2;
		$flight_no_rute1=$c->flight_no_rute1;
		$flight_no_rute2=$c->flight_no_rute2;
		$class_rute1=$c->class_rute1;
		$class_rute2=$c->class_rute2;
		$dep_rute1=$c->dep_rute1;
		$dep_rute2=$c->dep_rute2;
		$arr_rute1=$c->arr_rute1;
		$arr_rute2=$c->arr_rute2;
		$etd_rute1=$c->etd_rute1;
		$etd_rute2=$c->etd_rute2;
		$eta_rute1=$c->eta_rute1;
		$eta_rute2=$c->eta_rute2;


		$this->fpdf->Open();
		$this->fpdf->AddPage();
		$this->fpdf->Image('asset/images/web.jpg',88,12,40);
		$this->fpdf->Ln(35);
		$this->fpdf->SetFont('Arial','B',10);
        //Move to the right
        //$this->fpdf->Cell(80);
        //Title
        //$this->fpdf->Ln(5);
        //$this->fpdf->Cell(30,10,'Report Controllers',0,0,'L');
        //$this->fpdf->Cell(30,10,'Customer',0,0,'L');
        $y = $this->fpdf->GetY(); //Need the current Y value to reset it after the next line, as multicell automatically moves down after write
        $x = $this->fpdf->GetX();
        $y = $this->fpdf->GetY(); //Need the current Y value to reset it after the next line, as multicell automatically moves down after write
        $x = $this->fpdf->GetX();
        $this->fpdf->setFont('Arial','',10);
        $this->fpdf->setFillColor(255,255,255);
        $this->fpdf->cell(00,6,'LETTER OF BOOKING CONFIRMATION' ,1,0,'C',1);
        $this->fpdf->Ln(6);
        $this->fpdf->setFont('Arial','',10);
        $this->fpdf->setFillColor(255,255,255);
        $this->fpdf->cell(95 ,6,'No          : '.$no ,1,0,'L',0);
        $this->fpdf->cell(95 ,6,'To          : '.$customer ,1,0,'L',0);
        $this->fpdf->Ln(6);
        $this->fpdf->cell(95 ,12,'Flight      : '.$flight ,1,0,'L',0);
        $this->fpdf->cell(95 ,6, 'Alamat   : ' .$alamat ,1,0,'L',0);
        $this->fpdf->Ln(6);
        $this->fpdf->cell(95 ,6, '     ' ,0,0,'L',0);
        $this->fpdf->cell(95 ,6, 'Ponsel   : '.$hp ,1,0,'L',0);

        //
        $this->fpdf->Ln(11);
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->cell(95 ,7, 'Booking Information ',0,0,'L',0);

        //tabel
        
     
        if ($tanggal_rute1 = "0000-00-00") {
          $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial','',10);        
        $this->fpdf->cell(35 ,7, 'Day & Date' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Flight No' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Class' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Dep' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Arr' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'ETD' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'ETA' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'PNR' ,1,0,'C',0);
        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(35 ,7, date("D, ",strtotime($tanggal_berangkat)). date("d M Y",strtotime($tanggal_berangkat)) ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $flight_no_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $class_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $dep_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $arr_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $etd_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $eta_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $pnr ,0,0,'C',0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(35 ,7, date("D, ",strtotime($tanggal_pulang)). date("d M Y",strtotime($tanggal_pulang)) ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $flight_no_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $class_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $dep_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $arr_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $etd_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $eta_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $pnr ,0,0,'C',0);
        }else{
        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial','',10);        
        $this->fpdf->cell(35 ,7, 'Day & Date' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Flight No' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Class' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Dep' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'Arr' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'ETD' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'ETA' ,1,0,'C',0);
        $this->fpdf->cell(22 ,7, 'PNR' ,1,0,'C',0);
        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(35 ,7, date("D, ",strtotime($tanggal_berangkat)). date("d M Y",strtotime($tanggal_berangkat)) ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $flight_no_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $class_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $dep_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $arr_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $etd_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $eta_berangkat ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $pnr ,0,0,'C',0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(35 ,7, date("D, ",strtotime($tanggal_pulang)). date("d M Y",strtotime($tanggal_pulang)) ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $flight_no_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $class_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $dep_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $arr_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $etd_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $eta_pulang ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $pnr ,0,0,'C',0);	

        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(35 ,7, date("D, ",strtotime($tanggal_rute1)). date("d M Y",strtotime($tanggal_rute1)) ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $flight_no_rute1 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $class_rute1 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $dep_rute1 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $arr_rute1,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $etd_rute1 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $eta_rute1 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $pnr ,0,0,'C',0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(35 ,7, date("D, ",strtotime($tanggal_rute2)). date("d M Y",strtotime($tanggal_rute2)) ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $flight_no_rute2 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $class_rute2 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $dep_rute2 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $arr_rute2 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $etd_rute2 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $eta_rute2 ,0,0,'C',0);
        $this->fpdf->cell(22 ,7, $pnr ,0,0,'C',0);
        }
        

        //tabel 2
        $this->fpdf->Ln(11);
        $this->fpdf->SetFont('Arial','',10);        
        $this->fpdf->cell(63 ,7, 'Seat Booked' ,1,0,'C',0);
        $this->fpdf->cell(63 ,7, 'Amount/ Pax' ,1,0,'C',0);        
        $this->fpdf->cell(63 ,7, 'Total [Rp] : ' ,1,0,'C',0);

        $this->fpdf->Ln(6);
        $this->fpdf->SetFont('Arial','',9);        
        $this->fpdf->cell(63 ,7, $seat_booked ,0,0,'C',0);        
        $this->fpdf->cell(63 ,7,'HARGA Rp ' .number_format($rate,0,",",".") ,0,0,'C',0); 
        $total = $rate*$seat_booked;
        $this->fpdf->cell(63 ,7, 'Rp '.number_format($total,0,",",".") ,0,0,'C',0);
        $this->fpdf->Ln(3); 
        $this->fpdf->cell(35 ,7, "",0,0,'C',0);
        $this->fpdf->Ln(5); 
        $this->fpdf->SetFont('Arial','',10);        
        

        $date = $tanggal;
        $newdate = strtotime ( '+2 day' , strtotime ( $date ) ) ;
        $newdate = date ( 'Y-m-j' , $newdate );
        $this->fpdf->Ln(7);
        $this->fpdf->SetFont('Arial','',8);                        
        $this->fpdf->cell(185 ,7, 'TERM AND CONDITONS' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '1. Deposit' ,0,0,'L',0); 
         $q = mysql_query("SELECT * FROM lobc_deposit where id_lobc =  '$id' and deposit_no = 1 ");
        while ($row1 = mysql_fetch_array($q)){
                $deposit = $row1['deposit'];
        		$this->fpdf->cell(45 ,6, ': Rp '.number_format($deposit),0,0,'L',0);    
        }
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '2. Deposit time limit' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ': '. date("D, ",strtotime($newdate)). date("d M Y",strtotime($newdate)).'  Pukul 15.00' ,0,0,'L',0); 
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '3. Full payment time limit' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ': 30 Hari sebelum keberangkatan' ,0,0,'L',0); 
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '4. Insert name time limit' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ': 40 Hari sebelum keberangkatan' ,0,0,'L',0);  
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '5. Issued ticket time limit' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ': 30 Hari sebelum keberangkatan' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '6. Materializes' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ': '.$materializes .'%' ,0,0,'L',0);
        if ( $visa == "Y") {
           $visa = "Include Visa";
           } else
           $visa = "Exclude Visa";
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '7. Visa' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ': '. $visa ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(75 ,6, '8. Ticket group Non-Refundable and non charge name' ,0,0,'L',0); 
        $this->fpdf->cell(45 ,6, ' ' ,0,0,'L',0); 

        //term and conditions
        $this->fpdf->Ln(8);
        $this->fpdf->SetFont('Arial','',9);                        
        $this->fpdf->cell(185 ,7, 'Prosedur Pembayaran' ,0,0,'L',0);
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Arial','',7);                        
        $this->fpdf->cell(185 ,6, '1. Harga sewaktu-waktu bisa berubah tanpa pemberitahuan sebelumnya.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '2. Apabila terdapat pengurangan seat dalam kurun waktu 30 hari sebelum keberangkatan, maka denda yang dibebankan ke agen adalah.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '   sama dengan jumlah deposit yang sudah kami bayarkan ke maskapai' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '3. Pembayaran dilakukan dengan Rupiah (IDR) berdasarkan regulasi Pemerintah Indonesia.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '4. Deposit tidak dapat dikembalikan atau dirubah ke Kode booking yang lain.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '5. Bilamana ada pembatalan dan tidak ada pelunasan dalam pemesanan 30 hari sebelum keberangkatan maka deposit dianggap hilang atau hangus.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '6. Pembayaran diterima pada hari senin dampai hari jumat.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '7. Pembayaran dapat diterima secara tunai atau transfer bank ke rekening kami.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '8. Rekening Mandiri 1520-5017-1777-7 (PT.Dream Tour And Travel).' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '9. Untuk pembayaran transfer, wajib memberikan informasi atau berita pada slip transfer : Nama Perusahaan, Jumlah Pax dan Tanggal Keberangkatan. ' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '10. Serta wajib mengkonfirmasi ke bagian keuangan PT.Dream Tour And Travel' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '11. Jika tidak ada konfirmasi dan informasi transfer, pembayaran tidak akan dianggap sebagi pebayaran.' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->cell(185 ,6, '12.	Pembukuan yang tidak sesuai dengan ketentuan diatas : AUTO CANCEL tanpa pemberitahuan sebelumnya.' ,0,0,'L',0);

        $this->fpdf->Ln(12);
        $this->fpdf->SetFont('Arial','B',9);     
        $this->fpdf->cell(10 ,6, '' ,0,0,'L',0);
        $this->fpdf->cell(185 ,6, 'PT Dream Tours & Travel' ,0,0,'L',0);
        $this->fpdf->Ln(20);
        $this->fpdf->SetFont('Arial','U','B',8);     
        $this->fpdf->cell(10 ,6, '' ,0,0,'L',0);
        $this->fpdf->cell(185 ,6, 'Muhamad Umar bakadam' ,0,0,'L',0);
        $this->fpdf->Ln(4);
        $this->fpdf->SetFont('Arial','B',8);     
        $this->fpdf->cell(10 ,6, '' ,0,0,'L',0);
        $this->fpdf->cell(185 ,6, 'Direktur' ,0,0,'L',0);



        $this->fpdf->SetY(-1);
        // Print centered page number
        //$this->fpdf->Image('asset/images/logo_besar.png',88,8,33);
        //Line break
        $this->fpdf->Output($customer.' '.$no.'.pdf','D');
        $pdf->Output();
	}

	public function pdf() { 
		$this->auth->restrict();      
		$this->load->view('lobc/coba_pdf');
	}

}