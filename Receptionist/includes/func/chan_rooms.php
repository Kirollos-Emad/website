<?php

    include("../../../includes/connection.php");

    $sql_ins_new_room = "INSERT INTO tbl_reservation_current(ReservationId, RoomId) VALUES (".$_POST['res_id'].",".$_POST['new_room_id'].")";
    $con->query($sql_ins_new_room);

    $sql_upd_new_room_aval = "update tbl_room SET Avalibilty = 'not_available' WHERE RoomId = " . $_POST['new_room_id'];
    $con->query($sql_upd_new_room_aval);

    $sql_get_old_room_id = "select RoomId FROM tbl_room WHERE RoomNo = " . $_POST['old_room_num'];
    $result_old_room_id = $con->query($sql_get_old_room_id);
    $row_old_room_id = $result_old_room_id->fetch_array();

    $sql_del_old_room_from_res = "delete FROM tbl_reservation_current WHERE RoomId = " . $row_old_room_id['RoomId'];
    $con->query($sql_del_old_room_from_res);

    $sql_upd_old_room_aval = "update tbl_room SET Avalibilty = 'available' WHERE RoomId = " . $row_old_room_id['RoomId'];
    $con->query($sql_upd_old_room_aval);

    
?>