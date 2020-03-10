<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Emails extends CI_Controller {
public function __construct(){
    parent:: __construct();
    $this->load->library('email');
}
	public function index(){
	$to = 'daguindd@gmail.com';
$subject = 'test';
$message = 'Hi Dee, will this work?'; 
$from = 'wacademic95@gmail.com';
 
// Sending email
if(mail($to, $subject, $message)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email.Please try again.';
}	
	}

}
?>