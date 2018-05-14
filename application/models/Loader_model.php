<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader_model extends CI_Model {

	/*
	Giver mulighed for at autoload data fra en constructor.
	Fx javascript filer som bruges i hele controlleren.
	*/
	var $data;

	public function __construct()
	{
		parent::__construct();

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

		// Url handling
		addUrlArray($this->data['scripts'], 'script', base_url('assets/js/'));
		addUrlArray($this->data['css'], 'style', base_url('assets/css/'));
		
		// View files
		$this->parser->parse('head', $this->data);
		$this->parser->parse('nav', $this->data);
		$this->parser->parse($view, $this->data);
		$this->parser->parse('footer', $this->data);
		$this->parser->parse('end', $this->data);
	}
}
