<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model
{
    public function show_products()
    {
        $query = "SELECT * FROM products";
        return $this->db->query($query)->result_array();
    }

    public function show_only_product($id)
    {
        $query = "SELECT * FROM products WHERE id = ?";
        return $this->db->query($query, array("id"=>$id))->row_array();
    }

    public function validate_new_product()
    {
        $this->form_validation->set_rules("name", "Product Name", "required|alpha_numeric_spaces|min_length[4]");
        $this->form_validation->set_rules("description", "Product Description", "required|alpha_numeric_spaces|min_length[10]");
        $this->form_validation->set_rules("price", "Product Price", "required|numeric");
        $this->form_validation->set_rules("quantity", "Product Quantity", "required|numeric");
        if($this->form_validation->run() !== TRUE)
        {
            $this->session->set_flashdata("message", validation_errors());
            $this->session->set_flashdata("message_color", "danger");
            redirect("/products/new");
            die();
        }
    }

    public function process_new_product($data)
    {
        $query = "INSERT INTO product_dashboard.products(user_id, name, description, price, quantity, sold, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, NOW(), NOW());";
        $values = array(
            "user_id" => $this->session->userdata("user_id"),
            "name" => $data["name"],
            "description" => $data["description"],
            "price" => $data["price"],
            "quantity" => $data["quantity"],
            "sold" => 0
        );
        $result = $this->db->insert_id($this->db->query($query, $values));
        if($result == TRUE)
        {
            $this->session->set_flashdata("message", "Product successfully added!");
            $this->session->set_flashdata("message_color","success");
        }
    }

    public function delete_product($id)
    {
        $query = "DELETE FROM products WHERE id = ?";
        $this->db->query($query, array("id" => $id));
    }

    public function validate_update_product($id)
    {
        $this->form_validation->set_rules("name", "Product Name", "alpha_numeric_spaces|min_length[4]");
        $this->form_validation->set_rules("description", "Product Description", "alpha_numeric_spaces|min_length[10]");
        $this->form_validation->set_rules("price", "Product Price", "numeric");
        $this->form_validation->set_rules("quantity", "Product Quantity", "numeric");
        if($this->form_validation->run() !== TRUE)
        {
            $this->session->set_flashdata("message", validation_errors());
            $this->session->set_flashdata("message_color", "danger");
            redirect("/products/edit/$id");
            die();
        }
    }
    
    public function update_product($data)
    {
        $values = array();
        $counter = 0;
        $query = "UPDATE products SET ";
        foreach($data as $key=>$value)
        {
            if($value !== "" && ($value !== "" && $key !== "id"))
            {
                $values[$key] = $value;
            }
        }
        if(count($values) < 1)
        {
            redirect("/products/edit/{$data["id"]}");
        }
        foreach($values as $key=>$value)
        {
            if($counter === count($values) - 1)
            {   
                $query .= "$key = ? ";
            }
            else
            {
                $query .= "$key = ?, ";

            }
            $counter++;
        }
        $query .= "WHERE id = ?;";
        $values["id"] = $data["id"];
        $result = $this->db->query($query, $values);
        if($result === TRUE)
        {
            $this->session->set_flashdata("message", "Product has been updated successfully!");
            $this->session->set_flashdata("message_color", "success");
        }
    }
}
?>