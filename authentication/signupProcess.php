<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
include_once 'database_access/UserRepository.php';

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$UserRepository = new UserRepository('user');
$user1 = $UserRepository->findByEmail($email);
$user2 = $UserRepository->findByName($name);

if($user1) {
    $_SESSION["erreur"] = 'This email address is already taken! Try again.';
    header("location: signUp.php");
} elseif ($user2){
    $_SESSION["erreur"] = 'This display name is already taken! Try again.';
    header("location: signUp.php");
} else {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $UserRepository->Create(['email' => $email,'password'=>$hash,'name'=>$name]);
    $_SESSION["user"] = $email;
    $_SESSION["name"] = $name;
    header("location: /index.php");
}

?>
