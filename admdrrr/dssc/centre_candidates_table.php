

<!-- Responsive table -->
<!--<div class="table-responsive" id="centre-tables">-->
<table class="table table-striped table-hover table-condensed" id="centre-table" onload="restructureTable();showUserDetails();">					
        <thead>
            <tr>
                <!--<th>Serial</th>-->
                <th><!--<span class="fa fa-certificate"></span>--></th>
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
        if (empty($_GET['centre_selection'])) {
            $centrename = '0'; //echo 'Empty Selection';
        } else {
            $centrename = $_GET['centre_selection'];
        }
        //make sure file is only required once,
        //fail causes error that stops remainder of page from processing
        require_once "../../global/connection.php";

        //pull in function library
        require_once "../../global/functions_centre.php";
        require_once "../../global/functions.php";

        //call UDF (user-defined function)
        $results = getCandidatesPerCentre($centrename);
        $i=0;

        //for testing
        //print_r($results);
        //exit();
        //loop through each row
        foreach ($results as $result):
            //get candidate information
            ?>
        <tr id="data-row" data-href="candidate.php?ID=<?php echo $result['ID'] ?>" onclick="showUserDetails()">
            <td>
                <form method="get" action="candidate.php">
                    <button type="submit" name="ID" value="<?php echo $result['ID'] ?>" class="fa fa-id-badge" 
                            style="background-color: white; border: none;"></button>
                </form>
            </td>
                <!--<td><?php //echo $i+=1; ?></td>-->
                <td id="id"><?php echo htmlspecialchars($result['ID']); ?></td>
                <td id="name"><?php echo htmlspecialchars($result['name']); ?></td>
                <td id="dob"><?php echo htmlspecialchars($result['dob']); ?></td>
                <td id="state"><?php echo htmlspecialchars($result['state']); ?></td>
                <td id="lga"><?php echo htmlspecialchars($result['lga']); ?></td>                           
                <td id="specialty"><?php echo htmlspecialchars($result['specialty']); ?></td>                                  
                <?php
                $status = getCandidateStatus($result['app_pk']);
                if ($status == 'Pending Completion') {
                    ?>
                    <td class="btn-warning"><?php echo htmlspecialchars($status) ?></td>
                    <?php
                } else if ($status == 'Eligible') {
                    ?>
                    <td class="btn-success"><?php echo htmlspecialchars($status) ?></td>
                    <?php
                } else if ($status == 'Not Eligible') {
                    ?>
                    <td class="btn-danger"><?php echo htmlspecialchars($status) ?></td>
                    <?php
                }
                ?>

            </tr>

                <?php
                //$result = $statement->fetch();
            endforeach;
            $db = null;
            ?>

    </table>
<!--</div>  end table-responsive -->
                
            <?php include_once '../../js/includes_js.php'; ?>
        <script src="../../js/download.js" type="text/javascript"></script>
        
            