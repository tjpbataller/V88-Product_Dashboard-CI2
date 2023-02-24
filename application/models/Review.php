<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Model
{
    public function show_all_reviews($id)
    {
        $query = "SELECT reviews.id ,first_name, last_name, reviews.description, reviews.created_at FROM reviews INNER JOIN users ON reviews.user_id = users.id WHERE product_id = ?;";
        return $this->db->query($query, array("id" => $id))->result_array();

    }

    public function create_review($id, $description)
    {
        $user_id = $this->session->userdata("user_id");
        $query = "INSERT INTO reviews(user_id, product_id, description, created_at, updated_at) VALUES(?,?,?,NOW(),NOW());";
        $values = array(
            "user_id" => $user_id,
            "product_id" => $id,
            "description" => $description
        );
        return $this->db->query($query, $values);
    }
}
?>