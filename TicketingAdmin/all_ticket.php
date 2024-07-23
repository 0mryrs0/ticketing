<?php 
$pageName = "All Ticket";
include ('opening.php');

?>



      <!-- Every page content is included here -->
      <div class= "flex-column justify-content-center align-items-center" id="main-content"> <!-- style="position:relative; z-index: 100;" -->
        <div class="container gap-2 d-flex justify-content-center align-items-center flex-wrap mt-3">
          
        <div class="d-flex flex-column gap-2">
            <div class="click card dashboard-card rounded-0">
               <div class="card-body text-center text-white d-flex flex-column justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#openTicketModal" >
                  <h3 class="card-title"><i class="fa-solid fa-ticket fa-xl "></i><br><br> Open Ticket</h3>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade modal-xl" id="openTicketModal" tabindex="-1" aria-labelledby="openTicketModalLabel" aria-hidden="true" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="openTicketModalLabel">Open Ticket</h1>
                  </div>
                  <div class="modal-body">
                    <div class="container mt-2 h-100 overflow-y-auto">
                        <div class="mt-2" id="table" style="height: 70vh">
                          <table class="table table-danger table-hover table-fs text-center default-table table-bordered align-middle px-3 fs-6" id='table-content'>
                              <thead class="table-dark">
                                <!-- sample content -->
                              <tr>
                                    <th>Ticket ID</th>
                                    <th>Client Name</th>
                                    <th>Contact Number</th></th>
                                    <th>Service Request</th> 
                                    <th>Tech Support Assigned</th> 
                                    <th>Level</th>
                                </tr> 
                              </thead>
                                <tbody>
                                <?php
                              //Getting the data from the database
                              $query = "SELECT * FROM tickets WHERE (ticket_status='REQUEST' OR ticket_status='REQUEST(ESCALATION)') AND tech_support_name= 'No tech support assigned yet'";
                              $result = mysqli_query($conn, $query);
                              while ($fetch = mysqli_fetch_array($result)) {

                              ?>
                                  <tr>
                                    <!--Displaying the data in table form -->
                                    <td><?php echo $fetch['ticket_id']?></td>
                                    <td><?php echo $fetch['client_name']?></td>
                                    <td><?php echo $fetch['client_number']?></td>
                                    <td><?php echo $fetch['problem_description']?></td>
                                    <td>No assigned yet</td> 
                                    <td>Level <?php echo $fetch['ticket_level']?></td>                    
                                  </tr>

                              <?php }?>  
                              </tbody> 
                          </table>
                        </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>


            <div class="click card dashboard-card rounded-0">
                <div class="card-body text-center text-white d-flex flex-column justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#closedTicketModal">
                  <h3 class="card-title"><i class="fa-solid fa-rectangle-xmark fa-xl"></i><br><br> Closed Ticket</h3>
                </div>
            </div> 
            <!-- Modal -->
            <div class="modal fade modal-xl" id="closedTicketModal" tabindex="-1" aria-labelledby="closedTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="openTicketModalLabel">Closed Ticket</h1>
                  </div>
                  <div class="modal-body">
                   <div class="container mt-2 h-100 overflow-y-auto">
                      <div class="mt-1" id="table" style="height: 70vh">
                        <table class="table table-danger table-hover table-fs text-center default-table table-bordered align-middle px-3 fs-6" id='table-content'>
                            <thead class="table-dark">
                            <!-- sample content --> 
                              <tr>
                                  <th>Ticket Id</th>
                                  <th>Client Name</th>
                                  <th>Contact Number</th></th>
                                  <th>Service Acquired</th> 
                                  <th>Handled By</th>
                                  <th>Status</th>
                                  <th>Level</th>
                              </tr> 
                              
                            </thead>                  
                            <tbody>
                            <?php
                            //Getting the data from the database
                            $query = "SELECT * FROM tickets WHERE ticket_status = 'RESOLVED' ";
                            $result = mysqli_query($conn, $query);
                            while ($fetch = mysqli_fetch_array($result)) 
                            {
                            ?>
                                <tr>
                                  <!--Displaying the data in table form -->
                                  <td><?php echo $fetch['ticket_id']?></td>
                                  <td><?php echo $fetch['client_name']?></td>
                                  <td><?php echo $fetch['client_number']?></td>
                                  <td><?php echo $fetch['problem_description']?></td>
                                  <td><?php echo $fetch['tech_support_name']?></td>               
                                  <td><?php echo $fetch['ticket_status']?></td>
                                  <td>Level <?php echo $fetch['ticket_level']?></td>            
                                </tr>

                            <?php }?>  
                            </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

          </div>


        <div class="d-flex flex-column gap-2">
            <div class=" click card  dashboard-card rounded-0">
                <div class="card-body text-center text-white d-flex flex-column justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#ongoingTicketModal">
                  <h3 class="card-title"><i class="fa-solid fa-bars-progress fa-xl"></i><br><br> On-Going Ticket</h3>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade modal-xl" id="ongoingTicketModal" tabindex="-1" aria-labelledby="ongoingTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ongoingTicketModalLabel">On-Going Ticket</h1>
                  </div>
                  <div class="modal-body">

                    <div class="container mt-2 h-100 overflow-y-auto">
                      <div class="mt-1" id="table" style="height: 70vh">
                        <table class="table table-danger table-hover table-fs text-center default-table table-bordered align-middle px-3 fs-6" id='table-content'>
                            <thead class="table-dark">
                            <!-- sample content --> 
                            <tr>
                              <th>Ticket ID</th>
                              <th>Client Name</th>
                              <th>Contact Number</th></th>
                              <th>Service Acquired</th> 
                              <th>Handled By</th>
                              <th>Status</th>
                          </tr> 
                          
                          </thead>                  
                          <tbody>
                          <?php
                            //Getting the data from the database
                            $query = "SELECT * FROM tickets WHERE ticket_status = 'ON-GOING' ";
                            $result = mysqli_query($conn, $query);
                            while ($fetch = mysqli_fetch_array($result)) 
                            {
                            ?>
                                <tr>
                                  <!--Displaying the data in table form -->
                                  <td><?php echo $fetch['ticket_id']?></td>
                                  <td><?php echo $fetch['client_name']?></td>
                                  <td><?php echo $fetch['client_number']?></td>
                                  <td><?php echo $fetch['email_address']?></td>
                                  <td><?php echo $fetch['tech_support_name']?></td>               
                                  <td><?php echo $fetch['ticket_status']?></td>             
                                </tr>

                            <?php }?>  
                          </tbody>
                        </table>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="click card dashboard-card rounded-0">
                <div class="card-body text-center text-white d-flex flex-column justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#unsolvedTicketModal">
                  <h3 class="card-title"><i class="fa fa-circle-exclamation fa-xl" aria-hidden="true"></i><br><br> Unsolved Ticket</h3>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade modal-xl" id="unsolvedTicketModal" tabindex="-1" aria-labelledby="unsolvedTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="unsolvedTicketModalLabel">Unsolved Ticket</h1>
                  </div>
                  <div class="modal-body">

                    <div class="container mt-2 h-100 overflow-y-auto">
                      <div class="mt-1" id="table" style="height: 70vh">
                        <table class="table table-danger table-hover table-fs text-center default-table table-bordered align-middle px-3 fs-6" id='table-content'>
                            <thead class="table-dark">
                            <!-- sample content --> 
                              <tr>
                                  <th>Ticket ID</th>
                                  <th>Client Name</th>
                                  <th>Contact #</th></th>
                                  <th>Service Acquired</th> 
                                  <th>Handled By</th>
                                  <th>Status</th>
                              </tr> 
                              
                            </thead>                  
                            <tbody>
                            <?php
                            //Getting the data from the database
                            $query = "SELECT * FROM tickets WHERE ticket_status = 'UNRESOLVED' ";
                            $result = mysqli_query($conn, $query);
                            while ($fetch = mysqli_fetch_array($result)) 
                            {
                            ?>
                                <tr>
                                  <!--Displaying the data in table form -->
                                  <td><?php echo $fetch['ticket_id']?></td>
                                  <td><?php echo $fetch['client_name']?></td>
                                  <td><?php echo $fetch['client_number']?></td>
                                  <td><?php echo $fetch['email_address']?></td>
                                  <td><?php echo $fetch['tech_support_name']?></td>               
                                  <td><?php echo $fetch['ticket_status']?></td>             
                                </tr>

                            <?php }?>  
                            </tbody>
                        </table>
                      </div>
                    </div>

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
</div>

<script src="./js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>



</script>
</body>
</html>