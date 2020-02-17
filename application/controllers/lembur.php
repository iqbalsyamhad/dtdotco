<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lembur extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		//$this->load->library('fpdf');
		$this->load->model('Usermodel');
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
			$this->load->model('usermodel');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->usermodel->get_menu_for_level($level);
			$this->template->set('title','Welcome user! | DreamTour.co');
			// tampilkan halaman dashboard dengan data menu
			if ($this->session->userdata('user_id')==3) { //untuk BOD
				$data['approve'] = $this->Usermodel->approveBod();
				$this->load->view('lembur/dashboard'); 
				$this->load->view('lembur/view_approve_bod',$data);
			}
			elseif ($this->session->userdata('user_id')==4) { //untuk BOD
				$data['approve'] = $this->Usermodel->approveBod();
				$this->load->view('lembur/dashboard'); 
				$this->load->view('lembur/view_approve_bod',$data);
			}
			elseif ($this->session->userdata('user_id')==42) { // 4 untuk manager tiket
				$data['approve'] = $this->Usermodel->approveManagerTiket();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}
			elseif ($this->session->userdata('user_id')==75) { // 5 untuk manager Sales
				$data['approve'] = $this->Usermodel->approveManagerSales();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}
			elseif ($this->session->userdata('user_id')==8) { // 5 untuk manager Akunting
				$data['approve'] = $this->Usermodel->approveManagerAkunting();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}
			elseif ($this->session->userdata('user_id')==12) { // 6 untuk manager busdev
				$data['approve'] = $this->Usermodel->approveManagerBusdev();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}
			elseif ($this->session->userdata('user_id')==20) { // 6 untuk manager patty
				$data['approve'] = $this->Usermodel->approveManagerPatty();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}
			elseif ($this->session->userdata('user_id')==14) { // 7 untuk manager holiday
				$data['approve'] = $this->Usermodel->approveManagerHoliday();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}
			elseif ($this->session->userdata('user_id')==7) { // 8 untuk HR & finance hanya bisa view semua lemburan
				$data['approve'] = $this->Usermodel->approveHr();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_hr',$data);
			}
			else{ // staff
				$this->load->view('lembur/insert_lembur',$data);
			} 
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
			$this->load->view('lembur/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('lembur');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('lembur/login_view',$data);		
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
		redirect('lembur');
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

		$this->load->view('lembur/dashboard');
		$this->load->view('lembur/ubah_password',$data);
	}

	public function ubahSimpanPassword()
	{	$this->auth->restrict();
		$this->Usermodel->ubahPassword();
		
		$this->template->set('title','Login Form | DreamTour.co');
		$this->template->load('template','lembur/login_form');	
	}

	public function tambah_lembur()
	{		
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka

		$data = array(
			'user_lembur' => $this->input->post('user_lembur'),
			'tanggal' => $this->input->post('tanggal'),
			'jam_mulai' => $this->input->post('jam_mulai'),
			'jam_selesai' => $this->input->post('jam_selesai'),
			'permintaan' => $this->input->post('permintaan'),
			'intruksi' => $this->input->post('intruksi'),
			'uraian' => $this->input->post('uraian')
			);

		$this->Usermodel->tambahLembur($data);
		$this->Usermodel->hapusNol();

		// $data['ticket'] = $this->Usermodel->tampilTicket();

		// redirect ('lembur');
		//$data['lemburan'] = $this->Usermodel->tampilLembur();
		$this->load->view('lembur/insert_lembur');
	}

	public function lemburanku()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();

		$data['approve'] = $this->Usermodel->lemburanku();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Approvement | DreamTour.co');
		$this->load->view('lembur/lemburanku',$data);
	}

	public function view_hr()
	{	$this->auth->restrict();
		$data['approve'] = $this->Usermodel->approveHr();
		$this->load->view('lembur/dashboard');
		$this->load->view('lembur/view_hr',$data);
	}

	public function view_busdev()
	{	$this->auth->restrict();
		$data['approve'] = $this->Usermodel->approveManagerBusdev();
		redirect('lembur/approve_manager',$data);
		$this->load->view('lembur/dashboard');
	}

	public function view_akunting()
	{	$this->auth->restrict();
		$data['approve'] = $this->Usermodel->approveManagerAkunting();
		$this->load->view('lembur/dashboard');
		$this->load->view('lembur/view_approve_manager',$data);
	}

	public function approve_bod()
	{	$this->auth->restrict();
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(34);

		
		$data['approve'] = $this->Usermodel->approveBod();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('lembur/dashboard');
		$this->load->view('lembur/view_approve_bod',$data);
	}


	public function ubahstatus_bod($id_lembur){
		$this->auth->restrict();
		$this->id_lembur = $id_lembur;
		$this->Usermodel->ubahStatusBod($id_lembur);

		$data['approve'] = $this->Usermodel->approveBod();
		redirect('lembur/approve_bod',$data);
	}

	public function approve_manager()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		
		$data['approve'] = $this->Usermodel->approveManager();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('lembur/dashboard');
		$this->load->view('lembur/view_approve_manager',$data);
	}

	public function ubahstatus_manager($id_lembur){
		$this->auth->restrict();
		$this->id_lembur = $id_lembur;
		$this->Usermodel->ubahStatusManager($id_lembur);

		$q = mysql_query("SELECT departemen from user, lembur 
			where lembur.user_lembur = user.user_id and lembur.id_lembur= '$id_lembur' ");
		if ($row1 = mysql_fetch_array($q)){
			$departemen=$row1['departemen'];}

			if (stripos($departemen, "reza")) {
				$data['approve'] = $this->Usermodel->approveManagerTiket();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}elseif (stripos($departemen="andre")) {
				$data['approve'] = $this->Usermodel->approveManagerBusdev();
				redirect('lembur/approve_manager',$data);
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}elseif (stripos($departemen="adit")) {
				$data['approve'] = $this->Usermodel->approveManagerHoliday();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}elseif (stripos($departemen="lina")) {
				$data['approve'] = $this->Usermodel->approveManagerAkunting();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}elseif (stripos($departemen="nendi")) {
				$data['approve'] = $this->Usermodel->approveManagerSales();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}elseif (stripos($departemen="patty")) {
				$data['approve'] = $this->Usermodel->approveManagerPatty();
				$this->load->view('lembur/dashboard');
				$this->load->view('lembur/view_approve_manager',$data);
			}


		}

		public function cariNama(){
			$this->auth->restrict();
			$data['approve'] = $this->Usermodel->carinama();

			$this->load->view('lembur/dashboard');
			$this->load->view('lembur/view_approve_bod',$data);
		}

		public function cariNama1(){
			$this->auth->restrict();
			$data['approve'] = $this->Usermodel->carinama();

			$this->load->view('lembur/dashboard');
			$this->load->view('lembur/view_approve_manager',$data);
		}

		public function cariNama2(){
			$this->auth->restrict();
			$data['approve'] = $this->Usermodel->carinama();

			$this->load->view('lembur/dashboard');
			$this->load->view('lembur/view_hr',$data);
		}

		public function pdf() {
			$this->auth->restrict();
			$data['approve'] = $this->Usermodel->approveBod();       
			$this->load->view('lembur/coba_pdf',$data);
		}

		public function xls() {
			$this->auth->restrict();
			$data['approve'] = $this->Usermodel->approveBod();       
			$this->load->library('phpexcel');
			$this->load->view('lembur/coba_xls',$data);

		}


	}