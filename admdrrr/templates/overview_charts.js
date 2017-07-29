
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
        

        //<!-- Pie Charts for Pending Vs Completed and Personnel Vs Others pie charts -->
        
        
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
                title: 'Registered Personnel Vs Non-personnel'
              };

              var chart = new google.visualization.PieChart(document.getElementById('persVsNonChart'));
              chart.draw(data, options);
            }

        
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
        