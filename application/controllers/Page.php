<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	public function index()
	{
		$this->loader->view();
	}

	public function err404()
	{
		$this->loader->view();
	}

	public function kontakt()
	{
		if ($this->input->post('kontakt')) {
			$this->fval->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->fval->set_rules('emne', 'Emne', 'required');
			$this->fval->set_rules('besked', 'Besked', 'required');

			if ($this->fval->run()) {
				/**
				* @todo send email
				*/
			}
		}
		$this->loader->view('kontakt');
	}
}
