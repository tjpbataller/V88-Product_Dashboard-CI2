<?php
    if(uri_string() == "login" || uri_string() == "register")
    {
        if($this->session->userdata("user_id") && $this->session->userdata("user_level"))
        {
            redirect("dashboard");
            die();
        }
    }
    else
    {
        if(!$this->session->userdata("user_id") && !$this->session->userdata("user_level"))
        {
            redirect("login");
            die();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/action.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
	<title>Document</title>
</head>
<body>
    <header class="px-5 py-3 mb-5 d-flex">
        <a class="ms-5" href="/">Village88 Merchandise</a>
<?php
        if(uri_string() == "login")
        {
?>
        <a class="ms-auto me-5" href="register">Register</a>
<?php
        }
        else if(uri_string() == "register")
		{
?>
        <a class="ms-auto me-5" href="login">Login</a>
<?php
        }
		else
		{
?>
		<a class="mx-2" href="/dashboard">Dashboard</a>
		<a class="mx-2" href="/users/edit">Profile</a>
		<a class="ms-auto" href="/logoff">Logoff</a>
<?php	}
?>
    </header>
<?php   if($this->session->flashdata("message"))
        {
		$message = $this->session->flashdata("message");
?>
    <div class="mx-auto w-75 text-<?= $this->session->flashdata("message_color") ?> text-center">
		<?= $message ?>
	</div>
<?php   }
?>