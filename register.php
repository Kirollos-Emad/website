<?php 
    include("connection.php");
?>

<html>

<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Register</title>
    <link rel="stylesheet" href="reg-style.css">
</head>

<body>
    <!-- lon al background-->
    <div class="container">

        <div class="header">
            <h2 style="text-align: center;">Register</h2>
            <p> Please fill in this form to create an account</p>
            <hr>
        </div>

        <form class="form" action="register_handling.php" method="post" id="form">

            <div class="form-control" id="name_div">

                <label for="username"><b>First Name </b></label>
                <input type="text" placeholder="Enter your First name" name="fname" id="username" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">

                <label for="lname"><b>Last Name </b></label>
                <input type="text" placeholder="Enter your last name" name="lname" id="lname" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">

                <label for="pnum"><b>Phone Number </b></label>
                <input type="text" placeholder="Enter your phone number" name="pnum" id="pnum" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">

                <label for="Nnum"><b>National Number </b></label>
                <input type="text" placeholder="Enter your national number" name="Nnum" id="Nnum" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">

                <label for="email"><b>Email </b></label>
                <input type="email" placeholder="Enter your Email" name="mail" id="email" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter your password" name="password" id="password" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">
                <label for="password2"><b>Confirm Password</b></label>
                <input type="password" placeholder="Enter your Password" name="password" id="password2" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small></small>
            </div>

            <div class="form-control">
                <label for="n_id_image" class="form-label">National ID Image</label>
                <input class="form-control" type="file" id="n_id_image" name="n_id_image">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <div class="form-control">
                <label for="image" class="form-label">Your Image</label>
                <input class="form-control" type="file" id="image" name="image">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
            </div>

            <p>Gender:</p>

            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="female"> Female

            <br>
            <br>

            <div class="container">
                <input type="submit" value="Register" onclick="checkInputs()" onsubmit="checkInputs()"
                    class="btn btn-success" id="btn"></input>
            </div>
            <br>
            <!--3ayz a5ly al zorar bl 3ard-->

            <p style="text-align: center;">Already have an account? <a style="text-decoration: none;"
                    href="login.html">Sign in</a></p>

            <!-- 3ayz lon al zorar yb2a azr2-->
    </div>
    </form>
            <?php
                    $sql        = "select UserMail from tbl_user";
                    $result     = $con->query($sql);
                    $users_mail = $result->fetch_array();

                    // $email = ;

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
                        else{
                            echo "error";
                        }
                    }else{
                        die( print_r(mysql_error(), true));
                    }

                    if($check_mail === false )
		            {
                        
                    }
                    else{

                    }
            ?>
    <script src ="regjs.js"> </script>
</body>

</html>