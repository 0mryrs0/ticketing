<?php 
function check_login($conn) {

    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Creating a query to check if the user exists in the database
        $query = "SELECT * FROM personnel WHERE user_id = '$user_id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data; // Return user data if found
        }
    }
    
    // If session or user not found, redirect to login page
    header("Location: technical_login.php");
    exit(); // Stop script execution after redirect
}

?>

