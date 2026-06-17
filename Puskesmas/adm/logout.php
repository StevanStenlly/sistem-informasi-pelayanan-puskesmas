<?php
session_name("ADMIN_SESSION");
session_start();
session_unset();
session_destroy();
header("Location: login/login-admin.php");
