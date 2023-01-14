<?php
include('./PDF_set/PDF_conn.php');
$id = $_GET["pdfinvtax_id"];

$sql = "SELECT * FROM invoicetax WHERE invtax_id= '$id'";
$query = $conn->query($sql);
$infoinvtax = $query->fetch_assoc();

echo '

<div id="invtaxForm" class="container mt-5" style="width: 842px;">
    <div>
    <table>
        <tr>
            <td style="width:200px;">
                <div class="logo">
                    <img src="../../image/addpay-form-text.png" class="img-fluid position-relative" width="150" hight="auto" alt="addpay_logo_form">
                </div>
            </td>
            <td style="width:442px; text-align: center;" >
                <div>
                    <b style="font-size :16px;"> บริษัท แอดเพยเ์ซอร์วิสพอยท์จำกัด (สำนักงานใหญ่)</b><br>
                    <b> 406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี 34000</b><br>
                    <b> เลขประจำตัวผู้เสียภาษีอากร 0 3455 58001 37 0</b><br>
                    <b> โทร . 045-317123 Fax. 045-317678</b><br>
                    
                </div>
            </td>
            <td VALIGN="middle" class="text-center" style="width:200px;  ">
                <p style="border: 1px solid; padding:20px; margin:0; font-size :16px;">
                    <b>ใบแจ้งหนี้ / ใบกำกับภาษี</b>
                </p>
            </td>
        </tr>

        </table>
        
<!--php  ดึงข้อมูลลูกค้า -->
<table style="width: 842px; border:1px solid;border-bottom: 0; border-collapse: collapse; padding: 0; margin: 0;  margin-top: 10px; overflow: wrap;">
    <tr style="border-bottom: 0 solid;">
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 150px;">
            <b>ชื่อลูกค้า / Customer :</b> <br>
        </td>
        <td VALIGN="TOP" align="left" style=" width: 426px;">
            <b>' . $infoinvtax['invtax_name']  . '</b><br>
        </td>
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 266px;">
            <b>เลขที่ / No.</b> &nbsp;&nbsp;' . $infoinvtax['invtax_no']  . '<br>
        </td>
    </tr>
    <tr style="border-bottom: 0 solid;">
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 150px;">
            <b>ที่อยู่ / Address :</b><br>
        </td>
        <td VALIGN="TOP" align="left" style="width: 426px;">
           <b>' . $infoinvtax['invtax_address']  . '</b><br>
        </td>
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 266px;">
            <b>วันที่ / Date.</b> &nbsp;&nbsp;' . ConvDate($infoinvtax['invtax_date'])  . '
        </td>
    </tr>
    <tr style="border-bottom: 0 solid;">
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 150px;">
            <b>เลขประจำตัวผู้เสียภาษี :</b>
        </td>
        <td VALIGN="TOP" align="left" style=" width: 426px;">
            <b>' . $infoinvtax['invtax_cusid']  . '</b>
        </td>
        <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 266px;">
        </td>
    </tr>


</table>



    <div>
        <table style="width: 842px; border:1px solid; border-bottom: 0;border-collapse: collapse; padding: 0; margin: 0;">
            <tr style="border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <th class="text-center" style="border-left: 1px solid; width: 60px;">ลำดับที่<br> Item</th>
                <th class="text-center" style="border-left: 1px solid; width: 420px;">รายการ<br>Order</th>
                <th class="text-center" style="border-left: 1px solid; width: 96px;">จำนวน<br>Amount</th>
                <th class="text-center" style="border-left: 1px solid; width: 96px;">ราคา / หน่วย<br>Unit / Price</th>
                <th class="text-center" style="border-left: 1px solid; width: 170px;">จำนวนเงินรวม<br>Total</th>
            </tr>';


// <!--  -->
// <!--php  ดึงข้อมูลรายการ-->
// <!--  -->

$sql = "SELECT * FROM invoicetax_details WHERE invtaxd_tid = '$id';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoinvtaxitems = mysqli_fetch_assoc($result)) {
        $i++;
        echo ' <tr>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:10px;">' . $i . '</td>
            <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:10px;">' . $infoinvtaxitems['invtaxd_item'] . '</td>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:10px; ">' . $infoinvtaxitems['invtaxd_amount'] . '</td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px;  padding: 0 10px;">' . number_format($infoinvtaxitems['invtaxd_price'], 2) . '</td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px; padding: 0 10px;">' . number_format($infoinvtaxitems['invtaxd_result'], 2) . '</td>
        </tr>';
    }
}

// <!-- blank area -->

$sql = "SELECT * FROM invoicetax WHERE invtax_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoinvtaxsum = mysqli_fetch_array($result)) {
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


<tr style="text-align:center; border:1px solid;border-bottom: 0; border-collapse: collapse; padding: 0; margin: 0;">
    <td VALIGN="middle" style=" border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2" >
        <b>' . Convert($infoinvtaxsum['invtax_total']) . '</b> <br> (ตัวอักษร)
    </td>
    

    <td style="text-align: right; border-left: 0px solid;" colspan="2"><b>รวมมูลค่าสินค้า</b></td>
    <td style="text-align: right; border-left: 1px solid; padding: 0 10px;">' . number_format($infoinvtaxsum['invtax_sum'], 2) . '</td>
</tr>
<tr
    style="width: 100%; border-collapse: collapse; padding: 0; margin: 0;">
    <td style="text-align: right; border-left: 0px solid;" colspan="2"><b>ภาษีมูลค่าเพิ่ม 7%</b></td>
    <td style="text-align: right; border-left: 1px solid; border: 1px solid; padding: 0 10px;">' . number_format($infoinvtaxsum['invtax_vat'], 2) . '</td>
</tr>
<tr
    style=" width: 100%; border-bottom: 1px solid; border-collapse: collapse; padding: 0; margin: 0;">
    <td style="text-align: right; border-left: px solid;" colspan="2"><b>จำนวนเงินรวมทั้งสิ้น</b></td>
    <td style="text-align: right; border-left: 1px solid; border: 1px solid; padding: 0 10px;">' . number_format($infoinvtaxsum['invtax_total'], 2) . '</td>
</tr>


</table>

</div>';
}

$sql = "SELECT invtax_total FROM invoicetax WHERE invtax_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoinvtaxsum = mysqli_fetch_array($result)) {
    echo '
    <div>
        <!-- footer -->
        <table style="width: 842px; border:1px solid; border-top: 0;border-collapse: collapse; padding: 0;">
        <tr>
            <td VALIGN="TOP" style=" width: 480px; border-right:1px solid; border-bottom: 0; border-collapse: collapse; padding: 10px; margin: 0;">
                <br><b> ข้าพเจ้าได้รับเอกสารข้างต้นถูกต้องครบถ้วนแล้ว </b>
            </td>
        </tr>
        <tr>
            <td VALIGN="TOP" style="text-align: center; width: 480px; border-right:1px solid; border-bottom: 0;border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                
                <p >ผู้รับเอกสาร</p>
                <br><br><br>
                <p > (....................................................................)
                </p>
                <p > วันที่&nbsp;…………………/…………………/…………………</p>
            </td>
            <td VALIGN="BOTTOM" style="text-align: center; width: 362px; border-right:1px solid; border-top: 0; border-bottom: 0;border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                <p>(นายวรกฤต ศิรธนิตรา)</p>
                <p>ผู้มีอำนาจลงนาม</p>
                <!-- วันที่ในใบเสนอราคา -->
                <p> วันที่&nbsp;…………………/…………………/…………………</p>
                <p>เลขบัญชี 850-6000-548 ธนาคารกรุงไทย สาขาสุนีย์</p>
            </td>
        </tr>
        </table>
        <table style="margin-top:10px;">
                <tr>
                    <td style="width:842px; text-align: center; ">
                        <label>&nbsp;กรุณาตรวจสอบเอกสารและหัก ณ ที่จ่าย (ถ้ามี) พร้อมส่งหนังสือรับรองการหักภาษี ณ ที่จ่ายมาด้วยทุกครั้งที่ชำระเงิน</label>
                    </td>
                </tr>
            </table>
     </div>


</div>';
}
