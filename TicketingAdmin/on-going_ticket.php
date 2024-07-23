<?php 
$pageName = "On-going Tickets";
include ('opening.php');

?>


      <!-- Every page content is included here -->
      <div class= "flex-column justify-content-center" id="main-content"> 
        <div class="container d-flex justify-content-center gap-3 flex-wrap mt-5">
          <div class="container d-flex w-100 justify-content-between search-buttons m-1">
            <input class="p-2 w-25 form-control border-outline-dark" type="search" placeholder="Search" id="search-input" name="search-input" autocomplete="off">
          </div>
        </div>

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
                      <th>Level</th>
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

  </div>
</div>
<script src="./js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
// Search 
$(document).ready(function() {
   $('#search-input').keyup(function() {
      var searchInput = $(this).val();
      //alert(searchInput);

      if(searchInput != "") {
         $('.default-table').hide();
         $.ajax({
            url:'on-going_ticketCode.php',
            method:'POST',
            data: {
               'searchInput':searchInput
            },

            success: function(response) {
               $('.search-table').remove();
               $('#table').append(response);
            }
         })
      }else {
        $('.default-table').show();
        $('.search-table').remove();
      }
   });

});


</script>
</body>
</html>