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
                    <b>ใบแจ้งหนี้/ ใบกำกับภาษี</b><br>
                </td>
                <td  style="text-align: right; width: 500px; border-collapse: collapse; padding: 0; margin: 0;">เลขที่/No.</td>
                
                <td class="underline" style="text-align: center; width: 142px;">
                    <p class="text-left"> <span>&nbsp;' .$infoinvtax['invtax_no']   . ' &nbsp;&nbsp;</span> </p>
                </td>

            </tr>
            <tr>
                <td style="text-align: right; border-collapse: collapse; padding: 0; margin: 0;">วันที่/Date.</td>
                <td class="underline" style="text-align: center;">
                    <p class="text-left"> <span>&nbsp;' . $infoinvtax['invtax_date']  . ' &nbsp;&nbsp;</span> </p>
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
                <td style="width:200px;">
                    <p class="text-left ">ชื่อ ลูกค้า :</p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left "> <span>&nbsp; ' . $infoinvtax['invtax_name'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">ที่อยู่ :</p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left"> <span>&nbsp;' . $infoinvtax['invtax_address'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:200px;">
                    <p class="text-left ">เลขประจำตัวผู้เสียภาษี : </p>
                </td>
                <td class="underline" style="width:642px;">
                    <p class="text-left "> <span>&nbsp;' . $infoinvtax['invtax_cusid'] . ' &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
        
        </table>
    </div>


    <div>
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; margin-top:5px;">
            <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <th class="text-center" style="border-left: 1px solid; width: 59px;">ลำดับที่</th>
                <th class="text-center" style="border-left: 1px solid; width: 497px;">รายการ / Description</th>
                <th class="text-center" style="border-left: 1px solid; width: 88px;">จำนวน<br>Amount</th>
                <th class="text-center" style="border-left: 1px solid; width: 88px;">ราคา / หน่วย<br>Unit / Price</th>
                <th class="text-center" style="border-left: 1px solid; width: 109px;">จำนวนเงิน<br>บาท</th>
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
            <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:10px;">' .$infoinvtaxitems['invtaxd_item'] .'</td>
            <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:10px;">' .$infoinvtaxitems['invtaxd_amount'] . '</td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px;">' .number_format($infoinvtaxitems['invtaxd_price'],2) . '</td>
            <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:10px;">' .number_format($infoinvtaxitems['invtaxd_result'],2) . '</td>
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


<tr style="text-align:center; background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
    <td style=" border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2" >
        ' . Convert($infoinvtaxsum['invtax_total']) . ' <br> (ตัวอักษร)
    </td>
    



    <!--  -->
    <!-- ดึงข้อมูลจำนวนเงิน เงินรวมต่างๆ -->
    <!--  -->


    <td style="text-align: right; border-left: 0px solid;" colspan="2">รวมเงิน</td>
    <td style="text-align: right; border-left: 1px solid;">' . number_format($infoinvtaxsum['invtax_sum'],2) . '</td>
</tr>
<tr
    style="background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
    <td style="text-align: right; border-left: 0px solid;" colspan="2">ภาษีมูลค่าเพิ่ม 7%</td>
    <td style="text-align: right; border-left: 1px solid;">' . number_format($infoinvtaxsum['invtax_vat'],2) . '</td>
</tr>
<tr
    style=" background-color:LightGray; width: 100%; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
    <td style="text-align: right; border-left: px solid;" colspan="2">จำนวนเงินรวมทั้งสิน</td>
    <td style="text-align: right; border-left: 1px solid;">' . number_format($infoinvtaxsum['invtax_total'],2) . '</td>
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
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px; ">
            <tr>
                <td VALIGN="TOP" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p> ข้าพเจ้าได้รับเอกสารข้างต้นถูกต้องครบถ้วนแล้ว </p>
                    <p>ผู้รับเอกสาร</p>
                    <br><br><br><br><br>
                    <p> (....................................................................)
                    </p>
                    <p> วันที่&nbsp;…………………/…………………/…………………</p>
                </td>
                <td VALIGN="BOTTOM" style="text-align: center; width: 50%; border:1px solid; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p>(นายวรกฤต ศิรธนิตรา)</p>
                    <p>ผู้มีอำนาจลงนาม</p>
                    <!-- วันที่ในใบเสนอราคา -->
                    <p>วันที่ 11 มกราคม 2564</p>
                    <p>เลขบัญชี 850-6000-548 ธนาคารกรุงไทย สาขาสุนีย์</p>
                </td>
                
        </table>
        <br>
        <p style="text-align: center;">กรุณาตรวจสอบเอกสารและหัก ณ ที่จ่าย (ถ้ามี)พร้อมส่งหนังสือรับรองการหักภาษี ณ ที่จ่ายมาด้วยทุกครั้งที่ชำระเงิน</p>
    </div>


</div>';
}
