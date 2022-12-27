<?php 

// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('Location: ../login.php?success=ออกจากระบบสำเร็จ!');
exit;