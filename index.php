<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">


    <body>
        <h1>Halla Registration System</h1>

        <!-- Input fields for user id and password -->
        <form action = "login.php" method = "POST">
            <div>
                <label>ID</label>
                <input type = "text" name = "userID">
            </div>
            <br>
            <div>
                <label>PW</label>
                <input type = "text" name = "userPW">
            </div>
            <br>
            
            <!-- Login button -->
            <button type="submit" id="login_btn">Login</button>
        </form>

    </body>
</html>