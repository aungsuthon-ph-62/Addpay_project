<?php
include('./PDF_set/PDF_conn.php');
$id = $_GET["pdfdocout"];

$sql = "SELECT * FROM `docout` WHERE docout_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infodoc = mysqli_fetch_array($result)) {
    echo '
    <div class="container py-5" style="width: 842px;">
        <div class="main-body">
            <table>
                <tr>
                    <td class="pt-10" style="width: 300px;">
                        <img src="../../image/logo-addpay.png" alt="" width="200" hight="auto">
                    </td>
                    
                    <td class="docright pt-10 ms-5" style="width: 500px;">
                        <b>บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด
                            ADDPAY SERVICE POINT CO.,LTD.
                            406 หมู่ 18 ตำบลขามใหญ่ อำเภอเมือง จังหวัดอุบลราชธานี</b>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="padding-top: 30px;">ที่ อพ.</td>
                    <td style="padding-top: 30px;">'.$infodoc['docout_no'].'</td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center;">'.DateThai($infodoc['docout_date']).'</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="padding-top: 30px;">เรื่อง</td>
                    <td style="padding-top: 30px; padding-left:10px">'.$infodoc['docout_title'].'</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="padding-top: 15px;">เรียน</td>
                    <td style="padding-top: 15px; padding-left:10px;">'.$infodoc['docout_to'].'</td>
                </tr>
            </table>

            <table>
                <tr>
                    <td VALIGN="TOP" style="padding-top: 15px; width:100px;">สิ่งที่ส่งมาด้วย</td>
                    <td style="padding-top: 15px; padding-left:10px; width: 695px; word-break:break-all">'.$infodoc['docout_send'].'</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style=" width: 785px; word-break:break-all">'.$infodoc['docout_details'].'</td>
                </tr>
            </table>

            
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center;padding-top:50px">
                        ขอแสดงความนับถือ <br><br><br><br>
                        ( '.$infodoc['docout_signame'].' )<br>
                        '.$infodoc['docout_position'].' <br>
                        บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด
                    </td>
                </tr>
            </table>
            <div style="padding-top: 40px;">
                <label for="">ผู้ประสานงาน<br>
                    โทร. 085-4964855 , 045-317123<br>
                    แฟกซ์ 045-317678
                </label>
            </div>

        </div>
    </div>


    ';
}