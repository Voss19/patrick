<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	
	public function index()
	{
		$this->loader->data['about'] = $this->db->where('p_page', 'about')->get('pages')->result_array();
		$this->loader->view('about');
	}

	public function err404()
	{
		$this->loader->view();
	}

	public function kontakt()
	{
		if ($this->input->post('kontakt')) {
			$this->fval->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->fval->set_rules('emne', 'Emne', 'required');
			$this->fval->set_rules('besked', 'Besked', 'required');

			if ($this->fval->run()) {

				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => $this->secret->email_adress,
					'smtp_pass' => $this->secret->email_password,
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);

				$this->email->initialize($config);

				$this->email->from($this->secret->email_adress, 'Patrick Lykke Hansen Holm');
				$this->email->to($this->input->post('email'));
				$this->email->subject('Automatisk svar: '.$this->input->post('emne'));
				$this->email->message('<h2>Jeg har modtaget din besked.</h2>');

				if ($this->email->send()) {
					echo "yay<br>";
				} else {
					echo "øv<br>";
				}

				$this->email->from($this->secret->email_adress, 'Patrick Lykke Hansen Holm');
				$this->email->to($this->secret->email_adress_to);
				$this->email->subject('Form: '.$this->input->post('emne'));
				$this->email->message("
					<p>Email: {$this->input->post('email')}</p>
					<p>Emne: {$this->input->post('emne')}</p>
					<p>Besked:</p>
					<p>{$this->input->post('email')}</p>
				");

				if ($this->email->send()) {
					echo "yay<br>";
				} else {
					echo "øv<br>";
				}
			}
		}
		$this->loader->view('kontakt');
	}
}
