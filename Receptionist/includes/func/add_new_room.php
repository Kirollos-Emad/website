<?php

    include("../../../includes/connection.php");

    $sql_ins_new_room = "INSERT INTO tbl_reservation_current(ReservationId, RoomId) VALUES (".$_POST['res_id'].",".$_POST['new_room_id'].")";
    $con->query($sql_ins_new_room);

    $sql_upd_new_room_aval = "update tbl_room SET Avalibilty = 'not_available' WHERE RoomId = " . $_POST['new_room_id'];
    $con->query($sql_upd_new_room_aval);
?>