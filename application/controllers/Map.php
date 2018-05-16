<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->loader->data['scripts'][]['script'] = 'jquery-jvectormap-2.0.3.min.js';
		$this->loader->data['css'][]['style'] = 'jquery-jvectormap-2.0.3.css';
		$this->loader->data['css'][]['style'] = 'map.css';
	}
	
	public function map($id)
	{
		$current_map = $this->db->where('m_id', $id)->get('maps');
		$map_type = $this->db->where('mt_id', $current_map->row()->m_type)->get('maptypes')->row();
		$map_inputs = $this->db->where('mi_map', $id)->where('mi_active', 1)->get('mapinputs')->result_array();

		$this->loader->data['scripts'][]['script'] = $map_type->mt_file;
		$this->loader->data['current_map'] = $current_map->result_array();

		$visited = "";
		foreach ($map_inputs as $key => $value) {
			$visited = $visited.$value['mi_a2'].": 'blue', ";
		}

		$map_settings = "
			$(function() {
				$('#map').vectorMap({
					map: '{$map_type->mt_code}',
					backgroundColor: 'transparent',
					regionStyle: {
						initial: {
							fill: 'lightgrey'
						}
					},
					series: {
						regions: [{
							values: {
								{$visited}
							}
						}]
					}
				})
			})
		";

		$this->loader->data['html_scripts'][]['src'] = $map_settings;

		$this->loader->view('map/map');
	}
}
