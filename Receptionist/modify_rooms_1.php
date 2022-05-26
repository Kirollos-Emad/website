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
<body>
    <!-- Header -->
    <?php include("header.html"); ?>

    <div class = "rooms_in_reservation">
        <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center;">
        Please click on the image or the name to modify rooms data 
        </h1>

        <?php

            $sql_get_res_id = "select ReservationId FROM tbl_reservation";
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
                                <img src = \"../img/Guest/Guest_Image/" . $row_user_data['UserMail'] .".jfif\">
                            </a>
                                <div class = \"name_mail\">
                                    <h1>Name: ". $row_user_data['UserFirstName'] . " " . $row_user_data['UserLastName'] . "</h1>
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

</body>
</html>

<?php
    // if(isset($_POST['mail']))
    // {
        // $mail = $_POST['mail'];

        // $sql_get_user_id = "select UserId FROM tbl_user WHERE UserMail = '$mail' ";
        // $result_user_id = $con->query($sql_get_user_id);

        // if($result_user_id->num_rows > 0)
        // {
        //     $user_id_arr = $result_user_id->fetch_array();
        //     $user_id = $user_id_arr['UserId'];

        //     $sql_get_res_id = "select ReservationId FROM tbl_reservation WHERE UserId = $user_id";
        //     $result_res_id = $con->query($sql_get_res_id);

        //     if($result_res_id->num_rows > 0)
        //     {
        //         $res_id_arr = $result_res_id->fetch_array();
        //         $res_id = $res_id_arr['ReservationId'];

        //         $sql_get_rooms = "select RoomId FROM tbl_reservation_details_current WHERE ReservationId = $res_id";
        //         $result_rooms_id = $con->query($sql_get_rooms);

        //         $counter = 1;

        //         echo "<table> <tr> <th></th> <th>Old Room Number</th> <th>New Room Number</th> <th>New Room Type</th> <th>New Room Fees</th></tr>";

        //         while($rooms_arr = $result_rooms_id->fetch_array())
        //         {
        //             $room_id = $rooms_arr['RoomId'];
                    
        //             $sql_get_room_spec = "select RoomNo, RoomTypeId FROM tbl_room WHERE RoomId = $room_id";
        //             $result_room_spec = $con->query($sql_get_room_spec);
        //             $room_spec_arr = $result_room_spec->fetch_array();
        //             $old_room_no = $room_spec_arr['RoomNo'];
        //             $old_room_type_id = $room_spec_arr['RoomTypeId'];

        //             $sql_get_room_type = "";
        //         }
        //         echo "</table>";
        //     }
        //     else
        //     {
        //         echo "<h1>No Reservation Found</h1>";
        //     }
        // }
        // else
        // {
        //     echo "<h1>User Not Found</h1>";
        // }
    // }
?>