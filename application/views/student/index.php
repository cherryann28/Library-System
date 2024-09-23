<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=base_url('assets/css/student/index.css')?>">
    <link type="text/css" href="<?=base_url('assets/icons/css/font-awesome.css')?>" rel="stylesheet">
	<script src="https://kit.fontawesome.com/fb998ac4aa.js" crossorigin="anonymous"></script>
	<title>Home Page</title>
</head>
<body>
	<div class="container">
        <div class="nav-bar">
            <div class="logo">
                <img src="<?=base_url('assets/img/logo.png')?>" alt="saint-jude-logo">
                <h1>PHINMA SJCLS</h1>
            </div>
            <div class="logout">
                <a href="<?=base_url('users/logout')?>"><i id="signout" class="menu-icon icon-signout"></i> LOGOUT</a>
            </div>
        </div>
        <h4>Hey there, welcome back <?= ucwords(strtolower($this->session->userdata('name'))); ?>!</h4>  
        <div class="icon_container">
            <div class="icons">
                <div class="icon messages">
                    <a href="<?=base_url('students/messages')?>"><i class="menu-icon icon-inbox"></i></a>
                    <h5>Messages</h5>
                </div>
                <div class="icon books">
                    <a href="<?=base_url('students/books')?>"><i class="menu-icon icon-book"></i></a>
                    <h5>Books</h5>
                </div>
                <div class="icon borrowed">
                    <a href="<?=base_url('students/borrowed_books')?>"><i class="menu-icon icon-tasks"></i></a>
                    <h5>Borrowed Books</h5>
                </div>
                <div class="icon previously">
                    <a href="<?=base_url('students/previously_borrowed_books')?>"><i id="icon-list" class="menu-icon icon-list"></i></a>
                    <h5>Previously Borrowed Books</h5>
                </div>
            </div>
        </div>
        <footer>
            <p> &#169; 2022 copyright all right reserved</p>
        </footer>
	</div>
</body>
</html>