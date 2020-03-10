<?php
defined('BASEPATH') or('No direct script access allowed');
Class Fruit extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function confirmexist($condition=''){
		$this->db->select('*');
		$this->db->from('tblfruits');
	    if(!empty($condition)){
	    	$this->db->where($condition);
	    }
	    return $this->db->get();
	}
	public function insert($data){
		$this->db->trans_begin();
		$this->db->insert('tblfruits',$data);
		return insert_id();

		$this->db->trans_complete();
		if($this->db->trans_status()===false){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}
	}
}