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
            function getRooms(counter)
            {
                var type = document.getElementById("types_"+counter).value;
                
                jQuery.ajax({
                    url: "includes/func/get_ava_rooms.php",
                    data: 'type=' + type +'&count=' + counter,
                    type: "POST",
                    success: function(data){
                        $("#new_rooms_"+counter).html(data);
                    }
                });
            }

            function delRoom(counter)
            {
                let text = "By clicking ok the rooms you choose will be delete from this reservation";
                
                if (confirm(text) == true) 
                {
                    var num = document.getElementById("old_room_num_"+counter).textContent;
                    
                    jQuery.ajax({
                        url: "includes/func/del_room_cur_res.php",
                        data: 'num=' + num,
                        type: "POST",
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            }

            function chanRooms(counter)
            {
                var text = "By clicking ok the room will be change";
                if (confirm(text) == true) 
                {
                    var old_room_num = document.getElementById("old_room_num_"+counter).textContent;
                    var new_room_id = document.getElementById("new_room_"+counter).value;
                    // var ReservationId = $_GET['ReservationId'];

                    var parts = window.location.search.substr(1).split("&");
                    var $_GET = {};
                    for (var i = 0; i < parts.length; i++) {
                        var temp = parts[i].split("=");
                        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
                    }
                    // alert($_GET['ReservationId'] + " " + new_room_id);
                    
                    jQuery.ajax( {
                        url: "includes/func/chan_rooms.php",
                        data:  'old_room_num=' + old_room_num + '&new_room_id=' + new_room_id + "&res_id=" + $_GET['ReservationId'],
                        type: "POST",
                        success: function(data){
                            location.reload();
                        }
                    } );
                }
            }

            function getNewRoom()
            {
                var type = document.getElementById("add_new_room_select").value;
                
                jQuery.ajax({
                    url: "includes/func/get_new_rooms.php",
                    data: 'type=' + type,
                    type: "POST",
                    success: function(data){
                        $("#add_new_room_options").html(data);
                    }
                });
            }

            function add_new_room()
            {
                var text = "By clicking ok the room will be added";
                if (confirm(text) == true) 
                {
                    var new_room_id = document.getElementById("add_new_rooms_select").value;

                    var parts = window.location.search.substr(1).split("&");
                    var $_GET = {};
                    for (var i = 0; i < parts.length; i++) {
                        var temp = parts[i].split("=");
                        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
                    }
                    
                    jQuery.ajax( {
                        url: "includes/func/add_new_room.php",
                        data: '&new_room_id=' + new_room_id + "&res_id=" + $_GET['ReservationId'],
                        type: "POST",
                        success: function(data){
                            location.reload();
                        }
                    } );
                }
            }

            function conf(res_id)
            {
                var text = "By clicking ok the reservation will be confirmed\nNote: make sure add the rooms the user reserve it";
                if (confirm(text) == true)
                {
                    jQuery.ajax({
                            url: "includes/func/confirm_res.php",
                            data: 'res_id=' + res_id,
                            type: "POST",
                            success: function(data){
                                document.location.href = "conf_rej_wait_res1.php";
                            }
                        });
                }
            }

            function rej(res_id)
            {
                var text = "By clicking ok the reservation will be canceled\nNote: make sure you need to cancel the reservation";
                if (confirm(text) == true)
                {
                    jQuery.ajax({
                            url: "includes/func/rej_res.php",
                            data: 'res_id=' + res_id,
                            type: "POST",
                            success: function(data){
                                document.location.href = "conf_rej_wait_res1.php";
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
                The rooms user have
            </h1>

            <div class = "rooms">
            <?php
                    $sql_get_rooms = "select RoomId FROM tbl_reservation_current WHERE ReservationId = " . $_GET['ReservationId'];
                    $result_get_rooms = $con->query($sql_get_rooms);
                    
                    if($result_get_rooms->num_rows > 0)
                    {
                        echo "<table>
                        <tr> <th>Room Type</th> <th>Room Number</th> <th>New Room Type</th> <th>New Room Number</th> <th>Delete Room </th> <th>Save Data</th></tr>";
                        $counter = 0;
                        while($row_room_id = $result_get_rooms->fetch_array())
                        {
                            $sql_get_room_data = "select RoomNo, RoomTypeId FROM tbl_room WHERE RoomId = " . $row_room_id['RoomId'];
                            $result_room_data = $con->query($sql_get_room_data);
                            $row_room_data = $result_room_data->fetch_array();

                            $sql_get_room_type = "select RoomType FROM tbl_room_details WHERE RoomTypeId = " . $row_room_data['RoomTypeId'];
                            $result_room_type = $con->query($sql_get_room_type);
                            $row_room_type = $result_room_type->fetch_array();

                            $sql_get_room_types = "select RoomType FROM tbl_room_details";
                            $result_room_types = $con->query($sql_get_room_types);

                            echo "<tr>
                            <td>" . $row_room_type['RoomType'] . "</td>
                            <td id = \"old_room_num_".$counter."\">" . $row_room_data['RoomNo'] . "</td>
                            <td> <select id = \"types_".$counter."\" onchange = \"getRooms(".$counter.")\"> ";
                            while($row_room_types = $result_room_types->fetch_array())
                            {
                                echo "<option value = \"". $row_room_types['RoomType'] . "\" > ";
                                echo $row_room_types['RoomType'];
                                echo " </option> ";
                            }
                            echo "</select></td>";
                            
                            echo "<td id = \"new_rooms_".$counter."\"></td>
                            <td> <input type = \"button\" value = \"Delete\" onclick = \"delRoom(".$counter.")\"></td>
                            <td> <input type = \"button\" value = \"Change\" onclick = \"chanRooms(".$counter.")\"></td>
                            </tr>";
                            $counter++;
                        }
                        echo "</table>";
                    }
                    else
                    {
                        echo "<h1 style = \"text-align: center; padding-top: 100px;\">No Data Available</h1>";
                    }
                ?>
            </div>
            
            <br>

            <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center; ">
                The rooms user reserve
            </h1>

            <div class = "rooms">
                <?php

                    $sql_get_rooms_id_user_reserve = "select RoomTypeId, NumberOfRooms FROM tbl_reservation_comming WHERE ReservationId = ". $_GET['ReservationId'];
                    $result_get_rooms_id_user_reserve = $con->query($sql_get_rooms_id_user_reserve);

                    if($result_get_rooms_id_user_reserve->num_rows > 0)
                    {
                        echo "<table>
                        <tr> <th>Room Type</th> <th>Number of Rooms</th></tr>";
                        while($row_rooms_id_user_reserve = $result_get_rooms_id_user_reserve->fetch_array())
                        {
                            $sql_get_room_type = "select RoomType FROM tbl_room_details WHERE RoomTypeId = " . $row_rooms_id_user_reserve['RoomTypeId'];
                            $result_get_room_type = $con->query($sql_get_room_type);
                            $row_room_type = $result_get_room_type->fetch_array();

                            echo"<tr>
                                    <td>".$row_room_type['RoomType']."</td>
                                    <td>".$row_rooms_id_user_reserve['NumberOfRooms']."</td>
                                </tr>";
                        }
                        echo "</table>";
                    }
                    else{
                        echo "<h1 style = \"text-align: center; padding-top: 100px;\">No Data Available</h1>";
                    }
                ?>
            </div>

            <br>

            <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center; ">
                Add the rooms
            </h1>

            <table>
                <tr> 
                    <th>Room Type</th> 
                    <th>Room Number</th> 
                    <th>Add</th> 
                </tr>

                <tr>
                    <?php 
                        $sql_get_room_types = "select RoomType FROM tbl_room_details";
                        $result_room_types = $con->query($sql_get_room_types);
                        echo "<td><select id = \"add_new_room_select\" onchange = \"getNewRoom()\"> ";
                        while($row_room_types = $result_room_types->fetch_array())
                        {
                            echo "<option value = \"". $row_room_types['RoomType'] . "\" > ";
                            echo $row_room_types['RoomType'];
                            echo " </option> ";
                        }
                        echo "</select></td>";
                        echo "<td id = \"add_new_room_options\">  </td>";

                    ?>
                    <td><input type = "button" value = "Add" onclick = "add_new_room()"></td>
                </tr>
            </table>

            <?php
                echo "<div class = \"buttons\">
                        <input type = \"button\" value = \"Reject\" onclick = \"rej(".$_GET['ReservationId'].")\">
                        <input type = \"button\" value = \"Confirm\" onclick = \"conf(".$_GET['ReservationId'].")\">
                    </div>";
            ?>
        </div>
    </body>
</html>