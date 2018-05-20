<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {

	/*
	Giver mulighed for at autoload data fra en constructor.
	Fx javascript filer som bruges i hele controlleren, men ikke i andre.
	*/
	var $data;
	var $user;

	public function __construct()
	{
		parent::__construct();

		// Init
		$this->data['scripts'] = array();
		$this->data['html_scripts'] = array();
		$this->data['css'] = array();

		// General
		$this->data['title'] = 'Patrick Lykke Hansen Holm';
		$this->data['base_url'] = base_url();

		// JS
		$this->data['scripts'][]['script'] = 'jquery-3.3.1.min.js';
		$this->data['scripts'][]['script'] = 'popper.min.js';
		$this->data['scripts'][]['script'] = 'bootstrap.min.js';

		# From old loading method
		// moveArrayElement($this->data['scripts'], count($this->data['scripts']) - 1, 0);
		// moveArrayElement($this->data['scripts'], count($this->data['scripts']) - 1, 0);
		// moveArrayElement($this->data['scripts'], count($this->data['scripts']) - 1, 0);

		// CSS
		$this->data['css'][]['style'] = 'bootstrap.min.css';
		$this->data['css'][]['style'] = 'main.css';

		# From old loading method
		// moveArrayElement($this->data['css'], count($this->data['css']) - 1, 0);
		// moveArrayElement($this->data['css'], count($this->data['css']) - 1, 0);
	}
	
	public function view($view = 'not_found')
	{
		// Error handling
		if (!$view) {
			$view = 'not_found';
		}

		// Nav
		$this->data['nav_maps'] = $this->db->get('maps')->result_array();

		// Url handling
		addUrlArray($this->data['scripts'], 'script', base_url('assets/js/'));
		addUrlArray($this->data['css'], 'style', base_url('assets/css/'));
		foreach ($this->data['nav_maps'] as $key => $value) {
			$this->data['nav_maps'][$key]['url'] = base_url('map/map/'.$value['m_id']);
		}

		// Adding user information to the data
		if ($this->user) {
			$this->data['user'] = (array) $this->user;
		}
		
		// View files
		$this->parser->parse('head', $this->data);
		$this->parser->parse('nav', $this->data);
		$this->parser->parse($view, $this->data);
		$this->parser->parse('footer', $this->data);
		$this->parser->parse('end', $this->data);
	}
}




























