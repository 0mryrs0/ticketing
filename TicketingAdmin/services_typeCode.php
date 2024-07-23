<?php 

include("../config/db_connect.php");

if(isset($_POST['new_srInput']))
{
    $newSr = $_POST['srInput'];


    if(!empty($newSr)) {
        $query = "INSERT INTO `services`(`services_name`, `service_type`) VALUES ('$newSr', 'Services Request')";
        $result= mysqli_query($conn, $query);
    
        if($result)
        {
            $response = [
                'status' => 200,
                'message' => 'New Services Request has been added '
            ];
            echo json_encode($response);
            return;
        }
        else
        {
            $response = [
                'status' => 500,
                'message' => 'New Services Request is not added'
            ];
            echo json_encode($response);
            return;
        }

    }else {
        $response = [
            'status' => 500,
            'message' => 'No services has been added'
        ];
        echo json_encode($response);
        return;

    }

}

if(isset($_POST['new_siInput']))
{
    $newSi = $_POST['siInput'];


    if(!empty($newSi)) {
        $query = "INSERT INTO `services`(`services_name`, `service_type`) VALUES ('$newSi', 'System Incident')";
        $result= mysqli_query($conn, $query);
    
        if($result)
        {
            $response = [
                'status' => 200,
                'message' => 'New System Incident has been added '
            ];
            echo json_encode($response);
            return;
        }
        else
        {
            $response = [
                'status' => 500,
                'message' => 'New System Incident is not added'
            ];
            echo json_encode($response);
            return;
        }

    }else {
        $response = [
            'status' => 500,
            'message' => 'No services has been added'
        ];
        echo json_encode($response);
        return;

    }

}

?>