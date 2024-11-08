<?php 
    $loadinfo = '
    <table>
        <tr>
            <td><h5>UniFAST TDP Form
                <br>2022 version
                <br>(NOT FOR SALE)</h5>
            </td>
            <td colspan="3" style="text-align: center;">
                <img src="'.$destinationForm1Logo.'">
                <h4 style="font-size: 11px;"><span style="color: red; font-style: italic;">CHED Regional Office ___</span>
                <br>UniFAST TULONG DUNONG PROGRAM (UniFAST-TDP)
                <br>APPLICATION FORM</h4>

            </td>
            <td style="text-align: right;"><h5>Annex 1</h5><br><br><br><br><br><div></div>
            <img width="107px;" height="107px;" src="';
            if($profile_pic == ""){
                $loadinfo .= '/scholarship_system/user/profile/profilepic/default.png';
            }else{
                $loadinfo .= '/scholarship_system/user/profile/profilepic/'.$profile_pic;
            }
    $loadinfo .= '" style="border: 1px solid black;">
            </td>
        
        </tr>
        <tr>
            <td colspan="5"><h5 style="font-weight: none; font-size: 7px;"><i>Instructions. Read General and Documentary Requirements. Fill in all the required information. Do not leave an item blank Item is not applicable, indicate "NA".</i></h5><br></td>
        </tr>
    </table><br>

    <table border="1" cellpadding="2">
        <tr>
            <td colspan="5" style="text-align: center; font-weight:bold;">PERSONAL INFORMATION</td>
        </tr>
        <tr>
            <td rowspan="2" style="text-align: center;"><br><br><b>Name</b><br></td>
            <td style="text-align: center;">'.$last_name.'</td>
            <td style="text-align: center;">'.$first_name.'</td>
            <td style="text-align: center;">'.$middle_name.'</td>
        </tr>
        <tr>
            <td style="text-align: center;">(Last Name)</td>
            <td style="text-align: center;">(First Name)</td>
            <td style="text-align: center;">(Middle Name)</td>
            <td style="text-align: center;">Maiden Name<br>(For Married Women)</td>
        </tr>
        <tr>
            <td style="text-align: center;"><b>Date of Birth</b><br>(mm/dd/yyyy)</td>
            <td style="text-align: center;">'.$format_birthdate.'</td>
            <td colspan="2" style="text-align: center;"><b>Permanent Address</b><br></td>
            <td style="text-align: center;"><b>Zip Code</b></td>
        </tr>
    </table>
    <table border="1" cellpadding="2">
        <tr>
            <td rowspan="3" width="20%" style="text-align: center;"><br><br><br><b>Place of Birth</b></td>
            <td rowspan="3" width="20%" style="text-align: center;"><br><br><br>'.$birthplace.'</td>
            <td width="13%" style="text-align: center;">'.$arr_address[0].'</td>
            <td width="14%" style="text-align: center;">'.$arr_address[1].'</td>
            <td width="13%" style="text-align: center;">'.$arr_address[2].'</td>
            <td rowspan="2" width="20%" style="text-align: center;"><br><br>'.$postal_code.'</td>
        </tr>
        <tr>
            <td style="text-align: center;">Street & Barangay</td>
            <td style="text-align: center;">Town/City/<br>Municipality</td>
            <td style="text-align: center;">Province</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><b>Name of School Attended</b></td>
            <td colspan="2" style="text-align: center;">'.$school_attended.'</td>
        </tr>
        <tr>
            <td rowspan="2" width="20%" style="text-align: center;"><b>Sex</b></td>
            <td rowspan="2" width="20%" >';
                if($sex == "M"){
                    $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Male';
                }else{
                    $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Male';

                }

                if($sex == "F"){
                    $loadinfo .= '<br>&nbsp;&nbsp;&nbsp;( <b>/</b> ) Female';
                }else{
                    $loadinfo .= '<br>&nbsp;&nbsp;&nbsp;( <b> </b> ) Female';

                }
        $loadinfo .= '</td>
            <td colspan="2" style="text-align: center;">School ID Number</td>
            <td colspan="2" style="text-align: center;">'.$school_id_num.'</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">School Address</td>
            <td colspan="2" style="text-align: center;">'.$school_address.'</td>
        </tr>
        <tr>
            <td style="text-align: center;"><b>Citizenship</b></td>
            <td style="text-align: center;">'.$citizenship.'</td>
            <td colspan="2" style="text-align: center;"><b>School Sector</b></td>
            <td colspan="2" style="text-align: center;">';
            if($school_sector == "Public"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Public';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Public';

            }

            if($school_sector == "Private"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Private';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Private';

            }
        $loadinfo .= '</td>
        </tr>
    </table>
    <table border="1" cellpadding="2">
        <tr>
            <td style="text-align: center;"><b>Mobile Number</b></td>
            <td style="text-align: center;">'.$contact.'</td>
            <td style="text-align: center;"><b>Year Level</b></td>
            <td style="text-align: center;">'.$yearlevel.'</td>
            <td style="text-align: center;"><b>Tribal Membership</b><br>(if applicable)</td>
        </tr>
        <tr>
            <td style="text-align: center;"><b>Email</b></td>
            <td style="text-align: center;">'.$email.'</td>
            <td style="text-align: center;"><b>Type of Disability<br>(if applicable)</b></td>
            <td style="text-align: center;">'.$disability.'</td>
            <td style="text-align: center;">'.$tribal_membership.'</td>
        </tr>
    </table>
    <table border="1" cellpadding="2">
        <tr>
            <td colspan="3" style="text-align: center"><b>FAMILY BACKGROUND</b></td>
        </tr>
        <tr>
            <td width="40%"></td>
            <td width="30%"><b>Father: ';
            if($father_status == "Living"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Living';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Living';

            }

            if($father_status == "Deceased"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Deceased';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Deceased';

            }
        $loadinfo .= '</b></td>
            <td width="30%"><b>Mother: ';
            if($mother_status == "Living"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Living';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Living';

            }

            if($mother_status == "Deceased"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Deceased';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Deceased';

            }
        $loadinfo .= '</b></td>
        </tr>
        <tr>
            <td><b>Name</b></td>
            <td style="text-align: center;">'.$father_name.'</td>
            <td style="text-align: center;">'.$mother_name.'</td>
        
        </tr>
        <tr>
            <td><b>Address</b></td>
            <td style="text-align: center;">'.$father_address.'</td>
            <td style="text-align: center;">'.$mother_address.'</td>
        
        </tr>
        <tr>
            <td><b>Occupation</b></td>
            <td style="text-align: center;">'.$father_occupation.'</td>
            <td style="text-align: center;">'.$mother_occupation.'</td>
        
        </tr>
        <tr>
            <td><b>Total Parents Gross Income</b></td>
            <td style="text-align: center;">'.number_format($gross_income, 2, ".", ",").'</td>
            <td><b>No. of Siblings in the family</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$no_of_siblings.'</td>
        
        </tr>
        <tr>
            <td colspan="3"><b>Are you enjoying other educational financial assistance? </b>';
            if($isScholar == "Yes"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) Yes';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) Yes';

            }

            if($isScholar == "No"){
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b>/</b> ) No';
            }else{
                $loadinfo .= '&nbsp;&nbsp;&nbsp;( <b> </b> ) No';

            }
        $loadinfo .= '<br>
        <table cellpadding="5">
            <tr>
                <td width="20%"><b>If yes, please specify</b></td>
                <td width="80%">'.$otherScholarships.'</td>
            </tr>
        </table>
        <br><br>
        </td>
        </tr>
        <tr>
            <td colspan="3">
            <b>I hereby certify that foregoing statements are true and correct.</b><br><br>
            <table>
                <tr>
                <td style="text-align: center;">__________________________________________
                <br><b>Signature Over Printed Name</b>
                </td>
                <td style="text-align: center;">__________________________________________
                <br><b>Date Accomplished</b>
                
                </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center"><br><br>Note: Fully accomplished form to be submitted to the CHEDRO</td>
                </tr>
            </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;"><b>DO NOT FILL-OUT THIS PORTION FOR CHEDRO USE ONLY)</b></td>
        </tr>
        <tr>
            <td colspan="3">Documents Attached
            <br>Certificate of Registration/Enrolment (CORs/COEs) _________
            <br>Certificate of Indigency _________                                           
            </td>
        </tr>
        <tr>
            <td colspan="3"><b>Evaluated Processed By: 
            <br><span style="text-align: center">__________________________________________
                <br>UniFAST Regional Coordinator</span>
            </b></td>
        </tr>
    </table>
    <table border="1" cellpadding="2">
        <tr>
            <td width="40%" ><b>QUALIFICATION REQUIREMENTS 
            <br>per Section 1 of the Memorandum Circular No. __ s. 2022.</b>

            <br><br>An applicant for this grant must be a Filipino citizen with a combined household (parents/guardian) gross income which shall not exceed Four Hundred Thousand Pesos (PhP400,000.00) and maybe classified as one of the following:  

            <br><br>5.1	New TDP-TES Grantee must be enrolled in any first undergraduate degree in 
            SUCs, CHED-Recognized LUCs and Private HEIs that are in the CHED Registry of Programs and Institutions.
            </td>

            <td width="60%" ><b>DOCUMENTARY REQUIREMENTS per Section 3 of the Memorandum Circular No. __ s. 2022. 
            <br>6.2.1 a. For new applicants: </b>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participating higher education institutions (HEIs) must submit, to the respective CHED Regional Offices, a certified true copy or electronically-generated copy of the list of enrolled student- applicants with total number of units enrolled (Annex 5), with the attached certified electronically generated Certificate of Registration/Enrolment (CORs/COEs) as proof of enrollment. 

            <br><br><b>6.2.2 (Income Requirement)</b> New applicants and continuing grantees shall submit a Certificate of Indigency as proof of income, duly issued by the Punong Barangay where the applicant resides.
            </td>
        </tr>
    </table>
    ';


?>