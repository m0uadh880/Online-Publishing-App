<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
include_once 'database_access/UserRepository.php';
session_start();

$email = $_POST["email"];
$password = $_POST["password"];
$isAuthenticated = false ;
$userRepository= new UserRepository('user');
$user = $userRepository->findByEmail($email);

if(isset($user)) {
    if (password_verify($password, $user->password)) {
        $_SESSION["user"] = $email;
        $_SESSION["name"] = $user->name;
        $isAuthenticated = true;
        header("location: /index.php");
    }
}

if(!$isAuthenticated){
    $_SESSION["erreur"] = 'Wrong credentials! Try again.';
    header('location: /authentication/login.php');
}
?>
