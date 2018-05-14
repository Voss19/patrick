<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {
	
	public function view($view = 'not_found', $data = array())
	{
		// Error handling
		if (!$view) {
			$view = 'not_found';
		}
		
		// JS
		$data['scripts'][]['script'] = 'jquery-3.3.1.min.js';
		$data['scripts'][]['script'] = 'bootstrap.min.js';

		moveArrayElement($data['scripts'], count($data['scripts']) - 1, 0);
		moveArrayElement($data['scripts'], count($data['scripts']) - 1, 0);
		addUrlArray($data['scripts'], 'script', base_url('assets/js/'));

		// CSS
		$data['css'][]['style'] = 'bootstrap.min.css';
		$data['css'][]['style'] = 'main.css';

		moveArrayElement($data['css'], count($data['css']) - 1, 0);
		moveArrayElement($data['css'], count($data['css']) - 1, 0);
		addUrlArray($data['css'], 'style', base_url('assets/css/'));

		echo "<pre>";
		print_r($data);
		echo "</pre>";

		// View files
		$this->parser->parse('head', $data);
		$this->parser->parse('nav', $data);
		$this->parser->parse($view, $data);
		$this->parser->parse('footer', $data);
		$this->parser->parse('end', $data);
	}
}
