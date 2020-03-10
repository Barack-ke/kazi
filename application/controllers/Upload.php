<?php
defined('BASEPATH') or ('No direct script access allowed');
Class Upload extends CI_Controller{
    public function __construct(){
        parent:: __construct();
        $this->load->library('email');
        $this->uploadPath= 'uploads/images/';
    }
    public function index(){
 $thumb_msg = $status = $status_msg = $thumbnail = $org_image_size = $thumb_image_size = '';

        $data=array();

        if($this->input->post('submit')){
            if(!empty($_File['image']['name'])){
            $config['upload_path']=$this->uploadPath;
            $config['allowes_types']='jpg|jpeg|png';

             $this->load->library('upload', $config); 

             if($this->upload->do_upload('image')){
                $uploadData=$this->upload->data();
                $uploadedImage = $uploadData['file_name']; 
                $org_image_size = $uploadData['image_width'].'x'.$uploadData['image_height'];

                 $source_path = $this->uploadPath.$uploadedImage; 
                    $thumb_path = $this->uploadPath.'thumb/'; 
                    $thumb_width = 280; 
                    $thumb_height = 175; 
                     
                    // Image resize config 
                    $config['image_library']    = 'gd2'; 
                    $config['source_image']     = $source_path; 
                    $config['new_image']         = $thumb_path; 
                    $config['maintain_ratio']     = FALSE; 
                    $config['width']            = $thumb_width; 
                    $config['height']           = $thumb_height; 
                     
                    // Load and initialize image_lib library 
                    $this->load->library('image_lib', $config); 
                     
                    // Resize image and create thumbnail 
                    if($this->image_lib->resize()){ 
                        $thumbnail = $thumb_path.$uploadedImage; 
                        $thumb_image_size = $thumb_width.'x'.$thumb_height; 
                        $thumb_msg = '<br/>Thumbnail created!'; 
                    }else{ 
                        $thumb_msg = '<br/>'.$this->image_lib->display_errors(); 
                    } 
                     
                    $status = 'success'; 
                    $status_msg = 'Image has been uploaded successfully.'.$thumb_msg; 
                }else{ 
                    $status = 'error'; 
                    $status_msg = 'The image upload has failed!<br/>'.$this->upload->display_errors('',''); 
                } 
            }else{ 
                $status = 'error'; 
                $status_msg = 'Please select a image file to upload.';  
            } 
        } 
         
        // File upload status 
        $data['status'] = $status; 
        $data['status_msg'] = $status_msg; 
        $data['thumbnail'] = $thumbnail; 
        $data['org_image_size'] = $org_image_size; 
        $data['thumb_image_size'] = $thumb_image_size; 
         
        // Load form view and pass upload status 
        $this->load->view('email',$data); 
    }  

             }
            