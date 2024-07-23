<?php 
include("../config/db_connect.php");

// <________OPEN TICKET FORM HANDLER_______________>
if(isset($_POST['open_ticket'])) {
    $ticketId = "TID" . uniqid();
    $clientName = $_POST['client-name'];
    $companyName = $_POST['company-name'];
    $clientNumber = $_POST['client-number'];
    $emailAddress = $_POST['email'];
    $address = $_POST['office-address'];
    $serviceType = $_POST['service-type'];
    $clientId = $_POST['client-id'];
    $problemDescription = $_POST['problem-description'];
    $ticketStatus = "REQUEST";
    $techSupportName = "No tech support assigned yet";
    $ticket_level = 0;

    

    
    //Checking if all inputs are not empty
    if(!empty($ticketId) && !empty($clientName) && !empty($companyName) && !empty($clientNumber) && !empty($emailAddress) && !empty($address) && !empty($serviceType) && !empty($clientId) && !empty($problemDescription) && !empty($ticketStatus) && !empty($techSupportName)) 
    {

        
        $query = "INSERT INTO tickets (`ticket_id`, `client_name` , `company_name`,`client_number`, `email_address`, `address`, `service_type`, `problem_description`, `ticket_status`, `tech_support_name`, `client_id`, `ticket_level`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $ticketId, $clientName, $companyName, $clientNumber, $emailAddress, $address, $serviceType, $problemDescription, $ticketStatus, $techSupportName, $clientId);
        mysqli_stmt_execute($stmt);

        if ($stmt) {
            $response = [
                'status' => 200, 
                'message'=> 'Ticket submitted Successfully'
            ];
            echo json_encode($response);
            return;

        } else {
            $response = [
                'status' => 500, // Server Error
                'message'=> 'Failed to submit the ticket'
            ];
            echo json_encode($response);
            return;
        }

    } else {
        $response = [
            'status' => 422, // Unprocessable Entity
            'message'=> 'All details should be completed'
        ];
        echo json_encode($response);
        return;
    }
}