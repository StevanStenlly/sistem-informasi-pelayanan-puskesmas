<?php
session_name("APOTEKER_SESSION");
session_start();
session_unset();
session_destroy();
header("Location: login/login-petugas.php");
