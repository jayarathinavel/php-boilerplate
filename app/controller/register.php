<?php
$registerModel = new RegisterModel;
class RegisterController{
    function register($conn, $registerModel){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty(trim($_POST["username"]))){
                $registerModel -> setUsername_err('Please enter a username.');
            } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
                $registerModel -> setUsername_err('Username can only contain letters, numbers, and underscores.');
            } else{
                $sql = "SELECT id FROM users WHERE username = ?";
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    $param_username = trim($_POST["username"]);
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $registerModel -> setUsername_err('This username is already taken.');
                        } else{
                            $registerModel -> setUsername(trim($_POST["username"]));
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            
            if(empty(trim($_POST["password"]))){
                $registerModel -> setPassword_err('Please enter a password.');     
            } elseif(strlen(trim($_POST["password"])) < 6){
                $registerModel -> setPassword_err('Password must have atleast 6 characters.');
            } else{
                $registerModel -> setPassword(trim($_POST["password"]));
            }
            if(empty(trim($_POST["confirm_password"]))){
                $registerModel -> setConfirm_password_err('Please confirm password.');     
            } else{
                $registerModel -> setConfirm_password(trim($_POST["confirm_password"]));
                if(empty($registerModel ->getPassword_err()) && ($registerModel ->getPassword() != $registerModel ->getConfirm_password())){
                    $registerModel ->setConfirm_password_err("Password did not match.");
                }
            }
            if(empty($registerModel ->getUsername_err()) && empty($registerModel ->getPassword_err()) && empty($registerModel ->getConfirm_password_err())){
                $sql = "INSERT INTO users (username, password) VALUES (? , ?)";
                if($stmt = mysqli_prepare($conn, $sql)){
                    mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                    $param_username = $registerModel ->getUsername();
                    $param_password = password_hash($registerModel ->getPassword(), PASSWORD_DEFAULT); // Creates a password hash
                    if(mysqli_stmt_execute($stmt)){
                        header("location: login");
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            mysqli_close($conn);
        }
    }
}
?>