<?php
include_once './PDF_set/PDF_conn.php';
include_once('./PDF_set/readprice.php');
$id = $_GET["pdfinvbill_id"];
?>

<?php
include("./PDF_set/PDF_head.php");

require_once __DIR__ . '../../../vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];


$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/fonts',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' =>  'THSarabunNew Bold.ttf',
        ]
    ],
    'default_font' => 'sarabun',
    'default_font_size' => 15,
]);

$query = "SELECT * FROM `invoicebill` WHERE invbill_id = '$id'";
$result = mysqli_query($conn, $query);
while ($infoinvb = mysqli_fetch_array($result)) {
    $head = '
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
            <table style="width: 737px; border:1px solid blue; border-collapse: collapse; padding: 0; margin: 0; margin-top:0px;">
                <tr style=" border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1px solid blue; width: 10%;">ลำดับที่</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 20%;">รายการ</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;">วันที่ใบแจ้งหนี้/<br>ใบกำกับภาษี</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;">กำหนดชำระ</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;">จำนวนก่อน<br>ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;">ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 12%;">จำนวนเงินรวม</td>
                    
                </tr>
                <tr style=" border-bottom:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1px solid blue; width: 10%;"><br>Item</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 20%;"><br>Order</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;"><br>invoice Date</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 14%;"><br>Due Date</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;"><br>Amount</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 15%;"><br>Vat</td>
                    <td class="text-center" style="border-left: 1px solid blue; width: 12%;"><br>Total Amount</td>
                    
                </tr>

';
}


$sql = "SELECT * FROM `quotation_appraisal_details` WHERE quode_quoid = '$id' ;";
$result = mysqli_query($connect, $sql);
$contentitems = "";
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoquoitems = mysqli_fetch_assoc($result)) {
        $i++;
        $contentitems .= '  <tr>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $i . '</td>
        <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;">' . $infoquoitems['quode_item'] . '</td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">' . $infoquoitems['quode_amount'] . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . $infoquoitems['quode_price'] . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">' . $infoquoitems['quode_result'] . '</td>
    </tr>';
    }
}


$sql = "SELECT * FROM `quotation_appraisal` WHERE quo_id = '$id'";
$result = mysqli_query($connect, $sql);
$connectsum = "";
if (mysqli_num_rows($result) > 0) {

    while ($infoquosum = mysqli_fetch_assoc($result)) {
        $connectsum .= ' 
        
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

    </div>
       
';
    }
}

// $stylesheet = file_get_contents('./PDF_set/PDF.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
// $mpdf->WriteHTML($head);
// $mpdf->WriteHTML($contentitems);
// $mpdf->WriteHTML($contentsum);
// $mpdf->WriteHTML($footer);
// $mpdf->WriteHTML($head1);
// $mpdf->WriteHTML($head2);

// mysqli_close($conn);

// $mpdf->Output('./invoicebill_PDF/invoice_bill0.pdf');
?>
<style>
    *{
        font-size: 14px;
    }
    .btn-pdf {
        background: #fe9100;
        background: -webkit-linear-gradient(to right, #fdb04c, #fe9100);
        background: linear-gradient(to bottom, #fdb04c, #fe9100);
    }
</style>

<body>

    <div class="container py-md-5 px-md-4" style="width: 100%; ">
        <p class="text-end text-danger ">** โปรดตรวจสอบความถูกต้องของข้อมูลก่อนกด พิมพ์เอกสาร</p>
        <div class="mx-auto d-flex justify-content-end ">
            <a class="btn btn-pdf text-light px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold" role="button" href="./invoicebill_PDF/invoicebill.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
        </div>
        <hr>
        <?php
        include("./invoicebill_PDF/invoicebill_content.php");
        ?>
    </div>

</body>

</html>