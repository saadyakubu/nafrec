<?php
//show errors: at least 1 and 4..
ini_set('display_errors', 1);
//ini_set('log_errors',1);
//ini_set('error_log', dirname(__FILE__).'/error_log.txt');
error_reporting(E_ALL);
?>

<link rel="stylesheet" href="../css/admin.css">
        <?php require_once '../templates/top.php'; ?>
        
        <div class="container-fluid">
            <div class="starter-template">
                <div class="page-header">
                    <?php //include_once("../global/header.php")?><h2>Trades</h2>
                </div>


                

                <!--<a href="add_trade.php">Add Trade</a>-->
                <form action="add_trade.php">
                    <button type="submit" class="btn btn-primary fa fa-plus-square-o" name="add" value="add"> Add Trade</button>
                </form>

                <!-- Responsive table -->
                <div class="table-responsive">
                    <table id="editTable" class="table table-striped table-condensed">					
                        <thead>
                            <tr>
                                <th>Trade Name</th>						
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <?php
                        //make sure file is only required once,
                        //fail causes error that stops remainder of page from processing
                        require_once "../../global/connection.php";

                        //pull in function library
                        require_once "../../global/functions_specialty.php";

                        //call UDF (user-defined function)
                        $results = get_trades();

                        //for testing
                        //print_r($result);
                        //exit();
                        //loop through each row
                        foreach ($results as $result):
                            //get petstore information
                            ?>

                            <tr>

                                <td><?php echo htmlspecialchars($result['specialty_name']); ?></td>

                                <!-- Create form button and hidden fields to pass petstore info to delete specialty -->
                                <td   style="width: 5em;">
                                    <form onsubmit="return confirm('Do you really want to delete this trade?');"
                                          action ="delete_trade.php" method="post">
                                        <input type="hidden" name="specialty_id" value="<?php echo htmlspecialchars($result['specialty_id']); ?> " />
                                        <!--<input type="submit" value="Delete"/>-->
                                        <button type="submit" class="btn btn-danger fa fa-trash" value="Delete"> Delete</button>
                                    </form>
                                </td>

                                <!-- Create form button and hidden fields to pass specialty info to update specialty -->
                                <td>
                                    <form action ="edit_trade.php" method="post" id ="edit_trade.php">
                                        <input type="hidden" name="specialty_id" value="<?php echo htmlspecialchars($result['specialty_id']); ?> " />
                                        <!--<input type="submit" value="Edit"/>-->
                                        <button type="submit" class="btn btn-warning fa fa-edit" value="Edit"> Edit</button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                            //$result = $statement->fetch();
                        endforeach;
                        $db = null;
                        ?>

                    </table>
                </div> <!-- end table-responsive -->

                <br/>
                

            </div><!-- end starter-template -->
        </div><!-- end container -->
        <?php include_once "../templates/bottom.php"; ?>
        <!-- Bootstrap JavaScript 
        ============================== -->
        <!-- Placed at end of document so pages load faster -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../js/ie10-viewport-bug-workaround.js"></script>

        <script>
            $(document).ready(function () {
                $('#editTable').DataTable({
                    //https://datatables.net/reference/option/lengthMenu
                    //1st inner array page length values; 2nd inner array displayed options
                    //Note: -1 is used to disable pagination (i.e., display all rows)
                    //Note: pageLength property automatically set to first value given in array
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    //permit sorting (i.e., no sorting on last two columns: delete and edit)
                    "columns":
                            [
                                null,
                                {"orderable": false},
                                {"orderable": false}
                            ]
                });
            });
        </script>
    </body>
</html>