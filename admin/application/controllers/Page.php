<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		echo "<pre>";
		print_r((array) $this->loader->user);
		echo "</pre>";
		$this->loader->view();
	}

	public function denied()
	{
		$this->loader->view('admin/permission_denied');
	}
}
