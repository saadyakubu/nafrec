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
                <form method="post" action="#" id="centreform">
                    <div class="form-group row"> 
                        <div class="col-sm-8">
                            <select name ="centre_selection" class="form-control">
								
                                <?php                         
                                    
                                    require_once "../../global/functions.php";
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
                                    id="refresh-btn"> Select</button>
                        <button type="button" class="btn btn-success fa fa-download" name="download" value="download" 
                                onclick="downloadToExcel('centre-table', 'Table')"> Download</button>
                        </div>
                    </div>
                </form>
                
                 
                <!-- Responsive table -->
                <div class="table-responsive" id="centre-tables">
                    <table class="table table-striped table-hover table-condensed" id="centre-table">					
                        <thead>
                                <tr>
                                    <th>NAF Reg ID</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>State</th>
                                    <th>LGA</th>                                    
                                    <th>Specialty</th>
                                    <th>Status</th>
                                </tr>
                        </thead>

                        <?php
                        global $centrename;
                        //$centrename= $_POST['centre_selection'];
                        if(empty($_POST['centre_selection']))
                        {
                            $centrename = '0';//echo 'Empty Selection';
                        }
                        else
                        {
                            $centrename= $_POST['centre_selection'];
                        }
                        //make sure file is only required once,
                        //fail causes error that stops remainder of page from processing
                        require_once "../../global/connection.php";

                        //pull in function library
                        require_once "../../global/functions_centre.php";require_once "../../global/functions.php";
                        
                        //call UDF (user-defined function)
                        $results = getCandidatesPerCentre($centrename);
                        
                        
                        //for testing
                        //print_r($results);
                        //exit();

                        //loop through each row
                        foreach($results as $result):
                                //get candidate information
                        ?>
                            <tr   data-href="candidate.php?ID=<?php echo $result['ID']?>">
                                <td id="id"><?php echo htmlspecialchars($result['ID']); ?></td>
                                <td id="name"><?php echo htmlspecialchars($result['name']); ?></td>
                                <td id="dob"><?php echo htmlspecialchars($result['dob']); ?></td>
                                <td id="state"><?php echo htmlspecialchars($result['state']); ?></td>
                                <td id="lga"><?php echo htmlspecialchars($result['lga']); ?></td>                           
                                <td id="specialty"><?php echo htmlspecialchars($result['specialty']); ?></td>                                  
                                <?php
                                    $status = getCandidateStatus($result['app_pk']);
                                    if($status == 'Pending Completion')
                                    {
                                ?>
                                <td class="btn-warning"><?php echo htmlspecialchars($status)?></td>
                                <?php
                                    }
                                    else if($status == 'Eligible')
                                    {
                                ?>
                                <td class="btn-success"><?php echo htmlspecialchars($status)?></td>
                                <?php
                                    }
                                    else if($status == 'Not Eligible')
                                    {
                                ?>
                                <td class="btn-danger"><?php echo htmlspecialchars($status)?></td>
                                <?php
                                    }
                                ?>
                                
                            </tr>

                        <?php 
                                //$result = $statement->fetch();
                        endforeach;	
                        $db= null;
                        ?>

                    </table>
                </div> <!-- end table-responsive -->
                
                <script>
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
                            $('#centre-table').DataTable({
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
                                {"orderable":true}
                                //{"orderable":false}
                                ]

                        });
                    });
                    //$('#centre-table').DataTable().ajax.reload();
            </script>
            <script>
            $(document).ready(function() {

               /*function RefreshTable() {
                   $( "#centre-table" ).reload( "dynamic_candidates.php #centre-table" );
               }

               $("#refresh-btn").on("click", RefreshTable);*/

               // OR CAN THIS WAY
               //
               //$("#refresh-btn").on("click", function() {
               //$( "#centre-table" ).load( "centres_candidates.php #centre-table" );
               //});
               
               $("#refresh-btn").on("click", function() {
               // var table = $('.table').DataTable();alert("Something is going on");
                $("#centre-table").reload("centre_candidates.php?id #centre-table");
                /*var table = $('.table').DataTable();
                //table.ajax.reload(); 
                alert("Something is going on");
                table.ajax.reload( function ( json ) {
                    $('#refresh-btn').val( json.lastInput );
                } );
                
                });*/
        //$.get('centres_candidates.php', function(data) { $('#centre-table').html(data); }
               
            });
            
                
            </script>
                <?php //include_once "../global/footer.php"; ?>
			
            </div><!-- end starter-template -->
	</div><!-- end container -->
	
        <!--<script src="../../js/includes_js.php" type="text/javascript"></script>-->
	<?php include_once '../../js/includes_js.php'; ?>
        <script src="../../js/download.js" type="text/javascript"></script>
        
	     
               
</div>