<?php
	include("connection.php");
	if(isset($_POST['fname']))
	{
		$fn     = $_POST['fname'];
		$ls     = $_POST['lname'];
		$p_num  = $_POST['pnum'];
		$n_num  = $_POST['Nnum'];
		$email  = $_POST['mail'];
		$psw    = $_POST['password'];
		$gender = $_POST['gender'];


		$sql        = "select UserMail from tbl_guest";
		$result     = $con->query($sql);
		$users_mail = $result->fetch_array();

		$check_mail = true;

    	if($result)
		{
			if($users_mail)
			{
				do{
					if($users_mail['UserMail'] === $email)
					{
						$check_mail = false;
					}
				} while( $row = $result->fetch_array());
			}
			else
			{
				echo "error";
			}
		}else{
			die( print_r(mysql_error()(), true));
		}

		if($check_mail===false )
		{
			echo"double mail";
		}
		else
		{
			echo"mesh double mail";
			//images not inserted
			$sql = "insert into tbl_guest(UserFirstName, UserLastName, UserGender, UserPhoneNumber,
			 UserNationalIdNumber, UserMail, UserPassword) VALUES 
			 ('$fn','$ls','$gender','$p_num','$n_num','$email','$psw')";
			$con->query($sql);
		}
	}
?>