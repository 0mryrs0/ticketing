<?php 
$pageName = "Technical Support Dashboard";
include ('opening.php');

?>
    



      <!-- Every page content is included here -->
      <div class="container mt-2 h-100 overflow-y-auto">
        <div class="mt-2" id="table" style="height: 70vh">
          <table class="table table-danger table-hover  text-center default-table table-sm table-bordered align-middle px-1" id='table-content'>
              <thead class="table-dark">
                <!-- sample content -->
              <tr>
                    <th>Ticket ID</th>
                    <th>Client Name</th>
                    <th>Contact Number</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Service Request</th> 
                    <th>Level</th> 
                    <th class="action-column" style=" width: 100px">Action</th> 
                </tr> 
              </thead>
              <tbody>
                <?php
                //Getting the data from the database
                $query = "SELECT * FROM tickets WHERE (ticket_status='REQUEST' OR ticket_status='REQUEST(ESCALATION)') AND tech_support_name= 'No tech support assigned yet'";
                $result = mysqli_query($conn, $query);
                while ($fetch = mysqli_fetch_array($result)) {

                ?>
                    <tr class="">
                      <!--Displaying the data in table form -->
                      <td><?php echo $fetch['ticket_id']?></td>
                      <td><?php echo $fetch['client_name']?></td>
                      <td><?php echo $fetch['client_number']?></td>
                      <td><?php echo $fetch['email_address']?></td>
                      <td><?php echo $fetch['address']?></td>
                      <td><?php echo $fetch['problem_description']?></td>
                      <td>Level <?php echo $fetch['ticket_level']?></td>
                      <td>                          
                        <button type='button' class='border border-0 bg-transparent' data-bs-toggle="modal" data-bs-target="#acceptTicketModal" >
                          <img src="../img/check.svg" class="w-75 action-btn opacity" data-bs-toggle="tooltip" title="Accept ticket">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="acceptTicketModal" tabindex="-1" aria-labelledby="acceptTicketModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Approval Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div>
                                  <p>Before accepting this ticket, kindly email your supervisor for approval.</p>

                                  <a type="button" class="btn btn-primary mb-5" href="mailto:?subject=Request%20for%20approving%20technical%20support">Send an email</a>





                                  <p>Click "DONE" after you send an email. Thank you!</p>
                                  <button type='button' value='<?php echo $fetch['ticket_id']?>' class='acceptBtn btn btn-outline-success'>DONE</button>
                                  <input value="<?php echo $user_data['first_name'] . ' ' . $user_data['last_name']?>" id="tech-support-name" name="tech-support-name" type='hidden'>
                                </div>
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
//Approving technical support 


$(document).on('click', '.acceptBtn', function (e) {
   e.preventDefault();

  var ticket_id = $(this).val();
  var technical_name = $('#tech-support-name').val();
  console.log(ticket_id);
  console.log(technical_name);
  $.ajax({
    type: "POST",
    url: "dashboard_techCode.php",
    data: {
        'accept-ticket': true,
        'ticket_id': ticket_id,
        'technical_name': technical_name
    },
    success: function (response) {
        var res = jQuery.parseJSON(response);
        console.log(res)
        if(res.status == 500) {

              alert(res.message);
        }else{
          alert(res.message);
          $('#acceptTicketModal').modal('hide');
          // Reload the table
          $('#table').load(location.href + ' #table');
          
        }
    }
  });
   
});

function composeEmail(recipients) {
    // Specify email subject
    var subject = 'Request for approving technical support';

    // Specify email body
    var body = 'Technical support has  requested to take a ticket. Please open your admin account and take action.';

    // Compose mailto link
    var mailtoLink = 'mailto:' + recipients + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);

    // Open mailto link in new window
    window.open(mailtoLink, '_blank');
}


</script>

</script>
</body>
</html>