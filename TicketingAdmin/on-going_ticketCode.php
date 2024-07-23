<?php 
include("../config/db_connect.php");
// <________SEARCH  PRODUCT FORM HANDLER_______________>
if(isset($_POST['searchInput'])) 
{
   $searchInput = $_POST['searchInput'];

   $query = "SELECT * FROM tickets WHERE ticket_id LIKE '%{$searchInput}%' AND  ticket_status = 'ON-GOING'";
   $result = mysqli_query($conn, $query);
        if($result) 
        {
            if(mysqli_num_rows($result) > 0) 
            {   
            ?>
            <table class="table table-danger table-hover table-fs text-center search-table table-sm table-bordered align-middle px-3 fs-6" id='table-content'>
                <thead class="table-dark">
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
                    while($fetch = mysqli_fetch_assoc($result)) {
                        $ticketId = $fetch['ticket_id'];
                        $clientName = $fetch['client_name'];
                        $clientNumber = $fetch['client_number'];
                        $serviceAcquired = $fetch['problem_description'];
                        $handledBy = $fetch['tech_support_name'];
                        $status = $fetch['ticket_status'];
                        $level = $fetch['ticket_level'];

                    ?>

               <tr >
                  <td><?php echo $ticketId?></td>
                  <td><?php echo $clientName?></td>
                  <td><?php echo $clientNumber?></td>
                  <td><?php echo $serviceAcquired?></td>
                  <td> <?php echo $handledBy?></td>
                  <td> <?php echo $status?></td>
                  <td> <?php echo $level?></td>
               </tr>

               <?php } ?>
                </tbody>

            </table>
            <?php
            }
            else 
            {
                echo "<h3 class='text-danger text-center search-table'> Data not found</h3>";
            }
        
        }
}

?>

