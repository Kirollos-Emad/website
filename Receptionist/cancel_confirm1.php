<?php include("../includes/connection.php"); ?>

<html>
<head>
    <title>modify rooms</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/header-style.css">
    <link rel="stylesheet" href="styles/modify1-style.css">
</head>

<script>
    function showSearch(val)
    {
       if(val.length == 0)
       {
           location.reload();
       }
       else
        {
        jQuery.ajax({
                    url: "includes/func/get_search_con_res.php",
                    data: 'val=' + val,
                    type: "POST",
                    success: function(data){
                        $("#cards").html(data);
                    }
                });
        }}
</script>

<body>
    <!-- Header -->
    <?php include("includes/templates/header.html"); ?>

    <div class = "rooms_in_reservation">
        <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center;">
        Please click on the image or the name to cancel the reservation 
        </h1>

        <br>

        <div style = "text-align: center;">
            <label for = "search">Search by email</label>
            <input type = "text" onkeyup="showSearch(this.value)" id = "search">
        </div>

        <div class = "cards" id = "cards">


        <?php
            $sql_get_res_id = "select ReservationId FROM tbl_reservation where ReservationConfirmation = 'Confirmed'";
            $result_res_id = $con->query($sql_get_res_id);

            if($result_res_id->num_rows > 0)
            {
                while($row_res_id = $result_res_id->fetch_array())
                {
                    $sql_get_user_id = "select UserId FROM tbl_reservation WHERE ReservationId = " . $row_res_id['ReservationId'];
                    $result_user_id = $con->query($sql_get_user_id);
                    $row_user_id = $result_user_id->fetch_array();

                    $sql_get_user_data = "select UserFirstName, UserLastName, UserImage, UserMail FROM tbl_user WHERE UserId = " . $row_user_id['UserId'];
                    $result_user_data = $con->query($sql_get_user_data);
                    $row_user_data = $result_user_data->fetch_array();

                    echo "<div class = \"card\">
                            <div class = \"img_name_mail\">
                            <a href = \"modify_rooms_2.php?ReservationId=". $row_res_id['ReservationId'] ."\">
                                <img src = \"../img/Guest/Guest_Image/" . $row_user_data['UserMail'] .".jpg\">
                            </a>
                                <div class = \"name_mail\">
                                    <a href = \"cancel_confirm2.php?ReservationId=". $row_res_id['ReservationId'] ."\">
                                    <h1>Name: ". $row_user_data['UserFirstName'] . " " . $row_user_data['UserLastName'] . "</h1>
                                    </a>   
                                    <h1>Mail: " . $row_user_data['UserMail'] . "</h1>
                                </div>
                            </div>
                        </div>";
                }
            }
            else
            {
                echo "<h1 style = \"text-align: center; padding-top: 100px;\">No Data Available</h1>";
            }
        ?>

        </div>
    </div>

</body>
</html>