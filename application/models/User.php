<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{
    public function validate_register($data)
    {
        $this->form_validation->set_rules("email_address", "Email Address", 'required|valid_email|is_unique[users.email_address]');
        $this->form_validation->set_rules("first_name", "First Name", 'required|alpha');
        $this->form_validation->set_rules("last_name", "Last Name", 'required|alpha');
        $this->form_validation->set_rules("password", "Password", 'required|alpha_numeric');
        $this->form_validation->set_rules("password_confirm", "Confirm Password", 'required|alpha_numeric|matches[password]');
        if($this->form_validation->run() !== TRUE)
        {
            $this->session->set_flashdata("message", validation_errors());
            $this->session->set_flashdata("message_color", "danger");
            redirect("register");
            die();
        }
    }

    public function process_register($data)
    {
        ($this->db->count_all("users") > 0)?$level = 1:$level = 9;

        $password = md5($data["password"]);
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $encrypted_password = $password.$salt;
        $query = "INSERT INTO users (first_name, last_name, password, salt, email_address, level, created_at, updated_at) VALUES(?,?,?,?,?,?,NOW(),NOW());";
        $values = array(
            "first_name" => $data["first_name"],
            "last_name" => $data["last_name"],
            "password" => $encrypted_password,
            "salt" => $salt,
            "email_address" => $data["email_address"],
            "level" => $level
        );
        $this->db->query($query, $values);
        $this->session->set_flashdata("message", "<p>Registered successfully! You can now login.</p>");
        $this->session->set_flashdata("message_color", "success");

    }

    public function validate_login($data)
    {
        $this->form_validation->set_rules("email_address", "Email Address", "required|valid_email");
        $this->form_validation->set_rules("password", "Password", "required|alpha_numeric");
        if($this->form_validation->run() !== TRUE)
        {
            $this->session->set_flashdata("message", validation_errors());
            $this->session->set_flashdata("message_color", "danger");
            redirect("login");
            die();
        }
    }

    public function process_login($data)
    {
        /* check if email address exists, get salt */
        $values = array("email_address" => $data["email_address"]);
        $query = "SELECT salt FROM users WHERE email_address = ?";
        $salt = $this->db->query($query, $values)->row_array();
        $password = md5($data["password"]);
        $encrypted_password = $password.$salt["salt"];
        /* check if query has result, redirect to login if none*/ 
        if(count($salt) > 0)
        {
            /* check if email address and password with salt exists */
            $values = array(
                "email_address" => $data["email_address"],
                "password" => $encrypted_password
            );
            $query = "SELECT * FROM users WHERE email_address = ? AND password = ?";
            if($result = $this->db->query($query, $values)->row_array())
            {
                $this->session->set_userdata("user_id", $result["id"]);
                $this->session->set_userdata("user_level", $result["level"]);
            }
            else
            {
                $this->session->set_flashdata("message", "Invalid username and password.");
                $this->session->set_flashdata("message_color", "danger");
                redirect("login");
                die();
            }
        }
        else
        {
            $this->session->set_flashdata("message", "Invalid username and password.");
            $this->session->set_flashdata("message_color", "danger");
            redirect("login");
            die();
        }
    }

    public function validate_password($data)
    {
        $this->form_validation->set_rules("old_password", "Old Password", "required|alpha_numeric|min_length[8]");
        $this->form_validation->set_rules("new_password", "New Password", "required|alpha_numeric|min_length[8]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|alpha_numeric|matches[new_password]");
        if($this->form_validation->run() !== TRUE)
        {
            $this->session->set_flashdata("message", validation_errors());
            $this->session->set_flashdata("message_color", "danger");
            redirect("users/edit");
            die();
        }
    }

    public function process_password_change($data)
    {
        /* Get salt of user */
        $query = "SELECT salt FROM users WHERE id = ?";
        $user_id = $this->session->userdata("user_id");
        $salt = $this->db->query($query, array("user_id" => $user_id))->row_array();
        $old_password = md5($data["old_password"]);
        $encrypted_old_password = $old_password.$salt["salt"];

        /* Check if old password field matches with current password */
        $query = "SELECT id FROM users WHERE password = ? AND id = ?";
        $values = array(
            "password" => $encrypted_old_password,
            "id" => $user_id
        );
        if(!$this->db->query($query, $values)->row_array())
        {
            $this->session->set_flashdata("message", "Old password is incorrect.");
            $this->session->set_flashdata("message_color", "danger");
            redirect("users/edit");
            die();
        }

        /* Set old password to new password*/
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        $new_password = md5($data["new_password"]);
        $encrypted_new_password = $new_password.$salt;
        $query = "UPDATE users SET password=?, salt=? WHERE password=? AND id=?";
        $values = array(
            "password" => $encrypted_new_password,
            "salt" => $salt,
            "old_password" => $encrypted_old_password,
            "id" => $this->session->userdata("user_id")
        );
        $result = $this->db->query($query, $values);
        if($result === TRUE)
        {
            $this->session->set_flashdata("message", "Password has been updated!");
            $this->session->set_flashdata("message_color", "success");
        }
    }

    public function validate_user_edit($data)
    {
        $accepted_keys = array("email_address","first_name","last_name");
        $new_array = array();
        foreach($data as $key=>$value)
        {
            if(in_array($key, $accepted_keys))
            {
                if($value !== "")
                {   
                    $new_array[$key] = $value;
                }
            }
        }
        if(!empty($new_array))
        {
            /* Check an input has a value then validate */
            if(isset($new_array["email_address"]))
            {
                $this->form_validation->set_rules("email_address", "Email Address", "required|valid_email");
            }
            if(isset($new_array["first_name"]))
            {
                $this->form_validation->set_rules("first_name", "First Name", "required|alpha");
            }
            if(isset($new_arra["last_name"]))
            {
                $this->form_validation->set_rules("last_name", "Last Name", "required|alpha");
            }
            if($this->form_validation->run() !== TRUE)
            {
                $this->session->set_flashdata("message", validation_errors());
                $this->session->set_flashdata("message_color", "danger");
                redirect("/users/edit");
                die();
            }

            return $new_array;
        }
        else
        {
            $this->session->set_flashdata("message", "Edit information form must have atleast one input field with a value");   
            $this->session->set_flashdata("message_color", "danger");
            redirect("/users/edit");
            die();
        }
    }

    public function process_user_edit($data)
    {
        $query = "UPDATE users SET ";
        if(count($data) > 1)
        {
            /* used counter because the array is associative */
            $counter = 0;
            foreach($data as $key=>$value)
            {
                if($counter == count($data) - 1)
                {
                    $end = "$key=? ";
                }
                else
                {
                    $end = "$key=?, ";
                }
                $query .= "".$end;
            
                $counter++;
            }
        }
        else
        {
            $key = array_keys($data)[0];
            $query .= "$key = ? ";
        }
        $query = $query."WHERE id = ?";
        $data["user_id"] = $this->session->userdata("user_id");
        if($this->db->query($query, $data))
        {
            $this->session->set_flashdata("message", "User information has been updated!");
            $this->session->set_flashdata("message_color", "success");
        }
    }
}

?>