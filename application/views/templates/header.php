<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('assets/css/admin/book_list.css')?>">
     <!-- BOOTSTRAP  -->
     <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
     <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css"> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?=base_url('assets/css/admin/modal.css')?>">
    <link type="text/css" href="<?=base_url('assets/icons/css/font-awesome.css')?>" rel="stylesheet">
	<script src="https://kit.fontawesome.com/fb998ac4aa.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
    <div class="scontainer">
        <div class="nav-bar">
            <div class="name">
                <h1>PHINMA - SJCLS</h1>
            </div>
            <!-- <div class="name">
                <a href="<?=base_url('admins')?>"><?= ucwords(strtolower($this->session->userdata('name'))); ?></a>
            </div> -->
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= ucwords(strtolower($this->session->userdata('name'))); ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="<?=base_url('profile')?>">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?=base_url('users/logout')?>">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="side-bar">
            <div class="logo">  
                <img src="<?=base_url('assets/img/logo.png')?>" alt="saint-jude-logo">
            </div>
            <div class="dashboard">
                <ul id="menu">
                    <li><a href="<?=base_url('admins')?>"><i class="menu-icon icon-home"></i> Home</a></li>
                    <li><a href="<?=base_url('admins/messenger')?>"><i class="menu-icon icon-user"></i> Send a message</a></li>
                    <li><a href="<?=base_url('admins/student_list')?>"><i class="menu-icon icon-user"></i> Student List</a></li>
                    <li><a href="<?=base_url('book_list')?>"><i class="menu-icon icon-book"></i> Book List</a></li>
                    <li><a href="<?=base_url('admins/add_book')?>"><i class="menu-icon icon-edit"></i> Add Books</a></li>
                    <li><a href="<?=base_url('admins/issue_request')?>"><i class="menu-icon icon-tasks"></i> Issue Requests</a></li>
                    <li><a href="<?=base_url('admins/renew_request')?>"><i class="menu-icon icon-tasks"></i> Renew Requests</a></li>
                    <li><a href="<?=base_url('admins/return_request')?>"><i class="menu-icon icon-tasks"></i> Return Requests</a></li>
                    <li><a href="<?=base_url('admins/currently_issued_books')?>"><i class="menu-icon icon-list"></i> Curently Issued Books</a></li>
                </ul>
            </div>
        </div>
        