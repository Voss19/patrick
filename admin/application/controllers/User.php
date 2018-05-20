<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function create()
	{
		if ($this->loader->user->u_level < 2) {
			redirect('page/denied');
		}
		if ($this->input->post('create')) {
			$this->fval->set_rules('name', 'Navn', 'required');
			$this->fval->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.u_email]');
			$this->fval->set_rules('password', 'Kodeord', 'trim|required|min_length[6]');
			$this->fval->set_rules('rpassword', 'Gentag Kodeord', 'trim|required|matches[password]');

			if ($this->fval->run()) {
				$this->db->insert('users', array(
					'u_email'			=>		$this->input->post('email'),
					'u_password'		=>		password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'u_name'			=>		$this->input->post('name'),
					'u_verification'	=>		md5(date('s i d m Y'))
				));
			}
		}
		$this->loader->view('admin/user/create');
	}

	public function login()
	{
		if ($this->input->post('login')) {
			$this->fval->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->fval->set_rules('password', 'Kodeord', 'trim|required');

			if ($this->fval->run()) {
				$query = $this->db->where('u_email', $this->input->post('email'))->get('users');

				if ($query->num_rows()) {
					$user = $query->row();
					if (password_verify($this->input->post('password'), $user->u_password)) {
						$this->session->set_userdata('user', array(
							'u_name'			=>		$user->u_name,
							'u_email'			=>		$user->u_email,
							'u_verification'	=>		$user->u_verification
						));
						redirect();
					}
				}
			}
		}
		$this->loader->view('admin/user/login');
	}

	public function update($id = null)
	{
		if (!$id) {
			$id = $this->loader->user->u_id;
		}

		if ($this->loader->user->u_level < 2) {
			if ($id !== $this->loader->user->u_id) {
				redirect('page/denied');
			}
		}

		if ($this->input->post('update')) {
			$this->fval->set_rules('opassword', 'Gammelt Kodeord', 'trim|required');
			$this->fval->set_rules('npassword', 'Nyt Kodeord', 'trim|required');
			$this->fval->set_rules('rpassword', 'Gentag Nyt Kodeord', 'trim|required|min_length[6]|matches[npassword]');

			if ($this->fval->run()) {
				$where = $this->db->where('u_id', $id);
				if (password_verify($this->input->post('opassword'), $where->get('users')->row()->u_password)) {
					$where->update('users', array(
						'u_password'		=>		password_hash($this->input->post('npassword'), PASSWORD_DEFAULT),
						'u_verification'	=>		md5(date('s i d m Y'))
					));
					$user = $where->get('users')->row();
					$this->session->set_userdata('user', array(
						'u_name'			=>		$user->u_name,
						'u_email'			=>		$user->u_email,
						'u_verification'	=>		$user->u_verification
					));
				}
			}
		}

		$this->loader->view('admin/user/update');
	}
}





























