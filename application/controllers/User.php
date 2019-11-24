<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller {

    function __construct()
    {
		parent::__construct();
		
    }
	public function index()
	{   
        $data = returnData('index');
        $data['package'] = getPackages(3);
		$this->load->view('front_end_templates/basetemplate', $data);
    }

}