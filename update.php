<!DOCTYPE html>
<html>
<head>
    <title> Update Database</title>
    <link rel="stylesheet" href="css/insert.css" type="text/css" />
    <link rel="stylesheet" href="./css/homepage.css" type="text/css">
</head>
<body>
    <div id="header">
        <h1>Movie Database</h1>
    </div>


    <div id="section" class='movie'>
        <h2>Update Records</h2>

    <form method='POST' action = '' name ='insert' id = 'section' class ='s1'>
        <!--Movie Name  :--> <input type ='text' name='moviename' id = "moviename" autofocus placeholder = 'Movie Name'>
 
        Movie Genre  <select name="genre" id='genre' placeholder =' Genre'>
                        <option value="Action">Action</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Horror">Horror</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Fiction">Fiction</option>
                    </select>
     
        <input type = 'number' name='year' id='year' autofocus placeholder = 'Year'>
     
        Rating :<select name="rating" id='rating' >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
  
        <input type ='text' name='actors' id = 'actors' placeholder = 'Actors' autofocus>
     
        <input type ='text' name='directors' id = 'dierctors' placeholder = 'Directors' autofocus>
       
        <input type ='number' name='length' id = 'length' placeholder = 'Length(mins)' >
      



        <input type = 'text' name='thumbs' id = 'thumbs' placeholder = 'Thumbnail URL' onchange="readURL(this);" />
                        
    
        <input type = 'text' name = 'imdb' id = 'imdb' placeholder = 'IMDB unique code' >

                
        <input type = "hidden" name='movid' default = "$_GET['movid']" >
        <img src="captcha_image.php" />
        <input type="text" name="captcha_input" size="15">

        <input type = "submit" name = 'update' >
    </form>
        
    </div>

    <?php
    
        // *** The CAPTCHA comparison - http://frikk.tk ***
        // *** further modifications - http://www.captcha.biz ***

        session_start();

        // *** We need to make sure theyre coming from a posted form -
        //  If not, quit now ***
        if ($_SERVER["REQUEST_METHOD"] <> "POST")
            die("...");

        // *** The text input will come in through the variable $_POST["captcha_input"],
        //  while the correct answer is stored in the cookie $_COOKIE["pass"] ***
        if ($_POST["captcha_input"] == $_SESSION["pass"])
        {
                
        if( isset ($_POST["update"]))
        {
            $movid     = $_GET["movid"];
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "movies";

            $moviename = $_POST["moviename"];
            $genre     = $_POST["genre"];
            $year      = $_POST["year"];
            $rating    = $_POST["rating"];
            $actors    = $_POST["actors"];
            $directors = $_POST["directors"];
            $length    = $_POST["length"];
            $thumbs    = $_POST["thumbs"];
            $imdb      = $_POST["imdb"];

            try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "UPDATE movies SET moviename = '$moviename', genre = '$genre', year = '$year', rating = '$rating',actors = '$actors',directors = '$directors', length = '$length', thumbnail = '$thumbs', imdbcode = '$imdb' WHERE movie_id = '$movid';";

                    // Prepare statement
                    $stmt = $conn->prepare($sql);

                    // execute the query
                    $stmt->execute();

                    // echo a message to say the UPDATE succeeded
                    echo $stmt->rowCount() . " records UPDATED successfully";
                    }
                catch(PDOException $e)
                    {
                    echo $sql . "<br>" . $e->getMessage();
                    }

                $conn = null;
            }
        echo "Asta La vista!!! New record is created. <br><br>";
       

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
<div id='footer'>
</div>

</body>

</html>

