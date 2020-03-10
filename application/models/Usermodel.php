<?php

class Usermodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    //Get the models details meeting the condition
    public function confirmifexist($condition = '')
    {
        $this->db->select('*');
        $this->db->from('tbluser');
        $this->db->join('tblprivileg', 'tblprivileg.id=tbluser.privileg','inner');
        //$this->db->join('tbllogin', 'tbllogin.userId=tbluser.id','inner');
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get();
    }



    //Get the list of the models to be displayed
    public function getuserlist($condition = '')
    {
        $this->db->select('*, tbluser.id as userid, tblprivileg.id as prid');
        $this->db->from('tbluser');
        $this->db->join('tblprivileg', 'tblprivileg.id=tbluser.privileg','inner');
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get()->result();
    }

    //Insert model into the system
    public function insert($data, $password)
    {
        //starting transaction
        $this->db->trans_begin();

        $this->db->insert('tbluser', $data);
        $insertid = $this->db->insert_id();

        //Transaction completed
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return 0;
        } elseif ($this->db->trans_status() === true) {
            $this->db->trans_commit();
            return $insertid;
        }
    }

public function insertlogin($data)
    {
        //starting transaction
        $this->db->trans_begin();

        $this->db->insert('tbluser', $data);
        $insertid = $this->db->insert_id();

        //Transaction completed
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return 0;
        } elseif ($this->db->trans_status() === true) {
            $this->db->trans_commit();
            return $insertid;
        }
    }

    //Update models
    public function update($data, $condition)
    {
        $this->db->trans_start();

        $this->db->where($condition);
        $this->db->update('tbluser', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return 0;
        } elseif ($this->db->trans_status() === true) {
            return 1;
        }
    }

    //Pick all the model for a view dropdown
    public function getuserdropdown($condition = '')
    {
        if (!empty($condition)) {
            $this->db->where($condition);
        }

        return $this->db->get('tbluser')->result_array();
    }
    public function deleterecords($id)
    {
        $this->db->query("delete  from tbluser where register.id='".$id."'");
    }
    public function changepassword($condition=''){
        $this->db->where(array('id' => $userid));
    return $this->db->update('tbluser',$data);

    //update the user table next//
    $this->db->where(array('id' => $userid));
    return $this->db->update('tbllogin',$data);
    }
    public function barget(){
        $this->db->select('createdat');
        $this->db->from('tbluser');
        if(!empty($condition)){
            $this->db->where($condition);
                    }
                    $this->db->get()->result();
    }

    
   
}