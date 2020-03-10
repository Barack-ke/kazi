<?php
Class Privilegemodel extends CI_Model{
	public function __construct(){
		parent:: __construct();
	}
	public function getprivilegedropdown($condition=''){
      $this->db->select('*');
      $this->db->from('tblprivileg');
      if (!empty($condition)) {
            $this->db->where($condition);
        }
     return $this->db->get()->result_array();
	}
}