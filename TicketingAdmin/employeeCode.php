<?php
include("../config/db_connect.php");

if(isset($_POST['add_employee']))
{
    $user_id = 'PRSL' . uniqid();
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
            

            //This is the start of handling images


            // Create an array to hold the paths of uploaded images
            $imagePaths = array();

            // Move and handle profile picture
            $profilePictureName = $user_id;
            $targetDirectory = "D:/Users/OJT/Downloads/laragon/www/InfinityTechnosysSystem/employeeImages/";
            $fileExtension = pathinfo($_FILES["profile-picture"]["name"], PATHINFO_EXTENSION);
            $profilePictureFileName = $user_id . '.' . $fileExtension;
            $profilePicturePath = $targetDirectory . $profilePictureFileName;
            
            if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $profilePicturePath)) {
                $imagePaths['profile-picture'] = $profilePicturePath;
            } else {
                // Handle error if profile picture upload fails
                $response = [
                    'status' => 500,
                    'message' => 'Please upload your profile picture'
                ];
                echo json_encode($response);
                return;
            }

            // Handle each ID image individually
            $idKeys = ['sss-id', 'philhealth-id', 'umid-id'];
            foreach ($idKeys as $key) {
                // Specify the directory where the image will be stored based on the key
                $targetDirectory = "D:/Users/OJT/Downloads/laragon/www/InfinityTechnosysSystem/employeeImages/";

                // Get the file extension
                $fileExtension = pathinfo($_FILES[$key]["name"], PATHINFO_EXTENSION);

                // Construct the file name with user_id as the file name and extension
                $fileName = $user_id . '.' . $fileExtension;

                // Construct the file destination with the subdirectory
                switch ($key) {
                    case 'sss-id':
                        $subDirectory = 'SSS/';
                        break;
                    case 'philhealth-id':
                        $subDirectory = 'PHILHEALTH/';
                        break;
                    case 'umid-id':
                        $subDirectory = 'UMID/';
                        break;
                    default:
                        // Handle unknown keys if needed
                        break;
                }
                $fileDestination = $targetDirectory . $subDirectory . $fileName;

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES[$key]["tmp_name"], $fileDestination)) {
                    // File uploaded successfully
                    // Add the path to the array
                    $imagePaths[$key] = $fileDestination;
                } else {
                    // Error moving the uploaded file
                    $response = [
                        'status' => 500,
                        'message' => "Please upload your $key."
                    ];

                    echo json_encode($response);
                    return;
                }
            }

            //This is the end of handling images

            // Insert data into database
            $query = "INSERT INTO personnel(`user_id`, `first_name`, `middle_initial`, `last_name`, `birthdate`, `sex`, `address_first`, `address_province`, `position`, `department`, `date_hired`, `contact_number`, `emergency_contact_person`, `emergency_contact_number`, `email_address`, `privileges`, `password`, `profile_image_path`, `sss_number`, `sss_file_path`, `philhealth_number` , `philhealth_file_path`, `umid_number`, `umid_file_path`) 
                                VALUES ('$user_id','$firstName','$middleInitial','$lastName','$birthdate','$sex','$addressFirst','$addressSecond','$position','$department','$dateHired','$contactNumber','$emergencyContactPerson','$emergencyContactNumber','$emailAddress','$privileges','$password', '{$imagePaths['profile-picture']}', '$sssNumber', '{$imagePaths['sss-id']}', '$philhealthNumber', '{$imagePaths['philhealth-id']}', '$umidNumber', '{$imagePaths['umid-id']}')";

            if (mysqli_query($conn, $query)) {
                // Success response
                $response = [
                    'status' => 200,
                    'message' => 'Employee Added Successfully'
                ];

                echo json_encode($response);
                return;
            } else {
                // Error response
                $response = [
                    'status' => 500,
                    'message' => 'Employee did not added'
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


?>

