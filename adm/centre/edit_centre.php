<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
    
	<?php
	
	$centre_id = $_POST[centre_id]; 
	$centre_name = ""; 

	if(isset($centre_id))
	{
		//make sure file is only required once,
		//fail causes error that stops remainder of page from processing
		require_once "../../global/connection.php";
		
		//pull in function library
		require_once "../../global/functions_centre.php";
		
		//call UDF (user-defined function)
		$result = get_centre($centre_id);
        //for testing
		//print_r($result);
		//exit();

		if($result != null)
		{
			$centre_name = $result['centrename'];
		}	
	}
	?>
	 
	<div class="container">
        <div class="starter-template">
            <div class="row">
                <div class="col-xs-12">

                    <div class="page-header">
				<?php //include_once("../global/header.php")?><h2>Centres</h2>
			</div>

                    <form  method="post" action="edit_centre_process.php" class="form-horizontal" id="centreform_validation">
                        <input type="hidden" name="centre_id" value = "<?php echo $centre_id?>"/>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Centre Name:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" maxlength="30" name="centre_name" placeholder="(max 30 characters)" value ="<?php echo htmlspecialchars($centre_name);?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="btn btn-success fa fa-edit" name="update" value="Update"> Update</button>
                            </div>
                        </div>

                    </form>

                </div> <!-- end of class col-xs-12 -->
            </div> <!-- end of class row -->
        </div> <!-- end of starter-template -->
    </div> <!-- end of container -->
	<?php include_once "../templates/bottom.php"; ?>
	<!-- BOOTSTRAP JAVASCRIPT
		==================================================== -->
		<!-- placed at end of document so pages load faster -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		 
		<!-- Turn off client-side validation, in order to test server-side validation,-->
		<script type="text/javascript" src="../../js/formValidation/formValidation.min.js"></script>
		
		<!-- Note the following bootstrap.min.js file is for form validation, different from the one above. --> 
		<script type="text/javascript" src="../../js/formValidation/bootstrap.min.js"></script>
		
		<!-- IE10 viewport hack for surface/dekstop windows 8 bug -->
		<script src="../../js/ie10-viewport-bug-workaround.js"></script>
		 
		<!-- Validate the add centre page fields in the centre_validation js file -->
		<script src="../../js/centre_validation.js"></script>
	 
	
</body>
</html>