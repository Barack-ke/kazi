<?php

class Projectmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    //Get the models details meeting the condition
    public function confirmifexist($condition = '')
    {
        $this->db->select('*, tblproject.name as projectname, tblproject.id as projectid, tbldeveloper.id as devid, tblclient.id as clientid, tblprojectmanager.id as managerid, tblclient.name as clientname');
        $this->db->from('tblproject');
        $this->db->join('tbldeveloper', 'tbldeveloper.id=tblproject.developer','inner');
        $this->db->join('tblclient', 'tblclient.id=tblproject.client','inner');
        $this->db->join('tblprojectmanager', 'tblprojectmanager.id=tblproject.projectManager','inner');

        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get();
    }


    //Get the list of the models to be displayed
    public function getprojectlist($condition = '')
    {
        $this->db->select('*, tblproject.name as projectname, tblproject.id as projectid, tbldeveloper.id as devid, tblclient.name as clientname, tblclient.id as clientid, tblprojectmanager.pname as projectmanagername, tblprojectmanager.id as managerid');
        $this->db->from('tblproject');
        $this->db->join('tbldeveloper', 'tbldeveloper.id=tblproject.developer','inner');
        $this->db->join('tblclient', 'tblclient.id=tblproject.client','inner');
        $this->db->join('tblprojectmanager', 'tblprojectmanager.id=tblproject.projectManager','inner');
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

        $this->db->insert('tblproject', $data);
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
    public function update($data,$condition)
    {
        $this->db->trans_start();

        $this->db->where($condition);
        $this->db->update('tblproject', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return 0;
        } elseif ($this->db->trans_status() === true) {
            return 1;
        }
    }

    //Pick all the model for a view dropdown
    public function getprojectsdropdown($condition = '')
    {
        if (!empty($condition)) {
            $this->db->where($condition);
        }

        return $this->db->get('tblproject')->result_array();
    }
    public function deleterecords($id)
    {
        $this->db->query("update tblproject set deleted=1 where tblproject.id='".$id."'");
    }
}