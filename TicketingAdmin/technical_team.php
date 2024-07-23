<?php 
$pageName = "Technical Support";
include ('opening.php');

?>


      <!-- Every page content is included here -->
      <div class= "flex-column justify-content-center align-items-center mt-3" id="main-content">
      <div class="container d-flex w-100 justify-content-between search-buttons m-1">
            <input class="p-2 w-25 form-control border-outline-dark" type="search" placeholder="Search" id="search-input" name="search-input" autocomplete="off">
      </div>
      <div class="container mt-2 h-100 overflow-y-auto">
          <div class="mt-1 overflow-y-scroll" id="table" style="height: 70vh">
            <table class="table table-danger table-hover text-center default-table table-sm table-bordered align-middle px-3" id='table-content'>
                <thead class="table-dark">
                  <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Contact Number</th>
                      <th>Email Address</th></th>
                      <th class="action-column">Action</th>
                  </tr> 
                  
                </thead>                  
                <tbody>
                <?php
                //Getting the data from the database
                $query = "SELECT * FROM personnel WHERE department='Technical'";
                $result = mysqli_query($conn, $query);
                while ($fetch = mysqli_fetch_array($result)) {

                ?>
                    <tr>
                      <!--Displaying the data in table form -->
                      <td><?php echo $fetch['first_name'] . ' ' .  $fetch['middle_initial'] . '. ' . $fetch['last_name']?></td>
                      <td><?php echo $fetch['position']?></td>
                      <td><?php echo $fetch['contact_number']?></td>
                      <td><?php echo $fetch['email_address']?></td>
                      <td class='action action-column'>
                          <button type='button' value='<?php echo $fetch['user_id']?>' class='viewEmployeeBtn opacity' data-bs-toggle="modal" data-bs-target="#viewModal">
                            <i class='fa-solid fa-eye text-primary' data-bs-toggle="tooltip" title="View All Employee Details"></i>
                          </button>

                          <!-- Modal -->
                          <div class="modal fade modal-xl" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="viewModalLabel">Employee Information</h1>
                                </div>
                                <div class="modal-body">
                                
                                <div class="container rounded bg-white mt-2">
                                  <div class="row">
                                      <div class="col-md-3 border-right">
                                          <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                              <img class="rounded-circle my-3 border" width="250px" height="250px" id="vuser-profile">
                                              <span class="fw-bold "></span>
                                              <span class="text-black"></span>
                                          </div>
                                      </div>
                                      <div class="col-md-9 border-right">
                                          <div class="p-3 py-2">
                                              <div class="row mt-2">
                                                  <div class="col-md-6 input-group-sm"><label class="labels text-start w-100">Name:</label><input type="text" class="form-control" id="vname" readonly></div>
                                                  <div class="col-md-6 input-group-sm"><label class="labels text-start w-100">Birthdate:</label><input type="text" class="form-control" id="vbirthday" readonly></div>
                                              </div>
                                              <div class="row mt-2">
                                                  <div class="col-md-12 input-group-sm"><label class="labels text-start w-100">Address:</label><input type="text" class="form-control" id="vaddress" readonly></div>
                                              </div>
                                              <div class="row mt-2">
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Sex:</label><input type="text" class="form-control" id="vsex" readonly></div>
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Contact Number:</label><input type="text" class="form-control" id="vcontact-number" readonly></div>
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Position:</label><input type="text" class="form-control" id="vposition"readonly></div>
                                              </div>
                                              <div class="row mt-2">
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Department:</label><input type="text" class="form-control" id="vdepartment" readonly></div>
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Privileges:</label><input type="text" class="form-control" id="vprivileges" readonly></div>
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Date Hired:</label><input type="text" class="form-control" id="vdate-hired" readonly></div>
                                              </div>
                                              <div class="row mt-2">
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Emergency Contact Name:</label><input type="text" class="form-control" id="vemergency-contact-person" readonly></div>
                                                  <div class="col-md-4 input-group-sm"><label class="labels text-start w-100">Emergency Contact Number:</label><input type="text" class="form-control" id="vemergency-contact-number" readonly></div>
                                              </div>

                                              <hr class="mt-5">
                                              <h6>SSS Id</h6>
                                              <div class="row mt-2">
                                                  <div class="col-md-5 input-group-sm">
                                                      <label class="labels w-100 text-start">SSS Id Number:</label>
                                                      <input type="text" class="form-control" readonly id="vsss-number">                           
                                                  </div>
                                                  <div class="col-md-7 input-group-sm mt-4">
                                                      <img class="border border-dark" width="250px" height="150px" id="vsss-id">
                                                  </div>
                                              </div>

                                              <hr class="mt-5">
                                              <h6>Philhealth Id</h6>
                                              <div class="row mt-2">
                                                  <div class="col-md-5 input-group-sm">
                                                      <label class="labels w-100 text-start">Philhealth Id Number:</label>
                                                      <input type="text" class="form-control"  readonly id="vphilhealth-number">                           
                                                  </div>
                                                  <div class="col-md-7 input-group-sm mt-4">
                                                      <img class="border border-dark" width="250px" height="150px" id="vphilhealth-id">
                                                  </div>
                                              </div>

                                              <hr class="mt-5">
                                              <h6>UMID Id</h6>
                                              <div class="row mt-2">
                                                  <div class="col-md-5 input-group-sm">
                                                      <label class="labels w-100 text-start">UMID Id Number:</label>
                                                      <input type="text" class="form-control"  readonly id="vumid-number">                           
                                                  </div>
                                                  <div class="col-md-7 input-group-sm mt-4">
                                                      <img class="border border-dark" width="250px" height="150px" id="vumid-id">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>


                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <button type='button' value='<?php echo $fetch['user_id']?>' class='editEmployeeBtn opacity'  data-bs-toggle='modal' data-bs-target='#editEmployeeModal' tabindex='-1' >
                            <i class='fa fa-pencil-square bg-success' data-bs-toggle="tooltip" title="Edit Management details"></i>
                          </button>
                          <div class="modal fade modal-lg" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                            <div class="modal-content" style="background-color: #E6E6E6">
                              <div class="modal-header text-center">
                                <h1 class="modal-title fs-5 textcolor-light" id="editEmployeeModalLabel">Edit Employee</h1>
                              </div>
                              <div class="modal-body">

                                <form id="edit-employee"  enctype="multipart/form-data">
                                      <div class="alert alert-warning d-none" id="errorMessage_update" ></div>
                                      <div class="row">
                                          <input type="hidden" name="user_id" id="user_id">
                                          <div class="col form-group mb-4 ">
                                            <label class="w-100 label mb-1 text-start">Last Name: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="last-name" name="last-name">
                                          </div>
                                          <div class="col form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">First Name: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="first-name" name="first-name">
                                          </div>  
                                          <div class="col form-group mb-4 text-start">
                                            <label class="w-100 label mb-1">Middle Initial: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="middle-initial" name="middle-initial">
                                          </div>               
                                      </div>
                                      <div class="row">
                                          <div class="col col-4 form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Birthdate: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="date" id="birthdate" name="birthdate">
                                          </div>
                                          <div class="col col-4 form-group mb-4">
                                            <label class="w-100 mb-1 text-start">Sex: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="sex" name="sex">
                                          </div>         
                                      </div>
                                      <div class="row">
                                          <div class="col  form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Address 1: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="address-first" name="address-first">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col  form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Address 2 (Province): </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="address-second" name="address-second">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Position: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="position" name="position">
                                          </div>
                                          <div class="col form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Department: </label>
                                            <select class="form-select col-sm-5 border border-dark shadow form-bg" type="text" id="department" name="department">
                                              <option selected></option>
                                              <option>Management</option>
                                              <option>Technical</option>
                                              <option>Accounting</option>
                                              <option>Human Resource</option>  
                                            </select>
                                          </div>  
                                          <div class="col form-group mb-4 text-start">
                                            <label class="w-100 label mb-1">Privileges: </label>
                                            <select class="form-select col-sm-5 border border-dark shadow form-bg" type="text" id="privileges" name="privileges">
                                              <option selected></option>
                                              <option>Admin</option>
                                              <option>Power user</option>
                                              <option>User</option> 
                                            </select>
                                          </div>               
                                      </div>
                                      <div class="row">
                                          <div class="col form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Date Hired: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="date" id="date-hired" name="date-hired">
                                          </div>
                                          <div class="col form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Contact Number: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="contact-number" name="contact-number">
                                          </div>  
                                          <div class="col form-group mb-4 text-start">
                                            <label class="w-100 label mb-1">Email Address: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="email" id="email-address" name="email-address">
                                          </div>               
                                      </div>
                                      <div class="row">
                                          <div class="col col-8 form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Person to Contact In Case of Emergency: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="emergency-contact-person" name="emergency-contact-person">
                                          </div>
                                          <div class="col form-group mb-4">
                                            <label class="w-100 label mb-1 text-start">Contact Number: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" id="emergency-contact-number" name="emergency-contact-number">
                                          </div>               
                                      </div>
                                      <div class="row">
                                          <div class="col form-group mb-4">
                                            <label class="w-100 form-label mb-1 text-start">Password: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg"  type="password" id="password" name="password">
                                          </div>
                                          <div class="col form-group mb-4">
                                            <label class="w-100 form-label mb-1 text-start">Confirm Password: </label>
                                            <input class="form-control col-sm-5 border border-dark shadow form-bg" type="password" id="confirm-password" name="confirm-password">
                                          </div>       
                                       </div>

                                       <div class="row">
                                        <div class="col form-group mb-4">
                                          <label for="profile-picture" class="w-100 label mb-1 text-start">Select Profile Picture to Upload:</label><br>
                                          <div class="w-100 text-start">
                                              <span id="profile-id-file-name" style="font-size: small;"></span>
                                          </div>
                                          <input type="file" class="form-control col-sm-5 border border-dark shadow form-bg d-none" name="profile-picture" id="picture">
                                        </div>
                                       </div>
                                       <div class="row mt-3">
                                        <hr class="px-3">
                                        <label class="w-100 form-label mb-1 text-start">Upload Id/s</label>
                                        <div class="row">
                                            <div class="col form-group mb-4">
                                                <label class="w-100 form-label mb-1 text-start">SSS Id Number:</label>
                                                <input class="form-control border border-dark shadow form-bg" type="text" name="sss-number" id="sss-number" readonly>
                                            </div>
                                            <div class="col form-group mb-4">
                                                <label class="w-100 form-label mb-1 text-start" for="sss-id">SSS Id:</label>
                                                <div>
                                                    <span id="sss-id-file-name" style="font-size: small;"></span>
                                                </div>
                                                <input type="file" class="form-control border border-dark shadow form-bg d-none" name="sss-id" id="sss-id" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group mb-4">
                                                <label class="w-100 form-label mb-1 text-start">Philhealth Id Number:</label>
                                                <input class="form-control border border-dark shadow form-bg" type="text" name="philhealth-number" id="philhealth-number" readonly>
                                            </div>
                                            <div class="col form-group mb-4">
                                              <label class="w-100 form-label mb-1 text-start " for="philhealth-id">PhilHealth Id: </label>
                                              <div>
                                                  <span id="philhealth-id-file-name" style="font-size: small;"></span>
                                              </div>
                                              <input type="file" class="form-control col-sm-5 border border-dark shadow form-bg d-none" name="philhealth-id">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col form-group mb-4">
                                                <label class="w-100 form-label mb-1 text-start">UMID Id Number:</label>
                                                <input class="form-control border border-dark shadow form-bg" type="text" name="umid-number" id="umid-number" readonly>
                                            </div>
                                            <div class="col form-group mb-4">
                                              <label class="w-100 form-label mb-1 text-start" for="umid-id">UMID Id: </label>
                                              <div>
                                                  <span id="umid-id-file-name" style="font-size: small;"></span>
                                              </div>
                                              <input type="file" class="form-control col-sm-5 border border-dark shadow form-bg d-none" name="umid-id">
                                            </div>
                                        </div>
                                       </div>



                                       <div class="row form-down text-center">
                                            <button type="submit" class="add-btn rounded-5 py-3 w-25 mx-auto mt-5 text-white fw-bold backgroundcolor-red" name="update_employee">Update</button>
                                       </div>
                                  </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                              </div>
                          </div>
                          <button type='button' value='<?php echo $fetch['user_id']?>' class='deleteManagementBtn delete-btn opacity'>
                            <i class='fa fa-trash textcolor-light' data-bs-toggle="tooltip" title="Delete User"></i>
                          </button>
                      </td>                          
                    </tr>

                <?php }?>  
                </tbody>
            </table>
          </div>
        </div> 
      </div>
    </div>
</div>
<script src="./js/menu.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

//Getting id of the product
$(document).on('click', '.editEmployeeBtn', function()
{
   var user_id = $(this).val();

   $.ajax({
      type: 'GET',
      url: 'serverCode.php',
      data: { editEmployee: true, user_id: user_id }, // Send 'editManagement' parameter
      success: function(response) {
         var res = jQuery.parseJSON(response);
         console.log(res);
         if (res.status == 404) 
         {
               alert(res.message);

         } else if (res.status == 200) 
         {
            // assigning value to the edit user form
            $('#user_id').val(res.data.user_id);
            $('#last-name').val(res.data.last_name);
            $('#first-name').val(res.data.first_name);
            $('#middle-initial').val(res.data.middle_initial);
            $('#birthdate').val(res.data.birthdate);
            $('#sex').val(res.data.sex);
            $('#address-first').val(res.data.address_first);
            $('#address-second').val(res.data.address_province);
            $('#position').val(res.data.position);
            $('#department').val(res.data.department);
            $('#privileges').val(res.data.privileges);
            $('#date-hired').val(res.data.date_hired);
            $('#contact-number').val(res.data.contact_number);
            $('#email-address').val(res.data.email_address);
            $('#emergency-contact-person').val(res.data.emergency_contact_person);
            $('#emergency-contact-number').val(res.data.emergency_contact_number);
            $('#password').val(res.data.password);
            $('#confirm-password').val(res.data.password);
            $('#sss-number').val(res.data.sss_number);
            $('#philhealth-number').val(res.data.philhealth_number);
            $('#umid-number').val(res.data.umid_number);

            // Function to get the path directory of the id's (SSS/PHILHEALTH/UMID)
            function getPath(idPath) {
            // Extract the directory path
            var idDirectory = idPath.substring(0, idPath.lastIndexOf('/'));
            // Get the filename
            var idFilename = idPath.substring(idPath.lastIndexOf('/') + 1);
 

            return idFilename;
          };

            $('#sss-id-file-name').html(getPath(res.data.sss_file_path));
            $('#philhealth-id-file-name').html(getPath(res.data.philhealth_file_path));
            $('#umid-id-file-name').html(getPath(res.data.umid_file_path));
          

          //Getting profile image directory
          let filePath = res.data.profile_image_path;
          // Get the directory path
          var directory = filePath.substring(0, filePath.lastIndexOf('/'));

          // Extract the directory name
          var directoryName = directory.substring(directory.lastIndexOf('/') + 1);

          // Extract the filename
          var filename = filePath.substring(filePath.lastIndexOf('/') + 1);
          $('#profile-id-file-name').html( filename);


         }
      }
   });
});

//For viewing of employee details
$(document).on('click', '.viewEmployeeBtn', function()
{
   var user_id = $(this).val();

   $.ajax({
      type: 'GET',
      url: 'serverCode.php',
      data: { editEmployee: true, user_id: user_id }, 
      success: function(response) {
         var res = jQuery.parseJSON(response);
         console.log(res);
         if (res.status == 404) 
         {
               alert(res.message);

         } else if (res.status == 200) 
         {
            // assigning value to the edit user form
            $('#vname').val(res.data.first_name + ' '  + res.data.middle_initial + '. ' + res.data.last_name );
            $('#vbirthday').val(res.data.birthdate);
            $('#vsex').val(res.data.sex);
            $('#vaddress').val(res.data.address_first + ', ' + res.data.address_province);
            $('#vposition').val(res.data.position);
            $('#vdepartment').val(res.data.department);
            $('#vprivileges').val(res.data.privileges);
            $('#vdate-hired').val(res.data.date_hired);
            $('#vcontact-number').val(res.data.contact_number);
            $('#vemail-address').val(res.data.email_address);
            $('#vemergency-contact-person').val(res.data.emergency_contact_person);
            $('#vemergency-contact-number').val(res.data.emergency_contact_number);
            $('#vpassword').val(res.data.password);
            $('#vsss-number').val(res.data.sss_number);
            $('#vphilhealth-number').val(res.data.philhealth_number);
            $('#vumid-number').val(res.data.umid_number);

            // Function to get the path directory of the id's (SSS/PHILHEALTH/UMID)
            function getPath(idPath) {
              // Extract the directory path
              var idDirectory = idPath.substring(0, idPath.lastIndexOf('/'));
              // Get the filename
              var idFilename = idPath.substring(idPath.lastIndexOf('/') + 1);
              // Construct the desired path
              var desiredIdPath = '/' + idDirectory.substring(idDirectory.indexOf('employeeImages')) + '/' + idFilename;
              return desiredIdPath;
            };


            $('#vsss-id').attr('src', getPath(res.data.sss_file_path));
            $('#vphilhealth-id').attr('src', getPath(res.data.philhealth_file_path));
            $('#vumid-id').attr('src', getPath(res.data.umid_file_path));
            
   
            //Getting profile image directory
            let filePath = res.data.profile_image_path;
            // Get the directory path
            var directory = filePath.substring(0, filePath.lastIndexOf('/'));

            // Extract the directory name
            var directoryName = directory.substring(directory.lastIndexOf('/') + 1);

            // Extract the filename
            var filename = filePath.substring(filePath.lastIndexOf('/') + 1);

            // Construct the desired path
            var desiredPath = "/" + directoryName + "/" + filename;
            $('#vuser-profile').attr('src', desiredPath);
         }
      }
   });
});

//Updating the user
$(document).on('submit', '#edit-employee', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append('update_employee', true);

    $.ajax({
        type: 'POST',
        url: 'serverCode.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
             console.log(response);
            var res = jQuery.parseJSON(response);
            
            if (res.status == 422) {
                // Show error message inside the modal
                $('#errorMessage_update').removeClass('d-none');
                $('#errorMessage_update').text(res.message);
            } else if (res.status == 200) {
                alert(res.message);
                $('#errorMessage_update').addClass('d-none');
                $('#editManagementModal').modal('hide');
                $('#update-management')[0].reset();

                // Reload the table
                $('#table-content').load(location.href + ' #table-content');
            }else if(res.status == 500) {
               alert(res.message);
            }
        }
    });
});

//Deleting user
$(document).on('click', '.deleteManagementBtn', function (e) {
   e.preventDefault();

   if(confirm('Are you sure you want to delete this user?'))
   {
         var user_id = $(this).val();
         $.ajax({
            type: "POST",
            url: "serverCode.php",
            data: {
               'delete_employee': true,
               'user_id': user_id
            },
            success: function (response) {
               var res = jQuery.parseJSON(response);
               if(res.status == 500) {

                     alert(res.message);
               }else{
                  alert(res.message);
                  // Reload the table
                  $('#table-content').load(location.href + ' #table-content');
                  
               }
            }
         });
   }
});

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
</body>
</html>