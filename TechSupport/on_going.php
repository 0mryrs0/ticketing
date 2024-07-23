<?php 
$pageName = "On-going Tickets";
include ('opening.php');

?>
    

      <!-- Every page content is included here -->
      
      <div class="container mt-2 h-100 overflow-y-auto">
        <div class="mt-2" id="table" style="height: 70vh">
          <table class="table table-danger table-hover  text-center default-table table-sm table-bordered align-middle px-1" id='table-content'>
              <thead class="table-dark">
                <!-- sample content -->
              <tr>
                    <th>Transaction ID</th>
                    <th>Client Name</th>
                    <th>Service Request</th> 
                    <th>Status</th>
                    <th>Level</th>
                    <th class="action action-column" >Action</th> 
                </tr> 
              </thead>
                <tbody>
                <?php
              //Getting the data from the database
              $techName = $user_data['first_name'] . ' ' . $user_data['last_name'];
              $query = "SELECT * FROM tickets WHERE ticket_status='ON-GOING' AND tech_support_name='$techName'";
              $result = mysqli_query($conn, $query);
              while ($fetch = mysqli_fetch_array($result)) {

              ?>
                  <tr class="">
                    <!--Displaying the data in table form -->
                    <td><?php echo $fetch['ticket_id']?></td>
                    <td><?php echo $fetch['client_name']?></td>
                    <td><?php echo $fetch['problem_description']?></td>
                    <td><?php echo $fetch['ticket_status']?></td>
                    <td>Level <?php echo $fetch['ticket_level']?></td>
                    <td class = "">          
                      <button type='button' class='border border-0 bg-transparent'  data-bs-toggle="modal" data-bs-target="#resolvedTicketModal" >
                        <img src="../img/solved.svg" class="w-75 action-btn opacity " data-bs-toggle="tooltip" title="Resolved Ticket">
                      </button>

                      <!-- Modal for Resolved Ticket-->
                      <div class="modal fade" id="resolvedTicketModal" tabindex="-1" aria-labelledby="resolvedTicketModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="resolvedTicketModalLabel">Resolved Ticket Report</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="alert alert-warning d-none" id="errorMessage" >
                              </div>
                              <form id="resolved_ticket">
                                <div class="mb-3 ">
                                  <input type="hidden" value="Resolved" name="status">
                                  <label for="ticket-id" class="w-100 form-label text-start">Ticket Id:</label>
                                  <input type="text" class="form-control" id="ticket-id" value='<?php echo $fetch['ticket_id']?>' readonly name="ticket-id">
                                </div>
                                <div class="mb-3">
                                  <label for="technical-support" class="form-label w-100 text-start">Technical Support:</label>
                                  <input type="text" class="form-control" id="technical-support" value='<?php echo $fetch['tech_support_name']?>' readonly name="technical-support">
                                </div>
                                <div class="mb-3">
                                  <label for="initial-findings" class="form-label w-100 text-start">Initial Findings:</label>
                                  <textarea class="form-control" id="initial-findings" rows="3" name="initial-findings"></textarea>
                                </div>
                                <div class="mb-3">
                                  <label for="service-done" class="form-label w-100 text-start">Service Done:</label>
                                  <textarea class="form-control" id="service-done" rows="3" name="service-done"></textarea>
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

                      <?php 
                      if ($fetch['ticket_level'] == 3) {

                      ?>
                          <button type='button' class='border border-0 bg-transparent'  data-bs-toggle="modal" data-bs-target="#closeTicketModal">
                            <img src="../img/unsolved.svg" class="w-75 action-btn opacity " data-bs-toggle="tooltip" title="Unsolved ticket">
                          </button>


                      <?php
                      } else {
                      ?>
                          <button type='button' class='border border-0 bg-transparent escalation-btn'  data-bs-toggle="modal" data-bs-target="#escalationTicketModal">
                            <img src="../img/unsolved.svg" class="w-75 action-btn opacity " data-bs-toggle="tooltip" title="Escalation Ticket">
                          </button>

                      <?php
                      }
                      ?>

                      <!-- Modal for Unsolved Ticket-->
                      <div class="modal fade" id="closeTicketModal" tabindex="-1" aria-labelledby="closeTicketModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="closeTicketModalLabel">Ticket Report (Unsolved Ticket)</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="alert alert-warning d-none" id="errorMessage" >
                              </div>
                              <form id="unsolved_ticket_report">
                                <div class="mb-3 ">
                                  <input type="hidden" value="UNSOLVED" name="status">
                                  <label for="ticket-id" class="w-100 form-label text-start">Ticket Id:</label>
                                  <input type="text" class="form-control" id="ticket-id" value='<?php echo $fetch['ticket_id']?>' readonly name="ticket-id">
                                </div>
                                <div class="mb-3">
                                  <label for="technical-support" class="form-label w-100 text-start">Technical Support:</label>
                                  <input type="text" class="form-control" id="technical-support" value='<?php echo $fetch['tech_support_name']?>' readonly name="technical-support">
                                </div>
                                <div class="mb-3">
                                  <label for="initial-findings" class="form-label w-100 text-start">Initial Findings:</label>
                                  <textarea class="form-control" id="initial-findings" rows="3" name="initial-findings"></textarea>
                                </div>
                                <div class="mb-3">
                                  <label for="service-done" class="form-label w-100 text-start">Service Done/Reason for usolved ticket:</label>
                                  <textarea class="form-control" id="service-done" rows="3" name="service-done"></textarea>
                                </div>
                                <div class="row form-down text-center">
                                      <button type="submit" class="add-btn rounded-5 py-3 w-25 mx-auto mt-5 text-white fw-bold backgroundcolor-red" value='<?php echo $fetch['ticket_id']?>' name="add-ticket">Submit</button>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal for Escalation Ticket-->
                      <div class="modal fade" id="escalationTicketModal" tabindex="-1" aria-labelledby="escalationTicketModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="escalationTicketModalLabel">Ticket Report (for Escalation)</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="alert alert-warning d-none" id="errorMessage" >
                              </div>
                              <form id="escalation_ticket_report">
                                <div class="mb-3 ">
                                  <input type="hidden" value="REQUEST(ESCALATION)" name="status">
                                  <label for="ticket-id" class="w-100 form-label text-start">Ticket Id:</label>
                                  <input type="text" class="form-control" id="ticket-id" value='<?php echo $fetch['ticket_id']?>' readonly name="ticket-id">
                                </div>
                                <div class="mb-3">
                                  <label for="technical-support" class="form-label w-100 text-start">Technical Support:</label>
                                  <input type="text" class="form-control" id="technical-support" value='<?php echo $fetch['tech_support_name']?>' readonly name="technical-support">
                                </div>
                                <div class="mb-3">
                                  <label for="initial-findings" class="form-label w-100 text-start">Initial Findings:</label>
                                  <textarea class="form-control" id="initial-findings" rows="3" name="initial-findings"></textarea>
                                </div>
                                <div class="mb-3">
                                  <label for="service-done" class="form-label w-100 text-start">Service Done:</label>
                                  <textarea class="form-control" id="service-done" rows="3" name="service-done"></textarea>
                                </div>
                                <div class="row form-down text-center">
                                      <button type="submit" class="add-btn rounded-5 py-3 w-25 mx-auto mt-5 text-white fw-bold backgroundcolor-red" value='<?php echo $fetch['ticket_id']?>' name="add-ticket">Submit</button>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
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

<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
<script>
//Adding Product
$(document).on('submit', '#resolved_ticket', function(e) 
{
   e.preventDefault();

   var formData = new FormData(this);
   formData.append('resolved_ticket_report', true);

   $.ajax({
   type: 'POST',
   url: 'dashboard_techCode.php',
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
         $('#resolvedTicketModal').modal('hide');
         $('#resolved_ticket')[0].reset();

         // Reload the table
         $('#table-content').load(location.href + ' #table-content');
      }
   },
   error: function(jqXHR, textStatus, errorThrown) {
   console.log("AJAX request failed: " + errorThrown);
   }
   });
});


$(document).on('submit', '#escalation_ticket_report', function(e) 
{
   e.preventDefault();

   var formData = new FormData(this);
   formData.append('escalation_ticket_report', true);

   $.ajax({
   type: 'POST',
   url: 'dashboard_techCode.php',
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
         $('#escalationTicketModal').modal('hide');
         $('#escalation_ticket_report')[0].reset();

         // Reload the table
         $('#table-content').load(location.href + ' #table-content');
      }
   },
   error: function(jqXHR, textStatus, errorThrown) {
   console.log("AJAX request failed: " + errorThrown);
   }
   });
});


$(document).on('submit', '#unsolved_ticket_report', function(e) 
{
   e.preventDefault();

   var formData = new FormData(this);
   formData.append('unsolved_ticket_report', true);

   $.ajax({
   type: 'POST',
   url: 'dashboard_techCode.php',
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
         $('#closeTicketModal').modal('hide');
         $('#unsolved_ticket_report')[0].reset();

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

</script>
</body>
</html>