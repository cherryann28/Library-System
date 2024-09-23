<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=base_url('assets/css/admin/index.css')?>">
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
                <a href="<?=base_url('users/logout')?>"><i class="menu-icon icon-signout"></i> LOGOUT</a>
            </div>
        </div>
        <h4>Hey there, Welcome back <?= ucwords(strtolower($this->session->userdata('name'))); ?>!</h4>  
        <div class="icon_container">
            <div class="icons">
                <div class="icon messages">
                    <a href="<?=base_url('admins/messenger')?>"><i class="menu-icon icon-inbox"></i></a>
                    <h5>Messages</h5>
                </div>
                <div class="icon student_list">
                    <a href="<?=base_url('admins/student_list')?>"><i class="menu-icon icon-user"></i></a>
                    <h5>Student list</h5>
                </div>
                <div class="icon book_lists">
                    <a href="<?=base_url('book_list')?>"><i class="menu-icon icon-book"></i></a>
                <h5>Book list</h5>
                </div>
                <div class="icon add_books">
                    <a href="<?=base_url('admins/add_book')?>"><i class="menu-icon icon-edit"></i></a>
                    <h5>Add Books</h5>
                </div>
            </div>
            <div class="icons">
                <div class="icon issue_request">
                    <a href="<?=base_url('admins/issue_request')?>"><i class="menu-icon icon-tasks"></i></a>
                <h5>Issue Requests</h5>
                </div>
                <div class="icon renew">
                    <a href="<?=base_url('admins/renew_request')?>"><i id="icon-renew" class="menu-icon icon-tasks"></i></a>
                    <h5>Renew Requests</h5>
                </div>
                <div class="icon return">
                    <a href="<?=base_url('admins/return_request')?>"><i id="icon-request" class="menu-icon icon-tasks"></i></a>
                    <h5>Return Requests</h5>
                </div>
                <div class="icon current">
                    <a href="<?=base_url('admins/currently_issued_books')?>"><i id="icon-list" class="menu-icon icon-list"></i></a>
                    <h5>Currently Issued Books</h5>
                </div>
            </div>
        </div>
        <footer>
            <p> &#169; 2023 copyright all right reserved</p>
        </footer>
	</div>
</body>
</html>