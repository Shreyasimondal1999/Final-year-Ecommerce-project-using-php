<?php
session_start();
session_unset();//destroys session variables
session_destroy();
echo "<script>window.open('HOME.php', '_self')</script>";

?>