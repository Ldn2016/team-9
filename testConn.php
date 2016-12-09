<?php
function isConnected()
{
    $connection = @fsockopen("www.google.com", 80);
                                        //HTTP port attempting to establish connection with google server
    if ($connection){
        $is_connected = true; //action when connected
        fclose($connection); //close connection if connection was established successfully
        echo "connected"; 

    }else{
        $is_connected = false; //action in connection failure
        echo "not connected" ;
    }
    return $is_connected;

}

isConnected();
?>
