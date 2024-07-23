<?php 
$pageName = "Add Employee";
include ('opening.php');

?>



      <!-- Every page content is included here -->
      <div class="container d-flex align-items-center justify-content-center mt-2" id="main-content">
        <div class="container d-flex flex-column ms-3">
          <div class="box content d-flex align-items-center"> <!-- Added 'd-flex align-items-center' class to make the image and text align vertically -->
            <img src="./img/personnel.png">
            <div class="box w-100"> <!-- Adjusted class to 'box w-50' -->
                <p class="box lead bold">
                  “Our team is a group of professional Technical Support Engineer with highly motivated skills and knowledge to support our Client's needs and requirements. Combine with our friendly, supportive and accommodating HR, Accounting & Marketing Team..”
                </p>
            </div>
          </div>
        </div>
      </div>
        <br><br>
        <div class="w-100 text-center">
          <button class="btn btn-lg fw-bold text-white backgroundcolor-red btn-shadow" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Employee Form</button>
          <div class="modal fade modal-lg" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" style="background-color: #E6E6E6">
                <div class="modal-header text-center">
                  <h1 class="modal-title fs-5 textcolor-light" id="addEmployeeModalLabel">Add Employee</h1>
                </div>
                <div class="modal-body">
                  <div class="alert alert-warning d-none" id="errorMessage" >
                  </div>
                  <form id="add-employee" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col form-group mb-4 ">
                              <label class="w-100 label mb-1 text-start">Last Name: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="last-name">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">First Name: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="first-name">
                            </div>  
                            <div class="col form-group mb-4 text-start">
                              <label class="w-100 label mb-1">Middle Initial: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="middle-initial">
                            </div>               
                        </div>
                        <div class="row">
                            <div class="col col-4 form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Birthdate: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="date" name="birthdate">
                            </div>
                            <div class="col col-4 form-group mb-4">
                              <label class="w-100 mb-1 text-start">Sex: </label>
                              <select class="form-select col-sm-5 border border-dark shadow form-bg" type="text" name="sex">
                                <option selected></option>
                                <option>Female</option>
                                <option>Male</option>
                              </select>
                            </div>         
                        </div>
                        <div class="row">
                            <div class="col  form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Address 1: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="address-first">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col  form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Address 2 (Province): </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="address-second">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Position: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="position">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Department: </label>
                              <select class="form-select col-sm-5 border border-dark shadow form-bg" type="text" name="department">
                                <option selected></option>
                                <option>Management</option>
                                <option>Technical</option>
                                <option>Accounting</option>
                                <option>Human Resource</option>  
                              </select>
                            </div>  
                            <div class="col form-group mb-4 text-start">
                              <label class="w-100 label mb-1">Privileges: </label>
                              <select class="form-select col-sm-5 border border-dark shadow form-bg" type="text" name="privileges">
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
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="date" name="date-hired">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Contact Number: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="contact-number">
                            </div>  
                            <div class="col form-group mb-4 text-start">
                              <label class="w-100 label mb-1">Email Address: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="email" name="email-address">
                            </div>               
                        </div>
                        <div class="row">
                            <div class="col col-8 form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Person to Contact In Case of Emergency: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="emergency-contact-person">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 label mb-1 text-start">Contact Number: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg" type="text" name="emergency-contact-number">
                            </div>               
                        </div>
                        <div class="row">
                            <div class="col form-group mb-4">
                              <label class="w-100 form-label mb-1 text-start">Password: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg"  type="password" name="password">
                            </div>
                            <div class="col form-group mb-4">
                              <label class="w-100 form-label mb-1 text-start">Confirm Password: </label>
                              <input class="form-control col-sm-5 border border-dark shadow form-bg"  type="password" name="confirm-password">
                            </div>       
                        </div>
                        <div class="row">
                          <div class="col form-group mb-4">
                            <label for="profile-picture" class="w-100 label mb-1 text-start">Select Profile Picture to Upload:</label><br>
                            <input type="file" class="form-control col-sm-5 border border-dark shadow form-bg" name="profile-picture" value="Please upload your photo">
                          </div>
                        </div>
                        <div class="row mt-3">
                          <hr class="px-3">
                          <label class="w-100 form-label mb-1 text-start">Upload Id/s</label>
                          <div class="row">
                              <div class="col form-group mb-4">
                                  <label class="w-100 form-label mb-1 text-start">SSS Id Number:</label>
                                  <input class="form-control border border-dark shadow form-bg" type="text" name="sss-number">
                              </div>
                              <div class="col form-group mb-4">
                                  <label class="w-100 form-label mb-1 text-start" for="sss-id">SSS Id:</label>
                                  <input type="file" class="form-control border border-dark shadow form-bg" name="sss-id">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col form-group mb-4">
                                  <label class="w-100 form-label mb-1 text-start">Philhealth Id Number:</label>
                                  <input class="form-control border border-dark shadow form-bg" type="text" name="philhealth-number">
                              </div>
                              <div class="col form-group mb-4">
                                <label class="w-100 form-label mb-1 text-start" for="philhealth-id">PhilHealth Id: </label>
                                <input type="file" class="form-control col-sm-5 border border-dark shadow form-bg" name="philhealth-id">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col form-group mb-4">
                                  <label class="w-100 form-label mb-1 text-start">UMID Id Number:</label>
                                  <input class="form-control border border-dark shadow form-bg" type="text" name="umid-number">
                              </div>
                              <div class="col form-group mb-4">
                                <label class="w-100 form-label mb-1 text-start" for="umid-id">UMID Id: </label>
                                <input type="file" class="form-control col-sm-5 border border-dark shadow form-bg" name="umid-id">
                              </div>
                          </div>
                        </div>
                        <div class="row form-down text-center">
                          <button type="submit" class="add-btn rounded-5 py-3 w-25 mx-auto mt-5 text-white fw-bold backgroundcolor-red" name="add_employee">add new employee</button>
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

      else if (res.status == 404 || res.status == 500) {
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