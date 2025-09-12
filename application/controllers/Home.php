<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    //HOME
   public function index()
    {
        $data['title'] = 'Item List';
        $data['_view'] = 'home/index';
        $this->load->view('layouts/master', $data);
    }
    
}