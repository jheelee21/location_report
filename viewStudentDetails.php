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
        <h2>View Student Details</h2>

        <!-- return to staff_main page -->
        <span>
            <a href="staff_main.php"><button class="return">Return to main</button></a>
        </span>
        <hr>

        <?php
            // function to display student details as table
            function display ($sql){
                while($row= mysqli_fetch_array($sql)) {
                    echo "<tr>";
                    echo "<td nowrap=''>" . $row['studentID'] . "</td>";
                    echo "<td nowrap=''>" . $row['studentName'] . "</td>";
                    echo "<td nowrap=''>" . $row['studentYeargroup'] . "</td>";
                    echo "<td nowrap=''>" . $row['studentRoomNo'] . "</td>";
                }
                echo "</table>";
            }

        ?>

         <!-- buttons to choose which column to sort the table with -->
         <table>
            <tr>
                <th><form action="viewStudentDetails.php" method="POST"><input type=submit name="sort_id_btn" value='Student ID' style='width:100%'></form></th>
                <th><form action="viewStudentDetails.php" method="POST"><input type=submit name="sort_name_btn" value='Name' style='width:100%'></form></th>
                <th><form action="viewStudentDetails.php" method="POST"><input type=submit name="sort_yeargroup_btn" value='Year Group' style='width:100%'></form></th>
                <th><form action="viewStudentDetails.php" method="POST"><input type=submit name="sort_roomNo_btn" value='Room No' style='width:100%'></form></th>

        <?php
            // a function in data base 'order by' is used
            if ($_SERVER['REQUEST_METHOD']  === 'POST') {
                if (isset($_POST['sort_name_btn'])) {
                    // sort the table by student name in ascending order
                    $sql = mq("SELECT * from `studentDetails` order by studentName");
                    display($sql);
                } else if (isset($_POST['sort_yeargroup_btn'])) {
                    // sort the table by student yeargroup in ascending order
                    $sql = mq("SELECT * from `studentDetails` order by studentYeargroup");
                    display($sql);
                } else if (isset($_POST['sort_roomNo_btn'])) {
                    // sort the table by student room number in ascending order
                    $sql = mq("SELECT * from `studentDetails` order by studentRoomNo");
                    display($sql);
                } else if (isset($_POST['sort_id_btn'])) {
                    // sort the table by student id in ascending order
                    $sql = mq("SELECT * from `studentDetails` order by studentId");
                    display($sql);
                }
            } else {
                // the default table display is sorted by the alphabetical order of student names
                $sql = mq("SELECT * from `studentDetails` order by studentName");
                    display($sql);
            }
        ?>

    </body>

</html>