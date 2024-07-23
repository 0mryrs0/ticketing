<?php 
$pageName = "Services Type";
include ('opening.php');

?>


      <!-- Every page content is included here -->
      <div class="container d-flex flex-column align-items-stretch justify-content-center mt-5 column-gap-2 " id="main-content"> 
        <div class="row mb-3">
          <div class="col px-5" >
              <h1 class="backgroundcolor-red text-white px-5 py-2 text-center rounded-2 mb-3">Service Request</h1>
              <div id="services-request">
              <?php
                  //Getting the data from the database
                  $query = "SELECT * FROM services WHERE service_type = 'Services Request'";
                  $result = mysqli_query($conn, $query);
                  while ($fetch = mysqli_fetch_array($result)) 
                  {
                  ?>
                      <!--Displaying the data in table form -->
                      <h5 class="ms-4"><i class="bi bi-check-all me-2"></i><?php echo $fetch['services_name']?></h5>

              <?php }?>
              </div>
              
          </div>
          <div class="col px-5">
              <h1 class="backgroundcolor-red text-white px-5 py-2 text-center rounded-2 mb-3">System Incident</h1>
              <div id="system-incident">
              <?php
                  //Getting the data from the database
                  $query = "SELECT * FROM services WHERE service_type = 'System Incident'";
                  $result = mysqli_query($conn, $query);
                  while ($fetch = mysqli_fetch_array($result)) 
                  {
                  ?>
                      <!--Displaying the data in table form -->
                      <h5 class="ms-4"><i class="bi bi-check-all me-2"></i><?php echo $fetch['services_name']?></h5>

              <?php }?>
              </div>
          </div>
        </div>

      </div>
</div>

<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



</body>
</html>