<?php
include('./PDF_set/PDF_conn.php');
$id = $_GET["pdfquo"];
$sql = "SELECT * FROM quotation_appraisal WHERE quo_id = $id";
$query = $conn->query($sql);
$infoquo = $query->fetch_assoc();

echo '
<div id="quotationForm" class="container mt-5" style="width: 842px;">
    <div>
        <table>
            <tr>
                <td style="width:250px;">
                    <div class="logo">
                        <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" width="200" hight="auto" alt="addpay_logo_form">
                    </div>
                </td>
                <td style="width:592px;">
                    <div style="margin-left: 60px;">
                        <b class="text-left"> บริษัท แอดเพย์ เซอร์วิสพอยท์ จํากัด</b><br>
                        <p class="text-left">406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี โทร. 045-317123</p>
                    </div>
                </td>
            </tr>
        </table>
        <table>

            <tr style=" border-collapse: collapse; padding: 0; margin: 0;">
                <td class="text-center" style="width: 200px;  border: 1px solid; padding: 8px;" ROWSPAN="2">
                    <b>ใบเสนอราคา</b><br>
                    <b>Quotation</b>
                </td>
                <td  style="text-align: right; width: 500px; border-collapse: collapse; padding: 0; margin: 0;">เลขที่/No.</td>
                
                <td class="underline" style="text-align: center; width: 142px;">
                    <p class="text-left"> <span>&nbsp;' . $infoquo['quo_no']  . ' &nbsp;&nbsp;</span> </p>
                </td>

            </tr>
            <tr>
                <td style="text-align: right; border-collapse: collapse; padding: 0; margin: 0;">วันที่/Date.</td>
                <td class="underline" style="text-align: center;">
                    <p class="text-left"> <span>&nbsp;' . ConvDate($infoquo['quo_date'])  . ' &nbsp;&nbsp;</span> </p>
                </td>
                
            </tr>
            
        </table>
    </div>

    <!--  -->
    <!--php  ดึงข้อมูลลูกค้า -->
    <!--  -->
    <div>
        <table style="margin-top: 5px;">
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">โครงการ</p>
                </td>
                <td class="underline" style="width:692px;">
                    <p class="text-left "><span>&nbsp;'. $infoquo['quo_namepj'] . ' &nbsp;&nbsp;</span></p>
                </td>
            </tr>
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">ลูกค้า /หน่วยงาน</p>
                </td>
                <td class="underline" style="width:692px;">
                    <p class="text-left "><span>&nbsp;'. $infoquo['quo_name'] . ' &nbsp;&nbsp;</span></p>
                </td>
            </tr>
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">ที่อยู่</p>
                </td>
                <td class="underline" style="width:692px;">
                    <p class="text-left"><span>&nbsp;'. $infoquo['quo_address'] . ' &nbsp;&nbsp;</span></p>
                </td>
            </tr>
        </table>
    </div>


    <div>
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; margin-top:5px;">
            <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <th class="text-center" style="border-left: 1px solid; width: 59px;">ลำดับที่</th>
                <th class="text-center" style="border-left: 1px solid; width: 497px;">รายการ / Description</th>
                <th class="text-center" style="border-left: 1px solid; width: 67px;">จำนวน<br>Amount</th>
                <th class="text-center" style="border-left: 1px solid; width: 109px;">ราคา / หน่วย<br>Unit / Price</th>
                <th class="text-center" style="border-left: 1px solid; width: 109px;">จำนวนเงิน<br>บาท</th>
            </tr>';



// <!--  -->
// <!--php  ดึงข้อมูลรายการ-->
// <!--  -->


$sql = "SELECT * FROM quotation_appraisal_details WHERE quode_quoid = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoquoitems = mysqli_fetch_assoc($result)) {
        $i++;
        echo ' <tr>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid;  line-height: 20px;">' . $i . '</td>
            <td VALIGN="TOP" style="text-align: left; border-left: 1px solid;  line-height: 20px;">' . $infoquoitems['quode_item'] . '
            </td>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid;  line-height: 20px;">' . $infoquoitems['quode_amount']
                . '</td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid;  line-height: 20px;">' .
                number_format($infoquoitems['quode_price'],2) . '</td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid;  line-height: 20px;">' .
                number_format($infoquoitems['quode_result'],2) . '</td>
        </tr>';
    }
    if($infoquo['quo_deli']>0){
        $i=$i+1;
        echo '<tr>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid;  line-height: 20px;">' . $i . '</td>
            <td VALIGN="TOP" style="text-align: left; border-left: 1px solid;  line-height: 20px;">ค่าขนส่ง</td>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid;  line-height: 20px;"></td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid;  line-height: 20px;"></td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid;  line-height: 20px;">' . $infoquo['quo_deli'] . '</td>
        </tr>';
    }    
}




// <!-- blank area -->


$sql = "SELECT * FROM quotation_appraisal WHERE quo_id = $id";
$result = mysqli_query($conn, $sql);
while ($infoquosum = mysqli_fetch_array($result)) {
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
   
        <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
            <td style=" border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2">
            <p>
                หมายเหตุ <br>
                ราคาขาย หน่วยเป็นบาท และขอยืนยันราคา 30 วันนับจากวันที่ออกใบเสนอราคา <br>
                ใบเสนอราคา/ ใบสั่งซื้อนี้ถือเป็นส่วนหนึ่งของสัญญา <br>
                ขอขอบคุณที่ให้ความไว้วางใจในสินค้าและบริการของบริษัท แอดเพยเ์ซอร์วิสพอยท์ จำกัด <br>
            </p>
            </td>

            <td style="text-align: right; border-left: 0px solid;" colspan="2">รวมเงิน</td>
            <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quo_sum'], 2) . '</td>
        </tr>

            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid; color:red;" colspan="2">หัวส่วนลดพิเศษ</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quo_specialdis'], 2) . '</td>
            </tr>
            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid;" colspan="2">ยอดรวมหลังหักส่วนลด</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quo_afterdis'], 2) . '</td>
            </tr>
            <tr style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: 0px solid;" colspan="2">ภาษีมูลค่าเพิ่ม 7%</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quo_vat'], 2) . '</td>
            </tr>
            <tr style=" background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <td style="text-align: right; border-left: px solid;" colspan="2">จำนวนเงินรวมทั้งสิน</td>
                <td style="text-align: right; border-left: 1px solid;">' . number_format($infoquosum['quo_total'], 2) . '</td>
            </tr>

        </tr>
    </table>
</div>';
}

$sql = "SELECT * FROM quotation_appraisal WHERE quo_id = $id";
$result = mysqli_query($conn, $sql);
while ($infoquosum = mysqli_fetch_array($result)) {
echo '
    <div>
        <table style="text-align: left; width:842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px;">
            <tr style="border-bottom: 1px solid;">
                <td VALIGN="TOP" style="text-align: left;  width: 20%; padding:5px 10px;">จำนวนเงินตัวอักษร <br> The Sum Of Bahts </td>
                <td VALIGN="TOP" style="text-align: left;  width: 80%; padding:5px 10px;"> ' . Convert($infoquosum['quo_total']) . ' </td>
            </tr>
        </table>
        <!-- footer -->
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px; ">
            <tr>
                <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p> ยินดีรับข้อเสนอของ บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด </p>
                    <br><br><br><br><br>
                    <p> ผู้อนุมัติสั่งซื้อ / Customer Signature </p>
                    <p> วันที่&nbsp;................................................................................</p>
                </td>
                <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p>ขอแสงความนับถือ</p>
                    <br><br><br><br><br>
                    <p>ผู้มีอำนาจลงนาม / Authorlzed Siganture</p>

                    <!-- วันที่ในใบเสนอราคา -->
                    <p>วันที่ ' . DateThai($infoquosum['quo_date'])  . '</p>
                </td>

        </table>
    </div>

    </div>';
}
?>