<?php
session_start(); /* use to access session */
if (isset($_SESSION['client_id'])) {
    unset ($_SESSION['client_id']);
}
header("Location: client_login.php")
?>