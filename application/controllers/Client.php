<?php
defined('BASEPATH') OR ('No direct script access allowed');
 Class Client extends CI_Controller{
 	public function __construct(){
 		parent::__construct();
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
 	}
 	public function index(){
 		$condition=array('deleted'=>0);
 		$clients = $this->client->getclientlist($condition);
 		$projects= $this->project->getprojectlist();
		$data = array(
			'clients' => $clients,
			'projects' => $projects,
					);
 		$this->load->view('includes/header');
 		$this->load->view('includes/sidebar');
 		$this->load->view('includes/nav');
 		$this->load->view('Client/allclient',$data);
 		$this->load->view('includes/footer');

 	}
 	public function update(){
 		$id=$this->uri->segment('3');
 		$data= array(
			'tblclient.id'=>$id);

 		$client=$this->client->confirmifexist($data);
 		if($client->num_rows()>0){
 			$row=$client->row();
 			$id =$row->id;
 			$name =$row->name;
 			$phone =$row->phone;
 			$email =$row->email;

 			$data=array(
 				'id'=>$id,
 				'name'=>$name,
 				'phone'=>$phone,
 				'email'=>$email);

 		}

 		$this->load->view('includes/header');
 		$this->load->view('includes/sidebar');
 		$this->load->view('includes/nav');
 		$this->load->view('client/updateclient',$data);
 		$this->load->view('includes/footer');

 	}
 	public function saveupdate(){
 		$id=$this->input->post('cid');
 		$name= $this->input->post('name');
 		$phone= $this->input->post('phone');
 		$email= $this->input->post('email');

 		//$this->form_validationn->set_rules('id','id','xss_clean|trim|required');
 		$this->form_validation->set_rules('name','name','xss_clean|trim|required');
 		$this->form_validation->set_rules('phone','phone','xss_clean|trim|required');
 		$this->form_validation->set_rules('email','email','xss_clean|trim|required');

 		if($this->form_validation->run()===false){
 			$this->session->set_flashdata('tempdata', "Sorry,".validation_errors());
 			redirect(base_url().'client/update/'.$id);
 			//echo validation_errors();
 		}else{
 			$data=array('name'=>$name, 'phone'=>$phone, 'email'=>$email);
 			$condition =array('tblclient.id'=>$id);
 			$result=$this->client->update($data,$condition);
 			if($result<1){
 				$this->session->set_flashdata('tempdata', "Sorry, there was a problem updating your details, kindly try again");
 				//echo "Sorry, there was a problem updating your details, kindly try again";
 				redirect(base_url().'client/update/'.$id);
 			}elseif($result>0){
 				//echo $result;
 				redirect(base_url().'client');
 			}
 		}

 	}
 	public function delete(){
 		$id=$this->uri->segment('3');
 		$data=array('deleted'=>1);
 		$condition=array('tblclient.id'=>$id);
 		$client=$this->client->update($data,$condition);
 		echo $client;

 	}
 	public function create(){
 		$this->load->view('includes/header');
 		$this->load->view('includes/sidebar');
 		$this->load->view('includes/nav');
 		$this->load->view('client/createclient');
 		$this->load->view('includes/footer');
 	}
 	public function saveclient(){
 		$name= $this->input->post('name');
 		$phone= $this->input->post('phone');
 		$email= $this->input->post('email');

 		$this->form_validation->set_rules('name','client name','xss_clean|trim|required');
 		$this->form_validation->set_rules('phone','Phone','xss_clean|trim|required');
 		$this->form_validation->set_rules('email','Email','xss_clean|trim|required');

 		if($this->form_validation->run()==false){
 			redirect(base_url('client/create'));
 		}else{
 			$data= array('name'=>$name,'phone'=>$phone,'email'=>$email);
 			$result=$this->client->insert($data);

 			if($result<1){
 				echo 'your details could not be added';
 				redirect(base_url('client/createt'));
 			}else{
 				echo 'details added successful';
 				redirect(base_url('client/create'));
 			}
 		}
 	}

 }