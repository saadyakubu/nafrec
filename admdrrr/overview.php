<?php
    //create variables to be used in the overview section
    //use sql to get the values to be assigned
    //use functions_overview.php

    require_once '../global/connection.php';
    require_once '../global/functions_overview.php';

    $today = get_dssc_today_stats();
    $this_week = get_dssc_week_stats();
    $this_month = get_dssc_current_month_stats();
    $total = get_dssc_total_stats();

    //array of candidates per centre;
    $candidates_per_centre = get_dssc_total_registered_per_centre();

    $pending_applications= get_dssc_total_pending_app()['number'];
    $completed_applications = get_dssc_total_completed_app()['number'];
    
    $eligible_applications= get_dssc_eligible()['number'];
    $non_eligible_applications = get_dssc_ineligible()['number'];

    //array of specialty stats
    $specialty_stats = get_dssc_specialty_stats();
    
    //array of state stats
    $state_stats = get_dssc_states_stats();

    $registered_personnel = get_dssc_personnel_stats()['number'];
    //echo '<br>';
    $registered_non_personnel = (int)get_dssc_total_stats()['number'] - (int)get_dssc_personnel_stats()['number'];
?>

        <?php include_once 'templates/top_admin.php'; ?>
                
        <!--<div class="col-md-10">-->
            <!--Main Content-->
            
            <p style="text-align: center; color: white; background-color: #1a3b7f; padding: 1em;">
                <strong style="margin-left: -8em">Registration Statistics</strong>
            </p>
            
            <p>Number of registered candidates today[ 
                <?php date_default_timezone_set('Africa/Lagos'); 
                 echo date("d M Y"); ?>]: 
                <span class="btn-info"><?php echo $today['number']; ?></span>
            </p>
            <p>Number of registered candidates this week: <span class="btn-info"><?php echo $this_week['number']; ?></span></p>
            <p>Number of registered candidates in 
                <!-- F denotes Full Spelling of Current Month in PHP --> 
                <?php echo date("F")?>: 
                <span class="btn-info"> <?php echo $this_month['number']; ?></span>
            </p>
            <p>Total number of registered candidates:     <span class="btn-info"><?php echo $total['number']; ?></span></p>
            <br/><br/>
            
            <?php include_once "../js/includes_charts.php"; ?>         
        
            <!--<p style="text-align: center">Registered Candidates per centre</p>-->
            <canvas id="centresChart" width="400" height="80%"></canvas>
            
            
            <div class="row">
            <!-- <div class="col-md-6">
                    <canvas id="pendingVsNonPendingChart" style="width: 500px; height: 100%;></canvas>
                </div>  -->
                <div id="pendingVsNonPendingChart" style="width: 400px; height: 300px; " class="col-md-3"></div>
                <div id="persVsNonChart" style="width: 400px; height: 300px;"  class="col-md-6"></div>
                <div id="eligibleChart" style="width: 400px; height: 300px;"  class="col-md-3"></div>
            </div>
            
            <!--<p  style="text-align: center">Specialties Statistics </p>-->
            <canvas id="specialtiesChart" width="400" height="80%"></canvas>
            
            <!--<p  style="text-align: center">State Statistics </p>-->
            <canvas id="statesChart" width="400" height="80%"></canvas>
            
            <!-- //get and convert the php array of centres stats to JSON --
            Also, get and convert the php array of specialties stats to JSON -->
            <?php
            $centres_php_array = $candidates_per_centre;//array('abc','def','ghi');
            $centres_json = json_encode($centres_php_array);
            //echo "var javascript_array = ". $centres_json . ";\n";
            
            $specialties_php_array = $specialty_stats;//array('abc','def','ghi');
            $specialties_json = json_encode($specialties_php_array);
            //echo "var javascript_array = ". $specialties_json . ";\n"; //exit();
            
            $states_php_array = $state_stats;//array('abc','def','ghi');
            $states_json = json_encode($states_php_array);
            //echo "var javascript_array = ". $states_json . ";\n"; //exit();
            
            $pending_applications_json      = json_encode($pending_applications); //echo $pending_applications_json.'<br>';
            $completed_applications_json    = json_encode($completed_applications); //echo $completed_applications_json.'<br>';
            $registered_personnel_json      = json_encode($registered_personnel); //echo $registered_personnel_json.'<br>';
            $registered_non_personnel_json  = json_encode($registered_non_personnel); //echo $registered_non_personnel_json.'<br>';

            $eligible_applications_json      = json_encode($eligible_applications); //echo $pending_applications_json.'<br>';
            $non_eligible_applications_json    = json_encode($non_eligible_applications); //echo $completed_applications_json.'<br>';
            ?>
        <!--</div>--> 
        <?php include_once 'templates/bottom_admin.php'; ?>

 
        <script type='text/javascript'>
            //convert JSON to Java Script Array
            var myCentresArray = JSON.parse('<?php echo $centres_json;?>');
            var myCentres = [], myCentresNumbers = []; 

            //loop through array and put centre names & their numbers in separate arrays
            for(i = 0; i <myCentresArray.length; i++)//for(x in myCentresArray)
            {
                var centre = myCentresArray[i];
                myCentres.push(centre.centrename); //document.writeln(myCentres);
                myCentresNumbers.push(centre.number); //document.writeln(myCentresNumbers);
            }

            var ctx = document.getElementById("centresChart").getContext('2d');
            var myCentresChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: myCentres,//["Abuja", "Lagos", "Sokoto", "Kano", "Kaduna", "Port-Harcourt"], //placeholder for myCentres Array
                    datasets: [{
                        label: 'Centres',
                        data: myCentresNumbers,//[12, 19, 3, 5, 2, 3], //placeholder for myCentresNumbers Array
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>
        
        
        <script type="text/javascript">
            //convert JSON to Java Script Array
            var mySpecialtiesArray = JSON.parse('<?php echo $specialties_json;?>');
            var mySpecialties = [], mySpecialtiesNumbers = [];
 
            //loop through array and put centre names & their numbers in separate arrays
            for(i = 0; i < mySpecialtiesArray.length; i++)//for(x in mySpecialtiesArray)
            {
                var specialty = mySpecialtiesArray[i];
                mySpecialties.push(specialty.specialty); //document.writeln(mySpecialties);
                mySpecialtiesNumbers.push(specialty.number); //document.writeln(mySpecialtiesNumbers);              
            }

            var ctx1 = document.getElementById("specialtiesChart").getContext('2d');
            var mySpecialtiesChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: mySpecialties,//["Information Technology", "Radar", "Legal", "Supply", "Regiment", "Admin"], //placeholder for mySpecialties Array
                    datasets: [{
                        label: 'Specialties',
                        data: mySpecialtiesNumbers,//[2, 9, 13, 50, 12, 33], //placeholder for mySpecialtiesNumbers Array
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>
        
        
        <script type="text/javascript">
            //convert JSON to Java Script Array
            var myStatesArray = JSON.parse('<?php echo $states_json;?>');
            var myStates = [], myStatesNumber = [];
 
            //loop through array and put centre names & their numbers in separate arrays
            for(i = 0; i < myStatesArray.length; i++)//for(x in mySpecialtiesArray)
            {
                var state = myStatesArray[i];
                myStates.push(state.state); //document.writeln(mySpecialties);
                myStatesNumber.push(state.number); //document.writeln(mySpecialtiesNumbers);              
            }
            
            var chartData = {
                labels: myStates,
                datasets: [
                    {
                        label: 'States',
                        fillColor: "#79D1CF",
                        strokeColor: "#79D1CF",
                        data: myStatesNumber,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',//'rgba(54, 162, 235, 0.8)'//,                            
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)', 
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',                        
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)', 
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',                        
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)', 
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',                        
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)', 
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',                        
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)', 
                            
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',                        
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)' 
                            
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }
                ]
            };
            
            //var ctx2 = document.getElementById("statesChart").getContext('2d');
            var opt = {
                events: false,
                tooltips: {
                    enabled: true
                },
                hover: {
                    animationDuration: 1
                },
                animation: {
                    duration: 1,
                    onComplete: function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];                            
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                }
            };
            var ctx = document.getElementById("statesChart"),
             myLineChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: opt
                /*options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }*/
             });
             
             /*var ctx = document.getElementById("statesChart"),
             myLineChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: opt
             });*/
            
            /*var ctx1 = document.getElementById("statesChart").getContext('2d');
             * var myStatesChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: myStates,//["Information Technology", "Radar", "Legal", "Supply", "Regiment", "Admin"], //placeholder for mySpecialties Array
                    datasets: [{
                        //pointStyle: 'line',
                        label: 'States',
                        data: myStatesNumber,//[2, 9, 13, 50, 12, 33], //placeholder for mySpecialtiesNumbers Array
                        backgroundColor: [
                            //'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',                            
                            //'rgba(255, 206, 86, 0.2)',
                            //'rgba(75, 192, 192, 0.2)',
                            //'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });*/
        </script>
        

        <!-- Pie Charts for Pending Vs Completed and Personnel Vs Others pie charts -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            //convert JSON to Java Script variables
            var personnel = JSON.parse('<?php echo $registered_personnel_json ?>');                    
            var nonpersonnel = JSON.parse('<?php echo $registered_non_personnel_json  ?>');
            
            personnel = parseInt(personnel);
            nonpersonnel = parseInt(nonpersonnel);
                   
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawPersNonPersChart);

            function drawPersNonPersChart() {

              var data = google.visualization.arrayToDataTable([
                ['Group', 'Number'],
                ['Personnel',     personnel],
                ['Others',      nonpersonnel]                 
              ]);

              var options = {
                title: 'Registered Personnel Vs Non-Personnel'
              };

              var chart = new google.visualization.PieChart(document.getElementById('persVsNonChart'));
              chart.draw(data, options);
            }

        </script>
        <script type="text/javascript">
            //convert JSON to Java Script variables
           var pending = JSON.parse('<?php echo $pending_applications_json?>');                    
            var completed = JSON.parse('<?php echo $completed_applications_json ?>');
            
            pending = parseInt(pending);
            completed = parseInt(completed);
            
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawPendingChart);
            function drawPendingChart() {

              var data = google.visualization.arrayToDataTable([
                ['Group', 'Number'],
                ['Pending',     pending],
                ['Complete',    completed],                 
              ]);

              var options = {
                title: 'Pending Vs Completed Applications'
              };

              var chart = new google.visualization.PieChart(document.getElementById('pendingVsNonPendingChart'));
              chart.draw(data, options);
            }
            
            /*var ctx2 = document.getElementById("pendingVsNonPendingChart").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                  backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e"
                  ],
                  data: [12, 19, 3, 17, 28, 24, 7]
                }]
              }
            });*/
        </script>
        <script type="text/javascript">
            //convert JSON to Java Script variables
            var eligible = JSON.parse('<?php echo $eligible_applications_json;  ?>');                    
            var noneligible = JSON.parse('<?php echo $non_eligible_applications_json;  ?>');
            
            eligible = parseInt(eligible);
            noneligible = parseInt(noneligible);
                   
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawPersNonPersChart);

            function drawPersNonPersChart() {

              var data = google.visualization.arrayToDataTable([
                ['Group', 'Number'],
                ['Eligible',     eligible],
                ['Non-Eligible',      noneligible]                 
              ]);

              var options = {
                title: 'Eligible Vs Non-Eligible'
              };

              var chart = new google.visualization.PieChart(document.getElementById('eligibleChart'));
              chart.draw(data, options);
            }

        </script>           
        
    </div> <!-- the beginning div tag is in the side_main_contents.php -->
            
        <?php //require_once 'templates/footer.php'; ?>
     <!-- Pie Charts for Pending Vs Completed and Personnel Vs Others pie charts -->
        <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript" src= "templates/overview_charts.js" ></script> -->
    </body>
</html>