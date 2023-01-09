<?php
include('./PDF_set/PDF_conn.php');
$id = $_GET["pdfinvbill_id"];

$sql = "SELECT * FROM `invoicebill` WHERE invbill_id = '$id'";
$query = $conn->query($sql);
$infoinvb = $query->fetch_assoc();

echo '
<div id="invoicebillForm" class="container mt-5" style="width: 842px;">
    <div>
        <table style="padding-bottom: 20px;">
            <tr>
                <td style="width:250px;">
                    <div class="logo">
                        <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" width="200" hight="auto" alt="addpay_logo_form">
                    </div>
                </td>
                <td style="width:392px;" rowspan="3">
                    <div class="text-center">
                        <b> บริษัท แอดเพยเ์ซอร์วิสพอยท์จำกัด (สำนักงานใหญ่)</b><br>
                        <!-- <p class="text-left">406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี โทร. 045-317123</p> -->
                        
                        <label for="">406 หมู่18 ตำบลขามใหญ่ อำเภอเมือง จังหวัดอุบลราชธานี34000<br>
                            เลขประจำตัวผู้เสียภาษีอากร 0 3455 58001 37 0<br>
                            โทร . 045-317123 Fax. 045-317678</label>
                    </div>
                </td>
                <td class="text-center" style="width:200px; ">
                    <b style="border: 1px solid; padding:20px; margin:0;">ใบแจ้งหนี้ / ใบกำกับภาษี</b>
                </td>
            </tr>

        </table>



        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; ">
            <tr style="border-bottom: 1px solid;">
                <td align="left" style="border-left: 1px solid; width: 500px;">
                    <label>ชื่อลูกค้า / Customer :</label> &nbsp;&nbsp;' . $infoinvb['invbill_name']  . '<br>
                    <label>ที่อยู่ / Address :</label> &nbsp;&nbsp;' . $infoinvb['invbill_address']  . '<br>
                    <label>เลขประจำตัวผู้เสียภาษี :</label> &nbsp;&nbsp;' . $infoinvb['invbill_cusid']  . '
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 342px;">
                    <label>เลขที่ / No.</label> &nbsp;&nbsp;' . $infoinvb['invbill_no']  . '<br>
                    <label>วันที่ / Date.</label> &nbsp;&nbsp;' . $infoinvb['invbill_date']  . '
                </td>
            </tr>


        </table>

        <div>
            <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; margin-top:0px;">
                <tr style="background-color:LightGray; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1px solid; width: 80px;">ลำดับที่</td>
                    <td class="text-center" style="border-left: 1px solid; width: 126px;">รายการ</td>
                    <td class="text-center" style="border-left: 1px solid; width: 95px;">วันที่ใบแจ้งหนี้/<br>ใบกำกับภาษี</td>
                    <td class="text-center" style="border-left: 1px solid; width: 93px;">กำหนดชำระ</td>
                    <td class="text-center" style="border-left: 1px solid; width: 118px;">จำนวนก่อน<br>ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1px solid; width: 118px;">ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1px solid; width: 101px;">จำนวนเงินรวม</td>
                    <td class="text-center" style="border-left: 1px solid; width: 109px;">หมายเหตุ</td>
                </tr>
                <tr style="background-color:LightGray; border-bottom:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1px solid; width: 80px;"><br>Item</td>
                    <td class="text-center" style="border-left: 1px solid; width: 126px;"><br>Order</td>
                    <td class="text-center" style="border-left: 1px solid; width: 95px;"><br>invoice Date</td>
                    <td class="text-center" style="border-left: 1px solid; width: 93px;"><br>Due Date</td>
                    <td class="text-center" style="border-left: 1px solid; width: 118px;"><br>Amount</td>
                    <td class="text-center" style="border-left: 1px solid; width: 118px;"><br>Vat</td>
                    <td class="text-center" style="border-left: 1px solid; width: 101px;"><br>Total Amount</td>
                    <td class="text-center" style="border-left: 1px solid; width: 109px;"><br>Remark</td>
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
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $i . '</td>
                    <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;">' . $infoinvbitems['invbilld_item'] . ' </td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $infoinvbitems['invbilld_amount'] . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . number_format($infoinvbitems['invbilld_price'], 2) . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . number_format($infoinvbitems['invbilld_result'], 2) . '</td>
                
                    </tr>';
    }
    $i = $i + 1;
    echo '
    <tr>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $i . '</td>
        <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;">ค่าขนส่ง</td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . $infoinvb['quo_deli'] . '</td>
    </tr>';
}

//<!-- blank area -->
$sql = "SELECT * FROM invoicebill WHERE quo_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoinvbsum = mysqli_fetch_array($result)) {
    echo '
                <tr>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
                </tr>
                <tr>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;"></td>
                </tr>
                <!-- end blank area-->

                <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; ">
                    <td VALIGN="middle" style=" text-align:center;padding:20px 0; border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2">
                        <b>สามหมื่นหนึ่งพันเจ็ดร้อยห้าสิบสองบาทยี่สิบห้าสตางค์</b>
                        <p>(ตัวอักษร)</p>
                    </td>



                    <!--  -->
                    <!-- ดึงข้อมูลจำนวนเงิน เงินรวมต่างๆ -->
                    <!--  -->


                    <td style="text-align: right; border-left: 0px solid;" colspan="2">รวมเงิน</td>
                    <td style="text-align: right; border-left: 1px solid;">14,018.69</td>
                </tr>
                <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                    <td style="text-align: right; border-left: 0px solid; color:red;" colspan="2">หัวส่วนลดพิเศษ</td>
                    <td style="text-align: right; border-left: 1px solid;">-</td>
                </tr>
                <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                    <td style="text-align: right; border-left: 0px solid;" colspan="2">ยอดรวมหลังหักส่วนลด</td>
                    <td style="text-align: right; border-left: 1px solid;">14,018.69</td>
                </tr>
                <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                    <td style="text-align: right; border-left: 0px solid;" colspan="2">ภาษีมูลค่าเพิ่ม 7%</td>
                    <td style="text-align: right; border-left: 1px solid;">981.31</td>
                </tr>
                <tr style=" background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                    <td style="text-align: right; border-left: px solid;" colspan="2">จำนวนเงินรวมทั้งสิน</td>
                    <td style="text-align: right; border-left: 1px solid;">15,000.00</td>
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
            <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px; ">
                <tr>
                    <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                        <b> ข้าพเจ้าได้รับเอกสารข้างต้นถูกต้องครบถ้วนแล้ว</b>
                        <br><br><br><br><br>
                        <p> ผู้รับเอกสาร</p>
                        <p> วันที่&nbsp;................................................................................</p>
                    </td>
                    <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
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
