<?php
defined('BASEPATH') OR('No direct script allowed');
require APPPATH . 'libraries/AfricasTalkingGateway.php';
Class User extends CI_Controller{
	public function __contstruct(){
		parent::__contstruct();
		$this->load->model('Usermodel');
		$this->load->model('Privilegemodel','privilege');
	}
	public function test(){
		  $username = 'daguindd'; // use 'sandbox' for development in the test environment
        $apiKey = '6dd54335434146ec6b30f90e00cebed3c44cd25dfd93d7edeac1cea3ad66616b'; // use your sandbox app API key for development in the test environment
        $AT = new AfricasTalkingGateway($username, $apiKey);

        // Get one of the services
        $sms = $AT->sendMessage('254729233891', 'Test sms', 'ARI');

	}
	public function login(){
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav1');
		$this->load->view('user/login');
		$this->load->view('includes/footer');
	}
	public function saveuser(){

		$name= $this->input->post('name');
		$email= $this->input->post('email');
		$phone=$this->input->post('phone');
		$password= sha1($this->input->post('password'));
		$privileg=$this->input->post('privileg');

		$this->form_validation->set_rules('name','name','xss_clean|trim|required');
		$this->form_validation->set_rules('email','Email','xss_clean|trim|required');
		$this->form_validation->set_rules('phone','Phone','xss_clean|trim|required');
		$this->form_validation->set_rules('password','Password','xss_clean|trim|required');
		$this->form_validation->set_rules('privileg','Privileg','xss_clean|trim|required');

		if($this->form_validation->run()==false){
			$this->session->set_flashdata('tempdata', "Sorry, ".validation_errors());
			redirect(base_url().'user/create');
		}else{
			$data=array('name'=>$name, 'email'=>$email, 'phone'=>$phone,'password'=>$password, 'privileg'=>$privileg);
			$this->db->insert('tbluser',$data);
			$resultuser = $this->db->insert_id();


			//$data = array('userId' => $this->db->insert_id(), 'password' => $password);
			//$resultlogin = $this->db->insert('tbllogin',$data);


			if($resultuser<1){
				
				$this->session->set_flashdata('tempdata', "Sorry, there was a problem adding your details, kindly try again");
				redirect(base_url().'user/create');
			}else {
				 $message = '';
				 $to = $email;
				 $subject = 'verify your account';
				 $message .= 'thank you for registering with us. you can verify your account via the link below:<br>';
				 $message .= '<a href='.$_SERVER['SERVER_ADDR'].'/project/user/login></a>';
				 $headers = "From: wacademic95@gmail.com\r\n";
				 if (mail($to, $subject, $message, $headers)) {
				 	echo "SUCCESS";
				 } else {
				 	echo "ERROR";
				 }

				//$this->load->library('email');

//$this->email->from('wacademic95@gmail.com', 'Wacademic');
//$this->email->to($email);

//$this->email->subject('Verify your account');
//$this->email->message('Thank you for registering with us. you can verify your account via the link below:<br>. <a href='.$_SERVER['SERVER_ADDR'].'/project/user/login>ACtivate</a>');

//$this->email->send();
//if($this->email->send()===false){
//echo $this->email->print_debugger();
//		}else{		//$this->session->set_flashdata('tempdata', "Your datails were submitted successful");
				redirect(base_url().'user/login');
			}//}

		}

	}
	public function create(){
		$privileg = $this->privilegemodel->getprivilegedropdown();
		$data = array(
			//'tasks' => $tasks,
			'privileg' => $privileg);

		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('user/userregister',$data);
		$this->load->view('includes/footer');
	}
	public function checklogin(){
		$username= $this->input->post('uname');
		$password= sha1($this->input->post('pass'));

		$this->form_validation->set_rules('uname','username','xss_clean|trim|required');
		$this->form_validation->set_rules('pass','password','xss_clean|trim|required');


		if($this->form_validation->run()===false){
			$this->session->set_flashdata('tempdata', "Sorry,Invalid email address or password provided");
			redirect(base_url().'user/login');
		}else{
			$this->session->set_userdata('uname', $username);
			$data = array('email' =>$username, 'password'=>$password);
			$result = $this->usermodel->confirmifexist($data);
			$result->num_rows();
			
			if ($result->num_rows() > 0) {
				$row = $result->row();

				$this->session->set_userdata('loginname', $row->name);
				$this->session->set_userdata('loginemail', $row->email);
				$this->session->set_userdata('loginprivileg', $row->privileg);
				$this->session->set_userdata('loginactive', $row->active);
				$this->session->set_userdata('loginphone', $row->phone);
				$this->session->set_userdata('loginenabled', $row->enabled);
				
				if($row->privileg == 1){
					redirect(base_url().'dashboard');
				}else if($row->privileg == 2){
					redirect(base_url().'project');
				}else{
					redirect(base_url().'developer');
				}
			
			}else{
				redirect(base_url().'user/login');
			}
		}

	}
	public function change(){
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('user/changepassd');
		$this->load->view('includes/footer');
	}
	public function changepass(){
		$oldpass=sha1($this->input->post('oldpass'));
		$newpass=sha1($this->input->post('newpass'));
		$confirm=sha1($this->input->post('confirmpass'));

		$this->form_validation->set_rules('oldpass','xss_clean|trim|required');
		$this->form_validation->set_rules('newpass','xss_clean|trim|required');
		$this->form_validation->set_rules('confirmpass','matches[newpass]|required|xss_clean');

		if($this->form_validation->run()===false){
			redirect(base_url().'user/change');
		}else{
			$data=array('oldpass'=>$oldpass, 'newpass'=>$newpass, 'confirmpass'=>$confirm);
			$result=$this->usermodel->changepassword($data);

			if($result<1){
				redirect(base_url().'user/change');
			}
			elseif($result>0){
				redirect(base_url().'user/login');
			}


		}
	}

	public function killall(){
		$this->session->sess_destroy();
		redirect(base_url().'user/login');
	}
	public function getuser(){
		$users= $this->usermodel->getuserlist();
		$data= array(
			'users'=>$users);
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('user/userlist',$data);
		$this->load->view('includes/footer');
	}
	public function specificuser(){
		$id= $this->uri->segment('3');
		$data = array('tbluser.id' => $id);
		$users = $this->usermodel->confirmifexist($data);

		if($users->num_rows()>0){
			$row = $users->row();
			$id = $row->userid;
			$name = $row->name;
			$email = $row->email;
			$phone = $row->phone;
			$privileg= $row->privileg;
			

			$users = $this->privilegemodel->getprivilegedropdown();
			 $data= array(
			 	'users'=>$users,
			 	'id'=>$id,
			 	'name'=>$name,
			 	'email'=>$email,
			 	'phone'=>$phone,
			 	'privileg'=>$privileg
			 );

			 $this->load->view('includes/header');
			 $this->load->view('includes/sidebar');
			 $this->load->view('includes/nav');
			 $this->load->view('user/userspecific',$data);
			 $this->load->view('includes/footer');
			}
			
	}public function savespecificuser(){
		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$phone= $this->input->post('phone');
		$privileg=$this->input->post('privileg');
		$theid=$this->input->post('theid');

		$this->form_validation->set_rules('name','Name','xss_clean|trim|required');
		$this->form_validation->set_rules('email','Email','xss_clean|trim|required');
		$this->form_validation->set_rules('phone','Phone','xss_clean|trim|required');
		$this->form_validation->set_rules('privileg','privilege','xss_clean|trim|required');
		$this->form_validation->set_rules('theid','id','xss_clean|trim|required');

		if($this->form_validation->run()===false){
			$this->session->set_flashdata('tempdata', "Sorry,make sure every field is entered with correct data");
			redirect(base_url().'user/specificuser/'.$theid);
		}else{
			$condition = array(
				'id'=>$theid);
			$data = array(
				'name'=>$name, 'email'=>$email, 'phone'=>$phone, 'privileg'=>$privileg);
			$result = $this->usermodel->update($data, $condition);
			if($result<1){
				$this->session->set_flashdata('tempdata', "Sorry, could not update your details");
				redirect(base_url().'user/specificuser/'.$theid);
			}elseif($result>0){
				$this->session->set_flashdata('tempdata', "Update done successful");
				redirect(base_url().'user/getuser');
			}
		}
	}
}
