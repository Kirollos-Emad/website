<?php

    include("../../../includes/connection.php");

    $sql_get_res_id = "select ReservationId FROM tbl_reservation where ReservationConfirmation = 'Confirmed'";
    $result_res_id = $con->query($sql_get_res_id);

            if($result_res_id->num_rows > 0)
            {
                while($row_res_id = $result_res_id->fetch_array())
                {
                    $sql_get_user_id = "select UserId FROM tbl_reservation WHERE ReservationId = " . $row_res_id['ReservationId'];
                    $result_user_id = $con->query($sql_get_user_id);
                    $row_user_id = $result_user_id->fetch_array();

                    $sql_get_user_data = "select UserFirstName, UserLastName, UserImage, UserMail FROM tbl_user WHERE UserId = " . $row_user_id['UserId'] . " and UserMail like '%".$_POST['val']."%'";
                    $result_user_data = $con->query($sql_get_user_data);
                    

                    if($result_user_data->num_rows > 0)
                    {
                        $row_user_data = $result_user_data->fetch_array();
                        echo "<div class = \"card\">
                            <div class = \"img_name_mail\">
                            <a href = \"modify_rooms_2.php?ReservationId=". $row_res_id['ReservationId'] ."\">
                                <img src = \"../img/Guest/Guest_Image/" . $row_user_data['UserMail'] .".jpg\">
                            </a>
                                <div class = \"name_mail\">
                                    <a href = \"modify_rooms_2.php?ReservationId=". $row_res_id['ReservationId'] ."\">
                                    <h1>Name: ". $row_user_data['UserFirstName'] . " " . $row_user_data['UserLastName'] . "</h1>
                                    </a>   
                                    <h1>Mail: " . $row_user_data['UserMail'] . "</h1>
                                </div>
                            </div>
                        </div>";
                    }
                }
            }
            else
            {
                echo "<h1 style = \"text-align: center; padding-top: 100px;\">No Data Available</h1>";
            }

?>