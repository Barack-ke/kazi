<?php

class Clientmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    //Get the models details meeting the condition
    public function confirmifexist($condition = '')
    {
        $this->db->select('*');
        $this->db->from('tblclient');
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get();
    }


    //Get the list of the models to be displayed
    public function getclientlist($condition = '')
    {
        $this->db->select('*');
        $this->db->from('tblclient');
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get()->result();
    }

    //Insert model into the system
    public function insert($data)
    {
        //starting transaction
        $this->db->trans_begin();

        $this->db->insert('tblclient', $data);
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
        $this->db->update('tblclient', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return 0;
        } elseif ($this->db->trans_status() === true) {
            return 1;
        }
    }

    //Pick all the model for a view dropdown
    public function getclientdropdown($condition = '')
    {
        $this->db->select('*');
        $this->db->from('tblclient');
        if (!empty($condition)) {
            $this->db->where($condition);
        }

        return $this->db->get()->result_array();
    }
    public function deleterecords($id)
    {
        $this->db->query("delete  from tblclient where register.id='".$id."'");
    }

    //get the gender values
    
}