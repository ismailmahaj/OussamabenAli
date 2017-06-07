<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function contact_post(){
		//if($this->form_validation->run()){

			// récupérer les données
			$nom = $this->input->post('nom');
			$prenom = $this->input->post('prenom');
			$email = $this->input->post('email');
			$message = $this->input->post('message');

			// mettre dans la BDD
			$this->user_model->contact_send($nom,$prenom,$email,$message);

			// envoyer par email
	$data_msg = array(
						"var" => "mavar",
						"nom"=>$nom,
						"prenom"=>$prenom,
						"email"=>$email,
						"message"=>$message
					 );
            $this->load->library('email');
            // $config['protocol']='smtp';
            // $config['smtp_host']='your host';
            // $config['smtp_port']='465';
            // $config['smtp_timeout']='30';
            // $config['smtp_user']='ismailmahaj@gmail.com';
            // $config['smtp_pass']='813b55f47';
            // $config['charset']='utf-8';
			$msg = $this->load->view("mail/index",$data_msg,TRUE);
            $this->email->initialize();
            $this->email->from($email, 'Site name');
            $this->email->to('ismailmahaj@gmail.com');
            $this->email->subject('Notification Mail');
            $this->email->message($msg);
            $this->email->send();

			redirect('/');
			
	}
}
