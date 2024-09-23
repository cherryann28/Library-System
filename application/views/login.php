<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=base_url('assets/css/login.css')?>">
    <!-- <link type="text/css" href="<?= base_url('assets/icons/font-awesome.css'); ?>" rel="stylesheet"> -->
    <script src="https://kit.fontawesome.com/fb998ac4aa.js" crossorigin="anonymous"></script>
	<title>Login Page</title>
</head>
<body>
	<div class="container">
		<div id="home">
			<nav class="links">
				<ul>
					<li><a href="<?=base_url('users')?>">Home</a> | <a href="#about">About</a></li>
				</ul>
			</nav>
			<nav class="form">
				<ul>
                    <li><a href="<?=base_url('login')?>">Login</a><a href="<?=base_url('create_account')?>">Create Account</a></li>
				</ul>
			</nav>
			<div class="logo">
				<img src="assets/img/logo.png" alt="saint-jude-logo">
				<h1>PHINMA SJCLS</h1>
				<h2>Making Lives Better Through Education</h2>
			</div>
			<div class="login-form">
<?php
    $this->load->view('partials/flash_messages');
?>
                <h2>Login</h2>
                <form action="users/login_process" method="post">
                    <div class="input-div">
                        <div>
                            <h5>Email</h5>
            	            <p><?= $this->session->flashdata('invalid')?></p>
                            <p><?=$this->session->flashdata('email') ?></p>
                            <input class="input" type="text" name="email">
                        </div>
                    </div>
                    <div class="input-div">
                        <div>
                            <h5>Password</h5>
                            <p><?=$this->session->flashdata('password') ?></p>
                            <input class="input" type="password" name="password">
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Login">
                </form>
            </div>
			<div class="mini-analytics">
				<div class="books">
					<h3><?= $books_total['availability'] ?></h3>               
					<p><i class="fas fa-book-open"></i> Books</p>
				</div>
				<div class="borrowed">
					<h3><?= $borrowed['id'] ?></h3>
					<p><i class="fa-solid fa-arrow-up"></i> Borrowed</p>
				</div>
				<div class="returned">
					<h3><?= $returned['id'] ?></h3>
					<p><i class="fa-solid fa-arrow-down"></i> Returned</p>
				</div>
			</div>	
		</div>
		<div id="about">
			<div class="title">
				<h2>ABOUT US</h2>
				<p>
					<!-- Saint Jude College Delivers quality programs for the global Filipino toward
					optimized productivity through instruction, research and extension services founded
					on  Christian values and pride in one's race. -->
					At Saint Jude College, we strive to make a meaningful impact through quality education, aligning with the standards of the Philippines' leading universities. Our goal is to provide students in the National Capital Region (NCR) with the resources they need to build successful careers.
				</p><br><br>
				<p>
				Our Web-Based Library System is a key part of this effort. Designed to complement our educational mission, it offers a simple and efficient way for students and faculty to manage their library needs. While you can browse and borrow books online, we encourage you to visit our library to pick up your selected materials.
				</p>

				
			</div>
			<!-- <div class="front">
				<img src="assets/img/about-background.jpg" alt="background-image">
			</div> -->
			<!-- <div class="back"></div> -->
		</div>
		<footer>
			<p>&#169; 2023 copyright all right reserved</p>
		</footer>
	</div>
</body>
</html>