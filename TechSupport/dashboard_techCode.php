<?php 
include("../config/db_connect.php");


//dashboard_tech
if(isset($_POST['accept-ticket']))
{
    $ticket_id = $_POST['ticket_id'];
    $technical_name = $_POST['technical_name'];

    $query = "UPDATE tickets SET tech_support_name='$technical_name' WHERE ticket_id = '$ticket_id'";


    $notificationId = "NID" . uniqid();
    $activity = "Technical support has requested to take the ticket with Ticket id of " . $ticket_id;
    $category = "Tech Support Request";
    $insertQuery = "INSERT INTO notification_tickets (`notification_id`, `activity`, `category`, `isClicked`, `ticket_id`) VALUES ('$notificationId','$activity','$category', 0 ,'$ticket_id')";
    $newResult = mysqli_query($conn, $insertQuery);

    if(mysqli_query($conn, $query))
    {
        $response = [
            'status' => 200,
            'message' => 'Your request for approval has been sent. Please wait for an update.'
        ];
        echo json_encode($response);
        return;
    }
    else
    {
        $response = [
            'status' => 500,
            'message' => 'System is unable to sent your request.'
        ];
        echo json_encode($response);
        return;
    }
}




// <________OPEN TICKET FORM HANDLER_______________>
if(isset($_POST['resolved_ticket_report'])) 
{
    $ticketReportId = "TRI" . uniqid();
    $ticketId = $_POST['ticket-id'];
    $technicalSupport = $_POST['technical-support'];
    $initialFindings = $_POST['initial-findings'];
    $serviceDone = $_POST['service-done'];
    $status = $_POST['status'];



    //Checking if all inputs are not empty
    if(!empty($ticketId) && !empty($technicalSupport) && !empty($initialFindings) && !empty($serviceDone)) 
    {

        
        $query = "INSERT INTO `ticket_reports`(`tr_id`, `ticket_id`, `technical_suport`, `initial_findings`, `service_done`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $ticketReportId, $ticketId, $technicalSupport, $initialFindings, $serviceDone, $status);
        mysqli_stmt_execute($stmt);

        $updateStatusQuery = "UPDATE tickets SET ticket_status='RESOLVED' WHERE ticket_id='$ticketId'";
        $result= mysqli_query($conn, $updateStatusQuery);

        if ($stmt && $query) {
            $response = [
                'status' => 200, 
                'message'=> 'Ticket report submitted successfully'
            ];
            echo json_encode($response);
            return;

        } else {
            $response = [
                'status' => 500, // Server Error
                'message'=> 'Failed to submit the ticket report'
            ];
            echo json_encode($response);
            return;
        }

    } else {
        $response = [
            'status' => 422, // Unprocessable Entity
            'message'=> 'All details of report should be completed'
        ];
        echo json_encode($response);
        return;
    }
}


// <________OPEN TICKET FORM HANDLER_______________>
if(isset($_POST['escalation_ticket_report'])) {
    $ticketReportId = "TRI" . uniqid();
    $ticketId = $_POST['ticket-id'];
    $technicalSupport = $_POST['technical-support'];
    $initialFindings = $_POST['initial-findings'];
    $serviceDone = $_POST['service-done'];
    $status = $_POST['status'];



    //Checking if all inputs are not empty
    if(!empty($ticketId) && !empty($technicalSupport) && !empty($initialFindings) && !empty($serviceDone)) 
    {

        
        $query = "INSERT INTO `ticket_reports`(`tr_id`, `ticket_id`, `technical_suport`, `initial_findings`, `service_done`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $ticketReportId, $ticketId, $technicalSupport, $initialFindings, $serviceDone, $status);
        mysqli_stmt_execute($stmt);

        $updateStatusQuery = "UPDATE tickets SET ticket_status='REQUEST(ESCALATION)', ticket_level= ticket_level + 1, tech_support_name='No tech support assigned yet' WHERE ticket_id='$ticketId'";
        $result= mysqli_query($conn, $updateStatusQuery);

        if ($stmt && $query) {
            $response = [
                'status' => 200, 
                'message'=> 'Ticket report submitted successfully. REMARKS: ESCALATION'
            ];
            echo json_encode($response);
            return;

        } else {
            $response = [
                'status' => 500, // Server Error
                'message'=> 'Failed to submit the ticket report'
            ];
            echo json_encode($response);
            return;
        }

    } else {
        $response = [
            'status' => 422, // Unprocessable Entity
            'message'=> 'All details of report should be completed'
        ];
        echo json_encode($response);
        return;
    }
}


// <________OPEN TICKET FORM HANDLER_______________>
if(isset($_POST['unsolved_ticket_report'])) {
    $ticketReportId = "TRI" . uniqid();
    $ticketId = $_POST['ticket-id'];
    $technicalSupport = $_POST['technical-support'];
    $initialFindings = $_POST['initial-findings'];
    $serviceDone = $_POST['service-done'];
    $status = $_POST['status'];



    //Checking if all inputs are not empty
    if(!empty($ticketId) && !empty($technicalSupport) && !empty($initialFindings) && !empty($serviceDone)) 
    {

        
        $query = "INSERT INTO `ticket_reports`(`tr_id`, `ticket_id`, `technical_suport`, `initial_findings`, `service_done`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $ticketReportId, $ticketId, $technicalSupport, $initialFindings, $serviceDone, $status);
        mysqli_stmt_execute($stmt);

        $updateStatusQuery = "UPDATE tickets SET ticket_status='UNRESOLVED' WHERE ticket_id='$ticketId'";
        $result= mysqli_query($conn, $updateStatusQuery);

        if ($stmt && $query) {
            $response = [
                'status' => 200, 
                'message'=> 'Ticket report submitted successfully. REMARKS: Issue remains unresolved due for some reason' 
            ];
            echo json_encode($response);
            return;

        } else {
            $response = [
                'status' => 500, // Server Error
                'message'=> 'Failed to submit the ticket report'
            ];
            echo json_encode($response);
            return;
        }

    } else {
        $response = [
            'status' => 422, // Unprocessable Entity
            'message'=> 'All details of report should be completed'
        ];
        echo json_encode($response);
        return;
    }
}



?>