<?php
defined('BASEPATH') OR ('No direct script accesss allowed');

Class Developer extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('developermodel');
		$this->load->helper(array('form', 'url'));

		if($this->session->userdata('uname') == null){
			$this->session->set_flashdata('tempdata', "Sorry, Your session has expired, kindly login");
			redirect(base_url().'user/login');
		}
		
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->model('usermodel');
		$this->load->model('Projectmodel','project');
		$this->load->model('Clientmodel','client');
		$this->load->model('Projectmanager','projectmanger');
		$this->load->model('developermodel','developer');
		$this->load->model('rankmodel','rank');

	}
	public function index(){
		$condition = array('deleted'=>0);
		$developers = $this->developer->getdeveloperlist($condition);
		$data = array(
			'developers' => $developers,
		);
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('developer/alldeveloper',$data);
		$this->load->view('includes/footer');

	}
	public function createdeveloper(){
		$data['ranks'] = $this->rank->getranksdropdown();

		
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('developer/createdeveloper',$data);
		$this->load->view('includes/footer');
	}
	public function savedeveloper(){
		$fname = $this->input->post('fname');
		$sname = $this->input->post('sname');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$rank = $this->input->post('rank');
		//$userfile = $this->input->post('userfile');

		$this->form_validation->set_rules('fname','First', 'xss_clean|trim|required');
		$this->form_validation->set_rules('sname','Second', 'xss_clean|trim|required');
		$this->form_validation->set_rules('email','email', 'xss_clean|trim|required');
		$this->form_validation->set_rules('phone','phone', 'xss_clean|trim|required');
		$this->form_validation->set_rules('rank','rank', 'xss_clean|trim|required');
		//$this->form_validation->set_rules('userfile','userfile','xss_clean|trim|required');

		if($this->form_validation->run()===false){
			$this->session->set_flashdata('tempdata', "Sorry, ".validation_errors());
			echo validation_errors();
			//redirect(base_url() . 'developer/createdeveloper');

		}else
			
			{
				$data = array('fname' => $fname,'sname' => $sname, 'email' => $email, 'phone' => $phone, 'rank' => $rank);
				$result = $this->developer->insert($data);

				if ($result < 1) {
					$this->session->set_flashdata('tempdata', "Sorry, there was a problem adding your details, kindly try again");

					redirect(base_url() . 'developer/createdeveloper');
				} else {
					$this->session->set_flashdata('tempdata', "Details added successfully");
					redirect(base_url() . 'developer/createdeveloper');
				}

                        // $data = array('upload_data' => $this->upload->data());

                        // $this->load->view('upload_success', $data);
			}
			
		}
	
	public function saveupdate(){
             
		$fname=$this->input->post('fname');
		$sname=$this->input->post('sname');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$rank=$this->input->post('rank');
		$userfilee=$this->input->post('userfilee');

		$this->form_validation->set_rules('fname','fname','xss_clean|trim|required');
		$this->form_validation->set_rules('sname','sname','xss_clean|trim|required');
		$this->form_validation->set_rules('email','email','xss_clean|trim|required');
		$this->form_validation->set_rules('phone','phone','xss_clean|trim|required');
		$this->form_validation->set_rules('rank','rank','xss_clean|trim|required');
		$this->form_validation->set_rules('userfilee','userfilee','xss_clean|trim|required');

		if($this->form_validation->run()===false){
			redirect(base_url('developer/update'));
		}else{

			$config['upload_path'] = './imageuploads/';
			$config['allowed_types']='gif|png|jpg|jpeg';
			$config['max_size']=1024;
			$config['max_width']=480;
			$config['max_height']=750;
			$config['file_name']='userfilee';

            $this->upload->initialize($config);
			$this->load->library('upload',$config);
			$userfilee=$this->input->post('userfilee');
			$img='userfile';
                $this->upload->data();
                if (!$this->upload->do_upload($img))
			{
				$this->session->set_flashdata('tempdata', "Sorry, ".$this->upload->display_errors());
				echo  $this->upload->display_errors();
				//redirect(base_url() . 'developer/createdeveloper');
			}
			else
			{
				$filename = $this->upload->data('file_name');

			$id=$this->uri->segment('3');
			$condition= array('tbldeveloper.id'=>$id);
			$data= array('fname'=>$fname, 'sname'=>$sname, 'email'=>$email, 'phone'=>$phone,'rank'=>$rank, 'photo'=>$filename);
			$result= $this->developermodel->update($data, $condition);

			if($result<1){
				$this->session->set_flashdata('tempdata', "Sorry, there was a problem  updating your details, kindly try again");
				redirect(base_url('developer/createdeveloper'));
			}elseif($result>0){
				$this->session->set_flashdata('tempdata', "Your update was successfully");

			}
		}
	}}
	   public function update(){
		$id=$this->uri->segment('3');
		$data= array(
			'tbldeveloper.id'=>$id);
		$developer = $this->developer->confirmifexist($data);

		 if($developer->num_rows() > 0){
		 	$row=$developer->row();
		 	$id= $row->devid;
		 	$fname=$row->fname;
		 	$sname=$row->sname;
		 	$email=$row->email;
		 	$phone=$row->phone;
		 	$rank=$row->rank;
		 	$userfilee=$row->photo;
            $condition= array('tblrank.rank'=>$rank);
		 	
		 	$data=array(
		 		'id'=>$id,
		 		'fname'=>$fname,
		 		'sname'=>$sname,
		 		'email'=>$email,
		 		'phone'=>$phone,
		 		'rank'=>$rank,
		 		'userfilee'=>$userfilee);

		 	
		 }
		 $data['ranks'] =$this->rank->getranksdropdown($condition);

		 $this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('includes/nav');
			$this->load->view('developer/updatedev', $data);
			$this->load->view('includes/footer');
	}
	public function deletedeveloper(){
		$id=$this->uri->segment('3');
		$condition = array('tbldeveloper.id'=>$id);
		$data = array('deleted'=>1);
		$developer= $this->developer->update($data, $condition);
		echo $developer;
		//redirect(base_url().'developer/index');
	}/*
	 public function do_upload()
        {
        	$userfilee=$this->input->post('userfilee');

                $config['upload_path']          = './imageuploads/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
                $this->upload->data();

                if ( ! $this->upload->do_upload('userfilee'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload_success', $data);
                }
        }*/
}