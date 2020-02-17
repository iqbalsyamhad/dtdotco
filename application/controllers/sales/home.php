<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
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
			$this->template->load('template','admin/index',$data);
		}
	}
	public function manajemen_menu()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(1);
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Manajemen Menu | DreamTour.co');
		$this->template->load('template','admin/manajemen_menu');
	}

	public function manajemen_user()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(1);

		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Manajemen User | DreamTour.co');
		$this->template->load('template','admin/manajemen_user',$data);
	}

	public function cek_transaksi_gm()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(2);

		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_gm',$data);
	}

	public function cek_transaksi_vp()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(5);

		$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_vp',$data);
	}

	public function confirm_aggrement_gm($id_transaksi)
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(2);
		$this->id_transaksi = $id_transaksi;
		$this->Usermodel->terimaAggrementGM($id_transaksi);

		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_gm',$data);
	}

	public function confirm_aggrement_vp($id_transaksi)
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(2);
		$this->id_transaksi = $id_transaksi;
		$this->Usermodel->terimaAggrementVP($id_transaksi);

		$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_vp',$data);
	}

	public function confirm_approval_gm($id_transaksi)
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(2);
		$this->id_transaksi = $id_transaksi;
		$this->Usermodel->terimaApprovalGM($id_transaksi);

		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_gm',$data);
	}

	public function confirm_approval_vp($id_transaksi)
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(2);
		$this->id_transaksi = $id_transaksi;
		$this->Usermodel->terimaApprovalVP($id_transaksi);

		$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_vp',$data);
	}

	public function accounting()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(6);

		$data['accounting'] = $this->Usermodel->tampilTransaksiAc();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Accounting | DreamTour.co');
		$this->template->load('template','admin/accounting',$data);
	}

	public function customer()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(7);

		$data['customer'] = $this->Usermodel->tampilTransaksiCus();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Customer | DreamTour.co');
		$this->template->load('template','admin/customer',$data);
	}

	public function visa()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(8);

		$data['visa'] = $this->Usermodel->tampilVisa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/visa',$data);
	}

	public function transaksi_sm()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(3);

		
		$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Transaksi Sales Manager | DreamTour.co');
		$this->template->load('template','admin/transaksi_sm',$data);
	}

	public function transaksi_se()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(4);

		
		$data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Transaksi Sales Manager | DreamTour.co');
		$this->template->load('template','admin/transaksi_se',$data);
	}

	public function view_visa()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(9);

		
		$data['visa'] = $this->Usermodel->tampilVisa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa',$data);
	}

	public function view_ticket()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(11);

		
		$data['ticket'] = $this->Usermodel->tampilTicket1();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Ticket | DreamTour.co');
		$this->template->load('template','admin/view_ticket',$data);
	}

	public function ticketing()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(10);

		$data['ticket'] = $this->Usermodel->tampilTicket();

		$this->template->set('title','Ticketing | DreamTour.co');
		$this->template->load('template','admin/ticketing',$data);
	}

	public function tambah_transaksi_se()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data['perusahaan'] = $this->Usermodel->tampilPerusahaan();
		$data['perusahaan1'] = $this->Usermodel->tampilPerusahaan1();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Transaksi | DreamTour.co');
		$this->template->load('template','admin/tambah_transaksi_se',$data);
	}

	public function tambah_transaksi_se1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'background' => $this->input->post('background'),
   				'credit_facilities' => $this->input->post('credit_facilities'),
   				'tanggal' => $this->input->post('tanggal'),
   				'sales_month' => $this->input->post('sales_month'),
   				'credit_limit' => $this->input->post('credit_limit'),
   				'aggrement_gm' => $this->input->post('aggrement_gm'),
   				'aggrement_vp' => $this->input->post('aggrement_vp'),
   				'approval_gm' => $this->input->post('approval_gm'),
   				'approval_vp' => $this->input->post('approval_vp')
  				);
   		
  		$this->Usermodel->tambahTransaksiSE($data);
  		// redirect('mobil');
		$data['transaksi_se']= $this->Usermodel->tampilTransaksiSE(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Input Transaksi | DreamTour.co');
		$this->template->load('template','admin/transaksi_se',$data);
	}

	public function tambah_transaksi_sm()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data['perusahaan'] = $this->Usermodel->tampilPerusahaan();
		$data['perusahaan1'] = $this->Usermodel->tampilPerusahaan1();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Transaksi | DreamTour.co');
		$this->template->load('template','admin/tambah_transaksi_sm',$data);
	}

	public function tambah_transaksi_sm1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'background' => $this->input->post('background'),
   				'credit_facilities' => $this->input->post('credit_facilities'),
   				'tanggal' => $this->input->post('tanggal'),
   				'sales_month' => $this->input->post('sales_month'),
   				'credit_limit' => $this->input->post('credit_limit'),
   				'aggrement_gm' => $this->input->post('aggrement_gm'),
   				'aggrement_vp' => $this->input->post('aggrement_vp'),
   				'approval_gm' => $this->input->post('approval_gm'),
   				'approval_vp' => $this->input->post('approval_vp')
  				);
   		
  		$this->Usermodel->tambahTransaksiSM($data);
  		// redirect('mobil');
		$data['transaksi_sm']= $this->Usermodel->tampilTransaksiSM(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Input Transaksi | DreamTour.co');
		$this->template->load('template','admin/transaksi_sm',$data);
	}
	public function tambah_visa()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Visa | DreamTour.co');
		$this->template->load('template','admin/tambah_visa');
	}

	public function tambah_visa1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'tanggal' => $this->input->post('tanggal'),
   				'nama_travel' => $this->input->post('nama_travel'),
   				'no_group' => $this->input->post('no_group'),
   				'provider' => $this->input->post('provider'),
   				'jumlah_pax' => $this->input->post('jumlah_pax'),
   				'status' => $this->input->post('status')
  				);
   		
  		$this->Usermodel->tambahVisa($data);
  		// redirect('mobil');
		$data['visa']= $this->Usermodel->tampilVisa(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/visa',$data);
	}

	public function confirm_visa($id_visa)
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(2);
		$this->id_visa = $id_visa;
		$this->Usermodel->terimaVisa($id_visa);

		$data['visa'] = $this->Usermodel->tampilVisa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/visa',$data);
	}

	public function tambah_perusahaan()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data['perusahaan'] = $this->Usermodel->tampilPerusahaan();
		$data['perusahaan1'] = $this->Usermodel->tampilPerusahaan1();
		$data['perusahaan2'] = $this->Usermodel->tampilPerusahaan2();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Perusahaan | DreamTour.co');
		$this->template->load('template','admin/tambah_perusahaan',$data);
	}

	public function tambah_perusahaan1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'nama_perusahaan' => $this->input->post('nama_perusahaan'),
   				'keterangan_perusahaan' => $this->input->post('keterangan_perusahaan')
  				);
   		
  		$this->Usermodel->tambahPerusahaan($data);

		$data['perusahaan']= $this->Usermodel->tampilPerusahaan(); 	
		$data['perusahaan1'] = $this->Usermodel->tampilPerusahaan1();
		$data['perusahaan2'] = $this->Usermodel->tampilPerusahaan2();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Daftar Perusahaan | DreamTour.co');
		$this->template->load('template','admin/daftar_perusahaan',$data);
	}

	public function tambah_user()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah User | DreamTour.co');
		$this->template->load('template','admin/tambah_user',$data);
	}

	public function tambah_user1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		$data = array(
   				'user_nama' => $this->input->post('user_nama'),
   				'user_username' => $this->input->post('user_username'),
   				'user_password' => $this->input->post('user_password'),
   				'user_level' => $this->input->post('user_level')
  				);

		$this->Usermodel->tambahUser($data);
		
		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Manajemen User | DreamTour.co');
		$this->template->load('template','admin/manajemen_user',$data);
	}

	public function tambah_menu()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah User | DreamTour.co');
		$this->template->load('template','admin/tambah_menu',$data);
	}

	public function tambah_menu1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		$data = array(
   				'menu_nama' => $this->input->post('menu_nama'),
   				'menu_uri' => $this->input->post('menu_uri'),
   				'menu_allowed' => $this->input->post('menu_allowed')
  				);

		$this->Usermodel->tambahMenu($data);
		
		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Manajemen User | DreamTour.co');
		$this->template->load('template','admin/manajemen_user',$data);
	}

	public function tambah_level()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Level | DreamTour.co');
		$this->template->load('template','admin/tambah_level',$data);
	}

	public function tambah_level1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		$data = array(
   				'level_nama' => $this->input->post('level_nama')
  				);

		$this->Usermodel->tambahLevel($data);
		
		$data['user'] = $this->Usermodel->tampilUser();
		$data['level'] = $this->Usermodel->tampilLevel();		
		$data['menu'] = $this->Usermodel->tampilMenu();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Manajemen User | DreamTour.co');
		$this->template->load('template','admin/manajemen_user',$data);
	}

	public function confirmPerusahaan($id_perusahaan)
	{
		$this->id_perusahaan = $id_perusahaan;
		$this->Usermodel->terimaPerusahaan($id_perusahaan);

		$data['perusahaan'] = $this->Usermodel->tampilPerusahaan();
		$data['perusahaan1'] = $this->Usermodel->tampilPerusahaan1();
		$data['perusahaan2'] = $this->Usermodel->tampilPerusahaan2();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Daftar Perusahaan | DreamTour.co');
		$this->template->load('template','admin/daftar_perusahaan',$data);
	}

	public function ubah_transaksi_gm($id_transaksi)
	{
		$where['id_transaksi'] = $id_transaksi;
		$a = $this->db->get_where('transaksi',$where)->row();
		$data['id_transaksi'] = $id_transaksi;
		$data['corporate_name'] = $a->corporate_name;
		$data['background'] = $a->background;
		$data['credit_facilities'] = $a->credit_facilities;
		$data['tanggal'] = $a->tanggal;
		$data['sales_month'] = $a->sales_month;
		$data['credit_limit'] = $a->credit_limit;
		$data['aggrement_gm'] = $a->aggrement_gm;
		$data['aggrement_vp'] = $a->aggrement_vp;
		$data['approval_gm'] = $a->approval_gm;
		$data['approval_vp'] = $a->approval_vp;

		$this->template->set('title','Ubah Transaksi | DreamTour.co');
		$this->template->load('template','admin/ubah_transaksi_gm',$data);
	}

	public function ubahSimpanTransaksiGM()
	{
		$this->Usermodel->ubahTransaksiGM();

		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();
		
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_gm',$data);
	}
	public function ubah_transaksi_sm($id_transaksi)
	{
		$where['id_transaksi'] = $id_transaksi;
		$a = $this->db->get_where('transaksi',$where)->row();
		$data['id_transaksi'] = $id_transaksi;
		$data['corporate_name'] = $a->corporate_name;
		$data['background'] = $a->background;
		$data['credit_facilities'] = $a->credit_facilities;
		$data['tanggal'] = $a->tanggal;
		$data['sales_month'] = $a->sales_month;
		$data['credit_limit'] = $a->credit_limit;
		$data['aggrement_gm'] = $a->aggrement_gm;
		$data['aggrement_vp'] = $a->aggrement_vp;
		$data['approval_gm'] = $a->approval_gm;
		$data['approval_vp'] = $a->approval_vp;

		$this->template->set('title','Ubah Transaksi | DreamTour.co');
		$this->template->load('template','admin/ubah_transaksi_sm',$data);
	}

	public function ubahSimpanTransaksiSM()
	{
		$this->Usermodel->ubahTransaksiSM();

		$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM();
		
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/transaksi_sm',$data);
	}

	public function ubah_transaksi_se($id_transaksi)
	{
		$where['id_transaksi'] = $id_transaksi;
		$a = $this->db->get_where('transaksi',$where)->row();
		$data['id_transaksi'] = $id_transaksi;
		$data['corporate_name'] = $a->corporate_name;
		$data['background'] = $a->background;
		$data['credit_facilities'] = $a->credit_facilities;
		$data['tanggal'] = $a->tanggal;
		$data['sales_month'] = $a->sales_month;
		$data['credit_limit'] = $a->credit_limit;
		$data['aggrement_gm'] = $a->aggrement_gm;
		$data['aggrement_vp'] = $a->aggrement_vp;
		$data['approval_gm'] = $a->approval_gm;
		$data['approval_vp'] = $a->approval_vp;

		$this->template->set('title','Ubah Transaksi | DreamTour.co');
		$this->template->load('template','admin/ubah_transaksi_se',$data);
	}

	public function ubah_password($user_id)
	{
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

		$this->template->set('title','Ubah Password | DreamTour.co');
		$this->template->load('template','admin/ubah_password',$data);
	}

	public function ubahSimpanPassword()
	{
		$this->Usermodel->ubahPassword();
		
		$this->template->set('title','Login Form | DreamTour.co');
		$this->template->load('template','admin/login_form');	
	}

	public function ubahSimpanTransaksiSE()
	{
		$this->Usermodel->ubahTransaksiSE();

		$data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE();
		
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/transaksi_se',$data);
	}

	public function tambah_ticket()
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'dari_tgl' => $this->input->post('dari_tgl'),
   				'sampai_tgl' => $this->input->post('sampai_tgl'),
   				'file' => $this->input->post('file')
  				);

		$this->Usermodel->tambahTicket1($data);

		$data['ticket'] = $this->Usermodel->tampilTicket();

		$this->template->set('title','Ticketing | DreamTour.co');
		$this->template->load('template','admin/ticketing',$data);
	}

	public function do_upload()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/file';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'pdf|doc|docx|xls|xlsx',
            'max_size'      => 5000,
            'remove_space'  => TRUE,
            
        );
        // $data['ticket'] = $this->Usermodel->tampilTicket();

		// $this->template->set('title','Ticketing | DreamTour.co');
		// $this->template->load('template','admin/ticketing',$data);

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            //echo json_encode($upload_error);
			$data['ticket'] = $this->Usermodel->tampilTicket();
			$this->template->set('title','Ticketing | DreamTour.co');
			$this->template->load('template','admin/ticketing',$data);
        } else {
            //$file_info = $this->upload->data();
           // echo json_encode($file_info);
			$data = $this->upload->data();
			foreach($data as $item => $value):
				if($item == 'file_name')
				{
					$nama_file = $value;
				}
			endforeach;
			
			$this->Usermodel->tambahTicket($nama_file);

	  		// redirect('mobil');
			$data['ticket'] = $this->Usermodel->tampilTicket();
			$this->template->set('title','Ticketing | DreamTour.co');
			$this->template->load('template','admin/ticketing',$data);		
        }
    }

    public function ubah_ticket($id_ticket)
    {
    	$where['id_ticket'] = $id_ticket;
		$a = $this->db->get_where('ticket',$where)->row();
		$data['id_ticket'] = $id_ticket;
    	$data['user_id'] = $a->user_id;
    	$data['dari_tgl'] = $a->dari_tgl;
		$data['sampai_tgl'] = $a->sampai_tgl;
		$data['file'] = $a->file;

		$this->template->set('title','Ubah Ticket | DreamTour.co');
		$this->template->load('template','admin/ubah_ticket',$data);
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
			$this->template->load('template','admin/login_form');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('home/index');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->template->load('template','admin/login_form',$data);		
			}
		}
	}
	function logout()
	{
		if($this->auth->is_logged_in() == true)
		{
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();
		}
		// larikan ke halaman utama
		redirect('home');
	}
}