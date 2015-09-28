<!DOCTYPE html>
<html>
<head>
	<title> Add Movies To Database</title>
    <link rel="stylesheet" href="css/insert.css" type="text/css" />
</head>
<body >
    <div id="header">
        <h1>Movie Database</h1>
    </div>
	<form method='POST' action = 'insert1.php' name ='insert' id = 'section' class ='s1' >
	<!--Movie Name  :--> <input type ='text' name='moviename' id = "moviename" autofocus placeholder = 'Movie Name'>
    <br>
    
    Movie Genre  <select name="genre" id='genre' placeholder =' Genre'>
  					<option value="Action">Action</option>
  					<option value="Thriller">Thriller</option>
  					<option value="Horror">Horror</option>
  					<option value="Comedy">Comedy</option>
  					<option value="Fiction">Fiction</option>
				  </select>
    
    <br>
    Year of Release : <select name="yob" id='yob' >
    <?php $val =1920;
        while($val<2016)
        {
            echo "<option value=".$val.">".$val."</option>";
            $val = $val+1;
        }
    ?>
    </select>
    <br>

    Rating 		: <select name="rating" id='rating' >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
    <br>
    
    <input type ='text' name='actors' id = 'actors' placeholder = 'Actors' autofocus>
    <br>
    
    <input type ='text' name='directors' id = 'dierctors' placeholder = 'Directors' autofocus>
    <br>
    
    <input type ='number' name='length' id = 'length' placeholder = 'Length(mins)' >
    

<script type='text/javascript'>

function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
    <input type = 'text' name='thumbs' id = 'thumbs' placeholder = 'Thumbnail URL' onchange="readURL(this);" />		
    
   
    <input type = 'text' name = 'imdb' id = 'imdb' placeholder = 'IMDB unique code' >
    <img src="captcha_image.php" />
    <input type="text" name="captcha_input" size="15">
    <input type = "submit">
</form>
<div id="footer">
    </div>
</body>

</html>



