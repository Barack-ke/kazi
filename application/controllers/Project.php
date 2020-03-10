<?php
defined('BASEPATH') OR ('No direct script access allowed');

Class Project extends CI_Controller{
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
		$this->load->model('Projectmanager','projectmanager');
		$this->load->model('developermodel','developer');
		$this->load->model('task');
	}
	public function index(){
		$condition = array('tblproject.deleted'=> 0);
		$projects = $this->project->getprojectlist($condition);
		$data = array(
			'projects' => $projects,
		);

		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('projects/projectdashboard', $data);
		$this->load->view('includes/footer');
	}

	public function specificproject(){
		$id = $this->uri->segment('3');
		$condition = array('tblproject.deleted'=> 0, 'tblproject.id' => $id);
		$projects = $this->project->getprojectlist($condition);
		$data = array(
			'projects' => $projects,
		);

		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('projects/singleproject', $data);
		$this->load->view('includes/footer');
	}

	//this method loads a view to create a project
	public function create(){
		//$tasks=$this->tasks->task->gettasklist();
		$clients = $this->client->getclientdropdown();
		$managers = $this->projectmanager->getprojectmanagerdropdown();
		$developers = $this->developer->getdevelopersdropdown();

		$data = array(
			//'tasks' => $tasks,
			'clients' => $clients,
			'managers' => $managers,
			'developers' => $developers,
		);

		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('projects/createproject', $data);
		$this->load->view('includes/footer');
	}
	public function saveproject(){

		$pname = $this->input->post('pname');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$developer = $this->input->post('developer');
		$client = $this->input->post('client');
		$manager = $this->input->post('manager');
		//$task = $this->input->post('task');

		$this->form_validation->set_rules('pname','Project Name','xss_clean|trim|required');
		$this->form_validation->set_rules('startdate','Start date','xss_clean|trim|required');
		$this->form_validation->set_rules('enddate','End date','xss_clean|trim|required');
		$this->form_validation->set_rules('developer','developer','xss_clean|trim|required');
		$this->form_validation->set_rules('client','Client','xss_clean|trim|required');
		$this->form_validation->set_rules('manager','Manager','xss_clean|trim|required');
		//$this->form_validation->set_rules('task','task','xss_clean|trim|required');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('tempdata', 'Sorry '.validation_errors());
			redirect(base_url() . 'project/create');
		}else{
			if($startdate > $enddate){
				$this->session->set_flashdata('tempdata', 'Sorry Project cannot end before it starts');
				redirect(base_url() . 'project/create');
			}else{
				$data = array('name' => $pname,'start' => $startdate, 'end' => $enddate, 'developer' => $developer, 'client' => $client,'projectmanager'=>$manager);
				$result = $this->project->insert($data);

				if ($result < 1 /*|| $resulttask<1*/ ) {
					$this->session->set_flashdata('tempdata', "Sorry, there was a problem adding your details, kindly try again");
					redirect(base_url() . 'project/create/');
				} else {
					$this->session->set_flashdata('tempdata', 'details added successfully');
					redirect(base_url() . 'project/specificproject/'.$result);
				}
			}
		}
	}
	public function doupdate()
	{
		$pname = $this->input->post('pname');
		$theid = $this->input->post('theid');
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$developer = $this->input->post('developer');
		$client = $this->input->post('client');
		$manager = $this->input->post('manager');

		$this->form_validation->set_rules('pname','Project Name','xss_clean|trim|required');
		$this->form_validation->set_rules('startdate','Start date','xss_clean|trim|required');
		$this->form_validation->set_rules('enddate','End date','xss_clean|trim|required');
		$this->form_validation->set_rules('developer','developer','xss_clean|trim|required');
		$this->form_validation->set_rules('client','Client','xss_clean|trim|required');
		$this->form_validation->set_rules('manager','Manager','xss_clean|trim|required');
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('tempdata', 'Sorry '.validation_errors());
			redirect(base_url() . 'project/create');
		}else{
			if($startdate > $enddate){
				$this->session->set_flashdata('tempdata', 'Sorry Project cannot end before it starts');
				redirect(base_url() . 'project/create');
			}else{
				$data = array('name' => $pname,'start' => $startdate, 'end' => $enddate, 'developer' => $developer, 'client' => $client,'projectManager'=>$manager);
				$condition = array('id' => $theid);
				$result = $this->project->update($data,$condition);

				if ($result < 1) {
					$this->session->set_flashdata('tempdata', "Sorry, there was a problem editing the contact, kindly try again");
					redirect(base_url() . 'project');
				} else {
					$this->session->set_flashdata('tempdata', 'Contact edited successfully');
					redirect(base_url() . 'project');
				}
			}
		}
	}
	public function update() {
		$id = $this->uri->segment('3');
		$data = array('tblproject.id' => $id);
		$project = $this->project->confirmifexist($data);
		//$project = $this->project->update($data);
		if($project->num_rows() > 0){
			$row = $project->row();
			$id = $row->projectid;
			$name = $row->projectname;
			$start = $row->start;
			$end = $row->end;
			$developer= $row->developer;
			$client= $row->client;
			$clientname= $row->clientname;
			$projectManager= $row->projectManager;

			$clients = $this->client->getclientdropdown();
			$managers = $this->projectmanger->getprojectmanagerdropdown();
			$developers = $this->developer->getdevelopersdropdown();

			$data = array(
				'id' => $id,
				'name' => $name,
				'start' => $start,
				'end' => $end,
				'developer' => $developer,
				'client' => $client,
				'clientn' => $clientname,
				'projectManager' =>  $projectManager,'clients' => $clients,
				'managers' => $managers,
				'developers' => $developers,
			);

			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('includes/nav');
			$this->load->view('projects/editproject', $data);
			$this->load->view('includes/footer');
		}
	}
	public function addtask(){
		//$projectid= 'id';
		$projectid = $this->uri->segment('3');
		$condition = array('tblproject.deleted'=> 0, 'tblproject.id' => $projectid);
		$projects = $this->project->getprojectlist($condition);
		$data = array(	
			'projectid' => $projectid,
			'projects'=>$projects
		);

		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('projects/addtask',$data);
		$this->load->view('includes/footer');
	}
	public function savetask(){
		 
		$addtas = $this->input->post('addt');
		$theid = $this->input->post('theid');

		foreach ($addtas as $index => $task) {
			$this->form_validation->set_rules('addt[]','task','xss_clean|trim|required');
			if($this->form_validation->run() == false){
				$this->session->set_flashdata('tempdata', 'Sorry '.validation_errors());
				redirect(base_url() . 'project/addtask');
			}else{
				$data = array('task' => $task, 'projectId'=>$theid[$index]);
				$result = $this->task->insert($data);

			redirect(base_url().'project/addtask');
			}
		}
		$this->session->set_flashdata('tempdata', 'details added successfully');
			redirect(base_url() . 'project/addtask');
	}


	public function delete(){
		$id = $this->uri->segment('3');
		$data = array('tblproject.id' => $id);
		$projects = $this->project->deleterecords($id);

		redirect(base_url('project'));

	}


}
