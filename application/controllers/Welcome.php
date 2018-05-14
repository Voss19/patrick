<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$data['scripts'][]['script'] = 'jquery-jvectormap-2.0.3.min.js';
		$data['scripts'][]['script'] = 'jquery-jvectormap-world-mill.js';
		$data['css'][]['style'] = 'jquery-jvectormap-2.0.3.css';

		$this->loader->view(null, $data);
	}
}
