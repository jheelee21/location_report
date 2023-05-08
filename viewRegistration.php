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
        <h2>View Registration Data</h2>

        <!-- Button to return to staff_main page -->
        <span>
            <a href="staff_main.php"><button class="return">Return to main</button></a>
        </span>
        <hr>


        <?php
            // function for displaying student location by correct format in the table
            function display($location, $site, $time) {
                if ($site == 1){
                    // insite locations are not underlined
                    if ($time == 1) {
                        // if student registered their location within the time boundary, then the background of the field in the table is green
                        echo "<td nowrap='' style='background-color: #008000'>".$location."</td>";
                    } else if ($time == 2) {
                        // if student did not registered their location within the time boundary, then the background of the field in the table is red
                        echo "<td nowrap='' style='background-color: #ff4f00'> ".$location."</td>";
                    }
                } else if ($site == 2) {
                    // off-site locations are underlined
                    if ($time == 1) {
                        // if student registered their location within the time boundary, then the background of the field in the table is green
                        echo "<td nowrap='' style='background-color: #008000'> <u> ".$location." </u> </td>";
                    } else if ($time == 2) {
                        // if student did not registered their location within the time boundary, then the background of the field in the table is red
                        echo "<td nowrap='' style='background-color: #ff4f00'> <u> ".$location." </u> </td>";
                    }
                } else {
                    echo "<td nowrap=''> </td>";
                }
            }

            // for saturday, there are three sessions for registration, hence 3 location columns for the table
            function saturday($sql) {
                while($row = mysqli_fetch_array($sql)) {
                    echo "<tr>";
                    echo "<td nowrap=''>" . $row['studentName'] . "</td>";
                    display($row['location1'], $row['site1'], $row['time1']);
                    display($row['location2'], $row['site2'], $row['time2']);
                    display($row['location3'], $row['site3'], $row['time3']);
                    echo "</tr>";
                }   
                echo "</table>";
            }

            // for sunday, there are two sessons for registration, hence 2 location columns for the table
            function sunday($sql) {
                while($row = mysqli_fetch_array($sql)) {
                    echo "<tr>";
                    echo "<td nowrap=''>".$row['studentName']."</td>";
                    display($row['location1'], $row['site1'], $row['time1']);
                    display($row['location2'], $row['site2'], $row['time2']);
                    echo "</tr>";  
                }
                echo "</table>";
            }

            function database($day, $sort1, $sort2){
                if ($sort2 == '0') {
                    // a function in database, 'order by' is used to sort the location data from the database when displaying to the table
                    // for student name, there is no need to display certain names at the top of the list, hence only one variable(student name) is used to sort
                    $sql = mq("SELECT s.studentName, r.* FROM ".$day." r, studentDetails s WHERE r.studentID = s.studentID ORDER BY s.".$sort1."");
                } else {
                    // for sorting the table by the location, in-site location should be displayed on the top of off-site location, hence two variables(location and site) are used to sort
                    $sql = mq("SELECT s.studentName, r.* FROM ".$day." r, studentDetails s WHERE r.studentID = s.studentID ORDER BY r.".$sort1.", r.".$sort2."");
                };
                
                if ($day == 'registrationSat') {
                    saturday($sql);
                } else if ($day == 'registrationSun') {
                    sunday($sql);
                };
            };

        ?>

        <!-- buttons to choose which column to sort the table with -->
        <table>
            <tr>
                <!-- table headers for saturday as buttons for sorting the table -->
                <th><form action="viewRegistration.php" method="POST"><input type=submit name="sortSatName" value='Name' style='width:100%'></form></th>
                <th><form action="viewRegistration.php" method="POST"><input type=submit name="sortSatOne" value='Sat 1:30' style='width:100%'></form></th>
                <th><form action="viewRegistration.php" method="POST"><input type=submit name="sortSatTwo" value='Sat 4:30' style='width:100%'></form></th>
                <th><form action="viewRegistration.php" method="POST"><input type=submit name ="sortSatThree" value='Sat 7:30' style='width:100%'></form></th>
            
        <?php
            // sort the table by student name in ascending order
            // a function in database, 'order by' is used
            if ($_SERVER['REQUEST_METHOD']  === 'POST') {
                // desired sorting actions are triggered when buttons on the table are clicked
                if (isset($_POST['sortSatName'])) {
                    database('registrationSat', 'studentName', '0');
                } else if (isset($_POST['sortSatOne'])){
                    // sort the table by first location, first, in-site locations then the off-site locations in alphabetical order
                    database('registrationSat', 'site1', 'location1');
                } else if (isset($_POST['sortSatTwo'])){
                    database('registrationSat', 'site2', 'location2');
                } else if (isset($_POST['sortSatThree'])){
                    database('registrationSat', 'site3', 'location3');
                }
            } else {
                // the order of the table is pre-set to be arranged in the alphabetical order of students' names
                database('registrationSat', 'studentName', '0');
            }
        ?>

                </tr>
            </table>
        <hr>

        <table>
            <tr>
                <!-- table headers for sunday as buttons for sorting the table -->
                <th><form action="viewRegistration.php" method="POST"><input type=submit name="sortSunName" value='Name' style='width:100%'></form></th>
                <th><form action="viewRegistration.php" method="POST"><input type=submit name="sortSunOne" value='Sun 1:30' style='width:100%'></form></th>
                <th><form action="viewRegistration.php" method="POST"><input type=submit name="sortSunTwo" value='Sun 4:30' style='width:100%'></form></th>
            
        <?php
            // sort the table by student name in ascending order
            // a function in database, 'order by' is used
            if ($_SERVER['REQUEST_METHOD']  === 'POST') {
                // desired sorting actions are triggered when buttons on the table are clicked
                if (isset($_POST['sortSunName'])){
                    // sort the table by student name in ascending order                    
                    database('registrationSun', 'studentName', '0');
                } else if (isset($_POST['sortSunOne'])){
                    // sort the table by first location, first, in-site locations then the off-site locations in alphabetical order                    
                    database('registrationSun', 'site1', 'location1');
                } else if (isset($_POST['sortSunTwo'])){
                    // sort the table by second location, first, in-site locations then the off-site locations in alphabetical order
                    database('registrationSun', 'site2', 'location2');
                }
            } else {
                // the order of the table is pre-set to be arranged in the alphabetical order of students' names
                database('registrationSun', 'studentName', '0');
            }
        ?>

            </tr>
        </table>

    </body>
</html>