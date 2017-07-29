<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
    
        <?php
        
	$specialty_id_v = $_POST['specialty_id'];
	$specialty_name_v = "";
	$specialt_type_v = "DSSC";

	if(isset($specialty_id_v))//($pst_id != null)
	{
            
            require_once "../../global/connection.php";
            require_once '../../global/functions_specialty.php';

            //get pet by ID
            $result = get_trade($specialty_id_v);

            //echo $result['specialty_name'];
            //exit();

            if($result != null)
            {
                $specialty_name_v = $result['specialty_name'];
                $specialty_type_v = $result['specialty_type'];
            }   
            
	}
	?>
	 
	<div class="container">
        <div class="starter-template">
            <div class="row">
                <div class="col-xs-12">

                    <div class="page-header">
                    <?php //include_once("../global/header.php")?><h2>Trades</h2>
                </div>

                    <form  method="post" action="edit_trade_process.php" class="form-horizontal" id="specialtyform_validation">
                        <input type="hidden" name="specialty_id" value = "<?php echo $specialty_id_v?>"/>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Trade Name:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" maxlength="40" name="specialty_name" placeholder="(max 40 characters)" value ="<?php echo htmlspecialchars($specialty_name_v);?>" />
                            </div>                                                         
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="btn btn-success fa fa-edit" name="edit" value="Edit">Edit Trade</button>
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
        <script src="../../js/specialty_validation.js"></script>
	  
	
</body>
</html>