<!-- restricting access from students' accounts -->
<?php
    include "db.php";
    if($_SESSION['is_admin'] == 0)
    {
        echo "<script>alert('Administrator Access Only'); location.href='/';</script>";
    }
?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    </head>
    
    <body>
        <h1>Halla Registration System</h1>
        <h2>Add Students</h2>

        <!-- button for returning to staff_main page -->
        <span>
            <a href="staff_main.php"><button class="return">Return to main</button></a>
        </span>
        <hr>

        <!-- button and fields for addind new student data to the database -->
        <span class="add">
            <form action = "addStudent.php" method = "POST">
                <div>
                    <label>Student ID</label>
                    <input type = "text" name = "new_id">
                </div>
                <div>
                    <label>Student Name</label>
                    <input type = "text" name = "new_name">
                </div>
                <div>
                    <label>Year Group</label>
                    <select name = "new_yeargroup">
                        <option value = "12">12</option>
                        <option value = "13">13</option>
                    </select>
                </div>
                <div>
                    <label>Room Number</label>
                    <input type = "text" name = "new_roomNo">
                </div>
                <div>
                    <label>Password</label>
                    <input type = "text" name = "new_password">
                </div>
                
                <button type = "Submit" name = "add_btn">Add</button>
            </form>
        </span>

        <?php
           include "password.php";
           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               //adding new student detail to the database
               if (isset($_POST['add_btn'])){
                   // the student detail is only saved to the database when all the fields in the display are filled in
                   if (((!empty($_POST['new_id']) and !empty($_POST['new_password'])) and !empty($_POST['new_yeargroup'])) and !empty($_POST['new_roomNo'])){
                        $id = $_POST['new_id'];
                        // encrypting password using open source code (password.php) to enhance security
                        $pw = password_hash($_POST['new_password'],PASSWORD_BCRYPT);
                        $name = $_POST['new_name'];
                        $yeargroup = $_POST['new_yeargroup'];
                        $roomNo = $_POST['new_roomNo'];

                    
                        // inserting input data into studentDetails database
                        $sql = mq("INSERT into studentDetails(studentID,studentName,studentYeargroup,studentRoomNo) values('".$id."','".$name."','".$yeargroup."','".$roomNo."')");
                        $sql = mq("INSERT into loginDetails(userID,userPW,isAdmin) values('".$id."','".$pw."',0)");
                        $sql = mq("INSERT into registrationSat(studentID) values('".$id."')");
                        $sql = mq("INSERT into registrationSun(studentID) values('".$id."')");

                        // print alert to let user know that the function is successfully accomplished
                        echo "<script>alert('Student Added.'); location.href-'staff_main.php';</script>";
                    
                    } else {
                        // alert when all the fields are not filled in; student details is not recorded to the database
                        echo "<script>alert('Please fill in every fields.');</script>";
                    }
                }
            }
        ?>
    </body>
</html>