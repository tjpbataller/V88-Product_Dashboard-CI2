<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Reviews extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Review");
    }

    public function add($id)
    {
        $description = $this->input->post(NULL, TRUE);
        $this->Review->create_review($id, $description);
        redirect("/products/show/$id");
    }
}
?>