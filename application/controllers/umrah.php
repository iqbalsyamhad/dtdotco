<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Umrah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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
			$this->load->view('umrah/index',$data);
		}
	}

	public function chart_umrah()
	{
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/chart_umrah');
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
			$this->load->view('umrah/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('index.php/umrah');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('umrah/login_view',$data);		
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
		redirect('index.php/umrah');
	}

	function view_umrah()
	{
		$data['umrah1'] = $this->Usermodel->tampilUmrah1();
		$data['umrah2'] = $this->Usermodel->tampilUmrah2();
		$data['umrah3'] = $this->Usermodel->tampilUmrah3();
		$data['umrah4'] = $this->Usermodel->tampilUmrah4();
		$data['umrah5'] = $this->Usermodel->tampilUmrah5();
		$data['umrah6'] = $this->Usermodel->tampilUmrah6();
		$data['umrah7'] = $this->Usermodel->tampilUmrah7();
		$data['umrah8'] = $this->Usermodel->tampilUmrah8();
		$data['umrah9'] = $this->Usermodel->tampilUmrah9();
		$data['umrah10'] = $this->Usermodel->tampilUmrah10();
		$data['umrah10'] = $this->Usermodel->tampilUmrah11();

		$this->auth->restrict();
		$this->auth->cek_menu(15);
		$this->load->view('umrah/view_umrah',$data);
	}

	function view_master()
	{
		$data['umrah1'] = $this->Usermodel->tampilUmrah1();
		$data['umrah2'] = $this->Usermodel->tampilUmrah2();
		$data['umrah3'] = $this->Usermodel->tampilUmrah3();
		$data['umrah4'] = $this->Usermodel->tampilUmrah4();
		$data['umrah5'] = $this->Usermodel->tampilUmrah5();
		$data['umrah6'] = $this->Usermodel->tampilUmrah6();
		$data['umrah7'] = $this->Usermodel->tampilUmrah7();
		$data['umrah8'] = $this->Usermodel->tampilUmrah8();
		$data['umrah9'] = $this->Usermodel->tampilUmrah9();
		$data['umrah10'] = $this->Usermodel->tampilUmrah10();
		$data['umrah10'] = $this->Usermodel->tampilUmrah11();
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/view_master',$data);
	}

	//view baru umrah 
	//start 2015
	function view_2015_maret1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah1();
		$data['kloter'] = "1" ;
		$data['tanggal'] = "12 Maret 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_april1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah2();
		$data['kloter'] = "2" ;
		$data['tanggal'] = "5 April 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_april2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah3();
		$data['kloter'] = "3" ;
		$data['tanggal'] = "30 April 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_mei1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah11();
		$data['kloter'] = "11" ;
		$data['tanggal'] = "3 Mei 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_mei2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah4();
		$data['kloter'] = "4" ;
		$data['tanggal'] = "14 Mei 2015 Reguler" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_mei3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah5();
		$data['kloter'] = "5" ;
		$data['tanggal'] = "14 Mei 2015 + Turkey 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_mei4()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah6();
		$data['kloter'] = "6" ;
		$data['tanggal'] = "14 Mei 2015 + Dubay 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_juni1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah7();
		$data['kloter'] = "7" ;
		$data['tanggal'] = "4 Juni 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_ramadhan1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah8();
		$data['kloter'] = "8" ;
		$data['tanggal'] = "Awal Ramadhan" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_ramadhan2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah9();
		$data['kloter'] = "9" ;
		$data['tanggal'] = "Akhir Ramadhan" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_ramadhan3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah10();
		$data['kloter'] = "10" ;
		$data['tanggal'] = "Akhir Ramadhan + Lebaran" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2015_desember1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah12();
		$data['kloter'] = "12" ;
		$data['tanggal'] = "03 Desember 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_desember2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah13();
		$data['kloter'] = "13" ;
		$data['tanggal'] = "15 Desember 2015" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_desember3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah14();
		$data['kloter'] = "14" ;
		$data['tanggal'] = "26 Desember 2015" ;
		$data['view'] = "umrah/view_umrah_baru" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	function view_2015_desember4()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah15();
		$data['kloter'] = "15" ;
		$data['tanggal'] = "04 Desember 2015 + Turkey" ;
		$data['view'] = "umrah/view_umrah_baru" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}


	//start 2016 
	function view_2016_januari1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah16();
		$data['kloter'] = "16" ;
		$data['tanggal'] = "14 Januari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_januari2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah17();
		$data['kloter'] = "17" ;
		$data['tanggal'] = "21 Januari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_januari3()
	{
		$data['umrah'] = $this->Usermodel->tampilUmrah18();
		$data['kloter'] = "18" ;
		$data['tanggal'] = "28 Januari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	
	function view_2016_februari1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah19();
		$data['kloter'] = "19" ;
		$data['tanggal'] = "04 Februari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_februari2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah20();
		$data['kloter'] = "20" ;
		$data['tanggal'] = "11 Februari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_februari3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah21();
		$data['kloter'] = "21" ;
		$data['tanggal'] = "16 Februari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_februari4()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah22();
		$data['kloter'] = "22" ;
		$data['tanggal'] = "25 Februari 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}
	
	function view_2016_maret1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah23();
		$data['kloter'] = "23" ;
		$data['tanggal'] = "03 Maret 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_maret2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah24();
		$data['kloter'] = "24" ;
		$data['tanggal'] = "17 Maret 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_maret3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah25();
		$data['kloter'] = "25" ;
		$data['tanggal'] = "24 Maret 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}


	function view_2016_april1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah26();
		$data['kloter'] = "26" ;
		$data['tanggal'] = "07 April 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_april2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah27();
		$data['kloter'] = "27" ;
		$data['tanggal'] = "14 April 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_april3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah28();
		$data['kloter'] = "28" ;
		$data['tanggal'] = "21 April 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_april4()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah29();
		$data['kloter'] = "29" ;
		$data['tanggal'] = "28 April 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_mei1()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah31();
		$data['kloter'] = "30" ;
		$data['tanggal'] = "02 Mei 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_mei2()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah32();
		$data['kloter'] = "31" ;
		$data['tanggal'] = "05 Mei 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_mei3()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah33();
		$data['kloter'] = "32" ;
		$data['tanggal'] = "12 Mei 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	function view_2016_mei4()
	{	
		$data['umrah'] = $this->Usermodel->tampilUmrah34();
		$data['kloter'] = "33" ;
		$data['tanggal'] = "19 Mei 2016" ;
		$this->auth->restrict();
		$this->auth->cek_menu(14);
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/view_umrah_baru',$data);	
	}

	public function tambah_umrah1()
	{
		$this->load->view('umrah/dashboard');
		$this->load->view('umrah/tambah_umrah1');		
	}

	public function tambah_umrah2()
	{	$this->load->view('umrah/dashboard');
	$this->load->view('umrah/tambah_umrah2');		
}

public function tambah_umrah1_1()
{
	$nama = $this->input->post('nama');
	$hp = $this->input->post('hp');
	$tgl_lahir = $this->input->post('lahir');
	$email = $this->input->post('email');
	$lokasi = $this->input->post('lokasi');
	$jenis_kelamin = $this->input->post('kelamin');
	$jenis = 1;

	$data2 = array($nama, $hp, $tgl_lahir, $email, $lokasi, $jenis_kelamin, $jenis);

	$this->Usermodel->simpanContactUmrah($data2);

	$data = array(
		'user_id' => $this->input->post('user_id'),
		'nama' => $this->input->post('nama'),
		'status' => $this->input->post('status'),
		'deposit' => $this->input->post('deposit'),
		'paid' => $this->input->post('paid'),
		'perlengkapan' => $this->input->post('perlengkapan'),
		'kloter' => $this->input->post('kloter'),
		'sumber' => $this->input->post('sumber')
		);
	$this->Usermodel->tambahUmrah1($data);

	$kloter1 = $this->input->post('kloter');
	if ($kloter1==1) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_maret1();
	}elseif ($kloter1==2) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_april1();
	}elseif ($kloter1==3) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_april2();
	}elseif ($kloter1==11) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei1();
	}elseif ($kloter1==4) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei2();
	}elseif ($kloter1==5) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei3();
	}elseif ($kloter1==6) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei4();
	}elseif ($kloter1==7) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_juni1();
	}elseif ($kloter1==8) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan1();
	}elseif ($kloter1==9) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan2();
	}elseif ($kloter1==10) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan3();
	}elseif ($kloter1==12) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember1();
	}elseif ($kloter1==13) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember2();
	}elseif ($kloter1==14) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember3();
	}elseif ($kloter1==15) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember4();
	}elseif ($kloter1==16) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari1();
	}elseif ($kloter1==17) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari2();
	}elseif ($kloter1==18) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari3();
	}elseif ($kloter1==19) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari1();
	}elseif ($kloter1==20) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari2();
	}elseif ($kloter1==21) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari3();
	}elseif ($kloter1==22) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari4();
	}elseif ($kloter1==23) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret1();
	}elseif ($kloter1==24) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret2();
	}elseif ($kloter1==25) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret3();
	}elseif ($kloter1==26) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april1();
	}elseif ($kloter1==27) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april2();
	}elseif ($kloter1==28) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april3();
	}elseif ($kloter1==29) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april4();
	}elseif ($kloter1==30) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei1();
	}elseif ($kloter1==31) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei2();
	}elseif ($kloter1==32) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei3();
	}elseif ($kloter1==33) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei4();
	}	
}


public function delete($id_umrah)
{
	$this->id_umrah = $id_umrah;

	$where['id_umrah'] = $id_umrah;
	$a = $this->db->get_where('umrah',$where)->row();
	$kloter1 = $data['umrah'] = $a->kloter;

	$this->Usermodel->hapusUmrahContact($id_umrah);
	$this->Usermodel->hapusUmrah($id_umrah);
	
	if ($kloter1==1) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_maret1();
	}elseif ($kloter1==2) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_april1();
	}elseif ($kloter1==3) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_april2();
	}elseif ($kloter1==11) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei1();
	}elseif ($kloter1==4) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei2();
	}elseif ($kloter1==5) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei3();
	}elseif ($kloter1==6) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei4();
	}elseif ($kloter1==7) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_juni1();
	}elseif ($kloter1==8) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan1();
	}elseif ($kloter1==9) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan2();
	}elseif ($kloter1==10) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan3();
	}elseif ($kloter1==12) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember1();
	}elseif ($kloter1==13) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember2();
	}elseif ($kloter1==14) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember3();
	}elseif ($kloter1==15) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember4();
	}elseif ($kloter1==16) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari1();
	}elseif ($kloter1==17) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari2();
	}elseif ($kloter1==18) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari3();
	}elseif ($kloter1==19) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari1();
	}elseif ($kloter1==20) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari2();
	}elseif ($kloter1==21) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari3();
	}elseif ($kloter1==22) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari4();
	}elseif ($kloter1==23) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret1();
	}elseif ($kloter1==24) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret2();
	}elseif ($kloter1==25) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret3();
	}elseif ($kloter1==26) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april1();
	}elseif ($kloter1==27) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april2();
	}elseif ($kloter1==28) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april3();
	}elseif ($kloter1==29) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april4();
	}elseif ($kloter1==30) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei1();
	}elseif ($kloter1==31) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei2();
	}elseif ($kloter1==32) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei3();
	}elseif ($kloter1==33) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei4();
	}
}

public function editUmrah($id_umrah){
	$this->load->model('Usermodel');
	$where['id_umrah'] = $id_umrah;
	$a=$this->db->get_where('umrah',$where)->row();
	$data['id_umrah']=$id_umrah;
	$data['nama']=$a->nama;
	$data['kloter']=$a->kloter;
	$data['status']=$a->status;
	$data['deposit']=$a->deposit;
	$data['paid']=$a->paid;
	$data['perlengkapan']=$a->perlengkapan;
	$data['id_contact']=$a->id_contact;
	$data['sumber']=$a->sumber;
	$data['comment']=$a->comment;

	$this->load->view('umrah/dashboard');
	$this->load->view('umrah/umrah_edit',$data);

    // $data = $this->input->post('ds');
}

public function editSimpanUmrah()
{
	$this->load->model('Usermodel');
	    // $this->id_mobil = $id_mobil;
	$this->Usermodel->ubahUmrahContact();
	$this->Usermodel->ubahUmrah();

	$kloter1 = $_POST['kloter'];;

	if ($kloter1==1) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_maret1();
	}elseif ($kloter1==2) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_april1();
	}elseif ($kloter1==3) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_april2();
	}elseif ($kloter1==11) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei1();
	}elseif ($kloter1==4) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei2();
	}elseif ($kloter1==5) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei3();
	}elseif ($kloter1==6) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_mei4();
	}elseif ($kloter1==7) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_juni1();
	}elseif ($kloter1==8) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan1();
	}elseif ($kloter1==9) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan2();
	}elseif ($kloter1==10) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_ramadhan3();
	}elseif ($kloter1==12) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember1();
	}elseif ($kloter1==13) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember2();
	}elseif ($kloter1==14) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember3();
	}elseif ($kloter1==15) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2015_desember4();
	}elseif ($kloter1==16) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari1();
	}elseif ($kloter1==17) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari2();
	}elseif ($kloter1==18) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_januari3();
	}elseif ($kloter1==19) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari1();
	}elseif ($kloter1==20) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari2();
	}elseif ($kloter1==21) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari3();
	}elseif ($kloter1==22) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_februari4();
	}elseif ($kloter1==23) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret1();
	}elseif ($kloter1==24) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret2();
	}elseif ($kloter1==25) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_maret3();
	}elseif ($kloter1==26) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april1();
	}elseif ($kloter1==27) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april2();
	}elseif ($kloter1==28) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april3();
	}elseif ($kloter1==29) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_april4();
	}elseif ($kloter1==30) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei1();
	}elseif ($kloter1==31) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei2();
	}elseif ($kloter1==32) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei3();
	}elseif ($kloter1==33) {
		$this->load->view('umrah/notif_tambah');
		$this->view_2016_mei4();
	}

}

public function contact()
{
	$this->db->select('*');
	$this->db->from('customer_contact');
	$getData = $this->db->get('');
	$a = $getData->num_rows();
			$config['base_url'] = base_url().'index.php/umrah/contact'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '25'; //the number of per page for pagination
			$config['uri_segment'] = 25; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
			$data['contact1'] = $this->Usermodel->tampilContactumrah1($config['per_page'],$this->uri->segment(3));
			$data['contact2'] = $this->Usermodel->tampilContactumrah2($config['per_page'],$this->uri->segment(3));
			$data['contact3'] = $this->Usermodel->tampilContactumrah3($config['per_page'],$this->uri->segment(3));
			$data['contact4'] = $this->Usermodel->tampilContactumrah4($config['per_page'],$this->uri->segment(3));
			$data['contact5'] = $this->Usermodel->tampilContactumrah5($config['per_page'],$this->uri->segment(3));
			$data['contact6'] = $this->Usermodel->tampilContactumrah6($config['per_page'],$this->uri->segment(3));
			$data['contact7'] = $this->Usermodel->tampilContactumrah7($config['per_page'],$this->uri->segment(3));
			$data['contact8'] = $this->Usermodel->tampilContactumrah8($config['per_page'],$this->uri->segment(3));
			$data['contact9'] = $this->Usermodel->tampilContactumrah9($config['per_page'],$this->uri->segment(3));
			$data['contact10'] = $this->Usermodel->tampilContactumrah10($config['per_page'],$this->uri->segment(3));
			$data['contact11'] = $this->Usermodel->tampilContactumrah11($config['per_page'],$this->uri->segment(3));
			$data['contact12'] = $this->Usermodel->tampilContactumrah12($config['per_page'],$this->uri->segment(3));
			$data['contact13'] = $this->Usermodel->tampilContactumrah13($config['per_page'],$this->uri->segment(3));
			$data['contact14'] = $this->Usermodel->tampilContactumrah14($config['per_page'],$this->uri->segment(3));


			//$data['contact'] = $this->Usermodel->tampilContact();
			// mencegah user yang belum login untuk mengakses halaman ini
			$this->auth->restrict();
			// mencegah user mengakses menu yang tidak boleh ia buka
			$this->auth->cek_menu(31);

			$this->load->view('umrah/dashboard2');
			$this->load->view('umrah/contact',$data);
		} 
		
		public function contact2016()
		{
			$this->db->select('*');
			$this->db->from('customer_contact');
			$getData = $this->db->get('');
			$a = $getData->num_rows();
			$config['base_url'] = base_url().'index.php/umrah/contact'; //set the base url for pagination
			$config['total_rows'] = $a; //total rows
			$config['per_page'] = '25'; //the number of per page for pagination
			$config['uri_segment'] = 25; //see from base_url. 3 for this case
			$config['full_tag_open'] = '<p>';
			$config['full_tag_close'] = '</p>';
			$this->pagination->initialize($config); //initialize pagination
			$data['contact1'] = $this->Usermodel->tampilContactumrah16($config['per_page'],$this->uri->segment(3));
			$data['contact2'] = $this->Usermodel->tampilContactumrah17($config['per_page'],$this->uri->segment(3));
			$data['contact3'] = $this->Usermodel->tampilContactumrah18($config['per_page'],$this->uri->segment(3));
			$data['contact4'] = $this->Usermodel->tampilContactumrah19($config['per_page'],$this->uri->segment(3));
			$data['contact5'] = $this->Usermodel->tampilContactumrah20($config['per_page'],$this->uri->segment(3));
			$data['contact6'] = $this->Usermodel->tampilContactumrah21($config['per_page'],$this->uri->segment(3));
			$data['contact7'] = $this->Usermodel->tampilContactumrah22($config['per_page'],$this->uri->segment(3));
			$data['contact8'] = $this->Usermodel->tampilContactumrah23($config['per_page'],$this->uri->segment(3));
			$data['contact9'] = $this->Usermodel->tampilContactumrah24($config['per_page'],$this->uri->segment(3));
			$data['contact10'] = $this->Usermodel->tampilContactumrah25($config['per_page'],$this->uri->segment(3));
			$data['contact11'] = $this->Usermodel->tampilContactumrah26($config['per_page'],$this->uri->segment(3));
			$data['contact12'] = $this->Usermodel->tampilContactumrah27($config['per_page'],$this->uri->segment(3));
			$data['contact13'] = $this->Usermodel->tampilContactumrah28($config['per_page'],$this->uri->segment(3));
			$data['contact14'] = $this->Usermodel->tampilContactumrah29($config['per_page'],$this->uri->segment(3));
			$data['contact15'] = $this->Usermodel->tampilContactumrah30($config['per_page'],$this->uri->segment(3));
			$data['contact16'] = $this->Usermodel->tampilContactumrah31($config['per_page'],$this->uri->segment(3));
			$data['contact17'] = $this->Usermodel->tampilContactumrah32($config['per_page'],$this->uri->segment(3));
			$data['contact18'] = $this->Usermodel->tampilContactumrah33($config['per_page'],$this->uri->segment(3));
			$data['contact19'] = $this->Usermodel->tampilContactumrah34($config['per_page'],$this->uri->segment(3));
			

			//$data['contact'] = $this->Usermodel->tampilContact();
			// mencegah user yang belum login untuk mengakses halaman ini
			$this->auth->restrict();
			// mencegah user mengakses menu yang tidak boleh ia buka
			$this->auth->cek_menu(31);

			$this->load->view('umrah/dashboard2');
			$this->load->view('umrah/contact2016',$data);
		} 

		function cariContact(){
			$this->db->select('*');
			$this->db->from('customer_contact');
			$getData = $this->db->get('');
			$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/umrah/contact'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '25'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['contact'] = $this->Usermodel->cariContact($config['per_page'],$this->uri->segment(-3));

	//	$data['contact'] = $this->Usermodel->cariContact();

		$this->load->view('umrah/dashboard2');
		$this->load->view('umrah/contact',$data);
	}

}