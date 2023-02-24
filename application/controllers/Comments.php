<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Comments extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Comment");
    }

    public function add($product_id, $review_id)
    {
        $description = $this->input->post("description", TRUE);
        $this->Comment->create_comment($review_id, $description);
        redirect("/products/show/$product_id");
    }
}
?>