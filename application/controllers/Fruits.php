<?php
defined('BASEPATH') or('No direct script access allowed');
Class Fruits extends CI_Controller{
	public function __construct(){
		parent:: __construct();
		$this->load->helper('string'); 
		$this->load->model('Fruit','fruit');
	}
	public function index(){
		$data= $this->fruit->confirmexist();

		 $responce->cols[] = array( 
            "id" => "", 
            "label" => "Topping", 
            "pattern" => "", 
            "type" => "string" 
        ); 
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Total", 
            "pattern" => "", 
            "type" => "number" 
        ); 
        foreach($data as $cd) 
            { 
            $responce->rows[]["c"] = array( 
                array( 
                    "v" => "$cd->tblfruits.name", 
                    "f" => null 
                ) , 
                array( 
                    "v" => (int)$cd->quantity, 
                    "f" => null 
                ) 
            ); 
            } 
 
        echo json_encode($responce); 
        } 
	}
