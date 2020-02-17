<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carter extends CI_Controller
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
			$this->load->view('carter/dashboard',$data);
			$this->load->view('carter/awal');
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
			$this->load->view('carter/login_view');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success)
			{
				// lemparkan ke halaman index user
				redirect('carter');
			}
			else
			{
				$this->template->set('title','Login Form | DreamTour.co');
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('carter/login_view',$data);		
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
		redirect('carter');
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


			// load model 'usermodel'
			$this->load->model('usermodel');
			// level untuk user ini
			$level = $this->session->userdata('level');
			// ambil menu dari database sesuai dengan level
			$data['menu'] = $this->usermodel->get_menu_for_level($level);

		$this->load->view('carter/dashboard',$data);
		$this->load->view('carter/ubah_password');
	}

	public function ubahSimpanPassword()
	{
		$this->Usermodel->ubahPassword();
		
			$this->template->set('title','Login Form | DreamTour.co');
			$this->load->view('carter/login_view');	
	}

	public function awal()
	{
		$this->load->view('carter/dashboard');
		$this->load->view('carter/awal');
	}

	public function carter1_1() //kloter 1 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view1');
	}

	public function carter1_2() //kloter 2 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view2');
	}

	public function carter1_3() //kloter 3 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view3');
	}

	public function carter1_4() //kloter 4 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view4');
	}

	public function carter1_5() //kloter 5 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view5');
	}

	public function carter1_6() //kloter 6 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view6');
	}

	public function carter1_7() //kloter 7 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view7');
	}

	public function carter1_8() //kloter 8 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view8');
	}

	public function carter1_9() //kloter 9 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view9');
	}

	public function carter1_10() //kloter 10 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view10');
	}

	public function carter1_11() //kloter 11 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view11');
	}

	public function carter1_12() //kloter 12 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view12');
	}

	public function carter1_13() //kloter 13 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view13');
	}

	public function carter1_14() //kloter 14 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view14');
	}

	public function carter1_15() //kloter 15 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view15');
	}

	public function carter1_16() //kloter 16 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view16');
	}

	public function carter1_17() //kloter 17 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view17');
	}

	public function carter1_18() //kloter 18 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view18');
	}

	public function carter1_19() //kloter 19 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view19');
	}

	public function carter1_20() //kloter 20 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view20');
	}

	public function carter1_21() //kloter 21 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view21');
	}

	public function carter1_22() //kloter 22 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view22');
	}

	public function carter1_23() //kloter 23 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view23');
	}

	public function carter1_24() //kloter 24 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view24');
	}

	public function carter1_25() //kloter 25 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view25');
	}

	public function carter1_26() //kloter 26 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view26');
	}

	public function carter1_27() //kloter 27 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view27');
	}

	public function carter1_28() //kloter 28 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view28');
	}

	public function carter1_29() //kloter 29 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view29');
	}

	public function carter1_30() //kloter 30 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view30');
	}

	public function carter1_31() //kloter 31 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view31');
	}

	public function carter1_32() //kloter 32 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view32');
	}

	public function carter1_33() //kloter 33 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view33');
	}

	public function carter1_34() //kloter 34 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view34');
	}

	public function carter1_35() //kloter 35 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view35');
	}

	public function carter1_36() //kloter36 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view36');
	}

	public function carter1_37() //kloter 37 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view37');
	}

	public function carter1_38() //kloter 38 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view38');
	}

	public function carter1_39() //kloter 39 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view39');
	}

	public function carter1_40() //kloter 40 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view40');
	}

	public function carter1_41() //kloter 41 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view41');
	}

	public function carter1_42() //kloter 42 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view42');
	}

	public function carter1_43() //kloter 43 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view43');
	}

	public function carter1_44() //kloter 44 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view44');
	}

	public function carter1_45() //kloter 45 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view45');
	}

	public function carter1_46() //kloter 46 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view46');
	}

	public function carter1_47() //kloter 47 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view47');
	}

	public function carter1_48() //kloter 48 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view48');
	}

	public function carter1_49() //kloter 49 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view49');
	}

	public function carter1_50() //kloter 50 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view50');
	}

	public function carter1_51() //kloter 51 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view51');
	}

	public function carter1_52() //kloter 52 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view52');
	}

	public function carter1_53() //kloter 53 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view53');
	}

	public function carter1_54() //kloter 54 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view54');
	}

	public function carter1_55() //kloter 55 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view55');
	}

	public function carter1_56() //kloter 56 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view56');
	}

	public function carter1_57() //kloter 57 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view57');
	}

	public function carter1_58() //kloter 58 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view58');
	}

	public function carter1_59() //kloter 59 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view59');
	}

	public function carter1_60() //kloter 60 tripuri1
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view60');
	}

	public function carter1_61() //kloter 61 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view61');
	}

	public function carter1_62() //kloter 62 tripuri
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view62');
	}


	public function carter2_1() //kloter 1 kano
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view1');
	}

	public function carter2_2() //kloter 2 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view2');
	}

	public function carter2_3() //kloter 3 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view3');
	}

	public function carter2_4() //kloter 4 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view4');
	}

	public function carter2_5() //kloter 5 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view5');
	}

	public function carter2_6() //kloter 6 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view6');
	}

	public function carter2_7() //kloter 7 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view7');
	}

	public function carter2_8() //kloter 8 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view8');
	}

	public function carter2_9() //kloter 9 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view9');
	}

	public function carter2_10() //kloter 10 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view10');
	}

	public function carter2_11() //kloter 11 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view11');
	}

	public function carter2_12() //kloter 12 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view12');
	}

	public function carter2_13() //kloter 13 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view13');
	}

	public function carter2_14() //kloter 14 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view14');
	}

	public function carter2_15() //kloter 15 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view15');
	}

	public function carter2_16() //kloter 16 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view16');
	}

	public function carter2_17() //kloter 17 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view17');
	}

	public function carter2_18() //kloter 18 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view18');
	}

	public function carter2_19() //kloter 19 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view19');
	}

	public function carter2_20() //kloter20 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view20');
	}

	public function carter2_21() //kloter 21 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view21');
	}

	public function carter2_22() //kloter 22 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view22');
	}

	public function carter2_23() //kloter 23 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view23');
	}

	public function carter2_24() //kloter 24 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view24');
	}

	public function carter2_25() //kloter 25 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view25');
	}

	public function carter2_26() //kloter 26 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view26');
	}

	public function carter2_27() //kloter 27 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view27');
	}

	public function carter2_28() //kloter 28 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view28');
	}

	public function carter2_29() //kloter 29 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view29');
	}

	public function carter2_30() //kloter 30 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view30');
	}

	public function carter2_31() //kloter 31 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view31');
	}

	public function carter2_32() //kloter 32 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view32');
	}

	public function carter2_33() //kloter 33 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view33');
	}

	public function carter2_34() //kloter 34 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view34');
	}

	public function carter2_35() //kloter 35 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view35');
	}

	public function carter2_36() //kloter 36 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view36');
	}

	public function carter2_37() //kloter 37 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view37');
	}

	public function carter2_38() //kloter 38 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view38');
	}

	public function carter2_39() //kloter 39 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view39');
	}

	public function carter2_40() //kloter 40 kano alia sdw
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/2/view40');
	}

	public function carter2_41() //kloter 41 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view41');
	}

	public function carter2_42() //kloter 42 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view42');
	}

	public function carter2_43() //kloter 43 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view43');
	}

	public function carter2_44() //kloter 44 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view44');
	}

	public function carter2_45() //kloter 45 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view45');
	}

	public function carter2_46() //kloter 46 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view46');
	}

	public function carter2_47() //kloter 47 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view47');
	}

	public function carter2_48() //kloter 48 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view48');
	}

	public function carter2_49() //kloter 49 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view49');
	}

		public function carter2_50() //kloter 50 kano alia sdw
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/2/view50');
	}

	public function carter2_51() //kloter 51 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view51');
	}

	public function carter2_52() //kloter 52 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view52');
	}

	public function carter2_53() //kloter 53 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view53');
	}

	public function carter2_54() //kloter 54 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view54');
	}

	public function carter2_55() //kloter 55 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view55');
	}

	public function carter2_56() //kloter 56 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view56');
	}

	public function carter2_57() //kloter 57 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view57');
	}

	public function carter2_58() //kloter 58 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view58');
	}

	public function carter2_59() //kloter 59 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view59');
	}

	public function carter2_60() //kloter 60 kano alia sdw
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/2/view60');
	}

	public function carter2_61() //kloter 61 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view61');
	}

	public function carter2_62() //kloter 62 kano alia sdw
	{
		$this->load->view('carter/dashboard2');
		$this->load->view('carter/2/view62');
	}


	public function carter3_1() // kloter 1 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view1');
	}

	public function carter3_2() // kloter 2 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view2');
	}

	public function carter3_3() //kloter 3 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view3');
	}

	public function carter3_4() //kloter 4 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view4');
	}

	public function carter3_5() //kloter 5 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view5');
	}

	public function carter3_6() //kloter 6 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view6');
	}

	public function carter3_7() //kloter 7 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view7');
	}

	public function carter3_8() //kloter 8 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view8');
	}

	public function carter3_9() //kloter 9 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view9');
	}

	public function carter3_10() //kloter 10 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view10');
	}

	public function carter3_11() //kloter 11 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view11');
	}

	public function carter3_12() //kloter 12 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view12');
	}

	public function carter3_13() //kloter 13 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view13');
	}

	public function carter3_14() //kloter 14 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view14');
	}

	public function carter3_15() //kloter 15 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view15');
	}

	public function carter3_16() //kloter 16 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view16');
	}

	public function carter3_17() //kloter 17 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view17');
	}

	public function carter3_18() //kloter 18 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view18');
	}

	public function carter3_19() //kloter 19 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view19');
	}

	public function carter3_20() //kloter 20 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view20');
	}

	public function carter3_21() //kloter 21 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view21');
	}

	public function carter3_22() //kloter 22 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view22');
	}

	public function carter3_23() //kloter 23 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view23');
	}

	public function carter3_24() //kloter 24 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view24');
	}

	public function carter3_25() //kloter 25 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view25');
	}

	public function carter3_26() //kloter 26 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view26');
	}

	public function carter3_27() //kloter 27 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view27');
	}

	public function carter3_28() //kloter 28 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view28');
	}

	public function carter3_29() //kloter 29 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view29');
	}

	public function carter3_30() //kloter 30 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view30');
	}

	public function carter3_31() // kloter 31 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view31');
	}

	public function carter3_32() // kloter 32 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view32');
	}

	public function carter3_33() //kloter 33 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view33');
	}

	public function carter3_34() //kloter 34 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view34');
	}

	public function carter3_35() //kloter 35 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view35');
	}

	public function carter3_36() //kloter 36 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view36');
	}

	public function carter3_37() //kloter 37 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view37');
	}

	public function carter3_38() //kloter 38 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view38');
	}

	public function carter3_39() //kloter 39 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view39');
	}

	public function carter3_40() //kloter 40 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view40');
	}

	public function carter3_41() // kloter 41 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view41');
	}

	public function carter3_42() // kloter 42 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view42');
	}

	public function carter3_43() //kloter 43 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view43');
	}

	public function carter3_44() //kloter 44 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view44');
	}

	public function carter3_45() //kloter 45 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view45');
	}

	public function carter3_46() //kloter 46 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view46');
	}

	public function carter3_47() //kloter 47 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view47');
	}

	public function carter3_48() //kloter 48 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view48');
	}

	public function carter3_49() //kloter 49 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view49');
	}

	public function carter3_50() //kloter 50 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view50');
	}

	public function carter3_51() // kloter 51 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view51');
	}

	public function carter3_52() // kloter 52 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view52');
	}

	public function carter3_53() //kloter 53 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view53');
	}

	public function carter3_54() //kloter 54 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view54');
	}

	public function carter3_55() //kloter 55 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view55');
	}

	public function carter3_56() //kloter 56 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view56');
	}

	public function carter3_57() //kloter 57 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view57');
	}

	public function carter3_58() //kloter 58 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view58');
	}

	public function carter3_59() //kloter 59 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view59');
	}

	public function carter3_60() //kloter 60 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view60');
	}

	public function carter3_61() // kloter 61 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view61');
	}

	public function carter3_62() // kloter 62 dream
	{
		$this->load->view('carter/dashboard3');
		$this->load->view('carter/3/view62');
	}


	public function carter4_1() //kloter 1 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view1');
	}

	public function carter4_2() //kloter 2 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view2');
	}

	public function carter4_3() //kloter 3 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view3');
	}

	public function carter4_4() //kloter 4 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view4');
	}

	public function carter4_5() //kloter 5 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view5');
	}

	public function carter4_6() //kloter 6 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view6');
	}

	public function carter4_7() //kloter 7 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view7');
	}

	public function carter4_8() //kloter 8 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view8');
	}

	public function carter4_9() //kloter 9 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view9');
	}

	public function carter4_10() //kloter 10 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view10');
	}

	public function carter4_11() //kloter 11 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view11');
	}

	public function carter4_12() //kloter 12 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view12');
	}

	public function carter4_13() //kloter 13 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view13');
	}

	public function carter4_14() //kloter 14 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view14');
	}

	public function carter4_15() //kloter 15 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view15');
	}

	public function carter4_16() //kloter 16 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view16');
	}

	public function carter4_17() //kloter 17 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view17');
	}

	public function carter4_18() //kloter 18 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view18');
	}

	public function carter4_19() //kloter 19 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view19');
	}

	public function carter4_20() //kloter 20 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view20');
	}

	public function carter4_21() //kloter 21 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view21');
	}

	public function carter4_22() //kloter 22 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view22');
	}

	public function carter4_23() //kloter 23 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view23');
	}

	public function carter4_24() //kloter 24 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view24');
	}

	public function carter4_25() //kloter 25 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view25');
	}

	public function carter4_26() //kloter 26 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view26');
	}

	public function carter4_27() //kloter 27 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view27');
	}

	public function carter4_28() //kloter 28 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view28');
	}

	public function carter4_29() //kloter 29 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view29');
	}

	public function carter4_30() //kloter 30 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view30');
	}

	public function carter4_31() //kloter 31 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view31');
	}

	public function carter4_32() //kloter 32 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view32');
	}

	public function carter4_33() //kloter 33 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view33');
	}

	public function carter4_34() //kloter 34 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view34');
	}

	public function carter4_35() //kloter 35 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view35');
	}

	public function carter4_36() //kloter36 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view36');
	}

	public function carter4_37() //kloter 37 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view37');
	}

	public function carter4_38() //kloter 38 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view38');
	}

	public function carter4_39() //kloter 39 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view39');
	}

	public function carter4_40() //kloter 40 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view40');
	}
	public function carter4_41() //kloter 41 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view41');
	}

	public function carter4_42() //kloter 42 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view42');
	}

	public function carter4_43() //kloter 43 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view43');
	}

	public function carter4_44() //kloter 44 view tripuri1
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view44');
	}

	public function carter4_45() //kloter 45 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view45');
	}

	public function carter4_46() //kloter 46 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view46');
	}

	public function carter4_47() //kloter 47 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view47');
	}

	public function carter4_48() //kloter 48 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view48');
	}

	public function carter4_49() //kloter 49 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view49');
	}

	public function carter4_50() //kloter 50 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view50');
	}

	public function carter4_51() //kloter 51 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view51');
	}

	public function carter4_52() //kloter 52 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view52');
	}

	public function carter4_53() //kloter 53 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view53');
	}

	public function carter4_54() //kloter 54 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view54');
	}

	public function carter4_55() //kloter 55 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view55');
	}

	public function carter4_56() //kloter 56 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view56');
	}

	public function carter4_57() //kloter 57 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view57');
	}

	public function carter4_58() //kloter 58 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view58');
	}

	public function carter4_59() //kloter 59 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view19');
	}

	public function carter4_60() //kloter 60 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view60');
	}

	public function carter4_61() //kloter 61 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view61');
	}

	public function carter4_62() //kloter 62 view tripuri
	{
		$this->load->view('carter/dashboard4');
		$this->load->view('carter/4/view62');
	}

	//kloter 1 tripuri tambah
	public function carter1_1_tambah()
	{
		// load model 'usermodel'
		$this->load->model('usermodel');
		// level untuk user ini
		$level = $this->session->userdata('level');
		// ambil menu dari database sesuai dengan level
		$data['menu'] = $this->usermodel->get_menu_for_level($level);
		$this->load->view('carter/dashboard',$data);
		$this->load->view('carter/1/view1_tambah');
	}

	public function carter1_1_tambah1()
	{		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'id_pemesanan' => $this->input->post('id_pemesanan'),
   				'id_kelas' => $this->input->post('id_kelas'),
   				'id_kloter' => $this->input->post('id_kloter'),
   				'jumlah' => $this->input->post('jumlah'),
   				'tanggal' => $this->input->post('tanggal')
  				);
  		$this->Usermodel->carter1_1_tambah($data);

		if ($this->input->post('id_kloter')==1) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view1');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view1');
			}
		}elseif ($this->input->post('id_kloter')==2) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view2');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view2');
			}
		}elseif ($this->input->post('id_kloter')==3) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view3');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view3');
			}
		}elseif ($this->input->post('id_kloter')==4) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view4');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view4');
			}
		}elseif ($this->input->post('id_kloter')==5) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view5');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view5');
			}
		}elseif ($this->input->post('id_kloter')==6) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view6');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view6');
			}
		}elseif ($this->input->post('id_kloter')==7) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view7');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view7');
			}
		}elseif ($this->input->post('id_kloter')==8) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view8');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view8');
			}
		}elseif ($this->input->post('id_kloter')==9) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view9');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view9');
			}
		}elseif ($this->input->post('id_kloter')==10) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view10');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view10');
			}
		}elseif ($this->input->post('id_kloter')==11) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view11');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view11');
			}
		}elseif ($this->input->post('id_kloter')==12) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view12');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view12');
			}
		}elseif ($this->input->post('id_kloter')==13) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view13');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view13');
			}
		}elseif ($this->input->post('id_kloter')==14) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view14');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view14');
			}
		}elseif ($this->input->post('id_kloter')==15) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view15');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view15');
			}
		}elseif ($this->input->post('id_kloter')==16) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view16');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view16');
			}
		}elseif ($this->input->post('id_kloter')==17) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view17');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view17');
			}
		}elseif ($this->input->post('id_kloter')==18) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view18');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view18');
			}
		}elseif ($this->input->post('id_kloter')==19) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view19');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view19');
			}
		}elseif ($this->input->post('id_kloter')==20) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view20');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view20');
			}
		}elseif ($this->input->post('id_kloter')==21) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view21');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view21');
			}
		}elseif ($this->input->post('id_kloter')==22) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view22');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view22');
			}
		}elseif ($this->input->post('id_kloter')==23) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view23');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view23');
			}
		}elseif ($this->input->post('id_kloter')==24) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view24');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view24');
			}
		}elseif ($this->input->post('id_kloter')==25) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view25');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view25');
			}
		}elseif ($this->input->post('id_kloter')==26) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view26');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view26');
			}
		}elseif ($this->input->post('id_kloter')==27) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view27');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view27');
			}
		}elseif ($this->input->post('id_kloter')==28) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view28');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view28');
			}
		}elseif ($this->input->post('id_kloter')==29) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view29');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view29');
			}
		}elseif ($this->input->post('id_kloter')==30) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view30');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view30');
			}
		}elseif ($this->input->post('id_kloter')==31) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view31');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view31');
			}
		}elseif ($this->input->post('id_kloter')==32) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view32');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view32');
			}
		}elseif ($this->input->post('id_kloter')==33) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view33');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view33');
			}
		}elseif ($this->input->post('id_kloter')==34) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view34');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view34');
			}
		}elseif ($this->input->post('id_kloter')==35) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view35');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view35');
			}
		}elseif ($this->input->post('id_kloter')==36) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view36');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view36');
			}
		}elseif ($this->input->post('id_kloter')==37) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view37');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view37');
			}
		}elseif ($this->input->post('id_kloter')==38) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view38');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view38');
			}
		}elseif ($this->input->post('id_kloter')==39) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view39');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view39');
			}
		}elseif ($this->input->post('id_kloter')==40) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view40');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view40');
			}
		}elseif ($this->input->post('id_kloter')==41) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view41');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view41');
			}
		}elseif ($this->input->post('id_kloter')==42) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view42');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view42');
			}
		}elseif ($this->input->post('id_kloter')==43) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view43');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view43');
			}
		}elseif ($this->input->post('id_kloter')==44) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view44');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view44');
			}
		}elseif ($this->input->post('id_kloter')==45) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view45');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view45');
			}
		}elseif ($this->input->post('id_kloter')==46) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view46');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view46');
			}
		}elseif ($this->input->post('id_kloter')==47) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view47');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view47');
			}
		}elseif ($this->input->post('id_kloter')==48) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view48');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view48');
			}
		}elseif ($this->input->post('id_kloter')==49) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view49');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view49');
			}
		}elseif ($this->input->post('id_kloter')==50) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view50');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view50');
			}
		}elseif ($this->input->post('id_kloter')==51) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view51');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view51');
			}
		}elseif ($this->input->post('id_kloter')==52) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view52');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view52');
			}
		}elseif ($this->input->post('id_kloter')==53) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view53');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view53');
			}
		}elseif ($this->input->post('id_kloter')==54) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view54');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view54');
			}
		}elseif ($this->input->post('id_kloter')==55) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view55');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view55');
			}
		}elseif ($this->input->post('id_kloter')==56) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view56');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view56');
			}
		}elseif ($this->input->post('id_kloter')==57) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view57');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view57');
			}
		}elseif ($this->input->post('id_kloter')==58) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view58');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view58');
			}
		}elseif ($this->input->post('id_kloter')==59) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view59');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view59');
			}
		}elseif ($this->input->post('id_kloter')==60) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view60');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view60');
			}
		}elseif ($this->input->post('id_kloter')==61) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view61');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view61');
			}
		}elseif ($this->input->post('id_kloter')==62) {
			if ($this->input->post('user_id')==43){
				$this->load->view('carter/dashboard1');
				$this->load->view('carter/1/view62');
			}else{
				$this->load->view('carter/dashboard2');
				$this->load->view('carter/2/view62');
			}
		}
	}

	//kloter 2 tripuri tambah
	public function carter1_2_tambah()
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view1_tambah');
	}

	public function carter1_2_tambah1()
	{		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'id_pemesanan' => $this->input->post('id_pemesanan'),
   				'id_kelas' => $this->input->post('id_kelas'),
   				'id_kloter' => $this->input->post('id_kloter'),
   				'jumlah' => $this->input->post('jumlah')
  				);
  		$this->Usermodel->carter1_1_tambah($data);

		$this->load->view('carter/dashboard1');
		$this->load->view('carter/1/view2');
	}

	public function carter2_1_tambah()
	{
		$this->load->view('carter/dashboard1');
		$this->load->view('carter/2/view1_tambah');
	}

	public function carter2_1_tambah1()
	{		
		$data = array(
   				'user_id' => $this->input->post('user_id'),
   				'id_pemesanan' => $this->input->post('id_pemesanan'),
   				'id_kelas' => $this->input->post('id_kelas'),
   				'id_kloter' => $this->input->post('id_kloter'),
   				'jumlah' => $this->input->post('jumlah')
  				);
  		$this->Usermodel->carter1_1_tambah($data);

		$this->load->view('carter/dashboard1');
		$this->load->view('carter/2/view1');
	}

	public function view_2()
	{
		$this->load->view('carter/dashboard');
		$this->load->view('carter/view_kano');
	}

}