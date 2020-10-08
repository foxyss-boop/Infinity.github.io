<?php
$utils = new Utils;
$user = new User;

$key = $utils->sanitize($_GET['key']);
$updatePassword = new ResetPassword;
if ($updatePassword->isExist($key) === "Key Exist") {
    $data = $updatePassword->getUserAssignToToken($key);
    $question = $user->isQuestionEnabled($data->username);
    $answered = isset($_GET['answered']) ? $utils->sanitize($_GET['answered']) : "false";
    if ($question !== false) {
        if ($answered !== "true") {
            $utils->redirect("question.php?username=$data->username&key=$key");
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $Password = $utils->sanitize($_POST['password']);
        $confirmPassword = $utils->sanitize($_POST['confirmPassword']);
        if ($Password === $confirmPassword) {
            $msg = $updatePassword->updatePassword($key, $data->username, $_POST['password']);
        } else {
            $err = "Password confirm is incorrect";
        }
    }
} else {
    $utils->redirect("expire.php");
}
session_destroy();
