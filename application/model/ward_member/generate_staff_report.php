<?php
    include '../../config/dbcon.php';
    session_start();
    extract($_POST);

    require('../../../public/assets/libraries/mpdf/vendor/autoload.php');
    $query="SELECT `userid`, `name`, `activity`, `date_time` from `tbl_staff_activity` where (date_time BETWEEN '$fDate' and '$tDate') and `userid`='$staff_id'";
    $queryRes=mysqli_query($conn, $query);
    if(mysqli_num_rows($queryRes)>0){
        $staffData=mysqli_fetch_assoc($queryRes);
        $sName=$staffData['name'];
        $sId=$staffData['userid'];
        
        $html='<style>
                    .heading{
                        font-size:28px; 
                        text-align:center;
                        margin-top:32px;
                        font-weight:bold;
                    }
                    .sub-head{
                        text-align:center;
                        margin-top:12px;
                    }
                    .sub-head span{
                        font-weight:bold;
                    }
                    .table{
                        margin-top:32px;
                        position: absolute;
                        left:50%;
                        transform:translateX(-50%);
                    }
                    th,td{
                        padding:6px 10px;
                        font-size:18px;
                        text-align:left;
                    }
                </style>
                <div class="heading">Office staff report</div>
                <div class="sub-head">Staff id: <span>'.$sId.'</span></div>
                <div class="sub-head">Staff name: <span>'.$sName.'</span></div>
                <table border=1 class="table">
                <tr>
                    <th width=100>Date</th>
                    <th width=80>Time</th>
                    <th width=600>Activity</th>
                </tr>';
        while($row=mysqli_fetch_assoc($queryRes)){
            $datetime = $row["date_time"];
            $date = date('d-m-Y', strtotime($datetime));
            $time = date('h:i a', strtotime($datetime));

            $html.='<tr>
                        <td width=120>'.$date.'</td>
                        <td width=120>'.$time.'</td>
                        <td width=540>'.$row["activity"].'</td>
                    </tr>';
        }
        $html.='</table>';

        // echo $html;
        $mpdf=new mPDF();
        $mpdf->WriteHTML($html);
        $file=time().'.pdf';
        $mpdf->output($file,'I');
    }else{
        $_SESSION['error'] = "Data not found";
        header("Location: ../../view/pages/ward_member/office_staff.php?id=$staff_id");
    }

?>