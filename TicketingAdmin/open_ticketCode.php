<?php 
include("../config/db_connect.php");

if(isset($_POST['tech_support_request']))
{
    $ticket_id = $_POST['ticket_id'];

    $query = "UPDATE tickets SET ticket_status='ON-GOING' WHERE ticket_id = '$ticket_id'";
    

    $updateQuery = "UPDATE notification_tickets SET isClicked=1 WHERE ticket_id = '$ticket_id'";
    $newResult = mysqli_query($conn, $updateQuery);

    if(mysqli_query($conn, $query))
    {
        $response = [
            'status' => 200,
            'message' => 'Tech support was been assigned. Ticket request is on-going'
        ];
        echo json_encode($response);
        return;
    }
    else
    {
        $response = [
            'status' => 500,
            'message' => 'System is unable to approved the request'
        ];
        echo json_encode($response);
        return;
    }
}

// <________SEARCH  PRODUCT FORM HANDLER_______________>
if(isset($_POST['searchInput'])) 
{
   $searchInput = $_POST['searchInput'];

   $query = "SELECT * FROM tickets WHERE  ticket_id LIKE '%{$searchInput}%' AND  ticket_status = 'REQUEST' AND tech_support_name != 'No tech support assigned yet'";
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
                    <th class="action-column" style="width: 100px">Action</th>
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

                    ?>

               <tr >
                  <td><?php echo $ticketId?></td>
                  <td><?php echo $clientName?></td>
                  <td><?php echo $clientNumber?></td>
                  <td><?php echo $serviceAcquired?></td>
                  <td> <?php echo $handledBy?></td>
                  <td class='action action-column'>
                    <button type='button' value='<?php echo $fetch['ticket_id']?>' class='approveBtn border border-0 bg-transparent'  data-bs-toggle='modal' data-bs-target='#editSupplierModal' tabindex='-1' >
                        <img src="./img/check.svg" class="w-100 action-btn opacity" data-bs-toggle="tooltip" title="Approve">
                    </button>
                    <button type='button' value='<?php echo $fetch['ticket_id']?>' class='disapproveBtn border border-0 bg-transparent'>
                        <img src="./img/wrong.svg" class="w-100 action-btn opacity" data-bs-toggle="tooltip" title="Disapprove">
                    </button>
                  </td>
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