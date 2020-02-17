<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gueh extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webmodel');
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
			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/awal');
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
			$this->load->view('gueh/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('gueh');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('gueh/login_view',$data);		
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
		redirect('gueh');
	}

	public function awal()
	{
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/awal');
	}


	// TOUR KATEGORI
	public function tour_kategori()
	{
		$data['tour_kategori'] = $this->Webmodel->adm_tour_kategori();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_kategori',$data);
	}

	public function tour_kategori_tambah()
	{		
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_kategori_tambah');
	}

	public function tour_kategori_tambah1()
	{		
		$data = array(
			'nama_kategori' => $_POST['nama_kategori']
		);
		
		$this->Webmodel->tour_kategori_tambah($data);
		$data['tour_kategori'] = $this->Webmodel->adm_tour_kategori();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_kategori',$data);
	}

	public function tour_kategori_hapus($id_tour_kategori){
		$this->id_tour_kategori = $id_tour_kategori;
		$this->Webmodel->tour_kategori_hapus($id_tour_kategori);

		$data['tour_kategori'] = $this->Webmodel->adm_tour_kategori();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_kategori',$data);
	}

	public function tour_kategori_edit($id_tour_kategori)
	{
		$where['id_tour_kategori'] = $id_tour_kategori;
		$a = $this->db->get_where('tb_tour_kategori',$where)->row();
		$data['id_tour_kategori'] = $id_tour_kategori;
		$data['nama_kategori'] = $a->nama_kategori;

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_kategori_edit',$data);
	}

	public function tour_kategori_edit_simpan()
	{
		$this->Webmodel->tour_kategori_edit();

		$data['tour_kategori'] = $this->Webmodel->adm_tour_kategori();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_kategori',$data);		
	}

	//TOUR
	public function tour()
	{
		$data['tour'] = $this->Webmodel->adm_tour();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour',$data);
	}

	public function tour_tambah()
	{		
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_tambah');
	}

	public function do_upload()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/images/tour/recent';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'jpg|jpeg',
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
			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/tour_tambah');
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
			
			$this->Webmodel->tour_tambah_1($nama_file);

	  		// redirect('mobil');
			$data['tour'] = $this->Webmodel->adm_tour();

			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/tour',$data);	
        }
    }

	public function tour_tambah1()
	{		
		$data = array(
			'id_tour_kategori' => $_POST['id_tour_kategori'],
			'gambar' => $_POST['gambar'],
			'nama_tour' => $_POST['nama_tour'],
			'ket1' => $_POST['ket1'],
			'ket2' => $_POST['ket2'],
			'link' => $_POST['link']
		);
		
		$this->Webmodel->tour_tambah($data);
		$data['tour'] = $this->Webmodel->adm_tour();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour',$data);
	}

	public function tour_hapus($id_tour){
		$this->id_tour = $id_tour;
		$this->Webmodel->tour_hapus($id_tour);

		$data['tour'] = $this->Webmodel->adm_tour();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour',$data);
	}

	public function tour_edit($id_tour)
	{
		$where['id_tour'] = $id_tour;
		$a = $this->db->get_where('tb_tour',$where)->row();
		$data['id_tour'] = $id_tour;
		$data['id_tour_kategori'] = $a->id_tour_kategori;
		$data['gambar'] = $a->gambar;
		$data['nama_tour'] = $a->nama_tour;
		$data['ket1'] = $a->ket1;
		$data['ket2'] = $a->ket2;
		$data['link'] = $a->link;

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_edit',$data);
	}

	public function tour_edit_simpan()
	{
		$this->Webmodel->tour_edit();

		$data['tour'] = $this->Webmodel->adm_tour();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour',$data);		
	}

	//TOUR DETAIL
	public function tour_detail()
	{
		$data['tour_detail'] = $this->Webmodel->adm_tour_detail();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_detail',$data);
	}

	public function tour_detail_tambah()
	{		
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_detail_tambah');
	}

	public function tour_detail_tambah1()
	{		
		$data = array(
			'id_tour' => $_POST['id_tour'],
			'gambar_detail' => $_POST['gambar_detail'],
			'id_itinerary' => $_POST['id_itinerary'],
			'include' => $_POST['include'],
			'exclude' => $_POST['exclude'],
			'term' => $_POST['term'],
			'highlight' => $_POST['highlight']
		);
		
		$this->Webmodel->tour_detail_tambah($data);
		$data['tour_detail'] = $this->Webmodel->adm_tour_detail();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_detail',$data);
	}

	public function do_upload_gambar_detail()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/images/tour/detail';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'jpg|jpeg',
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
			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/tour_detail_tambah');
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
			
			$this->Webmodel->tour_detail_tambah_1($nama_file);

	  		// redirect('mobil');
			$data['tour_detail'] = $this->Webmodel->adm_tour_detail();

			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/tour_detail',$data);	
        }
    }

	public function tour_detail_hapus($id_tour_detail){
		$this->id_tour_detail = $id_tour_detail;
		$this->Webmodel->tour_detail_hapus($id_tour_detail);

		$data['tour_detail'] = $this->Webmodel->adm_tour_detail();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_detail',$data);
	}

	public function tour_detail_edit($id_tour_detail)
	{
		$where['id_tour_detail'] = $id_tour_detail;
		$a = $this->db->get_where('tb_tour_detail',$where)->row();
		$data['id_tour_detail'] = $id_tour_detail;
		$data['id_tour'] = $a->id_tour;
		$data['gambar'] = $a->gambar;
		$data['id_itinerary'] = $a->id_itinerary;
		$data['include'] = $a->include;
		$data['exclude'] = $a->exclude;
		$data['term'] = $a->term;
		$data['highlight'] = $a->highlight;

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_detail_edit',$data);
	}

	public function tour_detail_edit_simpan()
	{
		$this->Webmodel->tour_detail_edit();

		$data['tour_detail'] = $this->Webmodel->adm_tour_detail();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/tour_detail',$data);		
	}

	// ITINERARY
	public function itinerary()
	{
		$data['itinerary'] = $this->Webmodel->adm_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/itinerary',$data);
	}

	public function itinerary_tambah()
	{		
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/itinerary_tambah');
	}

	public function itinerary_tambah1()
	{		
		$data = array(
			'id_itinerary' => $_POST['id_itinerary'],
			'nama_itinerary' => $_POST['nama_itinerary'],
			'id_tour' => $_POST['id_tour'],
			'file_itinerary' => $_POST['file_itinerary'],
			'tour_highlight' => $_POST['tour_highlight']
		);
		
		$this->Webmodel->itinerary_tambah($data);
		$data['itinerary'] = $this->Webmodel->adm_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/itinerary',$data);
	}

	public function do_upload_file_detail()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/file';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'pdf',
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
			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/tour_detail_tambah');
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
			
			$this->Webmodel->itinerary_tambah_1($nama_file);

	  		// redirect('mobil');
			$data['itinerary'] = $this->Webmodel->adm_itinerary();

			$this->load->view('gueh/dashboard');
			$this->load->view('gueh/itinerary',$data);	
        }
    }

	public function itinerary_hapus($id_itinerary){
		$this->id_itinerary = $id_itinerary;
		$this->Webmodel->itinerary_hapus($id_itinerary);

		$data['itinerary'] = $this->Webmodel->adm_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/itinerary',$data);
	}

	public function itinerary_edit($id_itinerary)
	{
		$where['id_itinerary'] = $id_itinerary;
		$a = $this->db->get_where('tb_itinerary',$where)->row();
		$data['id_itinerary'] = $id_itinerary;
		$data['id_tour'] = $a->id_tour;
		$data['nama_itinerary'] = $a->nama_itinerary;
		$data['file_itinerary'] = $a->file_itinerary;

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/itinerary_edit',$data);
	}

	public function itinerary_edit_simpan()
	{
		$this->Webmodel->itinerary_edit();

		$data['itinerary'] = $this->Webmodel->adm_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/itinerary',$data);		
	}


	// DETAIL ITINERARY
	public function detail_itinerary()
	{
		$data['detail_itinerary'] = $this->Webmodel->adm_detail_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/detail_itinerary',$data);
	}

	public function detail_itinerary_tambah()
	{		
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/detail_itinerary_tambah');
	}

	public function detail_itinerary_tambah1()
	{		
		$data = array(
			'id_itinerary' => $_POST['id_itinerary'],
			'id_tour' => $_POST['id_tour'],
			'hari' => $_POST['hari'],
			'kegiatan' => $_POST['kegiatan']
		);
		
		$this->Webmodel->detail_itinerary_tambah($data);
		$data['detail_itinerary'] = $this->Webmodel->adm_detail_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/detail_itinerary',$data);
	}

	public function detail_itinerary_hapus($id_detail_itinerary){
		$this->id_detail_itinerary = $id_detail_itinerary;
		$this->Webmodel->detail_itinerary_hapus($id_detail_itinerary);

		$data['detail_itinerary'] = $this->Webmodel->adm_detail_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/detail_itinerary',$data);
	}

	public function detail_itinerary_edit($id_detail_itinerary)
	{
		$where['id_detail_itinerary'] = $id_detail_itinerary;
		$a = $this->db->get_where('tb_detail_itinerary',$where)->row();
		$data['id_detail_itinerary'] = $id_detail_itinerary;
		$data['id_itinerary'] = $a->id_itinerary;
		$data['id_tour'] = $a->id_tour;
		$data['hari'] = $a->hari;
		$data['kegiatan'] = $a->kegiatan;

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/detail_itinerary_edit',$data);
	}

	public function detail_itinerary_edit_simpan()
	{
		$this->Webmodel->detail_itinerary_edit();

		$data['detail_itinerary'] = $this->Webmodel->adm_detail_itinerary();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/detail_itinerary',$data);		
	}

	//STATUS
	public function status(){
		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/status');
	}
	
	public function ubah_status_tour()
	{
		$this->Webmodel->adm_tour_status();

		$this->load->view('gueh/dashboard');
		$this->load->view('gueh/status');		
	}
}