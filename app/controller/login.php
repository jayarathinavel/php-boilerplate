<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: home");
        exit;
    }
    $loginModel = new LoginModel;
    class LoginController{
        function login($conn, $loginModel){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty(trim($_POST["username"]))){
                    $loginModel -> setUsername_err("Please enter username.");
                } else{
                    $loginModel -> setUsername(trim($_POST["username"]));
                }
                if(empty(trim($_POST["password"]))){
                    $loginModel -> setPassword_err("Please enter your password.");
                } else{
                    $loginModel -> setPassword(trim($_POST["password"]));
                }
                if(empty($loginModel -> getUsername_err()) && empty($loginModel -> getPassword_err())){
                    $sql = "SELECT id, username, password FROM users WHERE username = ?";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        $param_username = $loginModel -> getUsername();
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) == 1){                    
                                mysqli_stmt_bind_result($stmt, $id, $param_username, $hashed_password);
                                if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($loginModel -> getPassword(), $hashed_password)){
                                        session_start();
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $loginModel -> getUsername();                            
                                        header("location: home?query=loginsuccess");
                                    } else{
                                        $loginModel -> setLogin_err("Invalid username or password.");
                                    }
                                }
                            } else{
                                $loginModel -> setLogin_err("Invalid username or password.");
                            }
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