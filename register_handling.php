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
		$n_id_image = $_POST['n_id_image'];
		$image = $_POST['image'];
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
			die( print_r(mysql_error(), true));
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
			
			
			$sql     = "select UserId,UserMail FROM tbl_guest WHERE UserMail = '$email'";
			$result  = $con->query($sql);
			$row     = $result->fetch_array();
			$uid     = $row['UserId'];
			$umail   = $row['UserMail'];
			$unimage = $umail . "_national";
			$uimage  = $umail . "_self";
			
			// move_uploaded_file($unimage,)
			$sql = "update tbl_guest set UserNationalIdImage = '$unimage', UserImage = '$uimage' WHERE UserId = '$uid' ";
			$con->query($sql);
		}
	}
?>