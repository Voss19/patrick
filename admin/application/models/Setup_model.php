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
		if (!$this->session->user) {
			if ($this->router->fetch_class() != 'user' && $this->router->fetch_method() != 'login') {
				#redirect('user/login');
			}
		} else {
			$query =
				$this->db->where('u_verification', $this->session->user['u_verification'])
					->where('u_email', $this->session->user['u_email'])
					->get('users');

			if ($query->num_rows()) {
				$this->loader->admin = true;
				$this->loader->user = $query->row();
			} else {
				$this->session->unset_userdata('user');
				#redirect('user/login');
			}
		}
	}
}
