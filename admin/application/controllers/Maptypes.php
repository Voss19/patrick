<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maptypes extends CI_Controller {

	public function index()
	{
		$this->loader->data['add'] = site_url('maptypes/add');
		$this->loader->data['types'] = $this->db->get('maptypes')->result_array();

		$this->loader->view('admin/map/types/list');
	}

	public function add()
	{
		$this->loader->data['err'] = '';
		if ($this->input->post('upload')) {
			$this->fval->set_rules('name', 'Navn', 'required');
			$this->fval->set_rules('code', 'Kode', 'required');
			if (empty($_FILES['file']['name'])) {
				$this->fval->set_rules('file', 'Fil', 'required');
			}

			if ($this->fval->run()) {
				$config['upload_path']          = str_replace('admin/', '', FCPATH).'assets/js/';
				$config['allowed_types']        = 'js';
				$config['max_size']             = 1000;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('file')) {
					$this->db->insert('maptypes', array(
						'mt_name'	=>	$this->input->post('name'),
						'mt_code'	=>	$this->input->post('code'),
						'mt_file'	=>	$this->upload->data('file_name')
					));
					redirect('maptypes');
				} else {
					$this->loader->data['err'] = $this->upload->display_errors();
				}
			} else {
				$this->loader->data['err'] = validation_errors();
			}
		}

		$this->loader->view('admin/map/types/add');
	}
}

































