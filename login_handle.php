<?php
include("connection.php");

if(isset($_POST['name']) ||isset($_POST['pass']) )
{
    $user_name = $_POST['name'];
    $password = $_POST['pass'];

    $sql = "select * from tbl_guest where UserMail = '$user_name' ";
			$result = $con->query($sql);
            $user_data = $result->fetch_array();
            if($result)
			{
				if($user_data)
				{
					do{
						if($user_data['UserPassword'] === $password)
						{
							//$_SESSION['user_id'] = $user_data['user_id'];
							header("Location: index.php");
							die;
						}
	
					} while( $row = sqlsrv_fetch_array( $result ) );
				
					echo "<h1>wrong password!</h1> <br>";
					//die(print_r( sqlsrv_errors(), true));
				
				}else
				{
					echo "<h1>wrong username and password!</h1> <br>";
				}
			}
}
?>