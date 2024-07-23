<?php 
session_start(); // Start the session
include '../config/db_connect.php';
include 'functions.php';
// Check if the user is logged in
$user_data = check_login($conn);

//Note: Need to fix the accessibility of the inventory
if (empty($user_data['client_id'])) {
  header('Location: index.php');
  die;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="../css/header_sidebar.css">
    <link rel="stylesheet" href="../Client/dashboard_client.css">
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
        <a href="dashboard_client.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-4 rounded-start mb-5">Create Ticket</a>
        <a href="ticket_requests.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Ticket Request Lists</a>
        <a href="services_type.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Service Type</a>
         
      </div>
      <a href="logout.php" class="list-group-item text-center text-white p-3 rounded-0"><img src="/img/back.svg" class="icons me-2">Logout</a>  
      
    </div>
  
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-light bg-transparent py-3 px-4 position-sticky">
          <div class="d-flex align-items-center">
              <i class="fa-solid fa-bars fs-3 me-5 bgcolor-dark " id="menu-toggle"></i>
              <div>
                <h3 class="m-0 textcolor-light fw-bold">Client Dashboard</h3>
                <h6 class="fs-6 fw-light " id="date"></h6>
              </div>
          </div>
          <div class="d-flex align-item-center justify-item-center">
            <div class="ms-auto rounded-2 backgroundcolor-red  px-3 py-2 text-white">
            <h6 class="m-auto"><i class="bi bi-person me-2"></i><?php echo $user_data['client_name']?> <span id="client"></span></h6>
            </div>
          </div>
      </nav>


      <br><br><br>
      <!-- Every page content is included here -->
      <div class="container d-flex align-items-center justify-content-center mt-5" id="main-content">
        <div class="container d-flex flex-column ms-3">
          <div class="box content d-flex align-items-center"> <!-- Added 'd-flex align-items-center' class to make the image and text align vertically -->
            <img src="../img/ticket.png">
            <div class="box w-50"> <!-- Adjusted class to 'box w-50' -->
                <p class="box lead bold">
                "Infinity Technosys Innovation Solution Inc. provides a digital ticketing service for clients to easily create service requests. With skilled Technical Support Engineers and collaborative efforts from our HR, Accounting, and Marketing Team, we ensure efficient resolution tailored to meet client needs."
                </p>
            </div>
          </div>
        </div>
      </div>
        <br><br><br>

        <div class="w-100 text-center">
          <button class="btn btn-lg fw-bold text-white backgroundcolor-red btn-shadow px-4" data-bs-toggle="modal" data-bs-target="#addOpenTicketModal">Open a Ticket</button>
          <div class="modal fade modal-lg" id="addOpenTicketModal" tabindex="-1" aria-labelledby="addOpenTicketModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" style="background-color: #E6E6E6">
                <div class="modal-header text-center">
                  <h1 class="modal-title fs-5 textcolor-light" id="addOpenTicketModalLabel">Ticket Request Form</h1>
                </div>
                <div class="modal-body">
                  <div class="alert alert-warning d-none" id="errorMessage" >
                  </div>
                  <form id="open-ticket">
                        <input type="hidden" name="client-id" value="<?php echo $user_data['client_id']?>">
                        <div class="row">
                            <div class="col form-group mb-4 ">
                              <label class="w-100 label mb-1 text-start">Customer Name: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="client-name" value="<?php echo $user_data['client_name']?>">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Contact Number: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="client-number" value="<?php echo $user_data['client_number']?>">
                            </div>              
                        </div>
                        <div class="row">
                            <div class="col  form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Email Address: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="email" name="email" value="<?php echo $user_data['email_address']?>">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 mb-1 text-start">Office Address: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="office-address" value="<?php echo $user_data['office_address']?>">
                            </div>         
                        </div>
                        <div class="row">
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Company Name: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="company-name" value="<?php echo $user_data['company_name']?>">
                            </div> 
                            <div class="col  col-6 form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Service Type: </label>
                              <select class="form-select form-control col-sm-5 border border-dark shadow form-bg" type="text" name="service-type">
                                <option selected>Select type of request</option>
                                <option>Service Request</option>
                                <option>System Incident</option>
                              </select>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Problem Description: </label>
                              <textarea placeholder="Input description here..." class="form-control col-sm-5 border border-dark shadow form-bg" name="problem-description"></textarea>
                            </div>
                        </div>

                        <div class="row form-down text-center">
                              <button type="submit" class="add-btn rounded-5 py-3 w-25 mx-auto mt-5 text-white fw-bold backgroundcolor-red" name="add-ticket">Submit</button>
                        </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
<script>

$(document).on('submit', '#open-ticket', function(e) 
{
   e.preventDefault();

   var formData = new FormData(this);
   formData.append('open_ticket', true);

   $.ajax({
   type: 'POST',
   url: 'dashboard_clientCode.php',
   data: formData,
   processData: false,
   contentType: false,
   success: function(response){
      console.log(response);
      var res = jQuery.parseJSON(response);
      if (res.status == 422) 
      {
         // Show error message inside the modal
         $('#errorMessage').removeClass('d-none');
         $('#errorMessage').text(res.message);

      } 

      else if (res.status == 404) {
         // Show error message inside the modal
         $('#errorMessage').removeClass('d-none');
         $('#errorMessage').text(res.message);
      }
      else if (res.status == 200) 
      {
         //Removing error message (if visible) and hiding modal
         alert(res.message);
         $('#errorMessage').addClass('d-none');
         $('#addProductModal').modal('hide');
         $('#open-ticket')[0].reset();

         // Reload the table
         $('#table-content').load(location.href + ' #table-content');
      }
   },
   error: function(jqXHR, textStatus, errorThrown) {
   console.log("AJAX request failed: " + errorThrown);
   }
   });
});


</script>
</body>
</html>