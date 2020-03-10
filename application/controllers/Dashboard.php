<?php
defined('BASEPATH') OR ('No direct script access allowed');

Class Dashboard extends CI_Controller{
	public function __construct(){
       parent::__construct();
       if($this->session->userdata('uname') == null){
			$this->session->set_flashdata('tempdata', "Sorry, Your session has expired, kindly login");
			redirect(base_url().'user/login');
		}
		
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('Usermodel');
	}
	public function index(){
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('includes/nav');
		$this->load->view('includes/index');
		$this->load->view('includes/footer');
	}
}