<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->loader->data['scripts'][]['script'] = 'jquery-jvectormap-2.0.3.min.js';
		$this->loader->data['css'][]['style'] = 'jquery-jvectormap-2.0.3.css';
	}
	
	public function map($id)
	{
		$current_map = $this->db->where('m_id', $id)->get('maps')->row();
		$map_type = $this->db->where('mt_id', $current_map->m_type)->get('maptypes')->row();
		$map_inputs = $this->db->where('mi_map', $id)->where('mi_visited', 1)->get('mapinputs')->result_array();

		$this->loader->data['scripts'][]['script'] = $map_type->mt_file;

		$visited = "";
		foreach ($map_inputs as $key => $value) {
			$visited = $visited.$value['mi_a2'].": '#00ff00',";
		}

		$map_settings = "
			$(function() {
				$('#map').vectorMap({
					map: '{$map_type->mt_code}',
					backgroundColor: '#ffffff',
					regionStyle: {
						initial: {
							fill: '#ffffff',
							stroke: '#000000',
							'stroke-width': 0.3
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

		$this->loader->view('map/world');
	}
}
