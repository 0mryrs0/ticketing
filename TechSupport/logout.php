<?php
session_start(); /* use to access session */
if (isset($_SESSION['user_id'])) {
    unset ($_SESSION['user_id']);
}
header("Location: technical_login.php")
?>