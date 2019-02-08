<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barcode extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('Zend');
	}

	public function index($ab)
	{
 
		//I'm just using rand() function for data example
		
		$code = str_replace('-', '/', $ab);
		$img = $this->set_barcode($code);

		

		// echo $_GET['no_surat']; die();
	}
	
	private function set_barcode($code)
	{
		//load library

		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}


	

}