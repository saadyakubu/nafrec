<?php
//show errors: at least 1 and 4..
ini_set('display_errors',1);
//ini_set('log_errors',1);
//ini_set('error_log', dirname(__FILE__).'/error_log.txt');
error_reporting(E_ALL);



 
    require_once '../../global/connection.php';
    

?>

<!--<div>-->
	<?php //include_once("../global/nav.php")?> 
	<div class="container-fluid">
            <div class="starter-template">
                <div class="form-group row"> 
                    <div class="col-sm-4">
                        <form method="post" action="#">    
                            <button type="submit" class="btn btn-primary fa fa fa-language" name="select" value="Select"> Applicants Based On Category</button>
                        </form>
                    </div> 
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <form method="post" action="centres_candidates.php">                       
                            <button type="submit" class="btn btn-primary fa fa-university" name="select" value="Select"> Applicants Based On Centre</button>  
                        </form>
                    </div>
                </div>
                
                <div class="page-header">
                        <?php //include_once("../global/header.php")?><h2>Applicants' Details By Category</h2>
                </div>


                <?php //$menuOption = "";?>
                <form method="post" action="#">
                    <div class="form-group row"> 
                        <div class="col-sm-8">
                        <select class="form-control" name="menu_selection" onchange="">
                        <option value = '0'>All Applicants</option>
                        <option value = '1' >Potential Duplicates</option>
                        <option value = '2'>Eligibles - Trade</option>
                        <option value = '3'>Eligibles - Non-Trade</option>
                        <option value = '4'>Non-Eligibles - Trade</option>
                        <option value = '5'>Non-Eligibles - Non-Trade</option>
                        </select> </div>  
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary fa fa-paper-plane-o" name="select" value="Select"> Select</button>
                        <button type="button" class="btn btn-success fa fa-download" name="download" value="download" 
                                onclick="downloadToExcel('dynamic-table', 'Table')"> Download</button>
                        </div>
                    </div>
                </form>
                
                
                <?php
                    global $menuOption;
                    if(empty($_POST['menu_selection']))
                    {
                        $menuOption = '0';//echo 'Empty Selection';
                    }
                    else
                    {
                        $menuOption= $_POST['menu_selection'];
                    }
                    require_once "../../global/connection.php";			
                    //pull in function library
                    require_once "../../global/functions_recruit.php";
                    try
                    {				
                        //change display based on sql selection
                        $sql = getRecruitApplicantMenu($menuOption);
                        //because no user entered data, no need to bind values
                        $statement = $db->prepare($sql);
                        $statement->execute();
                        $statement->setFetchMode(PDO::FETCH_ASSOC);

                        //fetches all rows from a result set
                        $row = $statement->fetch();
                ?>

                <!-- Responsive table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed" id="dynamic-table">
                        <thead>
                            <tr>
                                <?php foreach($row as $name => $value): ?>
                                <th><?php echo $name; ?></th>						
                                <?php endforeach; ?>

                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>					
                        </thead>

                        <?php
                        //include table data here
                        while($row)
                        {
                        ?>

                        <tr>
                        <?php
                                //get data
                                foreach($row as $value):
                        ?>

                        <td>
                                <?php echo htmlspecialchars($value); ?>
                        </td>
                        <?php endforeach; ?>



                        </tr>

                        <?php
                                $row = $statement->fetch();
                        }
                        $statement->closeCursor();
                        $db=null;
                    }
                    catch(PDOException $e)
                    {
                        $error= $e->getMessage();
                        exit($error);
                    }
                        ?>
                    </table>
                </div> <!-- end table-responsive -->

                <br/>
                <?php //include_once "../global/footer.php"; ?>
			
            </div><!-- end starter-template -->
	</div><!-- end container -->
	
        <!--<script src="../../js/includes_js.php" type="text/javascript"></script>-->
        <?php include_once '../../js/includes_js.php'; ?>
        <script src="../../js/download.js" type="text/javascript"></script>
        
	
<!--</div>-->