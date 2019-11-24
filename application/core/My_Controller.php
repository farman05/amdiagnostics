<?php
class MY_Controller extends CI_Controller
{
	public $allowedActions = array();
	public $allowedAdmin = array();
	public $allowedUser = array();
	public $allowedEventAdmin = array();
	public $allowedEventEmployee = array();
	
	public $assertion = TRUE;
	
    function __construct()
    {
        parent::__construct();
		$this->data = "";
		
        // $this->load->model('Admin_model');
        
		// $this->data['userdata'] = $this->Admin_model->getUserData($this->session->userdata('id'));
        

       
		
    }
	
	function allow(){
		$this->allowedActions = array_merge($this->allowedActions, func_get_args());
	}
	
	function allowAdmin(){
		$this->allowedAdmin = array_merge($this->allowedAdmin, func_get_args());
	}
	
	function allowUser(){
		$this->allowedUser = array_merge($this->allowedUser, func_get_args());
	}

	function allowEventAdmin(){
		$this->allowedEventAdmin = array_merge($this->allowedEventAdmin, func_get_args());
	}

	function allowEventEmployee(){
		$this->allowedEventEmployee = array_merge($this->allowedEventEmployee, func_get_args());
	}

	

	function assert($msg){
		if($this->assertion){
			echo '<pre>';
			throw new Exception($msg);
			echo '</pre>';
			exit;
		}
	}
}