<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller
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

	public function upload_manifest()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		// $this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		// $this->auth->cek_menu(1);
		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$data['manifest'] = $this->Usermodel->tampilManifest();

		$this->template->set('title','Upload Manifest | DreamTour.co');
		$this->template->load('template','admin/manifest',$data);
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
		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_gm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM($config['per_page'],$this->uri->segment(3));

		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(2);

		//$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/cek_transaksi_gm',$data);
	}

	public function cek_transaksi_vp()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_vp'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(5);

		//$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP();

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

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_gm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();

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

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_vp'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP();

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

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_gm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();

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

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_vp'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_vp'] = $this->Usermodel->tampilTransaksiVP();

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
		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(8);

		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/visa',$data);
	}

	public function report()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(12);

		$data['report'] = $this->Usermodel->tampilReport();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Report | DreamTour.co');
		$this->template->load('template','admin/report',$data);
	}

	public function transaksi_sm()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/transaksi_sm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM($config['per_page'],$this->uri->segment(3));

		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(3);

		
		//$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Transaksi Sales Manager | DreamTour.co');
		$this->template->load('template','admin/transaksi_sm',$data);
	}


	public function delete_sales($id_transaksi)
	{
		$this->id_transaksi = $id_transaksi;
		$this->Usermodel->hapusSales($id_transaksi);
		redirect ('sales/transaksi_sm');
	}

	public function transaksi_se()
	{

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/transaksi_se'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE($config['per_page'],$this->uri->segment(3));

		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(4);

		
		// $data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Transaksi Sales Executive | DreamTour.co');
		$this->template->load('template','admin/transaksi_se',$data);
	}

	public function delete_visa($id_visa)
	{
		$this->id_visa = $id_visa;
		$this->Usermodel->hapusVisa($id_visa);

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/edit_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(16);

		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		$this->template->set('title','Visa | DreamTour.co'); 
		$this->template->load('template','admin/view_visa_edit',$data);
	}

	public function view_visa()
	{
		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/view_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(9);

		
		// $data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa',$data);
	}

	public function edit_visa()
	{
		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/edit_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(16);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa_edit',$data);
	}

	public function entry_visa()
	{
		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/entry_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(17);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/visa_entry',$data);
	}

	public function visa_kedutaan()
	{
		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa_kedutaan'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(18);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/visa_kedutaan',$data);
	}

	public function visa_master()
	{
		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa_master'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(19);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa_master',$data);
	}

	public function view_report()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(13);

		
		$data['report'] = $this->Usermodel->tampilReport();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','View Report | DreamTour.co');
		$this->template->load('template','admin/view_report',$data);
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

	public function tambah_report()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		// $data['perusahaan'] = $this->Usermodel->tampilPerusahaan();
		// $data['perusahaan1'] = $this->Usermodel->tampilPerusahaan1();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Report | DreamTour.co');
		$this->template->load('template','admin/tambah_report');
	}

	public function tambah_report1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'month' => $this->input->post('month'),
   				'year' => $this->input->post('year'),
   				'sales' => $this->input->post('sales')
  				);
   		
  		$this->Usermodel->tambahReport($data);
  		// redirect('mobil');
		$data['report']= $this->Usermodel->tampilReport(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Report | DreamTour.co');
		$this->template->load('template','admin/report',$data);
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
   				'address' => $this->input->post('address'),
   				'phone' => $this->input->post('phone'),
   				'pic' => $this->input->post('pic'),
   				'credit_facilities' => $this->input->post('credit_facilities'),
   				'tanggal' => $this->input->post('tanggal'),
   				'sales_month' => $this->input->post('sales_month'),
   				'comments' => $this->input->post('comments'),
   				'credit_limit' => $this->input->post('credit_limit'),
   				'aggrement_gm' => $this->input->post('aggrement_gm'),
   				'aggrement_vp' => $this->input->post('aggrement_vp'),
   				'approval_gm' => $this->input->post('approval_gm'),
   				'approval_vp' => $this->input->post('approval_vp')
  				);
   		
  		$this->Usermodel->tambahTransaksiSE($data);
  		// redirect('mobil');
  		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/transaksi_se'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE($config['per_page'],$this->uri->segment(3));
		//$data['transaksi_se']= $this->Usermodel->tampilTransaksiSE(); 	

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
   				'address' => $this->input->post('address'),
   				'phone' => $this->input->post('phone'),
   				'pic' => $this->input->post('pic'),
   				'credit_facilities' => $this->input->post('credit_facilities'),
   				'tanggal' => $this->input->post('tanggal'),
   				'sales_month' => $this->input->post('sales_month'),
   				'credit_limit' => $this->input->post('credit_limit'),
   				'comments' => $this->input->post('comments'),
   				'aggrement_gm' => $this->input->post('aggrement_gm'),
   				'aggrement_vp' => $this->input->post('aggrement_vp'),
   				'approval_gm' => $this->input->post('approval_gm'),
   				'approval_vp' => $this->input->post('approval_vp')
  				);
   		
  		$this->Usermodel->tambahTransaksiSM($data);
  		// redirect('mobil');

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/transaksi_sm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_sm']= $this->Usermodel->tampilTransaksiSM(); 	

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

	public function tambah_visa2()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Visa | DreamTour.co');
		$this->template->load('template','admin/tambah_visa1');
	}

	public function tambah_visa4()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Tambah Visa | DreamTour.co');
		$this->template->load('template','admin/tambah_visa2');
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
   				'status' => $this->input->post('status'),
   				'kedutaan' => $this->input->post('kedutaan'),
   				'input_visa' => $this->input->post('input_visa'),
   				'comment' => $this->input->post('comment'),
   				'tgl_berangkat' => $this->input->post('tgl_berangkat'),
   				'paspor_masuk' => $this->input->post('paspor_masuk'),
   				'manifest' => $this->input->post('manifest'),
   				'barcode' => $this->input->post('barcode'),
   				'pengambilan_paspor' => $this->input->post('pengambilan_paspor'),
   				'paket_informasi' => $this->input->post('paket_informasi')
  				);
   		
  		$this->Usermodel->tambahVisa($data);
  		// redirect('mobil');

  		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/edit_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		//$data['visa']= $this->Usermodel->tampilVisa(); 	

		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa_edit',$data);
	}

	public function tambah_visa3()
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
   				'status' => $this->input->post('status'),
   				'kedutaan' => $this->input->post('kedutaan'),
   				'input_visa' => $this->input->post('input_visa'),
   				'comment' => $this->input->post('comment'),
   				'tgl_berangkat' => $this->input->post('tgl_berangkat'),
   				'paspor_masuk' => $this->input->post('paspor_masuk'),
   				'manifest' => $this->input->post('manifest'),
   				'barcode' => $this->input->post('barcode'),
   				'pengambilan_paspor' => $this->input->post('pengambilan_paspor'),
   				'paket_informasi' => $this->input->post('paket_informasi')
  				);
   		
  		$this->Usermodel->tambahVisa($data);
  		// redirect('mobil');

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));

		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa']= $this->Usermodel->tampilVisa(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/visa',$data);
	}

	public function tambah_visa5()
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
   				'status' => $this->input->post('status'),
   				'kedutaan' => $this->input->post('kedutaan'),
   				'input_visa' => $this->input->post('input_visa'),
   				'comment' => $this->input->post('comment'),
   				'tgl_berangkat' => $this->input->post('tgl_berangkat'),
   				'paspor_masuk' => $this->input->post('paspor_masuk'),
   				'manifest' => $this->input->post('manifest'),
   				'barcode' => $this->input->post('barcode'),
   				'pengambilan_paspor' => $this->input->post('pengambilan_paspor'),
   				'paket_informasi' => $this->input->post('paket_informasi')
  				);
   		
  		$this->Usermodel->tambahVisa($data);
  		// redirect('mobil');

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa_master'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));

		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa']= $this->Usermodel->tampilVisa(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa_master',$data);
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

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/cek_transaksi_gm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_gm'] = $this->Usermodel->tampilTransaksiGM();
		
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
		$data['address'] = $a->address;
		$data['phone'] = $a->phone;
		$data['pic'] = $a->pic;
		$data['credit_facilities'] = $a->credit_facilities;
		$data['tanggal'] = $a->tanggal;
		$data['sales_month'] = $a->sales_month;
		$data['credit_limit'] = $a->credit_limit;
		$data['comments'] = $a->comments;
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

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/transaksi_sm'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_sm'] = $this->Usermodel->tampilTransaksiSM();
		
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
		$data['address'] = $a->address;
		$data['phone'] = $a->phone;
		$data['pic'] = $a->pic;
		$data['credit_facilities'] = $a->credit_facilities;
		$data['tanggal'] = $a->tanggal;
		$data['sales_month'] = $a->sales_month;
		$data['credit_limit'] = $a->credit_limit;
		$data['comments'] = $a->comments;
		$data['aggrement_gm'] = $a->aggrement_gm;
		$data['aggrement_vp'] = $a->aggrement_vp;
		$data['approval_gm'] = $a->approval_gm;
		$data['approval_vp'] = $a->approval_vp;

		$this->template->set('title','Ubah Transaksi | DreamTour.co');
		$this->template->load('template','admin/ubah_transaksi_se',$data);
	}

	public function ubahSimpanTransaksiSE()
	{
		$this->Usermodel->ubahTransaksiSE();

		$this->db->select('*');
		$this->db->from('transaksi');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/transaksi_se'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '10'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE($config['per_page'],$this->uri->segment(3));

		//$data['transaksi_se'] = $this->Usermodel->tampilTransaksiSE();
		
		$this->template->set('title','Cek Transaksi | DreamTour.co');
		$this->template->load('template','admin/transaksi_se',$data);
	}

	public function ubah_visa($id_visa)
	{
		$where['id_visa'] = $id_visa;
		$a = $this->db->get_where('visa',$where)->row();
		$data['id_visa'] = $id_visa;
		$data['nama_travel'] = $a->nama_travel;
		$data['no_group'] = $a->no_group;
		$data['provider'] = $a->provider;
		$data['jumlah_pax'] = $a->jumlah_pax;
		$data['status'] = $a->status;
		$data['kedutaan'] = $a->kedutaan;
		$data['input_visa'] = $a->input_visa;
		$data['comment'] = $a->comment;
		$data['tgl_berangkat'] = $a->tgl_berangkat;
		$data['manifest'] = $a->manifest;
		$data['paspor_masuk'] = $a->paspor_masuk;
		$data['barcode'] = $a->barcode;
		$data['pengambilan_paspor'] = $a->pengambilan_paspor;
		$data['paket_informasi'] = $a->paket_informasi;

		$this->template->set('title','Ubah Visa | DreamTour.co');
		$this->template->load('template','admin/ubah_visa',$data);
	}

	public function ubah_visa1($id_visa)
	{
		$where['id_visa'] = $id_visa;
		$a = $this->db->get_where('visa',$where)->row();
		$data['id_visa'] = $id_visa;
		$data['nama_travel'] = $a->nama_travel;
		$data['no_group'] = $a->no_group;
		$data['provider'] = $a->provider;
		$data['jumlah_pax'] = $a->jumlah_pax;
		$data['status'] = $a->status;
		$data['kedutaan'] = $a->kedutaan;
		$data['input_visa'] = $a->input_visa;
		$data['comment'] = $a->comment;
		$data['tgl_berangkat'] = $a->tgl_berangkat;
		$data['manifest'] = $a->manifest;
		$data['paspor_masuk'] = $a->paspor_masuk;
		$data['barcode'] = $a->barcode;
		$data['pengambilan_paspor'] = $a->pengambilan_paspor;
		$data['paket_informasi'] = $a->paket_informasi;

		$this->template->set('title','Ubah Visa | DreamTour.co');
		$this->template->load('template','admin/ubah_visa1',$data);
	}

	public function ubah_visa2($id_visa)
	{
		$where['id_visa'] = $id_visa;
		$a = $this->db->get_where('visa',$where)->row();
		$data['id_visa'] = $id_visa;
		$data['nama_travel'] = $a->nama_travel;
		$data['no_group'] = $a->no_group;
		$data['provider'] = $a->provider;
		$data['jumlah_pax'] = $a->jumlah_pax;
		$data['status'] = $a->status;
		$data['kedutaan'] = $a->kedutaan;
		$data['input_visa'] = $a->input_visa;
		$data['comment'] = $a->comment;
		$data['tgl_berangkat'] = $a->tgl_berangkat;
		$data['manifest'] = $a->manifest;
		$data['paspor_masuk'] = $a->paspor_masuk;
		$data['barcode'] = $a->barcode;
		$data['pengambilan_paspor'] = $a->pengambilan_paspor;
		$data['paket_informasi'] = $a->paket_informasi;

		$this->template->set('title','Ubah Visa | DreamTour.co');
		$this->template->load('template','admin/ubah_visa2',$data);
	}

	public function ubah_visa3($id_visa)
	{
		$where['id_visa'] = $id_visa;
		$a = $this->db->get_where('visa',$where)->row();
		$data['id_visa'] = $id_visa;
		$data['nama_travel'] = $a->nama_travel;
		$data['no_group'] = $a->no_group;
		$data['provider'] = $a->provider;
		$data['jumlah_pax'] = $a->jumlah_pax;
		$data['status'] = $a->status;
		$data['kedutaan'] = $a->kedutaan;
		$data['input_visa'] = $a->input_visa;
		$data['comment'] = $a->comment;
		$data['tgl_berangkat'] = $a->tgl_berangkat;
		$data['manifest'] = $a->manifest;
		$data['paspor_masuk'] = $a->paspor_masuk;
		$data['barcode'] = $a->barcode;
		$data['pengambilan_paspor'] = $a->pengambilan_paspor;
		$data['paket_informasi'] = $a->paket_informasi;

		$this->template->set('title','Ubah Visa | DreamTour.co');
		$this->template->load('template','admin/ubah_visa3',$data);
	}

	public function ubah_visa4($id_visa)
	{
		$where['id_visa'] = $id_visa;
		$a = $this->db->get_where('visa',$where)->row();
		$data['id_visa'] = $id_visa;
		$data['nama_travel'] = $a->nama_travel;
		$data['no_group'] = $a->no_group;
		$data['provider'] = $a->provider;
		$data['jumlah_pax'] = $a->jumlah_pax;
		$data['status'] = $a->status;
		$data['kedutaan'] = $a->kedutaan;
		$data['input_visa'] = $a->input_visa;
		$data['comment'] = $a->comment;
		$data['tgl_berangkat'] = $a->tgl_berangkat;
		$data['manifest'] = $a->manifest;
		$data['paspor_masuk'] = $a->paspor_masuk;
		$data['barcode'] = $a->barcode;
		$data['pengambilan_paspor'] = $a->pengambilan_paspor;
		$data['paket_informasi'] = $a->paket_informasi;

		$this->template->set('title','Ubah Visa | DreamTour.co');
		$this->template->load('template','admin/ubah_visa4',$data);
	}

	public function ubah_visa5($id_visa)
	{
		$where['id_visa'] = $id_visa;
		$a = $this->db->get_where('visa',$where)->row();
		$data['id_visa'] = $id_visa;
		$data['nama_travel'] = $a->nama_travel;
		$data['no_group'] = $a->no_group;
		$data['provider'] = $a->provider;
		$data['jumlah_pax'] = $a->jumlah_pax;
		$data['status'] = $a->status;
		$data['kedutaan'] = $a->kedutaan;
		$data['input_visa'] = $a->input_visa;
		$data['comment'] = $a->comment;
		$data['tgl_berangkat'] = $a->tgl_berangkat;
		$data['manifest'] = $a->manifest;
		$data['paspor_masuk'] = $a->paspor_masuk;
		$data['barcode'] = $a->barcode;
		$data['pengambilan_paspor'] = $a->pengambilan_paspor;
		$data['paket_informasi'] = $a->paket_informasi;

		$this->template->set('title','Ubah Visa | DreamTour.co');
		$this->template->load('template','admin/ubah_visa5',$data);
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

	public function ubahSimpanVisa()
	{
		$this->Usermodel->ubahVisa();

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/edit_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(16);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa'] = $this->Usermodel->tampilVisa();
		
		$this->template->set('title','Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa_edit',$data);
	}

	public function ubahSimpanVisa1()
	{
		$this->Usermodel->ubahVisa1();

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(8);

		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();


		//$data['visa'] = $this->Usermodel->tampilVisa();
		
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/visa',$data);
	}

	public function ubahSimpanVisa2()
	{
		$this->Usermodel->ubahVisa2();

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/entry_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(17);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/visa_entry',$data);
	}

	public function ubahSimpanVisa3()
	{
		$this->Usermodel->ubahVisa3();

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa_kedutaan'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(18);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa'] = $this->Usermodel->tampilVisa();
		
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/visa_kedutaan',$data);
	}

	public function ubahSimpanVisa4()
	{
		$this->Usermodel->ubahVisa4();

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/visa_master'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(19);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa'] = $this->Usermodel->tampilVisa();
		
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa_master',$data);
	}

	public function ubahSimpanVisa5()
	{
		$this->Usermodel->ubahVisa5();

		$this->db->select('*');
		$this->db->from('visa');
		$getData = $this->db->get('');
		$a = $getData->num_rows();
		$config['base_url'] = base_url().'index.php/sales/view_visa'; //set the base url for pagination
		$config['total_rows'] = $a; //total rows
		$config['per_page'] = '20'; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config); //initialize pagination
		$data['visa'] = $this->Usermodel->tampilVisa($config['per_page'],$this->uri->segment(3));
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(9);
		
		//$data['visa'] = $this->Usermodel->tampilVisa();
		$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
		$data['alaa'] = $this->Usermodel->jumlahAlaa();
		$data['edi'] = $this->Usermodel->jumlahEdi();
		$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

		//$data['visa'] = $this->Usermodel->tampilVisa();
		
		$this->template->set('title','View Visa | DreamTour.co');
		$this->template->load('template','admin/view_visa',$data);
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

	public function tambah_manifest()
	{
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'judul' => $this->input->post('judul'),
   				'file' => $this->input->post('file')
  				);

		$this->Usermodel->tambahManifest1($data);

		$data['manifest'] = $this->Usermodel->tampilManifest();

		$this->template->set('title','Upload Manifest | DreamTour.co');
		$this->template->load('template','admin/manifest',$data);
	}

	public function do_upload_manifest()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/file';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'xlsx|pdf|doc|docx|xls',
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
			$data['manifest'] = $this->Usermodel->tampilManifest();
			$this->template->set('title','Upload Manifest | DreamTour.co');
			$this->template->load('template','admin/manifest',$data);
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
			
			$this->Usermodel->tambahManifest($nama_file);

	  		// redirect('mobil');
			$data['manifest'] = $this->Usermodel->tampilManifest();
			$this->template->set('title','Upload Manifest | DreamTour.co');
			$this->template->load('template','admin/manifest',$data);		
        }
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

	public function cariVisa(){
		$data['visa']= $this->Usermodel->cariVisa();
	    $query = "SELECT *
				FROM visa JOIN user WHERE visa.user_id = user.user_id
				AND visa.nama_travel LIKE '%$_GET[q]%'
				ORDER BY (visa.tanggal) DESC";
	    $result = mysql_query($query);
	    $jml = mysql_fetch_row($result);
		if ($jml>0){

			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/visa',$data);		
		}
		else
		{						
			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/visa',$data);
		}
	}

	public function cariVisa1(){
		$data['visa']= $this->Usermodel->cariVisa1();
	    $query = "SELECT *
				FROM visa JOIN user WHERE visa.user_id = user.user_id
				AND visa.no_group LIKE '%$_GET[q]%'
				ORDER BY (visa.tanggal) DESC";
	    $result = mysql_query($query);
	    $jml = mysql_fetch_row($result);
		if ($jml>0){

			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/view_visa_edit',$data);		
		}
		else
		{						
			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/view_visa_edit',$data);
		}
	}

	public function cariVisa2(){
		$data['visa']= $this->Usermodel->cariVisa();
	    $query = "SELECT *
				FROM visa JOIN user WHERE visa.user_id = user.user_id
				AND visa.nama_travel LIKE '%$_GET[q]%'
				ORDER BY (visa.tanggal) DESC";
	    $result = mysql_query($query);
	    $jml = mysql_fetch_row($result);
		if ($jml>0){

			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/view_visa',$data);		
		}
		else
		{						
			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();
		
			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/view_visa',$data);
		}
	}

	public function cariVisa3(){
		$data['visa']= $this->Usermodel->cariVisa();
	    $query = "SELECT *
				FROM visa JOIN user WHERE visa.user_id = user.user_id
				AND visa.nama_travel LIKE '%$_GET[q]%'
				ORDER BY (visa.tanggal) DESC";
	    $result = mysql_query($query);
	    $jml = mysql_fetch_row($result);
		if ($jml>0){

			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/view_visa_master',$data);		
		}
		else
		{						
			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/view_visa_master',$data);
		}
	}

	public function cariVisa4(){
		$data['visa']= $this->Usermodel->cariVisa();
	    $query = "SELECT *
				FROM visa JOIN user WHERE visa.user_id = user.user_id
				AND visa.nama_travel LIKE '%$_GET[q]%'
				ORDER BY (visa.tanggal) DESC";
	    $result = mysql_query($query);
	    $jml = mysql_fetch_row($result);
		if ($jml>0){

			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/visa_entry',$data);		
		}
		else
		{						
			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/visa_entry',$data);
		}
	}

	public function cariVisa5(){
		$data['visa']= $this->Usermodel->cariVisa();
	    $query = "SELECT *
				FROM visa JOIN user WHERE visa.user_id = user.user_id
				AND visa.nama_travel LIKE '%$_GET[q]%'
				ORDER BY (visa.tanggal) DESC";
	    $result = mysql_query($query);
	    $jml = mysql_fetch_row($result);
		if ($jml>0){

			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/visa_kedutaan',$data);		
		}
		else
		{						
			$data['fauzan'] = $this->Usermodel->jumlahAlfauzan();
			$data['alaa'] = $this->Usermodel->jumlahAlaa();
			$data['edi'] = $this->Usermodel->jumlahEdi();
			$data['mazaya'] = $this->Usermodel->jumlahMazaya();
		$data['alwan'] = $this->Usermodel->jumlahAlwan();
		$data['nebras'] = $this->Usermodel->jumlahNebras();
		$data['razek'] = $this->Usermodel->jumlahRazek();
		$data['waisam'] = $this->Usermodel->jumlahWaisam();
		$data['amanah'] = $this->Usermodel->jumlahAmanah();
		$data['tunsi'] = $this->Usermodel->jumlahTunsi();
		$data['elaf'] = $this->Usermodel->jumlahElaf();
		$data['massa'] = $this->Usermodel->jumlahAlmassa();

			$this->template->set('title','Visa | DreamTour.co');
			$this->template->load('template','admin/visa_kedutaan',$data);
		}
	}

	public function cariSales(){

		$data['transaksi_sm']= $this->Usermodel->cariSales();
	   //  $query = "SELECT *
				// FROM transaksi JOIN user WHERE transaksi.user_id = user.user_id
				// AND visa.corporate_name LIKE '%$_GET[q]%'
				// ORDER BY (transaksi.tanggal) DESC";
	   //  $result = mysql_query($query);
	   //  $jml = mysql_fetch_row($result);
			$this->template->set('title','Transaksi Sales Manager | DreamTour.co');
			$this->template->load('template','admin/transaksi_sm',$data);	
		
	}

	public function view_lembur()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(20);

		
		$data['lembur'] = $this->Usermodel->tampilDataLembur();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('admin/view_lembur',$data);
	}

	public function view_total_lembur()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		
		$data['total_lembur'] = $this->Usermodel->tampilTotalLembur();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('admin/view_total_lembur',$data);
	}

	public function ubah_lembur($id_lembur)
	{
		$data['lembur'] = $this->Usermodel->tampilDataLembur();

		$where['id_lembur'] = $id_lembur;
		$a = $this->db->get_where('lembur',$where)->row();
		$data['id_lembur'] = $id_lembur;
		$data['user_lembur'] = $a->user_lembur;
		$data['tanggal'] = $a->tanggal;
		$data['jam_mulai'] = $a->jam_mulai;
		$data['jam_selesai'] = $a->jam_selesai;
		$data['uraian'] = $a->uraian;

		$this->load->view('admin/ubah_lembur',$data);
	}

	public function ubahSimpanLembur()
	{
		$this->Usermodel->ubahLembur();

		$data['lembur'] = $this->Usermodel->tampilDataLembur();

		$this->load->view('admin/view_lembur',$data);
	}

	public function karyawan()
	{
		$data['tugas'] = $this->Usermodel->tampilDataTugas();

		$this->load->view('admin/view_tugas',$data);
	}

	function ubahStatusTugas($id_tugas){
		$this->id_tugas = $id_tugas;
		$this->Usermodel->ubahStatusTugas($id_tugas);

		$data['tugas'] = $this->Usermodel->tampilDataTugas();
		$this->load->view('admin/view_tugas',$data);
	}
	
	public function ubah_tugas($id_tugas)
	{
		$data['tugas'] = $this->Usermodel->tampilDataTugas();

		$where['id_tugas'] = $id_tugas;
		$a = $this->db->get_where('tugas',$where)->row();
		$data['id_tugas'] = $id_tugas;
		$data['user_lembur'] = $a->user_lembur;
		$data['tanggal'] = $a->tanggal;
		$data['uraian'] = $a->uraian;
		$data['pelaksanaan'] = $a->pelaksanaan;
		$data['hasil'] = $a->hasil;
		$data['status'] = $a->status;

		$this->load->view('admin/ubah_tugas',$data);
	}

	public function ubahSimpanTugas()
	{
		$this->Usermodel->ubahTugas();

		$data['tugas'] = $this->Usermodel->tampilDataTugas();

		$this->load->view('admin/view_tugas',$data);
	}

	public function hapus_tugas($id_tugas)
	{
		$this->id_tugas = $id_tugas;
		$this->Usermodel->hapusTugas($id_tugas);
		redirect ('sales/karyawan');
	}

	public function nilai_karyawan()
	{
		$data['tugas'] = $this->Usermodel->tampilDataTugas();

		$this->load->view('admin/view_nilai_karyawan',$data);
	}

	public function tambah_karyawan()
	{
		$data['lemburan'] = $this->Usermodel->tampilLembur();
		$this->load->view('admin/tambah_tugas',$data);
	}

	public function tambah_karyawan1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_lembur' => $this->input->post('user_lembur'),
   				'tanggal' => $this->input->post('tanggal'),
   				'uraian' => $this->input->post('uraian'),
   				'pelaksanaan' => $this->input->post('pelaksanaan'),
   				'hasil' => $this->input->post('hasil'),
   				'status' => $this->input->post('status')
  				);
   		
  		$this->Usermodel->tambahKaryawan($data);
  		// redirect('mobil');
		$data['tugas']= $this->Usermodel->tampilDataTugas(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('admin/view_tugas',$data);
	}

	public function absen_karyawan()
	{
		$data['absen'] = $this->Usermodel->tampilDataAbsen();

		$this->load->view('admin/view_absen',$data);
	}

	public function tambah_absen()
	{
		$data['lemburan'] = $this->Usermodel->tampilLembur();
		$this->load->view('admin/tambah_absen',$data);
	}

	public function tambah_absen1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_lembur' => $this->input->post('user_lembur'),
   				'bulan' => $this->input->post('bulan'),
   				'nilai' => $this->input->post('nilai')
  				);
   		
  		$this->Usermodel->tambahAbsen($data);
  		// redirect('mobil');
		$data['absen']= $this->Usermodel->tampilDataAbsen(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
		$this->load->view('admin/view_absen',$data);
	}

	public function view_transaksi_eo()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		$this->auth->cek_menu(23);

		
		$data['eo'] = $this->Usermodel->tampilDataEO();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
			$this->template->set('title','EO | DreamTour.co');
			$this->template->load('template','admin/view_transaksi_eo',$data);
	}

	public function tambah_transaksi_eo()
	{
		$this->template->set('title','EO | DreamTour.co');
		$this->template->load('template','admin/tambah_transaksi_eo');
	}

	public function tambah_transaksi_eo1()
	{
		// mencegah user yang belum login untuk mengakses halaman ini
		//$this->auth->restrict();
		// mencegah user mengakses menu yang tidak boleh ia buka
		//$this->auth->cek_menu(4);

		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'tanggal' => $this->input->post('tanggal'),
   				'corporate_name' => $this->input->post('corporate_name'),
   				'pic' => $this->input->post('pic'),
   				'pelaksanaan' => $this->input->post('pelaksanaan'),
   				'uraian' => $this->input->post('uraian')
  				);
   		
  		$this->Usermodel->tambah_transaksi_eo($data);
  		// redirect('mobil');
		$data['eo']= $this->Usermodel->tampilDataEO(); 	

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
			$this->template->set('title','EO | DreamTour.co');
			$this->template->load('template','admin/view_transaksi_eo',$data);
	}
	
	
	//hapus trasaksi eo
	public function hapusEo($id_eo){
		$this->id_eo = $id_eo;
		$this->Usermodel->hapus_Eo($id_eo);

		
		$data['eo'] = $this->Usermodel->tampilDataEO();

		// tampilkan isi menu manajemen menu (mungkin tabel menu/input form menu)
			$this->template->set('title','EO | DreamTour.co');
			$this->template->load('template','admin/view_transaksi_eo',$data);
	}

	//edit transaksi EO
	public function editEo($id_eo){
		$where['id_eo'] = $id_eo;
		$a = $this->db->get_where('eo',$where)->row();
		$data['id_eo'] = $id_eo;
		$data['corporate_name'] = $a->corporate_name;
		$data['pic'] = $a->pic;
		$data['pelaksanaan'] = $a->pelaksanaan;
		$data['uraian'] = $a->uraian;
		$data['status'] = $a->status;
		
		$this->template->set('title','Ubah Transaksi Eo | DreamTour.co');
		$this->template->load('template','admin/ubah_eo',$data);
	}

	//simpan ubah data edit EO
	public function simpan_ubah_eo(){
		$this->Usermodel->ubah_eo();

		$data['eo'] = $this->Usermodel->tampilDataEO();
		redirect('sales/view_transaksi_eo',$data);
	}

	public function ubahstatus_eo($id_eo){
		$this->id_eo = $id_eo;
		$this->Usermodel->ubahStatusEo($id_eo);

		$data['eo'] = $this->Usermodel->tampilDataEO();
		redirect('sales/view_transaksi_eo',$data);
	}

	// SALES REPORT

	public function sales_report_cari(){
		$data['sales_report'] = $this->Usermodel->sales_report_cari();	
		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report();	

		$this->load->view('admin/sales_report',$data);
	}

	public function sales_report(){
		$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();
		
		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();

		$this->load->view('admin/sales_report',$data);
	}

	public function tambah_sales_report(){
		$this->load->view('admin/sales_report_tambah');
	}

	public function tambah_sales_report_1(){
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'paket' => $this->input->post('paket'),
			'tgl_berangkat' => $this->input->post('tgl_berangkat'),
			'jml_jamaah' => $this->input->post('jml_jamaah'),
			'keterangan' => $this->input->post('keterangan'),
			'bulan' => $this->input->post('bulan'),
			'tahun' => $this->input->post('tahun')
			);

		$this->Usermodel->tambahSalesReport($data);

		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();
		$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();

		$this->load->view('admin/sales_report',$data);
	}

	public function ubah_sales_report($id_sales_report){
		$this->load->model('Usermodel');
	    $where['id_sales_report'] = $id_sales_report;
	    $a=$this->db->get_where('tb_sales_report',$where)->row();
	    $data['id_sales_report']=$id_sales_report;
	    $data['user_id']=$a->user_id;
	    $data['paket']=$a->paket;
	    $data['tgl_berangkat']=$a->tgl_berangkat;
	    $data['jml_jamaah']=$a->jml_jamaah;
	    $data['total_poin']=$a->total_poin;
	    $data['keterangan']=$a->keterangan;

	    $this->load->view('admin/sales_report_ubah',$data);
	}

  	public function ubah_simpan_sales_report(){

	    $this->load->model('Usermodel');	    
	    $this->Usermodel->ubahSalesReport();

		$data['sales_report'] = $this->Usermodel->sales_report();
		$this->load->view('admin/sales_report',$data);

  	}

	public function hapus_sales_report($id_sales_report){
		$this->id_sales_report = $id_sales_report;
		$this->Usermodel->hapusSalesReport($id_sales_report); 		

		$data['poin_sales_report'] = $this->Usermodel->poin_sales_report_after_tambah();
		$data['sales_report'] = $this->Usermodel->sales_report_after_tambah();

		$this->load->view('admin/sales_report',$data);
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
				redirect('index.php/sales');
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
		redirect('index.php/sales');
	}
}