<?php 
 include 'global_variables.php';
 include 'config.php';
 include 'service_config.php';
 include 'functions.php';
 include 'link_test.php';
	$name=$_SESSION['user_name'];
	$user_id = return_id($conn,"user_name",$name,$job_users); 
	if ($_REQUEST['t']=="r" )
			{
				extract($_POST);
				$id=$_REQUEST['id'];
				$sql="update $com_job_post set `post`='2' where `id`=$id";
				//echo $sql;
				$res=mysql_query($sql);
				if($res)
					{
						?>
							<script>
							alert('Remove Job Post Successfully');
							window.location = "com_jobpost_list.php";
							</script>
						<?php
					}
				exit;
			}
		 		
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/test.css">
		<!-- new bootstrap set -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="js1/jquery.datatables/bootstrap-adapter/css/datatables.css" />
		
	</head>
	<body>
		<div class="container">
			<!-- ******************** start logo div ******************-->
				<?php include 'header_n.php';?>
				
			<!-- ******************** end logo div ******************-->
			<br>
		<!-- --------------------- main body ---------------------->	
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div id="custom_list" class="col-md-3">
						<?php include 'com_left_menu.php';?>
				</div>	
				<div class="col-md-9">
					<div class="content">
					<form name="" id="" action="com_jobpost_list.php" method="post">
							<div class="table-responsive">
								<table class="table table-bordered" id="datatable-icons" >
									<thead>
										<tr>
											<th style="text-align: center;">No</th>
											<th style="text-align: center;">Job Title</th>
											<th style="text-align: center;">Job Category</th>
											<th style="text-align: center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$qry="select * from $com_job_post where `user_id`='$user_id' and `post` NOT LIKE '2' and `continue` NOT LIKE 'No' ORDER BY `id` DESC";
							
										$res=mysql_query($qry);
										$no=1;
										if($res)
										{
											while($date=mysql_fetch_array($res))
											{
												$p_id=$date[id];
												$post=$date[post];
												
												echo "<tr>";
												echo "<td style='width: 5%; text-align: center;'>$no</td>";
												echo "<td style='width: 30%;'>$date[job_title]</td>";
												echo "<td style='text-align: center;'>$date[job_cat]</td>";
												if($post==0){
												echo "<td style='width: 25%;'><center>
												<a class='btn btn-danger' href='com_jobpost_list.php?id=$p_id&t=r'>Remove</a></center>
												</td>";
												}
												else
												{
												echo "<td style='width: 25%; color:green;'><center>
												Posted
												</center></td>";
												}
												echo "</tr>";
												$no++;
											
											}
										} 
										?>
									</tbody>
								</table>							
							</div>
							
							<form>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="container">
		<?php include 'footer.php';?>
		</div>
		<!-- js file start -->
			<script src="bootstrap/js/ie-emulation-modes-warning.js"></script>
			<script src="bootstrap/js/ie10-viewport-bug-workaround.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script src="js1/jquery.js"></script>
	
	<script type="text/javascript" src="js1/behaviour/general.js"></script>
  <script src="js1/jquery.ui/jquery-ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="js1/jquery.datatables/jquery.datatables.min.js"></script>
	<script type="text/javascript" src="js1/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
	
	
	 <script type="text/javascript"> 
      $(document).ready(function(){
        //initialize the javascript
       // App.init();
        App.dataTables();
        
       /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
            sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
            sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
            sOut += '</table>';
             
            return sOut;
        }
       
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img class="toggle-details" src="images/plus.png" />';
        nCloneTd.className = "center";
         
        $('#datatable2 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#datatable2 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#datatable2').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#datatable2').delegate('tbody td img','click', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                this.src = "images/plus.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                this.src = "images/minus.png";
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
        
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
      $('.dataTables_length select').addClass('form-control');    

        //Horizontal Icons dataTable
        $('#datatable-icons').dataTable();
      });
    </script>
	
	<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>