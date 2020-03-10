<?php
defined('BASEPATH') OR('No direct script access allowed');

Class Rankmodel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function getranksdropdown($condition=''){
		if(!empty($condition)){
			$this->db->where($condition);
		}
		return $this->db->get('tblrank')->result_array();
	}
}