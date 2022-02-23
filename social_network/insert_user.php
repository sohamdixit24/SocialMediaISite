<?php
include("includes/connection.php");

	if(isset($_POST['sign_up'])){

		$first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		$username= htmlentities(mysqli_real_escape_string($con,$_POST['username']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
		$status = "verified";
		$posts = "no";

		$check_username_query = "select username from users where user_email='$email'";
		$run_username = mysqli_query($con,$check_username_query);

		if(strlen($pass) <8 ){
			echo"<script>alert('Password should be minimum 8 characters!')</script>";
			exit();
		}

		$check_email = "select * from users where user_email='$email'";
		$run_email = mysqli_query($con,$check_email);

		$check = mysqli_num_rows($run_email);

		if($check == 1){
			echo "<script>alert('Email already exist, Please try using another email')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}


		if($gender=="male"){
            $profile_pic="users/male.jfif";
        }
        else if($gender=="female"){
            $profile_pic="users/female.jfif";
        }else{
            $profile_pic="users/other.jfif";
        }

		$insert = "insert into users (first_name,last_name,user_email,user_name,user_password,user_gender,user_image,user_cover,usr_reg_date,posts,recovery_account,status,birth_date)
		values('$first_name','$last_name','$email','$username','$pass','$gender','$profile_pic','cover/default_cover.jpg',NOW(),'$posts','No','$status','$birthday'); ";
		
		$query = mysqli_query($con,$insert);

		if($query){
			echo "<script>alert('Well Done $first_name, you are good to go.')</script>";
			echo "<script>window.open('signin.php', '_self')</script>";
		}
		else{
			echo "<script>alert('Registration failed, please try again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
	}
?>