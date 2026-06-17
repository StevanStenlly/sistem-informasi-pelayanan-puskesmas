<?php
session_name("DOKTER_SESSION");
session_start();
session_unset();
session_destroy();
header("Location: login/login-dokter.php");
