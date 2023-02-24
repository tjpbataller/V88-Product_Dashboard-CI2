<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Users extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User");
    }

    public function index()
    {
        redirect("login");
    }

    public function login()
    {
        $this->load->view("users/login");
    }

    public function register()
    {   
        $this->load->view("users/register");
    }

    public function login_process()
    {
        $this->User->validate_login($this->input->post(NULL, TRUE));
        $this->User->process_login($this->input->post(NULL, TRUE));
        redirect("/dashboard");
    }

    public function register_process()
    {
        $this->User->validate_register($this->input->post(NULL, TRUE));
        $this->User->process_register($this->input->post(NULL, TRUE));
        redirect("login");
    }

    public function edit()
    {
        $this->load->view("users/edit");
    }

    public function logoff()
    {
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_level");
        redirect("login");
    }

    public function change_password()
    {
        $this->User->validate_password($this->input->post(NULL, TRUE));
        $this->User->process_password_change($this->input->post(NULL, TRUE));
        redirect("users/edit");
    }

    public function edit_process()
    {
        $data = $this->User->validate_user_edit($this->input->post(NULL, TRUE));
        $this->User->process_user_edit($data);
        redirect("users/edit");
    }
}
?>