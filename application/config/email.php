<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->library('email');

$config = array(
    'protocol' => 'sendmail', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.gmail.com', 
    'smtp_port' => 465,
    'smtp_user' => 'wacademic95@gmail.com',
    'smtp_pass' => 'password',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
//$this->email->initialize($config);