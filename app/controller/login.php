<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: home");
        exit;
    }
    $model = new LoginModel;
    class LoginController{
        function login($conn, $model){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty(trim($_POST["username"]))){
                    $model -> setUsername_err("Please enter username.");
                } else{
                    $model -> setUsername(trim($_POST["username"]));
                }
                if(empty(trim($_POST["password"]))){
                    $model -> setPassword_err("Please enter your password.");
                } else{
                    $model -> setPassword(trim($_POST["password"]));
                }
                if(empty($model -> getUsername_err()) && empty($model -> getPassword_err())){
                    $sql = "SELECT id, username, password FROM users WHERE username = ?";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        $param_username = $model -> getUsername();
                        if(mysqli_stmt_execute($stmt)){
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) == 1){                    
                                mysqli_stmt_bind_result($stmt, $id, $model -> getUsername(), $hashed_password);
                                if(mysqli_stmt_fetch($stmt)){
                                    if(password_verify($model -> getPassword(), $hashed_password)){
                                        session_start();
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $model -> getUsername();                            
                                        header("location: home");
                                    } else{
                                        $model -> setLogin_err("Invalid username or password.");
                                    }
                                }
                            } else{
                                $model -> setLogin_err("Invalid username or password.");
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