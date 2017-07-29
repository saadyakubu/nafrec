<?php
//show errors: at least 1 and 4..
ini_set('display_errors',1);
//ini_set('log_errors',1);
//ini_set('error_log', dirname(__FILE__).'/error_log.txt');
error_reporting(E_ALL);


    
    require_once '../../global/connection.php';

?>

<div>
	<?php //include_once("../global/nav.php")?> 
	<div class="container-fluid">
            <div class="starter-template">
                
                
                <div class="form-group row"> 
                       
                    <div class="col-sm-4">
                        <form method="post" action="index.php"> 
                            <button type="submit" class="btn btn-primary fa fa fa-language" name="select" value="Select"> Applicants Based On Category</button>
                        </form>
                    </div> 


                    <div class="col-sm-4"></div>


                    <div class="col-sm-4"
                         <form method="post" action="#">
                            <button type="submit" class="btn btn-primary fa fa-university" name="select" value="Select"> Applicants Based On Centre</button>
                        </form>
                    </div>
                    
                </div>
                
                <div class="page-header">
                        <?php //include_once("../global/header.php")?><h2>Applicants' Details Per Centre</h2>
                </div>

                
                
                
                <?php //$menuOption = "";?>
                <!--<form method="post" action="#" id="centreform">-->
                    <div class="form-group row"> 
                        <div class="col-sm-8">
                            <select name ="centre_selection" id="centre_selection" class="form-control">
								
                                <?php                         
                                    
                                    require_once "../../global/functions.php";
                                    require_once "../../global/functions_centre.php";
                                    $result = get_centres();
                                ?>	

                                <?php	
                                        foreach($result as $row)
                                        {
                                ?>	
                                <option  value = '<?php echo $row['centrename'] ?>'>  <?php echo $row['centrename'] ?> </option>
                                <?php		
                                        }
                              
                                ?>
                            </select>
                        </div>  
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-primary fa fa-paper-plane-o" name="select" value="Select" 
                                    onclick="showCandidates()" 
                                    id="refresh-btn"> Select</button>
                        <button type="button" class="btn btn-success fa fa-download" name="download" value="download"  
                                onclick="downloadToExcel('centre-table', 'Table')"> Download</button>
                        </div>
                    </div>
                <!--</form>-->
                
                 
                <!-- Responsive table -->
                <div class="table-responsive" id="centre-tables">
                    <table class="table table-striped table-hover table-condensed">					
                        <thead>
                                <tr>
                                    <!--<th>Serial</th>-->
                                    <th>NAF Reg ID</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>State</th>
                                    <th>LGA</th>                                    
                                    <th>Specialty</th>
                                    <th>Status</th>
                                </tr>
                        </thead>

                        <?php //include'centre_candidates_table.php'?>
                        
                    </table>
                </div><!-- end table-responsive -->
         
            
            </div><!-- end starter-template -->
	</div><!-- end container -->
	
        <!--<script src="../../js/includes_js.php" type="text/javascript"></script>-->
	<?php include_once '../../js/includes_js.php'; ?>
        <script src="../../js/download.js" type="text/javascript"></script>
        <script src="../../js/centre_candidates.js" type="text/javascript"></script>
               
	     
               
</div>