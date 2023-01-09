<?php
include('./PDF_set/PDF_conn.php');
$id = $_GET["pdfinvbill_id"];

$sql = "SELECT * FROM `invoicebill` WHERE invbill_id = '$id'";
$query = $conn->query($sql);
$infoinvb = $query->fetch_assoc();

echo '
<div id="invoicebillForm" class="container mt-5" style="width: 842px;">
    <div>
        <table>
            <tr>
                <td style="width:250px;">
                    <div class="logo">
                        <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" width="150" hight="auto" alt="addpay_logo_form">
                    </div>
                </td>
                <td VALIGN="middle" style="width:592px;" >
                    <label class="text-left"> บริษัท แอดเพยเ์ซอร์วิสพอยท์จำกัด (สำนักงานใหญ่)</label><br>
                    <label class="text-left">406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี 34000</label>
                </td>
                
            </tr>
            
        </table>
        <table style="margin-top: 15px;">
            <tr>
                <td style="width:642px;">
                    <label>โทร . 045-317123 Fax. 045-317678</label><br>
                    <label>เลขประจำตัวผู้เสียภาษีอากร 0 3455 58001 37 0</label>
                </td>
            
                <td class="text-center" style="width:200px; border: 1px solid;">
                    <div style=" padding:10px 20px; margin:0;"> 
                        <b >ใบแจ้งหนี้ / ใบวางบิล</b>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width:592px;">
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรียน แผนกบัญชีและการเงิน</label>
                </td>
            </tr>
        </table>

        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; ">
            <tr style="border-bottom: 1px solid;">
                <td align="left" style="border-left: 1px solid ; width: 642px;">
                    <label>ชื่อลูกค้า / Customer :</label> &nbsp;&nbsp;' . $infoinvb['invbill_name']  . '<br>
                    <label>ที่อยู่ / Address :</label> &nbsp;&nbsp;' . $infoinvb['invbill_address']  . '<br>
                    <label>เลขประจำตัวผู้เสียภาษี :</label> &nbsp;&nbsp;' . $infoinvb['invbill_cusid']  . '
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1px solid ; width: 200px;">
                    <label>เลขที่ / No.</label> &nbsp;&nbsp;' . $infoinvb['invbill_no']  . '<br>
                    <label>วันที่ / Date.</label> &nbsp;&nbsp;' . $infoinvb['invbill_date']  . '
                </td>
            </tr>


        </table>
        <table>
            <tr>
                <td style="width:592px;">
                    <label>&nbsp;ได้รับวางบิลจาก บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด ตามรายการต่อไปนี้</label>
                </td>
            </tr>
        </table>

        <div>
            <table style="width: 737px;  border-collapse: collapse; padding: 0; margin: 0; margin-top:0px;">
                <tr style="border-top:1px solid blue; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1px solid blue; width: 10%;">ลำดับที่</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 20%;">รายการ</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;">วันที่ใบแจ้งหนี้/<br>ใบกำกับภาษี</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;">กำหนดชำระ</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;">จำนวนก่อน<br>ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;">ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1px solid blue; border-right: 1px solid blue; width: 12%;">จำนวนเงินรวม</td>
                    
                </tr>
                <tr style=" border-bottom:1px solid blue; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1px solid blue; width: 10%;"><br>Item</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 20%;"><br>Order</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;"><br>invoice Date</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;"><br>Due Date</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;"><br>Amount</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;"><br>Vat</td>
                    <td class="text-center" style="border-left: 1px solid blue; border-right: 1px solid blue; width: 12%;"><br>Total Amount</td>
                    
                </tr>';


// <!--  -->
// <!--php  ดึงข้อมูลรายการ-->
// <!--  -->


$sql = "SELECT * FROM `invoicebill_details` WHERE invbilld_bid = '$id' ;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoinvbitems = mysqli_fetch_assoc($result)) {
        $i++;
        echo ' 
                <tr>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:20px;">' . $i . '</td>
                    <td VALIGN="TOP" style="text-align: left; border-left: 1px solid blue; height:20px;">' . $infoinvbitems['invbilld_item'] . ' </td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:20px;">' . $infoinvbitems['invbilld_inv_date'] . '</td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:20px;">' . $infoinvbitems['invbilld_due_date'] . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:20px;">' . number_format($infoinvbitems['invbilld_price'], 2) . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:20px;">' . number_format($infoinvbitems['invbilld_vat'], 2) . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-right: 1px solid blue; height:20px;">' . number_format($infoinvbitems['invbilld_result'], 2) . '</td>
                </tr>';
    }
    $i = $i + 1;
    echo '
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:50px;">' . $i . '</td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1px solid blue; height:50px;">ค่าขนส่ง</td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:50px;">' . number_format($infoinvb['invbill_deli']) . '</td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-right: 1px solid blue; height:50px;">' . number_format($infoinvb['invbill_deli']) . '</td>
            </tr>';
}

//<!-- blank area -->
$sql = "SELECT * FROM invoicebill WHERE invbill_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoinvbsum = mysqli_fetch_array($result)) {
    echo '
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-right: 1px solid blue; height:50px;"></td>
            </tr>
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid blue; border-right: 1px solid blue; border-bottom: 1px solid blue; height:50px;"></td>
            </tr>
        
            <tr style="border-collapse: collapse; ">
                <td style="text-align:center;" >รวม</td>
                <td style="text-align: center; ">1</td>
                <td style="text-align: left; border-right: 1px solid blue;" colspan="2">ฉบับ</td>

                <td VALIGN="middle" style=" text-align:center;padding:20px 0; border:1px solid blue; border-collapse: collapse; padding: 5px; margin: 0;" ROWSPAN="2" colspan="3">
                    <b>สามหมื่นห</b>
                    <p>(ตัวอักษร)</p>
                </td>
            </tr>

            <tr style="border-bottom: 1px solid ;">
                <td style="text-align: center;">ตัวอักษร</td>
                <td style="text-align: center; border-right: 1px solid blue;" colspan="3">14,018.69</td>
            </tr>
            
            

        </table>

    </div>';
}


// <!-- ดึงข้อมูลเงินเป็นตัวอักษร -->
// <!-- text price -->
$sql = "SELECT quo_total FROM invoicebill WHERE quo_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoinvbsum = mysqli_fetch_array($result)) {
    echo '
        <div>
            <table style="width: 842px; border:1px solid blue; border-collapse: collapse; padding: 0; margin-top: 10px; ">
                <tr>
                    <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid blue; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                        <b> ข้าพเจ้าได้รับเอกสารข้างต้นถูกต้องครบถ้วนแล้ว</b>
                        <br><br><br><br><br>
                        <p> ผู้รับเอกสาร</p>
                        <p> วันที่&nbsp;................................................................................</p>
                    </td>
                    <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid blue; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                        <p>ขอแสงความนับถือ</p>
                        <br><br><br><br><br>
                        <p>ผู้มีอำนาจลงนาม / Authorlzed Siganture</p>

                        <!-- วันที่ในใบเสนอราคา -->
                        <p>วันที่ 11 มกราคม 2564</p>
                    </td>

            </table>
        </div>

    </div>';
}
