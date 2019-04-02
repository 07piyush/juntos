<?php

function getPosts($user_namePhp){
	include 'includes/connect.php';
				if(!$conn){
					echo "connection failed!";
			}
			else{
				$PostsTableQuery = " SELECT body, post_date, likes FROM posts WHERE user_name = '$user_namePhp' ORDER BY post_id DESC; ";
				$result = ( mysqli_query($conn, $PostsTableQuery) );
				if( mysqli_num_rows($result)>0){
					//var_dump('$result');
					return $result; 
				}
				else{return 0;}


		}
				}



function getFriendsDetails(){
	include 'includes/connect.php';
	$user = $_SESSION['username'];
	$searchWhomIFollowQuery = " SELECT user_name FROM followers WHERE follower = '$user'; ";
	$result = ( mysqli_query($conn, $searchWhomIFollowQuery) );
				if( mysqli_num_rows($result)>0){
					return $result;}
				else{return 0;}
}

function getWhoFollowMe()
{
	include 'includes/connect.php';
	$user = $_SESSION['username'];
	$searchWhomIFollowQuery = " SELECT follower FROM followers WHERE user_name = '$user'; ";
	$result = ( mysqli_query($conn, $searchWhomIFollowQuery) );
				if( mysqli_num_rows($result)>0){
					return $result;}
				else{return 0;}

}

function getUserDetails($user_namePhp){
	include 'includes/connect.php';
	$searchUserFLName = "SELECT firstName FROM user_profile WHERE user_name ='$user_namePhp'; ";
	$result = ( mysqli_query($conn, $searchUserFLName) );
	if( mysqli_num_rows($result)> 0){
					return $result;}
				else{return 0;}
}

function getThoughtStatementArea($user_namePhp){
	include 'includes/connect.php';
	$ThoughtsTable = "SELECT body, updateDate, agreeCounts FROM thoughtstatement WHERE user_name ='$user_namePhp'; ";
	$result = ( mysqli_query($conn, $ThoughtsTable) );
	if( mysqli_num_rows($result)> 0){
					return $result;}
				else{return 0;}

}

function getAllConversations(){
	include 'includes/connect.php';
	$user_namePhp = $_SESSION['username'];
	$sentMessages = "SELECT sending_date, message, reciever, sender FROM messages WHERE sender ='$user_namePhp'; ";
	$recievedMessages = "SELECT sending_date, message, sender, reciever FROM messages WHERE reciever ='$user_namePhp'; ";
	$resultSentMessages = ( mysqli_query($conn, $sentMessages) );
	$resultRecievedMessages = ( mysqli_query($conn, $recievedMessages) );
	$result = array($resultSentMessages, $resultRecievedMessages);
	if($result){
					return $result;}
				else{return 0;}
}

function updatePostTable()
	{
		$submitPost = $_POST['submitPost'];
	
		if(filter_has_var(INPUT_POST, '$submitPost') ){

			if(!empty($_POST['postData']) ){
				/*provide mechaninsm to insert post into table*/
				include 'includes/connect.php';
				if(!$conn){
				echo "connection failed!";
				}
				else{
					$postBody = mysqli_real_escape_string($conn, $_POST['postData']);
					$today = date("Y-m-d h:i:s");
					$userid = $_SESSION['username'];
					$likesInit = 0;
					$insertQuery = " INSERT INTO posts(body, user_name, post_date, likes) VALUES ('$postBody','$userid','$today','$likesInit'); ";
					$result = ( mysqli_query($conn, $insertQuery) );
					}
				}
			}
			echo header('Location: profile.php');
		}