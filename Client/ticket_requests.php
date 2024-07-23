<?php 
$pageName = "Ticket Request Lists";
include ('opening.php');

?>



      <!-- Every page content is included here -->
      <div class="container mt-2 h-100 overflow-y-auto">
        <div class="mt-2" id="table" style="height: 70vh">
          <h2 class="fw-bold textcolor-light mt-3">Tickets</h2>
          <table class="table table-danger table-hover  text-center default-table table-sm table-bordered align-middle px-1" id='table-content'>
              <thead class="table-dark">
                <!-- sample content -->
              <tr>
                    <th>Ticket ID</th>
                    <th>Technical Support</th>
                    <th>Service Request</th> 
                    <th>Status</th>
                    <th>Level</th>
                </tr> 
              </thead>
                <tbody>
                <?php
              //Getting the data from the database
              $clientId = $user_data['client_id'];
              $query = "SELECT * FROM tickets WHERE client_id='$clientId'";
              $result = mysqli_query($conn, $query);
              while ($fetch = mysqli_fetch_array($result)) {

              ?>
                  <tr class="">
                    <!--Displaying the data in table form -->
                    <td><?php echo $fetch['ticket_id']?></td>
                    <td><?php echo $fetch['tech_support_name']?></td>
                    <td><?php echo $fetch['problem_description']?></td>
                    <td><?php echo $fetch['ticket_status']?></td>
                    <td>Level <?php echo $fetch['ticket_level']?></td>            
                  </tr>

              <?php }?>  
              </tbody> 
          </table>
        </div>
      </div>
</div>

<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



</body>
</html>