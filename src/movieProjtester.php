<!DOCTYPE html> <html> <head> <meta charset="ISO-8859-1"> <title>World of 
Movies</title> </head> <body> <h2>World of Movies</h2> <h4>Team Members: Bryan Denman, 
Jay and Susana </h4> <br> 
<h4>Relations:</h4> 
<ul style="list-style-type:none;"> 
<li><a href="https://hopper.csustan.edu/~bdenman/MoviePage.php">Movie</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/ActorsPage.php">Actors</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/AwardPage.php">Award</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/AwardsPage.php">Awards</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/AwardWinner.php">Award Winner</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/CastAs.php">Cast As</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Directed.php">Directed</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Directors.php">Directors</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/FilmedAt.php">Filmed At</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Genre.php">Genre</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Locations.php">Locations</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/People.php">People</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Produced.php">Produced</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Producers.php">Producers</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/ReviewedBy.php">ReviewedBy</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/Reviewers.php">Revieweres</a></li> </ul> 
<hr> <h3>Queries</h3>
<ul style="list-style-type:none;">  
<li><a href="https://hopper.csustan.edu/~bdenman/ACMTable.php">Query 1</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/PMCbudgets.php">Query 2</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/MCAwards.php">Query 3</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/MACount.php">Query 4</a></li> 
<li><a href="https://hopper.csustan.edu/~bdenman/MRating.php">Query 5</a></li> 
</ul>
<hr> <h3>Ad Hoc</h3>
	<?php
  	include 'dbconn_movie.php';
   	// Get all the Movies from movie table
    	$moviesql = "SELECT * FROM movie";
    	$all_movies = mysqli_query($conn,$moviesql);
	//
	?>
	
	<form action="" method="post">
	  <label>Select a Movie</label>
      <select name="Movie">
        <?php
             // use a while loop to fetch data
             // from the $all_categories variable
             // and individually display as an option
             while ($movie = mysqli_fetch_array(
                 $all_movies,MYSQLI_ASSOC)):;
        ?>
        <option value="<?php echo $movie["Mid"];
           // The value we usually set is the primary key
           ?>">
           <?php echo $movie["title"];
           // To show the beer name to the user
           ?>
        </option>
        <?php
           endwhile;
           // While loop must be terminated
        ?>
      </select>
      <input type="submit" name="cast" value="Cast">
      <input type="submit" name="reviews" value="Reviews">
      <input type="submit" name="producedby" value="Produced by">
      <input type="submit" name="popular" value="Awards">
      <input type="submit" name="specials" value="Director">
	<br></br>
     
  </form>
   
      <?php
      if(isset($_POST['cast'])){
    	  if(!empty($_POST['Movie'])) {
        	$selected = $_POST['Movie'];
        	echo 'You have chosen Cast for movie: ' . $selected;
                $movieTitleSql = "SELECT * FROM movie where Mid = " . $selected;
		$result = $conn->query($movieTitleSql);
		while($row = $result->fetch_assoc()){
    		echo " ".$row['Title']."<br>";
	  	}
        	$movieCastSql = "SELECT * FROM CastAs where Mid = ". $selected ;
    		$result = $conn->query($movieCastSql);
		if ($result->num_rows > 0) {
    			// output data of each row
    			while($row = $result->fetch_assoc()) {
        			echo "<br> ". " - Ppl_id: ". $row["ppl_id"]. " 
			Character Name: " . $row["character_name"] . " Description: " . 
			$row["character_description"] . "<br>";
    			}
	   	} else {
    			echo " - 0 results";
	   	}
    	   } else {
        	echo 'Please select the value.';
    	   }
      }

//
      if(isset($_POST['reviews'])){
        if(!empty($_POST['Movie'])) {
          $selected = $_POST['Movie'];
        	echo 'You have chosen Cast for movie: ' . $selected;
                $movieTitleSql = "SELECT * FROM movie where Mid = " . $selected;
		$result = $conn->query($movieTitleSql);
		while($row = $result->fetch_assoc()){
    		echo " ".$row['Title']."<br>";
	  	}
          // NEED to put reviews here
          $mostPopularSql = "SELECT * FROM Restaurant r inner join RestaurantN rn on 
r.Raddress = rn.RAddress
				 where rn.MostPopularItem = '". $beerName . "'" ;
           $result = $conn->query($mostPopularSql);
           if ($result->num_rows > 0) {
               // output data of each row
                while($row = $result->fetch_assoc()) {
                   echo "<br> ". " - Restaurante: ". $row["Name"] . " - Address: " . 
$row["RAddress"] .
			 " - Hours: " . $row["HoursofOperation"] ."<br>";
              
                }
           } else {
                echo " - 0 results";
           }
        } else {
          echo 'Please select the value.';
        }
      }
//
    if(isset($_POST['producedby'])){
        if(!empty($_POST['Movie'])) {
          $selected = $_POST['Movie'];
        	echo 'You have chosen Cast for movie: ' . $selected;
                $movieTitleSql = "SELECT * FROM movie where Mid = " . $selected;
		$result = $conn->query($movieTitleSql);
		while($row = $result->fetch_assoc()){
    		echo " ".$row['Title']."<br>";
	  	}
          // NEED to put produced by here
          $specialsSql = "SELECT * FROM Special where Bid = " . $selected;
           $result = $conn->query($specialsSql);
           if ($result->num_rows > 0) {
               // output data of each row
                while($row = $result->fetch_assoc()) {
                   echo "<br> ". " - Start Date: ". $row["StartDate"] . " - End: " . 
								$row["EndDate"] . " - Season: " . $row["Season"] ."<br>";
                }
           } else {
                echo " - 0 results";
           }
        } else {
          echo 'Please select the value.';
        }
      }
//
//
//
 
//
//

 if(isset($_POST['adhoc'])){
        $adhocsql = $_POST['adhocvar'];
        
        $url="https://hopper.csustan.edu/~bdenman/adhocPage.php?adhocsql=" .$adhocsql;
       echo "<script>window.location = '" .$url . "'</script>";
      } 
//
	?> <hr> <h4>Ad-Hoc Query:<h4> <h5> Only applicable for Movie and Actor Table. 
</h5> <form action="" method="post">
  <label for="fname">Enter your query here:</label>
  <input type="text" id="adhocvar" name="adhocvar" size="90"><br><br>
  <input type="button" value="Clear">
  <input type="submit" name="adhoc" value="Submit"> </form> </body> </html>
