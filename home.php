<?php

include 'header.php';
include 'includes/functions.inc.php';
include 'includes/connect.php';

if(empty($_SESSION['username'])){
		header('Location: includes/logout.inc.php');
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="background-color: lightgrey;">

	<?php $friends = getFriendsDetails();

	if($friends){
  		foreach ($friends as $f) {
  			# code...
  			//$userDetailsPhp = getUserDetails($f['user_name']);
  			$postsTable = getPosts($f['user_name']);
  			if($postsTable){
  			foreach ($postsTable as $p ) {
	  			echo'<div class="jumbotron" style="position: relative; width: 80%; left: 110px; top: 4px; padding-bottom: 15px;">';
				  echo'<h6 class="display-4"><p style="font-family: Century Gothic";>'.$f['user_name'].'</p></h6>';
				  	echo'<p class="lead">'.$p['body'].'</p>';
				  echo'<hr class="my-4">';
				  echo'<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>';
				  echo'<p class="lead">
				    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
				  </p>';
				echo'</div>';
				}
			}
  		}
  	}
			
	?>
</body>;

</html>