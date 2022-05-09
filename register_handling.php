<?php
include("connection.php");

$fn = $_POST['fname'];
$ls =$_POST['lname'];
$p_num=$_POST['pnum'];
$n_num=$_POST['Nnum'];
$email=$_POST['mail'];
$psw=$_POST['password'];
$gender=$_POST['gender'];
$sql = "SELECT UserMail FROM tbl_guest";
$result = $con->query($sql);
$users_mail = $result->fetch_array();
$check_mail=true;
     if($result)
{
	if($users_mail)
	{
	do{
	if($users_mail['UserMail'] === $email)
	{
		$check_mail=false;
	}
	
	} while( $row = sqlsrv_fetch_array( $result ) );
	}else
	{
		echo "error";
	}
	}
if($check_mail===false )
{
	
	echo"double mail";
}
else
{
	echo"kiro sndal";
	
}

?>