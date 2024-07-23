<?php 
session_start(); // Start the session
include("../config/db_connect.php");
include("../config/functions.php");
// Check if the user is logged in
$user_data = check_login($conn);

//Note: Need to fix the accessibility of the inventory
if (empty($user_data['user_id'])) {
  header('Location: ../index.php');
  die;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing System</title>
    <link rel="stylesheet" href="./css/header_sidebar.css">
    <link rel="stylesheet" href="./css/dashboard_personnel.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="sidebar-menu" id="sidebar">
      <div class="sidebar-heading ms-3 text-white py-5 fs-5 fw-bold text-uppercase"><span class="py-5 text-white" id="menu-close"><i class="fa-solid fa-circle-xmark fa-2xl"></i></span></div>
      <div class="list-group list-group-flush my-3" id="list-link">
      <a href="dashboard_tickets.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-4 rounded-start mb-5">Dashboard</a>
        <a href="open_ticket.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Tickets</a>
        <a href="on-going_ticket.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">On-Going Tickets</a>
        <a href="all_ticket.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">All Tickets</a>
        <a href="technical_team.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Technical Team</a>
        <a href="services_type.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Services Type</a>
        <a href="dashboard_personnel.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Add Accout</a>
        
      </div>
      <a href="logout.php" class="list-group-item text-center text-white p-3 rounded-0"><img src="/images/back.svg" class="icons me-2">logout</a>   
    </div>
  
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-light bg-transparent py-3 px-4 position-sticky">
          <div class="d-flex align-items-center">
              <i class="fa-solid fa-bars fs-3 me-5 bgcolor-dark " id="menu-toggle"></i>
              <div>
                <h3 class="m-0 textcolor-light fw-bold"><?php echo $pageName ?></h3>
                <h6 class="fs-6 fw-light " id="date"></h6>
              </div>
          </div>
          <div class="d-flex align-item-center justify-item-center " style="position:relative; z-index: 2000">
            <div class="dropdown me-5" id="dropdown" >
              <button class="btn dropdown-toggle bg-dark text-white " type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" >
                <i class="fas fa-bell "></i>
                <?php
                  $selectQuery = "SELECT COUNT(*) as num_rows FROM notification_tickets WHERE isClicked=0";
                  $result = mysqli_query($conn, $selectQuery);
              
                  if ($result) {
                      $row = mysqli_fetch_assoc($result);
                      $num_rows = $row['num_rows'];
                      // Use $num_rows as needed
                  } else {
                      $message = "Error: " . mysqli_error($conn);
                  } 

                  if ($num_rows != 0) {
                  ?>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $num_rows?></span>
                  <?php
                  }
                
                
                ?>
              </button>
              <div class="dropdown-menu  dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="background-color: #ffffff;">
                <h4 class="text-center fw-bold text-danger py-3 border-bottom">Notifications</h4>
                <?php 
                  $query = "SELECT * FROM `notification_tickets` ORDER BY date_added DESC";
                  $result = mysqli_query($conn, $query);

                  if ($result && mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          // Escape output to prevent XSS attacks
                          $activity = htmlspecialchars($row['activity']);
                          $isClicked = $row['isClicked'];
                          // Check if the notification is clicked or not
                          $liClass = $isClicked ? '' : 'text-danger '; // Add bg-danger class if not clicked

                          echo '<a href="open_ticket.php" class="text-decoration-none"><li class="dropdown-item ' . $liClass . '">' . $activity . '</li></a>';
                      }
                  } else {
                      echo '<li class="dropdown-item">No notifications</li>';
                  }
                  ?>
                  <!-- Replace with appropriate link -->
                  <li class="dropdown-item w-100 text-center fw-bold"><a href="open_ticket.php" class="text-decoration-none text-dark my-2">View all>></a></li></li>
              </div>
            </div>
            <div class="ms-auto rounded-2 backgroundcolor-red  px-3 py-2 text-white">
              <h6 class="m-auto"><i class="bi bi-person me-2"></i><?php echo $user_data['first_name'] . ' '. $user_data['last_name']?> <span id="admin"></span></h6>
            </div>
          </div>
      </nav>