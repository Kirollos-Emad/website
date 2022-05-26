<html>
<head>
    <title>non available rooms</title>
    <link rel="stylesheet" href="styles/header-style.css">
    <link rel="stylesheet" href="styles/available_rooms-style.css">
</head>
<body>
    <!-- Header -->
    <?php include("header.html"); ?>
    <div class = "av_ro">
        <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center;">
            non available rooms
        </h1>
    <?php
            include("../includes/connection.php");

            $sql = "select RoomNo, Avalibilty , RoomTypeId FROM tbl_room WHERE Avalibilty = 'not_available'";
            $result = $con->query($sql);
            
            if($result)
            {
                echo "<table> <tr> <th>RoomNo</th> <th>Availability</th> <th>Room Type</th> <th>Room Fees</th> </tr>";
                
                while($data1 = $result->fetch_array())
                {
                    $sql2 = "select RoomType, RoomFees FROM tbl_room_details WHERE RoomTypeId = " . $data1['RoomTypeId'];
                    $result2 = $con->query($sql2);
                    $data2 = $result2->fetch_array();
                    
                    echo "<tr>
                          <td>" . $data1['RoomNo'] ."</td>
                          <td>" . $data1['Avalibilty'] ."</td>
                          <td>" . $data2['RoomType'] ."</td>
                          <td>" . $data2['RoomFees'] ."</td>
                          </tr>";
    
                }
                echo "</table>";
            }
            else
            {
                echo "<h1 style = \"text-align: center; padding-top: 100px;\">No Data Available</h1>";
            }
    ?>
</div>
</body>
</html>