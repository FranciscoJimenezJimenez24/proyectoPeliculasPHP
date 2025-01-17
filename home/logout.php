<?php

session_start();
session_unset();    
header("Location: ../login/login.view.php");
exit();