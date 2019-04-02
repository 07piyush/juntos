<?php
	include 'header.php';
	include 'includes/functions.inc.php';
	if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>juntos profile</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


<div class="container-fluid">
	<div class="row">

		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	  		<div class="carousel-inner" style="height: 400px;">
	    		<div class="carousel-item active">
	      			<img class="d-block w-100" src="uploads/lambofGod.jpg" alt="First slide">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="uploads/car.jpg" alt="Second slide">
	    		</div>
	    		<div class="carousel-item">
	      			<img class="d-block w-100" src="uploads/earth1.jpg" alt="Third slide">
	    		</div>
	  		</div>
	  	<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
	    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Previous</span>
	  	</a>
	  	<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
	    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    	<span class="sr-only">Next</span>
	  	</a>
		</div>

	    <div class="col-sm background-dark">
		    
		    <div class="card" style="width: 18rem;position: relative;bottom: 150px;">
		  		<img class="card-img-top" src="../img/totem.jpg" alt="Card image cap">
			  	<div class="card-body">
			    	<h5 style="color: red"> <?php echo '@'.$_SESSION['username']; ?> </h5>
			    	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
		    		<a href="includes/logout.inc.php" class="btn btn-outline-danger">Log Out!</a>
		    		<a href="#" class="btn btn-outline-success" style="position: relative; float: right;">UpdateThought!!</a>
		  		</div>
			</div>
			<?php 
			$peopleIFollow = getFriendsDetails();
			foreach ($peopleIFollow as $person) {
				$details = getThoughtStatementArea($person['user_name']);
				echo'
				<div class="card" style="width: 15rem;position: relative;bottom: 120px; padding-bottom:15px;">
			  		<img class="card-img-top" src="../img/totem.jpg" alt="Card image cap">
				  	<div class="card-body">
				    	<h5 style="color: ">';echo '@'.$person['user_name'];echo'</h5>
				    	<p class="card-text">';echo 'body here!'; echo'</p>
			    		<a href="#" class="btn btn-warning">Agree!</a>
			    		<a href="#" class="btn btn-success" style="position: relative; float: right;">Visit Profile</a>
			  		</div>
				</div>';
				echo '<br>'; 
			}
			
				?>
	    
	    </div>
	    
	    <div class="col-7" style="position: relative; top: 5px;">
	      <ul class="nav nav-tabs">
			  
			  <li class="nav-item">
			    <a class="nav-link active" href="#">Post</a>
			  </li>
			  
			  <li class="nav-item">
			    <a class="nav-link" href="#">Link</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link disabled" href="#">Disabled</a>
			  </li>
			</ul>
			<div>
	
				<form style="position: relative;top: 5px; border-radius: 5px; border-color:grey; border-style: ridge; padding: 3px; border-width: 2px; border-color: #adad85; box-shadow: 4px 4px;" method="POST" action="includes/upload.inc.php">
					<div class="form-group">
    					<label for="exampleFormControlTextarea1">How you Doin!</label>
    					<textarea class="form-control" name="postData" id="exampleFormControlTextarea1" rows="3"></textarea>
  					</div>

  					<!-- upload file 
  						<div style="position: relative; float: right; right: 300px; bottom: 2px;"></div>
  					-->
				    <input type="file" name="fileSelected">
					<button type="submit" name="submitPost" class="btn btn-primary" style="position: relative; left: 10px; bottom: 4px;">Post</button>
				</form>
			</div>
			<br>
			<!--**Print all the cards** -->
			<?php $postsTable = getPosts($_SESSION['username']); 
			error_reporting(E_ALL ^ E_WARNING); 
			foreach ($postsTable as $p ) {
				$cardTypes = array("bg-primary mb-3", "bg-secondary mb-3", "bg-success mb-3", "bg-danger mb-3", "bg-warning mb-3", "bg-info mb-3", " bg-dark mb-3");
				$thisCardis = rand(0,6);
				echo'<div  style="padding:3px; position: relative; ">';
					echo '<div class="card text-white '.  $cardTypes[$thisCardis]. '"' . '>';
					echo'<div class="card-header">'. $_SESSION['emailid'] .'<div style="position:relative; float: right;">'.$p[post_date].'</div></div>';
					  echo'<div class="card-body">';
					    echo'<h7 class="card-title">Dark card title</h7>';
					    echo'<p class="card-text"><h4>'. $p['body'] .'</h4></p>';
					  echo'</div>';
					echo'</div>';
				echo'</div>';
			}
			
		?>
	    </div>
	    

	    <div class="col-sm">
	    </div>

</div>
</body>
</html>