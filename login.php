<?php  
    include "db.php";
    include "password.php";

    if($_POST["userID"] == "" || $_POST["userPW"] == ""){
        // alert when id or password are not entered then login button is clicked
        echo '<script> alert("Enter ID and PW"); history.back(); </script>';
    } 
    // verifying the user by id and password
    else {
        $password = $_POST["userPW"];
        // fetching stored password from the database by student id
        $sql = mq("SELECT * from loginDetails where userID='".$_POST['userID']."'");
        $member = $sql->fetch_array();            
        $hash_pw = $member['userPW'];

    
        // comparing the fetched password(hashed) and entered password(not hashed) by the function password_verify()
        if (password_verify($password, $hash_pw)) {
            // global variable for the logged in user
            $_SESSION['user_id'] = $member["userID"];
            $_SESSION["user_pw"] = $member["userPW"];
            $_SESSION['is_admin'] = $member["isAdmin"];
            
            if($_SESSION['is_admin'] == 0)
            {
                // for student account, register page is loaded after the alert
                echo "<script>alert('Logged in.'); location.href='register_main.php';</script>";
            }
            else if($_SESSION['is_admin'] == 1)
            {
                // for staff account, staff main page is loaded after the alert
                echo "<script>alert('Logged in.'); location.href='staff_main.php';</script>";
            }
        } 
        else { 
            // alert when password does not matched the stored password in the database
            echo "<script>alert('Check your ID and PW.'); history.back();</script>";
        }
    }
?>
