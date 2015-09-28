<!Doctype html>
<html>
	<head>
			<title>LOGGED IN</title>
			<link rel="stylesheet" href="./css/paginatestyle.css" type="text/css">
			<link rel="stylesheet" href="./css/tab.css" type="text/css">

	</head>
	<body>

		<!--header Division-->
		<div id="header">
			<h1 style="width:90% position:relative" >Movie Database </h1>
 
    			<?php
            			session_start();
    			?>
			    <?php
			        if($_SESSION["user_name"]) {
			    ?>
			       <span> Welcome !!<?php echo $_SESSION["user_name"]; ?>. Click here to <a href="http://movies.sj/V2.0/index.php" tite="Logout" >Logout.</a>
			        <?php
			        }?>
    				</span>
    	</div>
    		<!--Paginate Division-->

    		<?php

				include('pconfig.php');    //include of db config file
				include ('paginate.php'); //include of paginat page

				$per_page = 5;         // number of results to show per page
				$result = mysql_query("SELECT * FROM movies");
				$total_results = mysql_num_rows($result);
				$total_pages = ceil($total_results / $per_page);//total pages we going to have

				//-------------if page is setcheck------------------//
				if (isset($_GET['page'])) {
				    $show_page = $_GET['page'];             //it will telles the current page
				    if ($show_page > 0 && $show_page <= $total_pages) {
				        $start = ($show_page - 1) * $per_page;
				        $end = $start + $per_page;
				    } else {
				        // error - show first set of results
				        $start = 0;              
				        $end = $per_page;
				    }
				} else {
				    // if page isn't set, show first set of results
				    $start = 0;
				    $end = $per_page;
				}
				// display pagination
				$page = intval($_GET['page']);

				$tpages=$total_pages;
				if ($page <= 0)
				    $page = 1;
				?>
    	<div class="container">
       
       		<div class="row">
            
             
                <?php
                    $reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;
                    echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
                    ?>
                </div>
                    <?php

                    // loop through results of database query, displaying them in the table 
                    for ($i = $start; $i < $end; $i++) {
                        // make sure that PHP doesn't try to show results that don't exist
                        if ($i == $total_results) {
                            break;
                        }
                ?>
                      
                        <!--echo out the contents of each row into a table-->

                    <div class = 'tab'><strong><b><?php echo mysql_result($result, $i, 'movie_id'); ?> </b></strong><br>
                        <i>Genre :<?php echo mysql_result($result, $i, 'genre'); ?> <br>
                        Year :<?php echo mysql_result($result, $i, 'year'); ?> <br> 
                         Rating :<?php echo mysql_result($result, $i, 'rating'); ?> <br> 
                         Actors :<?php echo mysql_result($result, $i, 'actors'); ?> <br> 
                        Directors :<?php echo mysql_result($result, $i, 'directors'); ?> <br> 
                         <br> <center><img src='<?php echo mysql_result($result, $i, "thumbnail"); ?>' width='150' height='150'/></center> <br>

                        <form method= 'POST' action = '' name = 'delete' id='delete' onsubmit='return del("<?php echo mysql_result($result, $i, "movie_id"); ?>");'>
                        <input type ='hidden' name = 'movid'  value='<?php echo mysql_result($result, $i, "movie_id"); ?>'>
                        <input type ='submit' value = 'delete' name = 'delete'></form>

                        <a href='http://www.imdb.com/title/<?php echo mysql_result($result, $i, 'imdbcode'); ?>'><em> Read</em></a>

                        <form name = 'update' id='update' method= 'GET' action = './update.php'>
                        <input type = 'hidden' name ='movid' value =<?php echo mysql_result($result, $i, "movie_id");?>>
                        <input type ='submit' value='update'> </form>
                    </div>
            <?php }?>
            <div class="row">
            	<br> 
				    <div class = 'round-button'>
				            <a href="./insert.php">
				                <img src="./plus-sign8.svg" alt="Home" />
				            </a>
				        </div>
			</div>

				    
            <?php
       
                    // close table
                echo '<div class="pagination"><ul>';
                    if ($total_pages > 1) {
                        echo paginate($reload, $show_page, $total_pages);
                    }
                    echo "</ul></div>";
            // pagination

            ?>
        </div>
	
			<div id="footer">
				Footer
			</div>
	</body>
	<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "movies";

            $movid = $_POST["movid"];
           if(isset ($_POST["delete"]))
                {
                    try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
                            $sql = "DELETE FROM movies WHERE movie_id = '$movid' ";
                            
                             $conn->exec($sql);
                            header("Location: http://movies.sj/V2.0/logd.php");         
                            exit;               
                        }
                        /* No rows matched -- do something else */
                    catch(PDOException $e){
                        echo $sql . "<br>" . $e->getMessage();
                    }
                }
            $conn = null;
        ?>
    </body>
</html>