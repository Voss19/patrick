<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapinput extends CI_Controller {

	public function list($id)
	{
		$this->loader->data['inputs'] = $this->db->where('mi_map', $id)->get('mapinputs')->result_array();

		foreach ($this->loader->data['inputs'] as $key => $value) {
			$this->loader->data['inputs'][$key]['mi_active'] = ($this->loader->data['inputs'][$key]['mi_active']) ? '&#10004;' : '&#215;';

			$this->loader->data['inputs'][$key]['toggle'] = site_url('mapinput/toggle/'.$id.'/'.$value['mi_id']);
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
}
