<!DOCTYPE html>
<!-- saved from url=(0030)http://movies.sj/movie_db.html -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <link rel="stylesheet" href="./css/tab.css" type="text/css">
    <link rel="stylesheet" href="./css/button.css" type="text/css">



    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    

    <script>
    $(document).ready(function(){
        $("#search-box").keyup(function(){
            $.ajax({
            type: "POST",
            url: "readMovie.php",
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

    function selectMovie(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
    }

    function del(mid)
    {
       return confirm("ARE You Sure You Want to DELETE The Movie??");

    }
    function hidelogin()
    {
        document.getElementById("signup").style.visibility = "hidden"; 
        document.getElementById("login1").style.visibility = "hidden";
    }     

    </script>

    
</head>

<body class="s1">

    <!--Head-->

    <div id="header" >
        <center><h1 >Movie Database </h1></center>
    </div>

    <!--Live Search -->
     <div class="frmSearch">
        <input type="text" id="search-box" placeholder="Search Movie.." />
        <a href="#loginScreen" id='login' class="btn" style="float:right; ">Log In</a> &nbsp;

        <a href = 'signup.php' id="signup" class="btn" style="float:right;">Sign Up</a>
        <div id="suggesstion-box">
     </div>
    </div>


    <!--LOGIN SCREEN-->

    
    <div id="loginScreen" > 
        <h3> LOGIN </h3>
        <a href="#" class="cancel">&times;</a> 
        <div class = 's1' style ="float:center">
            <form method="POST" action="logged.php" name='signin'>
                <input type= 'text' name='email' id='email' placeholder='EMAIL' style="width:100%; height:50%;">
                <input type= 'password' name='pass' id='pass' placeholder='Password'>
                <input type='SUBMIT' value='signin'>
            </form>
        </div>
    </div> 
    <div id="cover" > 
    </div> 

    <!--Main Section-->
  
    <div id="section1" class='movie'>
    <h2>Recently Added</h2>  
    <?php
        require('config.php');
   
        
        $sql = "SELECT * FROM movies ORDER BY movie_id DESC LIMIT 0,5";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)) {
                echo    "<div class = 'tab'><strong><b>{$row['moviename']} </b></strong><br>".
                        " <i>Genre :{$row['genre']} <br>".
                        " Year :{$row['year']} <br> ".
                        " Rating :{$row['rating']} <br> ".
                        " Actors :{$row['actors']} <br> ".
                        "Directors :{$row['directors']}  <br> ".
                        "<br> <center><img src='".$row['thumbnail']."' width='150' height='150'/></center> <br>".
                        "<a href='http://www.imdb.com/title/".$row['imdbcode']."'><em> Read</em></a> </div>";
            }
        }
    mysqli_close($conn); 
?>
</div>
<div id="section2" class="pmovie">
    <h2>Most Popular</h2>  
        <?php
        include 'config.php';

        
            $sql = "SELECT * FROM movies ORDER BY rating  LIMIT 0,5";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {

                while($row = mysqli_fetch_assoc($result)) {
                    echo    "<div class = 'tab'><strong><b>{$row['moviename']} </b></strong><br>".
                            " <i>Genre :{$row['genre']} <br>".
                            " Year :{$row['year']} <br> ".
                            " Rating :{$row['rating']} <br> ".
                            " Actors :{$row['actors']} <br> ".
                            "Directors :{$row['directors']}  <br> ".
                            "<br> <center><img src='".$row['thumbnail']."' width='150' height='150'/></center> <br>".
                            "<a href='http://www.imdb.com/title/".$row['imdbcode']."'><em> Read</em></a> </div>";
                }
            }
        mysqli_close($conn); 
    ?>
</div> 

</body>
</html>





