<ul class="list-unstyled">
	<li><a href="j_se_home.php">Home</a></li>
	<li><a href="j_se_view.php">View Resume</a></li>
	<li><a href="j_se_edit_profile.php">Edit Profile</a></li>
	<?php
		/* return name and id from $job_users table*/
	$name=$_SESSION['user_name']; // $name= present user name
	$user_id = return_id($conn,"user_name",$name,$job_users); // return current user id
	$sql="select count(*) as count from $user_notification where `user_id`='$user_id' and `view`='0'";
	$res=mysql_query($sql);
	$result=mysql_fetch_array($res);
	$notification=$result['count'];
	?>
	<li><a href="j_pre_notification.php">Notification <span style="color:red;margin-left:20px;"><?php echo $notification; ?></span></a></li>
    <li><a href="j_online_application.php">Online Application List</a></li>
	<li><a href="j_se_change_pass.php">Change Password</a></li>
	<li><a href="logout.php">Sign Out</a></li>
</ul>