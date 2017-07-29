<?php
global $menuOption;
if (empty($_GET['menu_selection'])) {
    $menuOption = '0'; //echo 'Empty Selection';
} else {
    $menuOption = $_GET['menu_selection'];
}
require_once "../../global/connection.php";
//pull in function library
require_once "../../global/functions.php";


if ($menuOption == '3') {//($menuOption != '1' && $menuOption != '0')

    try {
        //change display based on sql selection
        $sql = getApplicantMenu($menuOption);
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
        <?php foreach ($row as $name => $value): ?>
                            <th><?php echo $name; ?></th>						
        <?php endforeach; ?>

                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>					
                </thead>

        <?php
        //include table data here
        while ($row) {
            ?>

                    <tr>
                    <?php
                    //get data
                    foreach ($row as $value):
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
        $db = null;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        exit($error);
    }
    ?>
        </table>
    </div> <!-- end table-responsive -->
<!--    <script>
        $(document).ready(function () {
            $('#dynamic-table').DataTable({
                //https://datatables.net/reference/option/lengthMenu
                //1st inner array page length values; 2nd inner array displayed options
                //Note: -1 is used to disable pagination (i.e., display all rows)
                //Note: pagelength property automatically set to first value given in array
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                //permit sorting (i.e., no sorting on last two columns: delete and edit)
                "columns":
                        [
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false}
                            //{"orderable":false}
                        ]

            });
        });
    </script>-->
    <?php
} else if ($menuOption == '2') {

    try {
        //change display based on sql selection
        $sql = getApplicantMenu($menuOption);
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
        <?php foreach ($row as $name => $value): ?>
                            <th><?php echo $name; ?></th>						
        <?php endforeach; ?>

                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>					
                </thead>

                        <?php
                        //include table data here
                        while ($row) {
                            ?>

                    <tr>
            <?php
            //get data
            foreach ($row as $value):
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
                        $db = null;
                    } catch (PDOException $e) {
                        $error = $e->getMessage();
                        exit($error);
                    }
                    ?>
        </table>

    </div> <!-- end table-responsive -->
<!--    <script>
        $(document).ready(function () {
            $('#dynamic-table').DataTable({
                //https://datatables.net/reference/option/lengthMenu
                //1st inner array page length values; 2nd inner array displayed options
                //Note: -1 is used to disable pagination (i.e., display all rows)
                //Note: pagelength property automatically set to first value given in array
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                //permit sorting (i.e., no sorting on last two columns: delete and edit)
                "columns":
                        [
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false}
                            //{"orderable":false},
                            //{"orderable":false}
                        ]

            });
        });
    </script>-->
    <?php
} else if ($menuOption == '1') {
    try {
        //change display based on sql selection
        $sql = getApplicantMenu($menuOption);
        //because no user entered data, no need to bind values
        $statement = $db->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        //fetches all rows from a result set
        $row = $statement->fetch();          //print_r($row); exit();
        ?>


        <!-- Responsive table -->
        <div class="table-responsive">
            <table  class="table table-striped table-hover table-condensed" id="dynamic-table">
                <thead>
                    <tr>
        <?php foreach ($row as $name => $value): ?>
                            <th><?php echo $name; ?></th>						
        <?php endforeach; ?>

                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>					
                </thead>



        <?php
        //include table data here
        while ($row) {
            ?>


                    <tr  data-href="duplicates.php?Name=<?php echo $row['Name'] ?>&State=<?php echo $row['State'] ?>&LGA=<?php echo $row['LGA'] ?>">
            <?php
            //get data
            foreach ($row as $value):
                ?>

                            <td  id="<?php echo htmlspecialchars($value); ?>">
                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>">
                                <!--<form method="post" action="duplicates.php">-->
                        <?php echo htmlspecialchars($value); ?>
                                <!--</form>-->
                            </td>    

                        <?php endforeach; ?>

                    </tr>

                        <?php
                        $row = $statement->fetch();
                    }
                    $statement->closeCursor();
                    $db = null;
                } catch (PDOException $e) {
                    $error = $e->getMessage();
                    exit($error);
                }
                ?>

        </table>
    </div> <!-- end table-responsive -->

<!--    <script>
        // when any row is clicked
        $(function () {
            $('.table tr[data-href]').each(function () {
                $(this).css('cursor', 'pointer').hover(
                        function () {
                            $(this).addClass('active');
                        },
                        function () {
                            $(this).removeClass('active');
                        }).click(function () {
                    document.location = $(this).attr('data-href');
                }
                );
            });
        });
    </script>                        -->
    <?php
} elseif ($menuOption == '0') {
    try {
        //change display based on sql selection
        $sql = getApplicantMenu($menuOption);
        //because no user entered data, no need to bind values
        $statement = $db->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        //fetches all rows from a result set
        $row = $statement->fetch();          //print_r($row); exit();
        ?>


        <!-- Responsive table -->
        <div class="table-responsive">
            <table  class="table table-striped table-hover table-condensed" id="dynamic-table">
                <thead>
                    <tr>
        <?php foreach ($row as $name => $value): ?>
                            <th><?php echo $name; ?></th>						
        <?php endforeach; ?>

                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>					
                </thead>



        <?php
        //include table data here
        while ($row) {
            ?>


                    <tr  data-href="candidate.php?ID=<?php echo $row['Applicant NAF ID'] ?>">
                            <?php
                            //get data
                            foreach ($row as $value):
                                ?>

                            <td  id="<?php echo htmlspecialchars($value); ?>">
                                <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>">
                                <!--<form method="post" action="duplicates.php">-->
                <?php echo htmlspecialchars($value); ?>
                                <!--</form>-->
                            </td>    

                    <?php endforeach; ?>

                    </tr>

                        <?php
                        $row = $statement->fetch();
                    }
                    $statement->closeCursor();
                    $db = null;
                } catch (PDOException $e) {
                    $error = $e->getMessage();
                    exit($error);
                }
                ?>

        </table>
    </div> <!-- end table-responsive -->

<!--    <script>
        // when any row is clicked
        $(function () {
            $('.table tr[data-href]').each(function () {
                $(this).css('cursor', 'pointer').hover(
                        function () {
                            $(this).addClass('active');
                        },
                        function () {
                            $(this).removeClass('active');
                        }).click(function () {
                    document.location = $(this).attr('data-href');
                }
                );
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#dynamic-table').DataTable({
                //https://datatables.net/reference/option/lengthMenu
                //1st inner array page length values; 2nd inner array displayed options
                //Note: -1 is used to disable pagination (i.e., display all rows)
                //Note: pagelength property automatically set to first value given in array
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                //permit sorting (i.e., no sorting on last two columns: delete and edit)
                "columns":
                        [
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false},
                            {"orderable": false}
                            //{"orderable":false},
                            //{"orderable":false}
                        ]

            });
        });
    </script>-->
    <?php
}
?>