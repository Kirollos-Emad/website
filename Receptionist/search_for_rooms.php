<html>
<head>
    <title>search for rooms</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/header-style.css">
    <link rel="stylesheet" href="styles/room_search.css">
</head>

<body>
    <!-- Header -->
    <?php include("header.html"); ?>

    <div class="room_search">
        <h1 style = "border: 6px solid gray; background-color: #f0f0f0; width: 100%; text-align: center;">
            Search for room using number
        </h1>

        <form style = "padding: 15px;"method="post" action="">
            <label for="room_no" style="font-size: 20px;">Enter the room number</label>
            <input id="room_no" name="room_no" type="text" style="font-size: 20px; width: 80px;">
            <input type="submit" style="font-size: 20px;" value = "Search">
        </form>

    </div>
</body>

</html>

<?php

if(isset($_POST['room_no']))
{
    $room_no = $_POST['room_no'];
    include("../includes/connection.php");

    $sql = "select RoomNo, Avalibilty , RoomTypeId FROM tbl_room WHERE RoomNo = $room_no";
    $result = $con->query($sql);
    
    if($result->num_rows > 0)
    {
        $data1 = $result->fetch_array();

        $sql2 = "select RoomType, RoomFees FROM tbl_room_details WHERE RoomTypeId = " . $data1['RoomTypeId'];
        $result2 = $con->query($sql2);
        $data2 = $result2->fetch_array();
        
        echo "<table> 
              <tr> <th>RoomNo</th> <th>Availability</th> <th>Room Type</th> <th>Room Fees</th> </tr> 
              <tr>
              <td>" . $data1['RoomNo'] ."</td>
              <td>" . $data1['Avalibilty'] ."</td>
              <td>" . $data2['RoomType'] ."</td>
              <td>" . $data2['RoomFees'] ."</td>
              </tr>
              </table>";
    }else{
        echo "<h1>Room not found</h1>";
    }
}
?>