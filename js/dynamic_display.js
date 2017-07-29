function menuAllApplicants(){ 
        // when any row is clicked        
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

        $('#dynamic-table').DataTable({
            //https://datatables.net/reference/option/lengthMenu
            //1st inner array page length values; 2nd inner array displayed options
            //Note: -1 is used to disable pagination (i.e., display all rows)
            //Note: pagelength property automatically set to first value given in array
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
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
       
    }


function menuDuplicates(){    
        // when any row is clicked
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
}


function menuEligible(){
         $('#dynamic-table').DataTable({
        //https://datatables.net/reference/option/lengthMenu
        //1st inner array page length values; 2nd inner array displayed options
        //Note: -1 is used to disable pagination (i.e., display all rows)
        //Note: pagelength property automatically set to first value given in array
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
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
}

function menuNonEligible() {
    $('#dynamic-table').DataTable({
        //https://datatables.net/reference/option/lengthMenu
        //1st inner array page length values; 2nd inner array displayed options
        //Note: -1 is used to disable pagination (i.e., display all rows)
        //Note: pagelength property automatically set to first value given in array
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
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
};

function changeDisplay() {//(str) {
            //alert("");exit();
            var select = document.getElementById("menu_selection").selectedIndex;
            var selected = document.getElementsByTagName("option")[select].value;
            //var selected = select.options[select.selectedIndex].innerHTML.trim();

            if (selected == "") {
                return;
            } else
            {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("dynamic-display-table").innerHTML = this.responseText;
                        //restructureTable();
                        if(selected == '0'){
                            menuAllApplicants();
                        }
                        else if(selected == '1'){
                            menuDuplicates();
                        }
                        else if(selected == '2'){
                            menuEligible();
                        }
                        else if(selected == '3'){
                            menuNonEligible();
                        }
                    }
                };
                //xmlhttp.open("GET","centre_candidates_table.php?centre_selection="+'Abuja',true);//xmlhttp.open("POST","dynamic_candidates.php?q="+str,true);
                xmlhttp.open("GET", "dynamic_display_table.php?menu_selection=" + selected, true);
                xmlhttp.send();
            }
        }
        
        
        function changeDisplayRecruit() {//(str) {
            //alert("");exit();
            var select = document.getElementById("menu_selection").selectedIndex;
            var selected = document.getElementsByTagName("option")[select].value;
            //var selected = select.options[select.selectedIndex].innerHTML.trim();

            if (selected == "") {
                return;
            } else
            {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("dynamic-display-table").innerHTML = this.responseText;
                        //restructureTable();
                        if(selected == '0'){
                            menuAllApplicantsRecruit();
                        }
                        else if(selected == '1'){
                            menuDuplicatesRecruit();
                        }
                        else if(selected == '2' || selected == '3'){
                            menuEligibleRecruit();
                        }
                        else if(selected == '4' || selected == '5'){
                            menuNonEligibleRecruit();
                        }
                    }
                };
                //xmlhttp.open("GET","centre_candidates_table.php?centre_selection="+'Abuja',true);//xmlhttp.open("POST","dynamic_candidates.php?q="+str,true);
                xmlhttp.open("GET", "dynamic_display_table_recruit.php?menu_selection=" + selected, true);
                xmlhttp.send();
            }
        }
        
        

        // when any row is clicked
        function menuDuplicatesRecruit(){
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
            };
   
   
   
        // when any row is clicked
        function menuAllApplicantsRecruit(){
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
        
                $('#dynamic-table').DataTable({
                    //https://datatables.net/reference/option/lengthMenu
                    //1st inner array page length values; 2nd inner array displayed options
                    //Note: -1 is used to disable pagination (i.e., display all rows)
                    //Note: pagelength property automatically set to first value given in array
                    "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                    //permit sorting (i.e., no sorting on last two columns: delete and edit)
                    "columns":
                    [
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false},
                    {"orderable":false}
                    //{"orderable":false},
                    //{"orderable":false}
                    ]

            });
        };
        
        
        function menuEligibleRecruit()
        {
            
        // when any row is clicked
        
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


            $('#dynamic-table').DataTable({
                //https://datatables.net/reference/option/lengthMenu
                //1st inner array page length values; 2nd inner array displayed options
                //Note: -1 is used to disable pagination (i.e., display all rows)
                //Note: pagelength property automatically set to first value given in array
                "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                //permit sorting (i.e., no sorting on last two columns: delete and edit)
                "columns":
                [
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false}
                //{"orderable":false},
                //{"orderable":false}
                ]

            });
       
        }
        
        
        function menuNonEligibleRecruit()
        {
            
            // when any row is clicked      
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

            $('#dynamic-table').DataTable({
                //https://datatables.net/reference/option/lengthMenu
                //1st inner array page length values; 2nd inner array displayed options
                //Note: -1 is used to disable pagination (i.e., display all rows)
                //Note: pagelength property automatically set to first value given in array
                "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
                //permit sorting (i.e., no sorting on last two columns: delete and edit)
                "columns":
                [
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false},
                {"orderable":false}
                //{"orderable":false}
                ]

            });

        }
        
        
