<?php
    include("../../../includes/connection.php");
    
    $sql_chan_res_stat = "update tbl_reservation set ReservationConfirmation = 'Rejected' WHERE ReservationId = " . $_POST['res_id'];
    $con->query($sql_chan_res_stat);
?>