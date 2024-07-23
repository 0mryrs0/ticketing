<?php 
session_start();
include '../config/db_connect.php';
include 'functions.php';




$messageError = "";
$count = 0;
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!empty($email) && !empty($password)) 
    {
        // Sanitize user input to prevent SQL injection
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        
        $query = "SELECT * FROM client WHERE email_address = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) 
        {
            $user_data = mysqli_fetch_assoc($result);
            
            if($user_data['password'] === $password) 
            {
                $_SESSION['client_id'] = $user_data['client_id'];
                header("Location: dashboard_client.php");
                die();

            } else 
            {
                $count++;
                $messageError = "Wrong password " . " ( " .  3 - $count . " attempts left)";
            }
        } else 
        {
            $messageError = "No account associated with this email";
        }
    } else {
        $messageError = "Please enter email and password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing Login Client</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="./css/header_sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<body class="">
    <div class="" style="width:100%" >
        <div class="row p-5 w-100 mt-5">
            <div class="col text-center align-self-center justify-content-center">
                <img src="../img/client.png" class="w-75">
            </div>
            <div class="col align-self-center justify-content-center ">
                <h1 class=" text-center fw-bold">LOG IN </h1>
                <form method="post">
                <label for="contact-number">Email:</label><br>
                    <div class="input-group mb-3 shadow ">
                        <div class="input-group-text">
                            <svg width="20" height="20" viewBox="0 0 52 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26 37.125C24.3212 37.125 22.6423 36.5531 21.2103 35.3943L0 18.2672V42.1875C0 44.9824 2.18258 47.25 4.875 47.25H47.125C49.8174 47.25 52 44.9835 52 42.1875V18.2672L30.7938 35.4059C29.3617 36.5555 27.6758 37.125 26 37.125ZM1.65445 15.3246L23.206 32.7375C24.8503 34.0664 27.1537 34.0664 28.798 32.7375L50.3496 15.3246C51.2992 14.4809 52 13.1836 52 11.8125C52 9.01652 49.8164 6.75 47.125 6.75H4.875C2.18258 6.75 0 9.01652 0 11.8125C0 13.1836 0.610391 14.4809 1.65445 15.3246Z" fill="#757575"/>
                            </svg>
                        </div>
                        <input type="text" class="form-control"  aria-label="email" aria-describedby="email" name="email" id="email">
                    </div>
                    <label for="contact-number">Password:</label><br>
                    <div class="input-group shadow">
                        <div class="input-group-text ">
                        <svg width="20" height="20" viewBox="0 0 42 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.0291 22.7572C39.2191 21.6689 39.3239 20.5493 39.3239 19.4048C39.3239 9.00037 31.1038 0.534912 21 0.534912C10.8958 0.534912 2.67521 9.00037 2.67521 19.4048C2.67521 20.5493 2.78047 21.668 2.97094 22.7572C1.3799 23.7733 0.321885 25.5499 0.321885 27.579V46.0518C0.321885 49.2116 2.88351 51.7728 6.04239 51.7728H35.9572C39.1152 51.7728 41.6763 49.2116 41.6763 46.0518H41.6781V27.579C41.6781 25.5503 40.621 23.7733 39.0291 22.7572ZM23.5242 38.887V42.9014C23.5242 44.2966 22.3939 45.4269 20.9991 45.4269C19.6043 45.4269 18.4741 44.2966 18.4741 42.9014V38.8853C16.8545 37.9927 15.7559 36.2705 15.7559 34.2901C15.7559 31.3944 18.1034 29.0464 21 29.0464C23.8966 29.0464 26.2446 31.3944 26.2446 34.2901C26.2446 36.2714 25.1451 37.995 23.5242 38.887ZM32.3518 21.8576H9.64775C9.49209 21.0658 9.40912 20.2447 9.40912 19.4048C9.40912 12.7128 14.6086 7.26883 21 7.26883C27.3909 7.26883 32.59 12.7123 32.59 19.4048C32.59 20.2447 32.5079 21.0658 32.3518 21.8576Z" fill="#757575"/>
                        </svg>
                        </div>
                        <input type="password" class="form-control"  aria-label="password" aria-describedby="password" name="password">
                    </div>
                    <div class="w-100 text-center">
                        <button class="btn backgroundcolor-red btn-danger rounded-4 text-center mt-5 px-4" type="submit">Log in</button>
                    </div>
                    
                    <?php if (!empty($messageError)): ?>
                    <p><?php echo $messageError; ?></p>
                    <?php endif; ?>
                </form>
                <p class="text-center  mt-4">Don't have account?<a href="client_registration.php" class="ms-1">Create here</a></p>


            </div>
        </div>

    </div>
</body>
</html>