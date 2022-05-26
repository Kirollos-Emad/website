<?php 

    include("../../../includes/connection.php");

    $sql_get_room_id = "select RoomId FROM tbl_room WHERE RoomNo = " . $_POST['num'];
    $result_room_id = $con->query($sql_get_room_id);
    $row_room_id = $result_room_id->fetch_array();

    $sql_del_room_from_res = "delete FROM tbl_reservation_current WHERE RoomId = " . $row_room_id['RoomId'];
    $con->query($sql_del_room_from_res);

    $sql_upd_room_aval = "update tbl_room SET Avalibilty = 'available' WHERE RoomId = " . $row_room_id['RoomId'];
    $con->query($sql_upd_room_aval);
?>