<?php include("../includes/connection.php"); ?>
<html>
    <head>
        <title>Receptionist Dashboard</title>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="styles/header-style.css">
        <link rel="stylesheet" href="styles/conf_rej_wait2.css">
    </head>

    <script>
            function check(pin)
            {
                if(pin.length == 0)
                {
                    location.reload();
                }
                else
                {
                    var parts = window.location.search.substr(1).split("&");
                    var $_GET = {};
                    for (var i = 0; i < parts.length; i++) {
                        var temp = parts[i].split("=");
                        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
                    }

                    jQuery.ajax({
                        url: "includes/func/chk_pin.php",
                        data: 'pin=' + pin + '&res_id=' + $_GET['ReservationId'], 
                        type: "POST",
                        success: function(data){
                            $("#resp").html(data);
                        }
                    });
                }
            }
    </script>

    <body>
        <!-- Header -->
        <?php include("includes/templates/header.html"); ?>

        <div class = "after-header" >
            <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center; ">
                You must enter the Manager PIN to cancel the reservation
            </h1>
            
            <br>

            <div style = "text-align: center;">
                <label>Enter the PIN</label>
                <input id = "pin" type = "password" onkeyup = "check(this.value)">
                <br>
                <div id = "resp"></div>
            </div>
            
        </div>
    </body>
</html>