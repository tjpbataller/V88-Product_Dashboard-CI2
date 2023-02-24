<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Products extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Product");
        $this->load->model("Review");
        $this->load->model("Comment");
    }

    public function index()
    {
        $view_data = array(
            "products" => $this->Product->show_products()
        );
        $this->load->view("products/index", $view_data);
    }

    public function new()
    {
        if($this->session->userdata("user_level") === 1){redirect("/dashboard");}
        $this->load->view("products/new");
    }

    public function edit($id)
    {
        if($this->session->userdata("user_level") === 1){redirect("/dashboard");}
        $view_data = $this->Product->show_only_product($id);
        $this->load->view("products/edit", $view_data);
    }

    public function edit_process($id)
    {
        if($this->session->userdata("user_level") === 1){redirect("/dashboard");}
        $data = $this->input->post(NULL, TRUE);
        $data["id"] = $id;
        $this->Product->validate_update_product($id);
        $this->Product->update_product($data);
        redirect("/products/edit/$id");
    }

    public function show($id)
    {
        $results = $this->Review->show_all_reviews($id);
        $reviews = "";
        foreach($results as $result)
        {
            $review_start = '<h5 class="w-75">'.$result["first_name"]." ".$result["last_name"].' wrote:</h5><p class="w-25 text-end">7 hours ago</p><p class="border border-dark review">'.$result["description"].'</p><form class="form row ms-5 ps-5 pe-5" action="/comments/add/'.$id.'/'.$result["id"].'" method="post">';
            $comments = $this->Comment->show_all_comments($result["id"], $id);
            $review_end = '<textarea class="form-control" name="description"></textarea><input class="btn btn-success ms-auto my-3 w-25" type="submit" value="Post"></form>';
            $reviews .= $review_start.$comments.$review_end;
        }
        $view_data = array(
            "product" => $this->Product->show_only_product($id),
            "reviews" => $reviews
        );
        $this->load->view("products/show", $view_data);
    }

    public function new_process()
    {
        if($this->session->userdata("user_level") === 1){redirect("/dashboard");}
        $this->Product->validate_new_product();
        $this->Product->process_new_product($this->input->post(NULL, TRUE));
        redirect("/products/new");
    }

    public function delete($id)
    {
        if($this->session->userdata("level") === 1){redirect("/dashboard");}
        $this->Product->delete_product($id);
        redirect("/dashboard");
    }
}
?>