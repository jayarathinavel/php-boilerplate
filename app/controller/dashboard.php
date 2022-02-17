<?php
    $dashboardModel = new DashboardModel;
    class DashboardController{
        function resetPassword($conn, $dashboardModel){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty(trim($_POST["new_password"]))){
                    $dashboardModel -> setNewPasswordErr("Please enter the new password.");     
                } elseif(strlen(trim($_POST["new_password"])) < 6){
                    $dashboardModel -> setNewPasswordErr("Password must have atleast 6 characters.");
                } else{
                    $dashboardModel -> setNewPassword(trim($_POST["new_password"]));
                }
                if(empty(trim($_POST["confirm_password"]))){
                    $dashboardModel -> setConfirmPasswordErr("Please confirm the password.");
                } else{
                    $dashboardModel -> setConfirmPassword(trim($_POST["confirm_password"]));
                    if(empty($dashboardModel -> getNewPasswordErr()) && ($dashboardModel -> getNewPassword() != $dashboardModel -> getConfirmPassword())){
                        $dashboardModel -> setConfirmPasswordErr("Password did not match.");
                    }
                }
                if(empty($dashboardModel -> getNewPasswordErr()) && empty($dashboardModel -> getConfirmPasswordErr())){
                    $sql = "UPDATE users SET password = ? WHERE id = ?";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                        $param_password = password_hash($dashboardModel -> getNewPassword(), PASSWORD_DEFAULT);
                        $param_id = $_SESSION["id"];
                        if(mysqli_stmt_execute($stmt)){
                            session_destroy();
                            header("location: login");
                            exit();
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