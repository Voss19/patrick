<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->loader->data['scripts'][]['script'] = 'jquery-jvectormap-2.0.3.min.js';
		$this->loader->data['css'][]['style'] = 'jquery-jvectormap-2.0.3.css';
	}
	
	public function index()
	{
		$this->loader->data['scripts'][]['script'] = 'jquery-jvectormap-world-mill.js';
		
		$this->loader->view();
	}
}
