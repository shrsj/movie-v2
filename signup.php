<!DOCTYPE html>
<html>
<head>
	<title> Add Movies To Database</title>
    <link rel="stylesheet" href="./css/insert.css" type="text/css">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    
    <script>
        $(document).ready(function(){
            $("#search-box").keyup(function(){
                $.ajax({
                type: "POST",
                url: "readCountry.php",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                    $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                    $("#search-box").css("background","#FFF");
                }
                });
            });
        });

        function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
        }
    </script>

</head>
<body >
    <div id="header">
        <h1>Movie Database</h1>
    </div>
	<form method='POST' action = '' name ='signup' id = 'section' class ='s1' >
	 <input type ='text' name='fname' id = "fname" autofocus placeholder = 'First Name'>&nbsp;
     <input type ='text' name='fname' id = "lname" autofocus placeholder = 'Last Name'>
    <br>
    Gender : <input type='radio' name='gender' value='M'>Male
             <input type='radio' name='gender' value='F'>Female
             <br>

              Year of Birth : <select name="yob" id='yob' >
    <?php $val =1920;
        while($val<2016)
        {
            echo "<option value=".$val.">".$val."</option>";
            $val = $val+1;
        }
    ?>
    </select>
              
    <br>
    <br>
    
    <div class="frmSearch">
    <input type="text" id="search-box" placeholder="Country " name='country' />
    <div id="suggesstion-box"></div>
    <br>

   

    <input type ='number' name='zipcode' id = 'zipcode' placeholder = 'Zip/Postal Code' autofocus required>
    <br>

    <input type ='email' name='email' id = 'email' placeholder = 'Email Address' autofocus required>
    <br>

    <input type ='password' name='pass' id = 'pass' placeholder = 'Password' required>
    <br>

    <input type ='password' name='cpass' id = 'cpass' placeholder = 'Confirm Password' required>
    <br>
    <br/>

    <img src="captcha_image.php" />
    <input type="text" name="captcha_input" size="15" required>

    <input type = "submit">
</form>
<div id="footer">
    </div>
</body>

</html>
<?php
// *** The CAPTCHA comparison - http://frikk.tk ***
// *** further modifications - http://www.captcha.biz ***

session_start();

// *** We need to make sure theyre coming from a posted form -
//  If not, quit now ***
if ($_SERVER["REQUEST_METHOD"] <> "POST")
{
    die("");
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

// *** The text input will come in through the variable $_POST["captcha_input"],
//  while the correct answer is stored in the cookie $_COOKIE["pass"] ***
if ($_POST["captcha_input"] == $_SESSION["pass"])
{

            $hostname = 'localhost';
            $username = 'root'; 
            $password = '';
            $dbname = 'movies';


// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";



if (empty($_POST["fname"])) {
     $nameErr = "Name is required";
   } else {
     $fname = test_input($_POST["fname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   if (empty($_POST["lname"])) {
     $nameErr = "Name is required";
   } else {
     $lname = test_input($_POST["lname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
    if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }

   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }

   if (empty($_POST["pass"])) {
     $passErr = "Password is required";
    } 
    else if (empty($_POST["cpass"])) {
        $passErr = "Confirm your password";
   } else {
            if($_POST["cpass"] == $_POST["pass"])
            {
                $pass = test_input($_POST["pass"]);
            }
     
        }
   
            $country    = $_POST["country"];
            $zipcode    = $_POST["zipcode"];
            $yob    = $_POST["yob"];


            try {
                $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sql = "INSERT INTO userlogin ( fname, lname, gender, birthyear, country, zipcode, email, pass)
                          VALUES ('$fname' ,'$lname', '$gender','$yob','$country','$zipcode','$email','$pass' )";
               // use exec() because no results are returned
                $conn->exec($sql);
                echo "Record updated successfully";
                }
            catch(PDOException $e)
                {
                echo $sql . "<br>" . $e->getMessage();
                }

            $conn = null;

    // *** They passed the test! ***
    // *** This is where you would post a comment to your database, etc ***
    echo "Asta La vista!!! Record is Updated. <br><br>";
       

} else {
    // *** The input text did not match the stored text, so they failed ***
    // *** You would probably not want to include the correct answer, but
    //  unless someone is trying on purpose to circumvent you specifically,
    //  its not a big deal.  If someone is trying to circumvent you, then
    //  you should probably use a more secure way besides storing the
    //  info in a cookie that always has the same name! :) ***
    echo "Sorry, your CAPTCHA was wrong.<br><br>";
    echo "    - Please click back in your browser and try again <br><br>";

}
?>