<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Chart extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
    // load model
        $this->load->database('project manager');
        $this->load->helper(array('url','html','form'));
        $this->load->model('Usermodel');
    }       
     public function bar_chart(){
   
      $query =  $this->usermodel->query("SELECT COUNT(id) as count,MONTHNAME(createdat) as month_name FROM tbluser WHERE YEAR(createdat) = '" . date('Y') . "'
      GROUP BY YEAR(createdat),MONTH(createdat)"); 
 
      $record = $query->result();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->month_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);
      $this->load->view('bar_chart',$data);
    }
     
}