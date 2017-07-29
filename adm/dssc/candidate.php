<?php

$reg_id = htmlspecialchars($_GET['ID']);;


//fail causes error that stops remainder of page from processing
require_once "../../global/connection.php";

//pull in function library
require_once "../../global/functions.php";

//call UDF (user-defined function) to get all applicant details in the following categories
$candidateDetails = getCandidateDetails($reg_id);
$app_pk = $candidateDetails['app_pk'];// exit();
$candidatePrySecDetails = getCandidatePrySecDetails($app_pk);
$candidateHigherInstitutionDetails = getCandidateHigherInstitutionDetails($app_pk);
$candidateCertificationDetails = getCandidateCertificationDetails($app_pk);
$candidateMilitaryExperienceDetails = getCandidateMilitaryExperienceDetails($app_pk);

$candidateStatus = getCandidateStatus($app_pk);

//echo $candidateDetails['name'] . " " . $candidateDetails['state'] . "<br>";
//echo $candidatePrySecDetails['cert_obtained']."<br>";
//echo $candidateHigherInstitutionDetails['course_name']."<br>";
//echo $candidateCertificationDetails['certification_name']."<br>";
//echo $candidateMilitaryExperienceDetails['rank']."<br>";
//}
//exit();
?>
<link rel="stylesheet" href="../css/admin.css">
<?php
require_once '../templates/top.php';
?>

<!--Main Content-->

<?php //include_once("../global/nav.php")  ?> 
<div class="container-fluid">
    <div class="starter-template">

        <div class="page-header">

            <h2 class="panel-header">Application Details for <?php echo htmlspecialchars($candidateDetails['ID'] . " " . $candidateDetails['name']); ?></h2>
        </div>

        <!-- Responsive table -->
        <div class="table-responsive">
            <table class="table-condensed">					

                <tbody>
                    <tr>

                        <th class="text-center btn-primary" colspan="4">Personal Information</th>
                    </tr>
                    <tr>
                        <th>NAF Applicant No:</th>
                        <td colspan="2"><?php echo htmlspecialchars($candidateDetails['ID']);?></td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td colspan="2"><?php echo htmlspecialchars($candidateDetails['name']); ?></td>
                        <td rowspan="4" class="text-right">
                            <img src ="../../documents/passport/dssc/<?php echo htmlspecialchars($candidateDetails['passport_url']);  ?>" 
                                class="img-thumbnail"         alt="Passport Img" style="width: 200px; height: 200px; border: 1px solid #1a3b7f;"/>
                            <!--<img src ="../../documents/passport/dssc/candidate.jpg" class="img-thumbnail"
                                 alt="Passport Img" style="width: 200px; height: 200px; border: 1px solid #1a3b7f;"/>-->
                        </td>
                    </tr>
                    <tr>
                        <th>Sex:</th>
                        <td colspan="2"><?php echo htmlspecialchars($candidateDetails['sex'])?></td>
                    </tr>
                    <tr>
                        <th>Date of Birth:</th>
                        <td colspan="2"><?php echo htmlspecialchars($candidateDetails['dob']);?></td>
                    </tr>
                    <tr>
                        <th>Nationality:</th>
                        <td colspan="2"><?php echo htmlspecialchars($candidateDetails['nationality']);?></td>
                    </tr>
                    <tr>
                        <th>State of Origin:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['state']);?></td>
                        <th>Local Government Area:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['lga']);?></td>
                    </tr>
                    <tr>
                        <th>Marital Status:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['marital']);?></td>
                        <th>Religion:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['religion']);?></td>
                    </tr>
                    <tr>
                        <th>Occupation:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['occupation']);?></td>
                        <th>Height:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['height']);?></td>
                    </tr>
                    <tr>
                        <th>Hobbies:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['hobbies']);?></td>
                        <th>Application Status</th>
                        <!--<td>[SHORTLISTED/NOT-SHORTLISTED]</td>-->
                        <td><?php echo htmlspecialchars($candidateStatus);?></td>
                    </tr>
                    <tr>
                        <th>Test Center:</th>
                        <td colspan="3"><?php echo htmlspecialchars($candidateDetails['centrename']);?></td>
                    </tr>
                    <tr>
                        <th class="text-centerbtn-primary" colspan="4"> DSSC Information</th>
                    </tr>
                    <tr>
                        <th>Specialty:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['specialty']);?></td>
                    </tr>
                    <tr>

                        <th class="text-center btn-primary" colspan="4">Military Experience</th>
                    </tr>
                    <tr>
                        <th>Previous Military Service:</th>                           
                        <th>Service Type:</th> 
                        <th>Rank:</th>                         
                    </tr>
                    <tr>
                        <?php
                        if(empty($candidateMilitaryExperienceDetailsDetails['app_pk']))
                        {
                        ?>
                            <td>No</td>
                            <td>N/A</td>
                            <td>N/A</td>
                        <?php
                        }
                        else
                        {
                        ?>
                            <td>Yes</td>
                            <td><?php echo htmlspecialchars($candidateMilitaryExperienceDetailsDetails['service_type'])?></td>
                            <td><?php echo htmlspecialchars($candidateMilitaryExperienceDetailsDetails['rank'])?></td>
                        <?php
                        }
                        ?>
                    </tr>

                    </tr>
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Contact Information</th>
                    </tr>
                    <tr>
                        <th>Mobile Number:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['mobile']);?></td>
                        <th>Email:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['email']);?></td>
                    </tr>
                    <tr>
                        <th>Contact Address:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['contact_address']);?></td>
                        <th>Permanent Address:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['permanent_address']);?></td>
                    </tr>
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Education - Primary &amp; Secondary</th>
                    </tr>
                    <tr>
                        <th>School</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Certificate</th>
                    </tr>
                    <?php
                        foreach ($candidatePrySecDetails as $candidatePrySecDetail) 
                        {
                    ?>         
                        <tr>
                            <td><?php echo htmlspecialchars($candidatePrySecDetail['school_name']);?></td>
                            <td><?php echo htmlspecialchars($candidatePrySecDetail['start_year']);?></td>
                            <td><?php echo htmlspecialchars($candidatePrySecDetail['end_year']);?></td>
                            <td><?php echo htmlspecialchars($candidatePrySecDetail['cert_obtained']);?></td>
                        </tr> 
                           
                    <?php        
                        }
                    ?>
                    
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Education - College, Polytechnic or University</th>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Institution</th>
                                        <th>Course of Study</th>
                                        <th>Certificate Received</th>
                                        <th>Grade</th>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(sizeof($candidateHigherInstitutionDetails) > 1)
                                    {
                                        foreach($candidateHigherInstitutionDetails as $candidateHigherInstitutionDetail)
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetail['institution_name']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetail['course_name']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetail['qualification']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetail['grade']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetail['start_year']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetail['end_year']);?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    else
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetails['institution_name']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetails['course_name']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetails['qualification']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetails['grade']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetails['start_year']);?></td>
                                        <td><?php echo htmlspecialchars($candidateHigherInstitutionDetails['end_year']);?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Education - Professional Certificates</th>
                    </tr>
                    <tr>
                        <th>Certificate</th>
                        <th>Certifying Body</th>
                        <!--<th>Address</th>-->
                        <th>Year Received</th>
                    </tr>

                    <?php
                    if(sizeof($candidateCertificationDetails) > 1)
                    {
                        foreach($candidateCertificationDetails as $candidateCertificationDetail)
                        {
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($candidateCertificationDetail['certification_name']);?></td>
                                <td><?php echo htmlspecialchars($candidateCertificationDetail['certifying_body']);?></td>
                                <td><?php echo htmlspecialchars($candidateCertificationDetail['year']);?></td>
                            </tr>
                            <?php
                        }
                            }
                    else if(sizeof($candidateCertificationDetails) > 1)
                    {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($candidateCertificationDetails['certification_name']);?></td>
                                <td><?php echo htmlspecialchars($candidateCertificationDetails['certifying_body']);?></td>
                                <td><?php echo htmlspecialchars($candidateCertificationDetails['year']);?></td>
                            </tr>
                    <?php
                    }
                    else
                    {
                    ?>
                            <tr>
                                <td>N/A</td>
                                <td></td>
                                <td></td>
                            </tr>
                    <?php
                    }
                    ?>
                    
                            
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Other Information - Medical Fitness</th>
                    </tr>
<!--                    <tr>
                        <th>Has been hospitalised:</th>
                        <td>no</td>
                        <th>Nature of illness:</th>
                        <td>
                            n/a                        </td>
                    </tr>-->
                    <tr>
                        <th>Has physical disability:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['physical_status']);?></td>
                        <th>Has mental disability:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['mental_status']);?> </td>
                    </tr>
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Other Information - Crime History</th>
                    </tr>
                    <tr>
                        <th>Has been convicted:</th>
                        <td><?php echo htmlspecialchars($candidateDetails['criminal_record']);?></td>
                        <!--<th>Reason:</th>-->
<!--                        <td>
                            n/a                        </td>-->
                    </tr>
<!--                    <tr>
                        <th>Served sentence:</th>
                        <td colspan="3">
                            n/a                        </td>
                    </tr>-->
<!--                    <tr>
                        <th class="text-center" colspan="4">Other Information - Employment</th>
                    </tr>
                    <tr>
                        <th>Employer:</th>
                        <td>NIGERIAN AIR FORCE</td>
                        <th>Address:</th>
                        <td>HEADQUARTER, NIGERIAN AIR FORCE, ABUJA</td>
                    </tr>
                    <tr>
                        <th>Date of appointment:</th>
                        <td colspan="3">27-06-2008</td>
                    </tr>-->
                    <tr>
                        <th class="text-center btn-primary" colspan="4">Documents</th>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Birth Certificate/Declaration of Age
                        </td>
                        <td class="col-xs-2"><a href=""  class="fa fa-user-circle-o"   data-toggle="modal" data-target="#myDOBModal"></a></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            O'Level Statement of Result
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"   data-toggle="modal" data-target="#myOLevelModal"></a></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Degree/HND Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"   data-toggle="modal" data-target="#myDegreeModal"></a></td>
                    </tr>
                    
                    
                        <?php 
                        if((!empty($candidateDetails['doc_cert_2'])) && (empty($candidateDetails['doc_cert_3'])))
                        {
                        ?>
                    <tr>
                        <td colspan="3" >
                            Professional Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"  data-toggle="modal" data-target="#myProfCert1Modal"></a></td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            Professional Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"  data-toggle="modal" data-target="#myProfCert2Modal"></a></td>
                    </tr>
                        <?php   
                        }
                        else if(!empty($candidateDetails['doc_cert_3']))
                        {
                        ?>
                    <tr>
                        <td colspan="3" >
                            Professional Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"  data-toggle="modal" data-target="#myProfCert1Modal"></a></td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            Professional Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"  data-toggle="modal" data-target="#myProfCert2Modal"></a></td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            Professional Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"  data-toggle="modal" data-target="#myProfCert3Modal"></a></td>
                    </tr>
                        <?php   
                        }
                        else
                        {
                        ?>
                    <tr>
                        <td colspan="3" >
                            Professional Certificate
                        </td>
                        <td class="col-xs-2"><a href="" class="fa fa-vcard-o"  data-toggle="modal" data-target="#myProfCert1Modal"></a></td>
                    </tr>
                        <?php
                        }
                        
                        ?>                        
                    
                    
                    
                    <?php include_once 'documents.php'; ?>
                    
                    
                    
                </tbody>
            </table>

            </table>
        </div> <!-- end table-responsive -->


        <br/>
        <?php //include_once "../global/footer.php";   ?>

    </div><!-- end starter-template -->
</div><!-- end container -->

<!--<script src="../../js/includes_js.php" type="text/javascript"></script>-->
<?php include_once '../../js/includes_js.php'; ?>
<!--<script src="../../js/download.js" type="text/javascript"></script>-->




<?php require_once '../templates/bottom.php'; ?>