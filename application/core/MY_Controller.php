<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function render($view,$template = 'template/base/index'){
        $this->data["view_content"] = $this->load->view($view,$this->data, TRUE);
        $this->load->view($template, $this->data);
   }

}