<?php 
include("../config/db_connect.php");

// <________GETTING PRODUCT ID FORM HANDLER_______________>
if (isset($_GET['editEmployee'])) 
{
    $personnel = $_GET['user_id'];

    $query = "SELECT * FROM personnel WHERE user_id='$personnel'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) 
    {
        $personnel = mysqli_fetch_array($result);
        $response = [
            'status' => 200,
            'message' => 'User Details',
            'data' => $personnel
        ];
        echo json_encode($response);
    } 
    else 
    {
        $response = [
            'status' => 404,
            'message' => 'User Id did not found'
        ];

        echo json_encode($response);
    }
}

// <________UPDATING THE PRODUCT FORM HANDLER_______________>
if(isset($_POST['update_employee']))
{
    $user_id = $_POST['user_id'];
    $lastName = $_POST['last-name'];
    $firstName = $_POST['first-name'];
    $middleInitial = $_POST['middle-initial'];
    $birthdate = $_POST['birthdate'];
    $sex = $_POST['sex'];
    $addressFirst= $_POST['address-first'];
    $addressSecond = $_POST['address-second'];
    $position = $_POST['position'];
    $department= $_POST['department'];
    $privileges = $_POST['privileges'];
    $dateHired = $_POST['date-hired'];
    $contactNumber = $_POST['contact-number'];
    $emailAddress = $_POST['email-address'];
    $emergencyContactPerson = $_POST['emergency-contact-person'];
    $emergencyContactNumber = $_POST['emergency-contact-number'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $sssNumber = $_POST['sss-number'];
    $philhealthNumber = $_POST['philhealth-number'];
    $umidNumber = $_POST['umid-number'];

       //Checking if all inputs are not empty
   if(!empty($lastName) && !empty($firstName) && !empty($middleInitial) && !empty($birthdate) && !empty($sex) && !empty($addressFirst)
   && !empty($addressSecond) && !empty($position) && !empty($department) && !empty($privileges) && !empty($dateHired) && !empty($contactNumber)
   && !empty($emailAddress) && !empty($emergencyContactPerson) && !empty($emergencyContactNumber) && !empty($password) && !empty($confirmPassword)
   && !empty($sssNumber) && !empty($philhealthNumber) && !empty($sssNumber) && !empty($umidNumber)) 
   {
       
       if($password == $confirmPassword) 
       {

 

            //Updating the database
            $query = "UPDATE personnel SET `last_name`='$lastName',`first_name`='$firstName',`middle_initial`='$middleInitial',`birthdate`='$birthdate',
            `sex`='$sex',`address_first`='$addressFirst',`address_province`='$addressSecond',`position`='$position',`department`='$department',
            `privileges`='$privileges',`date_hired`='$dateHired',`contact_number`='$contactNumber',`email_address`='$emailAddress',`emergency_contact_person`='$emergencyContactPerson',
            `emergency_contact_number`='$emergencyContactNumber',`password`='$password' WHERE user_id='$user_id'";

            if (mysqli_query($conn, $query)) {
                // Success response
                $response = [
                    'status' => 200,
                    'message' => 'Employee Updated Successfully'
                ];

                echo json_encode($response);
                return;
            } else {
                // Error response
                $response = [
                    'status' => 500,
                    'message' => 'Employee did not updated'
                ];

                echo json_encode($response);
                return;
            }
        } 
        else
        {
            $response = [
                'status' => 422, //Error
                'message'=> 'Your password does not match'
            ];
        
            echo json_encode($response);
            return;
        }


   }
   else
   {
       $response = [
           'status' => 422, //Error
           'message'=> 'All employee details should be completed'
       ];
 
       echo json_encode($response);
       return;
   }



}




// <________DELETING  USER FORM HANDLER_______________>
if(isset($_POST['delete_employee']))
{
    $personnel = $_POST['user_id'];

    $query = "DELETE FROM personnel WHERE user_id='$personnel'";
    $result= mysqli_query($conn, $query);

    if($result)
    {
        $response = [
            'status' => 200,
            'message' => 'User has been deleted'
        ];
        echo json_encode($response);
        return;
    }
    else
    {
        $response = [
            'status' => 500,
            'message' => 'User is not deleted'
        ];
        echo json_encode($response);
        return;
    }
}
// <________END OF DELETING USER FORM HANDLER_______________>
