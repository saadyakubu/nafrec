<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
	 
	<div class="container">
        <div class="starter-template">
            <div class="row">
                <div class="col-xs-12">

                    <div class="page-header">
                        <?php //include_once("../global/header.php")?><h2>LGA</h2>
                    </div>

                    <form  method="post" action="add_lga_process.php" class="form-horizontal" id="lgaform_validation">

                        <div class="form-group">
                            <label class="col-sm-4 control-label">State:</label>
                            <div class="col-sm-4">
                                <!-- <input type="text" class="form-control" maxlength="15" name="lga_state" placeholder="(max 15 characters)" value ="<?php //echo htmlspecialchars($lga_state);?>" /> -->
                                <select class="form-control" name="lga_state" required="Select a state">
                                    <option value="">Select a State</option>
                                    <?php
                                    require_once "../../global/connection.php";
                                    //pull in function library
                                    require_once "../../global/functions_lga.php";
                                        
                                    //call UDF (user-defined function)
                                    $states = get_states();                                      	
                                    foreach($states as $state):                                    
                                    ?>	
                                        <option value = '<?php echo $state['lga_state']; ?>'> <?php echo $state['lga_state']; ?></option>
                                    <?php		
                                    endforeach;
                                    ?>
                                </select>
                                
                                
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Lga Name:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" maxlength="40" name="lga_name" placeholder="(max 40 characters)" value ="<?php echo htmlspecialchars($lga_name);?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary fa fa-plus-square-o" name="add" value="Add"> Add LGA</button>
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

        <!-- Validate the add lga page fields in the lga_validation js file -->
        <script src="../../js/lga_validation.js"></script>
	  
	
</body>
</html>