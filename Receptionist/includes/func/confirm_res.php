<?php
    include("../../../includes/connection.php");
    
    $sql_chan_res_stat = "update tbl_reservation set ReservationConfirmation = 'Confirmed' WHERE ReservationId = " . $_POST['res_id'];
    $con->query($sql_chan_res_stat);

    // $sql_del_rooms_reserved = "delete FROM tbl_reservation_comming WHERE ReservationId = ". $_POST['res_id'];
    // $con->query($sql_del_rooms_reserved);

?>