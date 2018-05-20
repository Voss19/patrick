<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

	public function index()
	{
		$this->loader->data['map_create'] = site_url('map/create');

		$this->loader->data['maps'] = $this->db->get('maps')->result_array();

		foreach ($this->loader->data['maps'] as $key => $value) {
			$type = $this->db->where('mt_id', $value['m_type'])->get('maptypes')->row()->mt_name;

			$this->loader->data['maps'][$key]['m_type'] = $type;
			$this->loader->data['maps'][$key]['editurl'] = site_url('map/update/'.$value['m_id']);
			$this->loader->data['maps'][$key]['addurl'] = site_url('map/add/'.$value['m_id']);
			$this->loader->data['maps'][$key]['delurl'] = site_url('map/delete/'.$value['m_id']);
		}

		$this->loader->view('admin/map/list');
	}

	public function create()
	{
		if ($this->input->post('create')) {
			$this->fval->set_rules('name', 'Navn', 'required');
			$this->fval->set_rules('desc', 'Beskrivelse', 'required');
			$this->fval->set_rules('type', 'Type', 'required');

			if ($this->fval->run()) {
				$this->db->insert('maps', array(
					'm_name'	=>	$this->input->post('name'),
					'm_desc'	=>	$this->input->post('desc'),
					'm_type'	=>	$this->input->post('type')
				));
			}
		}

		$this->loader->data['map_types'] = $this->db->get('maptypes')->result_array();

		$this->loader->view('admin/map/create');
	}

	public function delete($id)
	{
		$map = $this->db->where('m_id', $id)->get('maps');
		if ($map->num_rows()) {
			$this->db->where('mi_map', $map->row()->m_id)->delete('mapinputs');
			$this->db->where('m_id', $id)->delete('maps');
		}
		redirect('map');
	}
}
