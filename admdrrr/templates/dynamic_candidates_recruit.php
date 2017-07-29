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
                <!--<form method="post" action="#">-->
                    <div class="form-group row"> 
                        <div class="col-sm-8">
                            <select name ="centre_selection"  id="centre_selection" class="form-control">
								
                                <?php                         
                                    
                                    require_once "../../global/functions_recruit.php";
                                    require_once "../../global/functions_centre.php";
                                    $result = get_centres();
                                ?>	

                                <?php	
                                        foreach($result as $row)
                                        {
                                ?>	
                                        <option value = '<?php echo $row['centrename'] ?>'>  <?php echo $row['centrename'] ?> </option>
                                <?php		
                                        }
                              
                                ?>
                            </select>
                        </div>  
                        <div class="col-sm-4">
                        <button type="button" class="btn btn-primary fa fa-paper-plane-o" name="select" value="Select" 
                                    onclick="showCandidatesRecruit()" 
                                    id="refresh-btn"> Select</button>
                        <button type="button" class="btn btn-success fa fa-download" name="download" value="download" 
                                onclick="downloadToExcel('centre-table-recruit', 'Table')"> Download</button>
                        </div>
                    </div>
                <!--</form>-->
                
                 
                <!-- Responsive table -->
                <div class="table-responsive" id="centre-tables-recruit">
                    <table class="table table-striped table-hover table-condensed">					
                        <thead>
                                <tr>
                                    <th>NAF Reg ID</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>State</th>
                                    <th>LGA</th>                                    
                                    <th>Trade</th>
                                    <th>Trade Type</th>
                                    <th>Status</th>
                                </tr>
                        </thead>

                    </table>
                </div> <!-- end table-responsive -->
<!--                <script>
                    // when any row is clicked
                    $(function(){
                            $('.table tr[data-href]').each(function(){
                                $(this).css('cursor','pointer').hover(
                                    function(){ 
                                        $(this).addClass('active'); 
                                    },  
                                    function(){ 
                                        $(this).removeClass('active'); 
                                    }).click( function(){ 
                                        document.location = $(this).attr('data-href'); 
                                    }
                                );
                            });
                        });
                </script>
                <script>
                    $(document).ready(function(){
                            $('#centre-table-recruit').DataTable({
                                //https://datatables.net/reference/option/lengthMenu
                                //1st inner array page length values; 2nd inner array displayed options
                                //Note: -1 is used to disable pagination (i.e., display all rows)
                                //Note: pagelength property automatically set to first value given in array
                                "lengthMenu": [[10,25,50,-1], [10,25,50, "All"]],
                                //permit sorting (i.e., no sorting on last two columns: delete and edit)
                                "columns":
                                [
                                {"orderable":false},
                                {"orderable":false},
                                {"orderable":false},
                                {"orderable":true},
                                {"orderable":false},
                                {"orderable":false},
                                {"orderable":false},		
                                {"orderable":true}
                                //{"orderable":false}
                                ]

                        });
                    });
                </script>-->
                <?php //include_once "../global/footer.php"; ?>
			
            </div><!-- end starter-template -->
	</div><!-- end container -->
	
        <!--<script src="../../js/includes_js.php" type="text/javascript"></script>-->
	<?php include_once '../../js/includes_js.php'; ?>
        <script src="../../js/download.js" type="text/javascript"></script>
        <script src="../../js/centre_candidates.js" type="text/javascript"></script>
	     
               
</div>