<?php
session_start();
unset($_SESSION["user_id_session"]);
session_destroy();
header("Location:index.php");
?>