<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
    
    <head>
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    </head>

    <body>
        <h1>Halla Registration System</h1>
        <h2>Register</h2>

        <!-- drop-down box for the list of insite locations and the submit button --> 
        <form action = "register_db.php" method = "POST"> 
            <section class="inSite">
                <h3>In-site Location</h3>
                <div>
                    <label>Location</label>
                    <select name = "insite_location">
                        <option value = "HallaNorth">Halla North</option>
                        <option value = "HallaEast">Halla East</option>
                        <option value = "Canteen">Canteen</option>
                        <option value = "Art Dept">Art Department</option>
                        <option value = "PAC">PAC</option>
                        <option value = "Main School">Main School Building</option>
                        <option value = "Jeoji">Jeoji</option>
                        <option value = "Sarah">Sarah</option>
                        <option value = "Mulchat">Mulchat</option>
                        <option value = "Geomun">Geomun</option>
                        <option value = "Noro">Noro</option>
                    </select>
                </div>
                <br>
                <button type = "Submit" name = "insite_btn">Submit</button>
            </section>
        </form> 
        <hr>

        <!-- drop-down box for the list of offsite locations and the submit button -->    
        <form action = "register_db.php" method = "POST">   
            <section class="offSite">
                <h3>Off-site Location</h3>
                <div>
                    <label>Location</label>
                    <select name = "offsite_location">
                        <option value = "CU">CU</option>
                        <option value = "Starbucks">Starbucks</option>
                        <option value = "Edu-Town">Edu-Town</option>
                        <option value = "Hakwon">Hakwon</option>
                        <option value = "Exeat">Exeat</option>
                        <option value = "Others">Others</option>
                    </select>
                </div>
                <br>
                <button type = "Submit" name = "offsite_btn">Submit</button>
            </section>
        </form>
        <hr>

        <form action = "logout.php" method = "POST">
            <button type = "Submit" name = "logout_btn" class = "logout_btn">Log Out</button>
        </form>
        <br>
        
    </body>
</html>