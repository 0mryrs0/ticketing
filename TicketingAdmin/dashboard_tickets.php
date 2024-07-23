
<?php 
$pageName = "Dashboard";
include ('opening.php');

?>
      <!-- Every page content is included here -->
      <div class= "flex-row justify-content-center align-items-center" id="main-content" style="position:relative; z-index: 100;"> 
        <div class="container gap-2 d-flex justify-content-center align-items-center flex-wrap mt-5  " >
          <div class="d-flex flex-row gap-4">
            <div class="card h-50 dashboard-card rounded-0">
                <div class="card-body bg-white text-center text-danger d-flex flex-column justify-content-center align-items-center">
                  <h3 class="card-title">New Ticket</h3>
                  <h3 class="card-text">
                  <?php 
                  $query = "SELECT COUNT(*) as total_rows FROM tickets WHERE (ticket_status='REQUEST' OR ticket_status='REQUEST(ESCALATION)') AND tech_support_name = 'No tech support assigned yet'";
                  $result = mysqli_query($conn, $query);
                  $row = mysqli_fetch_assoc($result);
                  $total_rows = $row['total_rows'];
                  echo $total_rows;
                   ?>
                  </h3>
                </div>
            </div>
            <div class="card h-50 dashboard-card rounded-0">
                <div class="card-body bg-white text-center text-danger d-flex flex-column justify-content-center align-items-center">
                  <h3 class="card-title">On-Going Ticket</h3>
                  <h3 class="card-text">
                    <?php 
                    $query = "SELECT COUNT(*) as total_rows FROM tickets WHERE ticket_status = 'ON-GOING' ";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_rows = $row['total_rows'];
                    echo $total_rows;
                    ?>
                  </h3>
                </div>
            </div> 
            <div class="card h-50 dashboard-card rounded-0">
                <div class="card-body bg-white text-center text-danger d-flex flex-column justify-content-center align-items-center">
                  <h3 class="card-title">All Ticket</h3>
                  <h3 class="card-text">
                  <?php 
                    $query = "SELECT COUNT(*) as total_rows FROM tickets";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_rows = $row['total_rows'];
                    echo $total_rows;
                    ?>
                  </h3>
                </div>
            </div>
         </div>
        </div>
      
      <div>
      
    </div>
    <div class="container mt-2 h-100 overflow-y-auto">
        <h4 class="table-title mt-5 ms-3 text-danger">Ticket Requests</h4>
        <div class="mt-2" id="table" style="height: 70vh">
          <table class="table table-danger table-hover table-fs text-center default-table table-bordered align-middle px-3 fs-6" id='table-content'>
              <thead class="table-dark">
                <!-- sample content -->
              <tr>
                    <th>Transaction ID</th>
                    <th>Client Name</th>
                    <th>Company Name</th>
                    <th>Contact Number</th>
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
                    <td><?php echo $fetch['company_name']?></td>
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
</div>

<script src="./js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>



</script>
</body>
</html>