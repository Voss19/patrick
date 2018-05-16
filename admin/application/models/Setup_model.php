<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('../../../application/helpers/Array_helper');
		$this->load->model('../../../application/models/Loader_model', 'loader');

		$this->logged_in();
	}

	private function logged_in()
	{
		if (!$this->session->admin) {
			if ($this->router->fetch_class() != 'user' && $this->router->fetch_method() != 'login') {
				#redirect();
			}
		}
	}
}
