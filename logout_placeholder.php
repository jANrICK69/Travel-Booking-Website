<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Logged out (placeholder).'); window.location='hp.php';</script>";
exit();
?>
