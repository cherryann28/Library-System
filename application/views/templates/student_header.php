<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('assets/css/student/books.css')?>">
    <!-- BOOTSTRAP  -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/css/student/modal.css')?>">
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
                <a href="<?=base_url('students')?>"><?= ucwords(strtolower($this->session->userdata('name'))); ?></a>
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
                    <li><a href="<?=base_url('students')?>"><i class="menu-icon icon-home"></i> Home</a></li>
                    <li><a href="<?=base_url('students/messages')?>"><i class="menu-icon icon-user"></i> Messages</a></li>
                    <li><a href="<?=base_url('students/books')?>"><i class="menu-icon icon-book"></i> Books</a></li>
                    <li><a href="<?=base_url('students/borrowed_books')?>"><i class="menu-icon icon-tasks"></i> Borrowed Books</a></li>
                    <li><a href="<?=base_url('students/previously_borrowed_books')?>"><i class="menu-icon icon-tasks"></i> Previously Borrowed Books</a></li>
                </ul>
            </div>
        </div>