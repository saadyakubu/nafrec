function showCandidatesRecruit() {//(str) {
    //alert("");exit();
    var select = document.getElementById("centre_selection");
    var selected = select.options[select.selectedIndex].innerHTML.trim();

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
                document.getElementById("centre-tables-recruit").innerHTML = this.responseText;
                restructureTableRecruit();
            }
        };
        //xmlhttp.open("GET","centre_candidates_table.php?centre_selection="+'Abuja',true);//xmlhttp.open("POST","dynamic_candidates.php?q="+str,true);
        xmlhttp.open("GET", "centre_candidates_table_recruit.php?centre_selection=" + selected, true);
        xmlhttp.send();
    }
}


function showCandidates() {//(str) {
    var select = document.getElementById("centre_selection");
    var selected = select.options[select.selectedIndex].innerHTML.trim();

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
                document.getElementById("centre-tables").innerHTML = this.responseText;
                restructureTable();
            }
        };
        //xmlhttp.open("GET","centre_candidates_table.php?centre_selection="+'Abuja',true);//xmlhttp.open("POST","dynamic_candidates.php?q="+str,true);
        xmlhttp.open("GET", "centre_candidates_table.php?centre_selection=" + selected, true);
        xmlhttp.send();
    }
}

//$(document).ready(function(){
function restructureTable() {
    $('#centre-table').DataTable({
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
                    {"orderable": true}
                    //{"orderable":false}
                ]

    });
}

//$('#centre-table').DataTable().ajax.reload();


function restructureTableRecruit() {
    $('#centre-table-recruit').DataTable({
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
                    {"orderable":true}
                ]

    });
}
;






// when any row is clicked
function showUserDetails() {
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
    });//.ajax.reload();
}
;
                