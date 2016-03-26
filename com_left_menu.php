	<?php
		/* return name and id from $job_users table*/
	$name=$_SESSION['user_name']; // $name= present user name
	$com_name=return_com($conn,"user_name",$name,$job_users);
	$sql="select count(*) as count from $com_nofitication where `com_name`='$com_name' and `view`='0'";
	$res=mysql_query($sql);
	$result=mysql_fetch_array($res);
	$notification=$result['count'];
	// cv bank count
	$count='0';
	$sql1="select count(*) as count from $cv_send where `com_name`='$com_name' and `view`='0' and `continue`='1'";
	
	$res1=mysql_query($sql1);
	$result1=mysql_fetch_array($res1);
	$total_cv=$result1['count'];
	
	?>
						<ul class="list-unstyled">
							<li><a href="com_home.php">Home</a></li>
							<li><a href="com_job_post.php">Post new Job</a></li>
							<li><a href="com_cv_bank.php">CV Bank<span style="color:red;margin-left:20px;"><?php echo $total_cv; ?></span></a></li>
							<li><a href="com_edit_acc.php">Edit Account info</a></li>
							<li><a href="com_notification2.php">Notification<span style="color:red;margin-left:20px;"><?php echo $notification; ?></span></a></li>
							<li><a href="com_jobpost_list.php">Job Post List</a></li>
							<li><a href="com_change_pass.php">Change Password</a></li>
							<li><a href="logout.php">Sign Out</a></li>
						</ul>