<?php 
include '../config/db_connect.php';


$messageError = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $clientId = "CID" . uniqid();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $clientNumber = $_POST['contact-number'];
    $companyName = $_POST['company-name'];
    $officeAddress = $_POST['office-address'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password']; // Corrected variable name
    
    if(!empty($email) && !empty($name) && !empty($clientNumber) && !empty($password) && !empty($confirmPassword)) 
    {
        // Sanitize user input to prevent SQL injection
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        
        // Check if the email already exists in the database
        $query = "SELECT email_address FROM client WHERE email_address = '$email'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) 
        {
            // Email address already exists in the database
            $messageError = "This email address is already registered.";
        } 
        else 
        {
            if($password === $confirmPassword) {
                $query = "INSERT INTO client (`client_id`,`client_name`, `client_number`, `company_name`, `office_address`, `email_address`, `password`) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "sssssss", $clientId, $name, $clientNumber, $companyName, $officeAddress, $email, $password);
                mysqli_stmt_execute($stmt);
    
                if ($stmt) {
                     $messageError = "";
                ?>
                <div class="alert alert-success" role="alert">
                     Your account has been registered. Please login.
                </div>

            <?php


        
                } else {
                    $messageError = "Account registration is not successful.";
                }

            } else {
                $messageError = "Your password does not match.";
            }

        }
    } 
    else 
    {
        $messageError = "Please enter all required fields.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing Registration Client</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="./css/header_sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<body class="overflow-auto">
    <div class="" style="width:100%;">
        <div class="row m-auto p-5 w-100">
            <div class="col text-center align-self-center justify-content-center">
                <img src="../img/client.png" class="w-75">
            </div>
            <div class="col align-self-center justify-content-center ">
                <h1 class="text-center fw-bold">REGISTER</h1>
                <form method="post">
                    <label for="email">Email:</label><br>
                    <div class="input-group mb-2 shadow">
                        <div class="input-group-text">
                            <svg width="20" height="20" viewBox="0 0 52 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 37.125C24.3212 37.125 22.6423 36.5531 21.2103 35.3943L0 18.2672V42.1875C0 44.9824 2.18258 47.25 4.875 47.25H47.125C49.8174 47.25 52 44.9835 52 42.1875V18.2672L30.7938 35.4059C29.3617 36.5555 27.6758 37.125 26 37.125ZM1.65445 15.3246L23.206 32.7375C24.8503 34.0664 27.1537 34.0664 28.798 32.7375L50.3496 15.3246C51.2992 14.4809 52 13.1836 52 11.8125C52 9.01652 49.8164 6.75 47.125 6.75H4.875C2.18258 6.75 0 9.01652 0 11.8125C0 13.1836 0.610391 14.4809 1.65445 15.3246Z" fill="#757575"/>
                            </svg>
                        </div>
                        <input type="text" class="form-control" aria-label="email" aria-describedby="email" name="email" id="email">
                    </div>
                    <label for="contact-number">Name:</label><br>
                    <div class="input-group mb-2 shadow">
                        <div class="input-group-text">
                        <svg width="20" height="20" viewBox="0 0 52 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M44.1 0H4.9C2.205 0 0 2.205 0 4.9V44.1C0 46.795 2.205 49 4.9 49H44.1C46.795 49 49 46.795 49 44.1V4.9C49 2.205 46.795 0 44.1 0ZM24.5 9.8C28.665 9.8 31.85 12.985 31.85 17.15C31.85 21.315 28.665 24.5 24.5 24.5C20.335 24.5 17.15 21.315 17.15 17.15C17.15 12.985 20.335 9.8 24.5 9.8ZM39.2 39.2H9.8V36.015C9.8 34.79 10.29 33.81 11.27 33.075C13.23 31.605 17.395 29.4 24.5 29.4C31.605 29.4 35.77 31.605 37.73 32.83C38.71 33.565 39.2 34.545 39.2 35.77V39.2Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="text" class="form-control" aria-label="name" aria-describedby="name" name="name" id="name">
                    </div>
                    <label for="contact-number">Contact Number:</label><br>
                    <div class="input-group mb-2 shadow">
                        <div class="input-group-text">
                        <svg width="20" height="20" viewBox="0 0 52 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.9503 31.9809C20.4821 28.3145 17.4986 23.7902 15.9301 21.2159L14.7601 19.0148C15.1692 18.5768 18.2888 15.2432 19.6408 13.4344C21.3397 11.1632 18.8765 9.11191 18.8765 9.11191C18.8765 9.11191 11.9455 2.19443 10.3659 0.822272C8.78635 -0.551811 6.96805 0.211355 6.96805 0.211355C3.64815 2.35196 0.206478 4.21305 6.9696e-06 13.1636C-0.00769359 21.5435 6.36693 30.1866 13.2604 36.8779C20.1649 44.4346 29.6448 52.0086 38.8099 52C47.7782 51.7959 49.6427 48.3619 51.7877 45.0489C51.7877 45.0489 52.553 43.2358 51.1775 41.6581C49.801 40.0809 42.8681 33.1629 42.8681 33.1629C42.8681 33.1629 40.814 30.7044 38.5375 32.4012C36.8409 33.6667 33.7944 36.4817 33.0605 37.1641C33.0619 37.1665 27.9656 34.4554 24.9503 31.9809Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="text" class="form-control" aria-label="contact-number" aria-describedby="contact-number" name="contact-number" id="contact-number">
                    </div>
                    <label for="company-name">Company Name:</label><br>
                    <div class="input-group mb-2 shadow">
                        <div class="input-group-text">
                        <svg width="20" height="20" viewBox="0 0 52 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 0C2.75544 0 1.80161 0.34241 1.09835 0.951903C0.395088 1.5614 0 2.38805 0 3.25V48.75C0 49.612 0.395088 50.4386 1.09835 51.0481C1.80161 51.6576 2.75544 52 3.75 52H15V40.625C15 40.194 15.1975 39.7807 15.5492 39.476C15.9008 39.1712 16.3777 39 16.875 39H28.125C28.6223 39 29.0992 39.1712 29.4508 39.476C29.8025 39.7807 30 40.194 30 40.625V52H41.25C42.2446 52 43.1984 51.6576 43.9016 51.0481C44.6049 50.4386 45 49.612 45 48.75V3.25C45 2.38805 44.6049 1.5614 43.9016 0.951903C43.1984 0.34241 42.2446 0 41.25 0L3.75 0ZM7.5 8.125C7.5 7.69402 7.69754 7.2807 8.04918 6.97595C8.40081 6.67121 8.87772 6.5 9.375 6.5H13.125C13.6223 6.5 14.0992 6.67121 14.4508 6.97595C14.8025 7.2807 15 7.69402 15 8.125V11.375C15 11.806 14.8025 12.2193 14.4508 12.524C14.0992 12.8288 13.6223 13 13.125 13H9.375C8.87772 13 8.40081 12.8288 8.04918 12.524C7.69754 12.2193 7.5 11.806 7.5 11.375V8.125ZM18.75 8.125C18.75 7.69402 18.9475 7.2807 19.2992 6.97595C19.6508 6.67121 20.1277 6.5 20.625 6.5H24.375C24.8723 6.5 25.3492 6.67121 25.7008 6.97595C26.0525 7.2807 26.25 7.69402 26.25 8.125V11.375C26.25 11.806 26.0525 12.2193 25.7008 12.524C25.3492 12.8288 24.8723 13 24.375 13H20.625C20.1277 13 19.6508 12.8288 19.2992 12.524C18.9475 12.2193 18.75 11.806 18.75 11.375V8.125ZM31.875 6.5H35.625C36.1223 6.5 36.5992 6.67121 36.9508 6.97595C37.3025 7.2807 37.5 7.69402 37.5 8.125V11.375C37.5 11.806 37.3025 12.2193 36.9508 12.524C36.5992 12.8288 36.1223 13 35.625 13H31.875C31.3777 13 30.9008 12.8288 30.5492 12.524C30.1975 12.2193 30 11.806 30 11.375V8.125C30 7.69402 30.1975 7.2807 30.5492 6.97595C30.9008 6.67121 31.3777 6.5 31.875 6.5ZM7.5 17.875C7.5 17.444 7.69754 17.0307 8.04918 16.726C8.40081 16.4212 8.87772 16.25 9.375 16.25H13.125C13.6223 16.25 14.0992 16.4212 14.4508 16.726C14.8025 17.0307 15 17.444 15 17.875V21.125C15 21.556 14.8025 21.9693 14.4508 22.274C14.0992 22.5788 13.6223 22.75 13.125 22.75H9.375C8.87772 22.75 8.40081 22.5788 8.04918 22.274C7.69754 21.9693 7.5 21.556 7.5 21.125V17.875ZM20.625 16.25H24.375C24.8723 16.25 25.3492 16.4212 25.7008 16.726C26.0525 17.0307 26.25 17.444 26.25 17.875V21.125C26.25 21.556 26.0525 21.9693 25.7008 22.274C25.3492 22.5788 24.8723 22.75 24.375 22.75H20.625C20.1277 22.75 19.6508 22.5788 19.2992 22.274C18.9475 21.9693 18.75 21.556 18.75 21.125V17.875C18.75 17.444 18.9475 17.0307 19.2992 16.726C19.6508 16.4212 20.1277 16.25 20.625 16.25ZM30 17.875C30 17.444 30.1975 17.0307 30.5492 16.726C30.9008 16.4212 31.3777 16.25 31.875 16.25H35.625C36.1223 16.25 36.5992 16.4212 36.9508 16.726C37.3025 17.0307 37.5 17.444 37.5 17.875V21.125C37.5 21.556 37.3025 21.9693 36.9508 22.274C36.5992 22.5788 36.1223 22.75 35.625 22.75H31.875C31.3777 22.75 30.9008 22.5788 30.5492 22.274C30.1975 21.9693 30 21.556 30 21.125V17.875ZM9.375 26H13.125C13.6223 26 14.0992 26.1712 14.4508 26.476C14.8025 26.7807 15 27.194 15 27.625V30.875C15 31.306 14.8025 31.7193 14.4508 32.024C14.0992 32.3288 13.6223 32.5 13.125 32.5H9.375C8.87772 32.5 8.40081 32.3288 8.04918 32.024C7.69754 31.7193 7.5 31.306 7.5 30.875V27.625C7.5 27.194 7.69754 26.7807 8.04918 26.476C8.40081 26.1712 8.87772 26 9.375 26ZM18.75 27.625C18.75 27.194 18.9475 26.7807 19.2992 26.476C19.6508 26.1712 20.1277 26 20.625 26H24.375C24.8723 26 25.3492 26.1712 25.7008 26.476C26.0525 26.7807 26.25 27.194 26.25 27.625V30.875C26.25 31.306 26.0525 31.7193 25.7008 32.024C25.3492 32.3288 24.8723 32.5 24.375 32.5H20.625C20.1277 32.5 19.6508 32.3288 19.2992 32.024C18.9475 31.7193 18.75 31.306 18.75 30.875V27.625ZM31.875 26H35.625C36.1223 26 36.5992 26.1712 36.9508 26.476C37.3025 26.7807 37.5 27.194 37.5 27.625V30.875C37.5 31.306 37.3025 31.7193 36.9508 32.024C36.5992 32.3288 36.1223 32.5 35.625 32.5H31.875C31.3777 32.5 30.9008 32.3288 30.5492 32.024C30.1975 31.7193 30 31.306 30 30.875V27.625C30 27.194 30.1975 26.7807 30.5492 26.476C30.9008 26.1712 31.3777 26 31.875 26Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="text" class="form-control" aria-label="company-name" aria-describedby="company-name" name="company-name" id="company-name">
                    </div>
                    <label for="office-address">Office Address:</label><br>
                    <div class="input-group mb-2 shadow">
                        <div class="input-group-text">
                        <svg width="20" height="20" viewBox="0 0 52 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.5 31.6H25.1V19V13.3H13.5V31.6ZM20 15.5H23.4V18.3H20V15.5ZM20 21.1H23.4V23.9H20V21.1ZM20 26.7H23.4V29.5H20V26.7ZM15.3 15.5H18.6V18.3H15.2V15.5H15.3ZM15.3 21.1H18.6V23.9H15.2V21.1H15.3ZM15.3 26.7H18.6V29.5H15.2V26.7H15.3Z" fill="#757575"/>
                            <path d="M28.5 31.6H33C33.3 31.6 33.6 31.3 33.6 31V22.3H28.5V31.6Z" fill="#757575"/>
                            <path d="M22.9 0C10.3 0 0 10.3 0 22.9C0 33.3 7.2 42.5 17.2 45.1L21.7 57C21.9 57.5 22.3 57.8 22.9 57.8C23.4 57.8 23.9 57.5 24.1 57L28.4 45.2C38.5 42.7 45.8 33.5 45.8 23C45.7 10.3 35.5 0 22.9 0ZM37 31.1C37 33.3 35.2 35 33.1 35H25.2H10.2V9.9H28.5V19H37V31.1Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="text" class="form-control" aria-label="office-address" aria-describedby="office-address" name="office-address" id="office-address">
                    </div>
                    <label for="contact-number">Password:</label><br>
                    <div class="input-group mb-2 shadow">
                        <div class="input-group-text">
                        <svg width="20" height="20" viewBox="0 0 42 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.0291 22.7572C39.2191 21.6689 39.3239 20.5493 39.3239 19.4048C39.3239 9.00037 31.1038 0.534912 21 0.534912C10.8958 0.534912 2.67521 9.00037 2.67521 19.4048C2.67521 20.5493 2.78047 21.668 2.97094 22.7572C1.3799 23.7733 0.321885 25.5499 0.321885 27.579V46.0518C0.321885 49.2116 2.88351 51.7728 6.04239 51.7728H35.9572C39.1152 51.7728 41.6763 49.2116 41.6763 46.0518H41.6781V27.579C41.6781 25.5503 40.621 23.7733 39.0291 22.7572ZM23.5242 38.887V42.9014C23.5242 44.2966 22.3939 45.4269 20.9991 45.4269C19.6043 45.4269 18.4741 44.2966 18.4741 42.9014V38.8853C16.8545 37.9927 15.7559 36.2705 15.7559 34.2901C15.7559 31.3944 18.1034 29.0464 21 29.0464C23.8966 29.0464 26.2446 31.3944 26.2446 34.2901C26.2446 36.2714 25.1451 37.995 23.5242 38.887ZM32.3518 21.8576H9.64775C9.49209 21.0658 9.40912 20.2447 9.40912 19.4048C9.40912 12.7128 14.6086 7.26883 21 7.26883C27.3909 7.26883 32.59 12.7123 32.59 19.4048C32.59 20.2447 32.5079 21.0658 32.3518 21.8576Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="password" class="form-control" aria-label="password" aria-describedby="password" name="password" id="password">
                    </div>
                    <label for="confirm-password">Confirm Password:</label><br>
                    <div class="input-group shadow">
                        <div class="input-group-text">
                        <svg width="20" height="20" viewBox="0 0 42 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.0291 22.7572C39.2191 21.6689 39.3239 20.5493 39.3239 19.4048C39.3239 9.00037 31.1038 0.534912 21 0.534912C10.8958 0.534912 2.67521 9.00037 2.67521 19.4048C2.67521 20.5493 2.78047 21.668 2.97094 22.7572C1.3799 23.7733 0.321885 25.5499 0.321885 27.579V46.0518C0.321885 49.2116 2.88351 51.7728 6.04239 51.7728H35.9572C39.1152 51.7728 41.6763 49.2116 41.6763 46.0518H41.6781V27.579C41.6781 25.5503 40.621 23.7733 39.0291 22.7572ZM23.5242 38.887V42.9014C23.5242 44.2966 22.3939 45.4269 20.9991 45.4269C19.6043 45.4269 18.4741 44.2966 18.4741 42.9014V38.8853C16.8545 37.9927 15.7559 36.2705 15.7559 34.2901C15.7559 31.3944 18.1034 29.0464 21 29.0464C23.8966 29.0464 26.2446 31.3944 26.2446 34.2901C26.2446 36.2714 25.1451 37.995 23.5242 38.887ZM32.3518 21.8576H9.64775C9.49209 21.0658 9.40912 20.2447 9.40912 19.4048C9.40912 12.7128 14.6086 7.26883 21 7.26883C27.3909 7.26883 32.59 12.7123 32.59 19.4048C32.59 20.2447 32.5079 21.0658 32.3518 21.8576Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="password" class="form-control"  aria-label="confirm-password" aria-describedby="confirm-password" name="confirm-password">
                    </div>
                    
                    <div class="w-100 text-center">
                        <button class="btn backgroundcolor-red btn-danger rounded-4 text-center mt-3 px-5" type="submit">Register</button>
                    </div>
                    
                    <?php if (!empty($messageError)): ?>
                    <p class="text-center text-danger mt-2"><?php echo $messageError; ?></p>
                    <?php endif; ?>
                </form>
                <p class="text-center mt-4 ">Have an account?<a href="client_login.php" class="ms-1">Login here</a></p>

                <div>
                    
                </div>
            </div>
        </div>

    </div>
</body>
</html>
