<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapinput extends CI_Controller {

	public function list($map)
	{
		$this->loader->data['inputs'] = $this->db->where('mi_map', $map)->get('mapinputs')->result_array();
		$this->loader->data['add'] = site_url('mapinput/add/'.$map);

		foreach ($this->loader->data['inputs'] as $key => $value) {
			$this->loader->data['inputs'][$key]['mi_active'] = ($this->loader->data['inputs'][$key]['mi_active']) ? '&#10004;' : '&#215;';

			$this->loader->data['inputs'][$key]['toggle'] = site_url('mapinput/toggle/'.$map.'/'.$value['mi_id']);
			$this->loader->data['inputs'][$key]['delete'] = site_url('mapinput/delete/'.$map.'/'.$value['mi_id']);
		}

		$this->loader->view('admin/map/input/list');
	}

	public function toggle($map, $id)
	{
		switch ($this->db->where('mi_id', $id)->get('mapinputs')->row()->mi_active) {
			case 1:
				$this->db->where('mi_id', $id)->update('mapinputs', array(
					'mi_active' => 0
				));
				break;

			case 0:
				$this->db->where('mi_id', $id)->update('mapinputs', array(
					'mi_active' => 1
				));
				break;
			
			default:
				$this->db->where('mi_id', $id)->update('mapinputs', array(
					'mi_active' => 0
				));
				break;
		}
		redirect('mapinput/list/'.$map);
	}

	public function delete($map, $id)
	{
		$this->db->where('mi_id', $id)->delete('mapinputs');
		redirect('mapinput/list/'.$map);
	}

	public function add($map)
	{
		if ($this->input->post('create')) {
			$this->fval->set_rules('name', 'Navn', 'required');
			$this->fval->set_rules('code', 'Kode', 'required');

			if ($this->fval->run()) {
				$this->db->insert('mapinputs', array(
					'mi_name'		=>		$this->input->post('name'),
					'mi_a2'			=>		strtoupper($this->input->post('code')),
					'mi_active'		=>		1,
					'mi_map'		=>		$map,
				));
				redirect('mapinput/list/'.$map);
			}
		}
		$this->loader->view('admin/map/input/add');
	}
}

































