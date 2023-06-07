<?php
if (!isset($_SESSION['user'])) {
    header('location: /authentication/login.php');
}
