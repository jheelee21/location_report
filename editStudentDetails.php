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
       <h2>Edit Student Details</h2>
 
       <!-- button to return to staff_main page -->
       <span>
           <a href="staff_main.php"><button class="return">Return to main</button></a>
       </span>
       <hr>
 
       <!-- button and field for searching student ID in the database -->
       <span class="search">
           <form action = "editStudentDetails.php" method = "POST">
               <label>Search by ID</label>
               <input type = "text" name = "search_ID">
               <button type = "Submit" name = "search_btn">Search</button>
           </form>
       </span>
       <br>
 
       <?php
           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               // search student details by inputting student id
               if (isset($_POST['search_btn'])) {
                   // select entered student ID and according student details in the database from phpMyAdmin server
                   $sql = mq("SELECT * from `studentDetails` where studentID='".$_POST['search_ID']."'");
                  
                   // store ID, name, yeartroup and room number of the student from the database as variables
                   if($student = $sql-> fetch_array()) {
                       $_SESSION['currentID'] = $student['studentID'];
                       $_SESSION['changeName'] = $student['studentName'];
                       $_SESSION['changeYeargroup'] =  $student['studentYeargroup'];
                       $_SESSION['changeRoomNo'] = $student['studentRoomNo'];
       ?>
                       <!-- Fields for editing any student details for searched student ID -->
                       <span class="edit">
                           <form action = "editStudentDetails.php" method = "POST">
                               <div>
                                   <label>Student Name</label>
                                           <!-- currrently stored student name is displayed in the field as default -->
                                           <input type = "text" name = "edit_name" value = "<?php echo htmlspecialchars($student['studentName']);?> ">
                               </div>
                               <div>
                                   <label>Year Group</label>
                                   <select name = "edit_yeargroup">
                                       <!-- currrent student details are displayed in the field as default -->
                                       <!-- dropdown box for selecting the yeargroup; 12 or 13 -->
                                       <option value="" selected disabled hidden ><?php echo htmlspecialchars($student['studentYeargroup']);?></option>
                                       <option value = "12">12</option>
                                       <option value = "13">13</option>
                                   </select>
                               </div>
                               <div>
                                   <label>Room Number</label>
                                   <!-- currrently stored student room number is displayed in the field as default -->
                                   <input type = "text" name = "edit_roomNo" value = "<?php echo htmlspecialchars($student['studentRoomNo']);?>">
                               </div>
                               <button type = "Submit" name = "edit_btn">Edit</button>
                           </form>
                       </span>
                              
                       <!-- Button to delete searched student's data  -->
                       <span class="delete">
                           <form action = "editStudentDetails.php" method = "POST">
                               <button type = "Submit" name = "delete_btn">Delete</button>   
                           </form>
                       </span>
                       <hr>
 
       <?php
                   } else {
                       // if entered student id is not found in the database
                       echo "<script>alert('Student does not exist. Please check the studentID'); location.href='editStudentDetails.php';</script>";
                   }
 
               }
 
               // deleting selected student searched from 'search'
               else if (isset($_POST['delete_btn'])) {
                   $sql = mq("DELETE FROM `studentDetails` WHERE studentID = '".$_SESSION['currentID']."'");
                   $sql = mq("DELETE FROM `loginDetails` WHERE userID = '".$_SESSION['currentID']."'");
                   $sql = mq("DELETE FROM `registrationSat` WHERE studentID = '".$_SESSION['currentID']."'");
                   $sql = mq("DELETE FROM `registrationSun` WHERE studentID = '".$_SESSION['currentID']."'");
                   echo "<script>alert('Student Deleted'); location.href='editStudentDetails.php';</script>";
               }
 
               // storing student details by the edited details
               else if (isset($_POST['edit_btn'])) {
                   if (isset($_POST['edit_name'])) {
                       $changed_name = $_POST['edit_name'];
                   } else {
                       $changed_name = $_SESSION['changeName'];
                   }
 
                   if (isset($_POST['edit_yeargroup'])) {
                       $changed_yeargroup = $_POST['edit_yeargroup'];
                   } else {
                       $changed_yeargroup = $_SESSION['changeYeargroup'];
                   }
 
                   if (isset($_POST['edit_roomNo'])) {
                       $changed_roomNo = $_POST['edit_roomNo'];
                   } else {
                       $changed_roomNo = $_SESSION['changeRoomNo'];
                   }
                   // updating new student detail to the database
                   $sql = mq("UPDATE `studentDetails` set studentName='".$changed_name ."', studentYeargroup='".$changed_yeargroup."', studentRoomNo='".$changed_roomNo."' where studentID='".$_SESSION['currentID']."'");
                   echo "<script>alert('Student detail edited');</script>";
 
               }
 
               // delete all student details and login details in the database when delete button is clicked
               if (isset($_POST['reset_btn'])) {
                   $sql = mq("DELETE from `studentDetails`");
                   $sql = mq("DELETE from `registrationSat`");
                   $sql = mq("DELETE from `registrationSun`");
                   $sql = mq("DELETE from `loginDetails` where isAdmin = 0");
  
                   echo "<script>alert('All student data deleted.');</script>";
                  
               }
           }
       ?>
 
       <!-- Button to reset student details -->
       <span class="reset">
           <form method = "POST">
               <button type = "Submit" name = "reset_btn">Reset all student data</button>
           </form>
       </span>
 
   </body>
</html>