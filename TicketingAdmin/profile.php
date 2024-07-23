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

function getRelativePathAndFilename($idFilePath) {
    // Find the index of 'employeeImages'
    $idStartIndex = strpos($idFilePath, 'employeeImages');

    // Extract the relative directory path and filename
    $idRelativePath = substr($idFilePath, $idStartIndex);
    return '/' . $idRelativePath;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnel Dashboard</title>
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
      <a href="dashboard_personnel.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-4 rounded-start mb-5">Personnel</a>
        <a href="management.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Management</a>
        <a href="technical.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Technical</a>
        <a href="accounting.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Accounting</a>
        <a href="humanresource.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">Human Resources</a>
        <a href="profile.php" class="list-group-item backgroundcolor-red text-white ms-3 mb-2 rounded-start">User Profile</a>
      </div>
      <a href="../dashboard.php" class="list-group-item text-center text-white p-3 rounded-0"><img src="/images/back.svg" class="icons me-2">back to home</a>   
    </div>
  
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-light bg-transparent py-3 px-4 position-sticky">
          <div class="d-flex align-items-center">
              <i class="fa-solid fa-bars fs-3 me-5 bgcolor-dark " id="menu-toggle"></i>
              <div>
                <h3 class="m-0 textcolor-light fw-bold">User Profile</h3>
                <h6 class="fs-6 fw-light " id="date"></h6>
              </div>
          </div>
          <div class="d-flex align-item-center justify-item-center">
            <div class="dropdown me-5">
              <button class="btn dropdown-toggle backgroundgcolor-red" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell "></i>
              </button>
            </div>
            <div class="ms-auto rounded-2 backgroundcolor-red  px-3 py-2 text-white">
              <h6 class="m-auto"><i class="bi bi-person me-2"></i><?php echo $user_data['first_name'] . ' '. $user_data['last_name']?> <span id="admin"></span></h6>
            </div>
          </div>
      </nav>



      <!-- Every page content is included here -->
      <div class="container d-flex align-items-center justify-content-center mt-2" id="main-content">
      <div class="container rounded bg-white mt-2">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <?php 
                    $filePath = $user_data['profile_image_path'];
                    
                    // Get the directory path
                    $directory = dirname($filePath);

                    // Find the index of the last occurrence of '/'
                    $lastSeparatorIndex = strrpos($directory, '/');

                    // Extract the directory path and filename
                    $relativePath = substr($directory, $lastSeparatorIndex);
                    $filename = basename($filePath);

                    
                    ?>
                    <img class="rounded-circle my-3 border" width="250px" height="250px" src="<?php echo  $relativePath . "/". $filename?>">
                    <span class="fw-bold "><?php echo $user_data['position']?></span>
                    <span class="text-black"><?php echo $user_data['email_address']?></span>
                </div>
            </div>
            <div class="col-md-9 border-right">
                <div class="p-3 py-2">
                    <div class="d-flex justify-content-between align-items-center mb-3 w-100">
                        <h4 class="text-right">Personal Information</h4>
                    </div>
                    <div class="row mt-2">
                        <?php 
                        $fullName = "{$user_data['first_name']} {$user_data['middle_initial']}. {$user_data['last_name']}";
                        $fullAddress = "{$user_data['address_first']}, {$user_data['address_province']}";
                        ?>
                        <div class="col-md-6 input-group-sm"><label class="labels">Name:</label><input type="text" class="form-control" value="<?php echo $fullName?>" readonly></div>
                        <div class="col-md-6 input-group-sm"><label class="labels">Birthdate:</label><input type="text" class="form-control"  value="<?php echo $user_data['birthdate']?>" readonly></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 input-group-sm"><label class="labels">Address:</label><input type="text" class="form-control"  value="<?php echo $fullAddress?>" readonly></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 input-group-sm"><label class="labels">Sex:</label><input type="text" class="form-control"  value="<?php echo $user_data['sex']?>" readonly></div>
                        <div class="col-md-4 input-group-sm"><label class="labels">Contact Number:</label><input type="text" class="form-control"  value="<?php echo $user_data['contact_number']?>" readonly></div>
                        <div class="col-md-4 input-group-sm"><label class="labels">Position:</label><input type="text" class="form-control"  value="<?php echo $user_data['position']?>" readonly></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 input-group-sm"><label class="labels">Department:</label><input type="text" class="form-control"  value="<?php echo $user_data['department']?>" readonly></div>
                        <div class="col-md-4 input-group-sm"><label class="labels">Privileges:</label><input type="text" class="form-control"  value="<?php echo $user_data['privileges']?>" readonly></div>
                        <div class="col-md-4 input-group-sm"><label class="labels">Date Hired:</label><input type="text" class="form-control"  value="<?php echo $user_data['date_hired']?>" readonly></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 input-group-sm"><label class="labels">Emergency Contact Name:</label><input type="text" class="form-control"  value="<?php echo $user_data['emergency_contact_person']?>" readonly></div>
                        <div class="col-md-4 input-group-sm"><label class="labels">Emergency Contact Number:</label><input type="text" class="form-control"  value="<?php echo $user_data['emergency_contact_number']?>" readonly></div>
                    </div>

                    <hr class="mt-5">
                    <h6>SSS Id</h6>
                    <div class="row mt-2">
                        <div class="col-md-5 input-group-sm">
                            <label class="labels w-100">SSS Id Number:</label>
                            <input type="text" class="form-control"  value="<?php echo $user_data['sss_number']?>" readonly>                           
                        </div>
                        <div class="col-md-7 input-group-sm mt-4">
                            <img class="border border-dark" width="250px" height="150px" src="<?php echo getRelativePathAndFilename($user_data['sss_file_path'])?>">
                        </div>
                    </div>

                    <hr class="mt-5">
                    <h6>Philhealth Id</h6>
                    <div class="row mt-2">
                        <div class="col-md-5 input-group-sm">
                            <label class="labels w-100">Philhealth Id Number:</label>
                            <input type="text" class="form-control"  value="<?php echo $user_data['philhealth_number']?>" readonly>                           
                        </div>
                        <div class="col-md-7 input-group-sm mt-4">
                            <img class="border border-dark" width="250px" height="150px" src="<?php echo getRelativePathAndFilename($user_data['philhealth_file_path'])?>">
                        </div>
                    </div>

                    <hr class="mt-5">
                    <h6>UMID Id</h6>
                    <div class="row mt-2">
                        <div class="col-md-5 input-group-sm">
                            <label class="labels w-100">UMID Id Number:</label>
                            <input type="text" class="form-control"  value="<?php echo $user_data['umid_number']?>" readonly>                           
                        </div>
                        <div class="col-md-7 input-group-sm mt-4">
                            <img class="border border-dark" width="250px" height="150px" src="<?php echo getRelativePathAndFilename($user_data['umid_file_path'])?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      </div>
</div>

<script src="./js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>

//Adding Employee
$(document).on('submit', '#add-employee', function(e) 
{
   e.preventDefault();

   var formData = new FormData(this);
   formData.append('add_employee', true);

   $.ajax({
   type: 'POST',
   url: 'employeeCode.php',
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
         alert(res.message);
         //Removing error message (if visible) and hiding modal
         $('#errorMessage').addClass('d-none');
         $('#addEmployeeModal').modal('hide');
         $('#add-employee')[0].reset();

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