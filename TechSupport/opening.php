<?php 
session_start(); // Start the session
include("../config/db_connect.php");
include("functions.php");
// Check if the user is logged in
$user_data = check_login($conn);

//Note: Need to fix the accessibility of the inventory
if (empty($user_data['user_id'])) {
  header('Location: technical_login.php');
  die;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageName ?></title>
    <link rel="stylesheet" href="../css/header_sidebar.css">
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
        <a href="dashboard_tech.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-4 rounded-start mb-5">Dashboard</a>
        <a href="on_going.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">On-going</a>
        <a href="ticket_handled.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Ticket Handled</a>
         
      </div>
      <a href="logout.php" class="list-group-item text-center text-white p-3 rounded-0"><img src="/img/back.svg" class="icons me-2">Logout</a>  
      
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
          <div class="d-flex align-item-center justify-item-center">
            <div class="ms-auto rounded-2 backgroundcolor-red  px-3 py-2 text-white">
            <h6 class="m-auto"><i class="bi bi-person me-2"></i><?php echo $user_data['first_name'] . ' ' . $user_data['last_name']?> <span id="admin"></span></h6>
            </div>
          </div>
      </nav>