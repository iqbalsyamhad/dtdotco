<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Career extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Webmodel');
	}

	public function index()
	{
		$this->load->view('web/career');
	}

	public function apply()
	{
		$this->load->view('web/apply');
	}

	public function apply_save()
	{		
		$data = array(
			'nama' => $_POST['nama'],
			'posisi' => $_POST['q'],
			'cv' => $_POST['cv']
		);
		$this->Webmodel->apply($data);
		$this->load->view('web/career');
	}

	public function do_upload()
    {
        $this->load->library('upload');
		
        $file_upload_folder = FCPATH . './asset/file/jobseeker';

        if (!file_exists($file_upload_folder)) {
            mkdir($file_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $file_upload_folder,
            'allowed_types' => 'pdf|doc|docx',
            'max_size'      => 20000,
            'remove_space'  => TRUE,
            
        );
        // $data['ticket'] = $this->Usermodel->tampilTicket();

		// $this->template->set('title','Ticketing | DreamTour.co');
		// $this->template->load('template','admin/ticketing',$data);

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            //echo json_encode($upload_error);
			$this->load->view('web/career');
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
			
			$this->Webmodel->apply_1($nama_file);

	  		// redirect('mobil');

			$this->load->view('web/career');	
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */