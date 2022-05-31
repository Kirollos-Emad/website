<?php

    include("../../../includes/connection.php");
    $sql_chk_pin = "select EmpId FROM tbl_manager WHERE ManagerPIN = '" . $_POST['pin'] . "'";
    $result_chk_pin = $con->query($sql_chk_pin);

    if($result_chk_pin->num_rows > 0)
    {
        echo "<p style = \"color: green;\">The PIN is correct</p>";
        echo"<div class = \"buttons\" style = \"text-align: center;\">
                        <input type = \"button\" value = \"Reject The Reservation\" onclick = \"del(".$_POST['res_id'].")\">
                    </div>";
    }
    else
    {
        echo "<p style = \"color: red;\">The PIN is not correct</p>";
    }
?>

<script>
    function del(res_id)
    {
        var text = "By clicking ok the reservation will be canceled\nNote: make sure you need to cancel the reservation\nMake sure you delete the rooms first";
        if (confirm(text) == true)
        {
            jQuery.ajax({
                            url: "includes/func/rej_res.php",
                            data: '&res_id=' + res_id, 
                            type: "POST",
                            success: function(data){
                                document.location.href = "cancel_confirm1.php";
                            }
                        });
        }
    }
</script>