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
        <br>
            <form action = "logout.php" method = "POST">
                <!-- Logout function; it redirects the user to the login page -->
                <button type = "submit" name = "logout_btn" class = "logout_btn">Log Out</button>
                <br>
            </form>
        
            
            <div>
                <!-- buttons are linked to different pages -->
                <a href="viewRegistration.php"><button type = "submit">View Registration</button></a>
                <br>
                <a href="viewStudentDetails.php"><button type = "submit">View Student Details</button></a>
                <br>
                <a href="editStudentDetails.php"><button type = "submit">Edit Student Details</button></a>
                <br>
                <a href="addStudent.php"><button type = "submit">Add Students</button></a>
                <br>
                <!-- button to reset the location data of the students in the database -->
                <form method = "POST"><button type = "submit" name = "reset_regi">Reset Registration Data</button></form>
            </div>  
            

            <?php           
                if ($_SERVER['REQUEST_METHOD']  === 'POST') {
                    // when reset student location button is clicked
                    if (isset($_POST['reset_regi'])) {
                        // confirming user action
                        // the data from database is deleted only if user clicks yes from the pop up box
                        ?>
                            <script>
                                var conf = confirm('Do you really want to delete all the location data? The location data should be deleted at the end of the weekend.');
                                if (conf == true) {
                                    <?php
                                    // delete all the location data of the students in the database
                                    // used at the end of the weekend
                                        $sql = mq("UPDATE `registrationSat` set 
                                        location1 = null, 
                                        site1 = null, 
                                        time1 = null,
                                        location2 = null, 
                                        site2 = null, 
                                        time2 = null,
                                        location3 = null, 
                                        site3 = null, 
                                        time3 = null ");
                    
                                        $sql = mq("UPDATE `registrationSun` set 
                                        location1 = null, 
                                        site1 = null, 
                                        time1 = null,
                                        location2 = null, 
                                        site2 = null, 
                                        time2 = null ");  
                                    ?>

                                    alert('All location data deleted.'); location.href='staff_main.php';
                                
                                } else {
                                    location.href='staff_main.php'
                                };
                            </script>
                        <?php
                    }
                }
            ?>

    </body>
</html>