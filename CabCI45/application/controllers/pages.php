<?php

class Pages extends CI_Controller {

	public function view($page = 'home',$data='')
	{
if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
	{
		
		show_404();
	}

	$title['title'] = ucfirst($page); 

	$this->load->view('templates/header', $title);
	$this->load->view('pages/'.$page, $data);
	$this->load->view('templates/footer', $title);
 
	}
}
