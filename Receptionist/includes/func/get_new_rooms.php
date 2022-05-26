<?php 

    include("../../../includes/connection.php");

    $sql_get_room_type_id = "select RoomTypeId FROM tbl_room_details WHERE RoomType = '". $_POST['type'] ."'";
    $result_room_type_id = $con->query($sql_get_room_type_id);
    $row_room_type_id = $result_room_type_id->fetch_array();

    $sql_get_ava_rooms = "select RoomId, RoomNo FROM tbl_room WHERE Avalibilty = 'available' AND RoomTypeId = " . $row_room_type_id['RoomTypeId'];
    $result_ava_rooms = $con->query($sql_get_ava_rooms);

    if($result_ava_rooms->num_rows > 0)
    {
        echo "<span style = \" color: red; font-size: 25;\"> Please choose room number</span> <br>";
        echo "<select id = \"add_new_rooms_select\">";
        while($row_ava_rooms = $result_ava_rooms->fetch_array())
        {
            echo "<option value = \"". $row_ava_rooms['RoomId'] . "\" >";
            echo $row_ava_rooms['RoomNo'];
            echo "</option>";
        }
        echo "</select></td>";
    }
    else
    {
        echo "No Rooms available in this type";
    }
    //
?>
