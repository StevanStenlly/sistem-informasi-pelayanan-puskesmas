<?php
session_name("PASIEN_SESSION");
session_start();
session_unset();
session_destroy();
header("Location: login/login-pasien.php");
