<?php
// Initialize the session.
session_start();
// Unset all of the session variables.
unset($_SESSION['loggedin']);
// Finally, destroy the session.
session_destroy();

// Include URL for Login page to login again.
header("Location: index.php");
exit;
