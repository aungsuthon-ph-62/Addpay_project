<?php
include_once './PDF_set/PDF_conn.php';
include_once('./PDF_set/readprice.php');
$id = $_GET["pdfquo_id"];
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
    'default_font_size' => 16,
]);

$query = "SELECT * FROM `quotation_appraisal` WHERE quo_id = '$id'"; 
$result = mysqli_query($conn, $query); 
while($infoquo = mysqli_fetch_array($result)) {
$head = '
<div id="quotationForm" class="container mt-5" style="width: 842px;">
    <div>
        <table>
            <tr>
                <td style="width:250px">
                    <div class="logo">
                        <img src="../image/addpay-form-text.png" class="img-fluid position-relative" width="200" hight="auto" alt="addpay_logo_form">
                    </div>
                </td>
                <td style="width:592px">
                    <div style="margin-left: 40px;">
                        <b class="text-left"> บริษัท แอดเพย์ เซอร์วิสพอยท์ จํากัด</b><br>
                        <p class="text-left">406 หมู่ 18 ตําบลขามใหญ่ อําเภอเมือง จังหวัดอุบลราชธานี โทร. 045-317123</p>
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="text-center" style="width:200px;  border: 1px solid; padding: 8px;">
                    <b>ใบเสนอราคา</b><br>
                    <b>Quotation</b>
                </td>
                <td style="width:422px; text-align: right;"></td>
                
                <td style="width:100px;  text-align: right;">
                    <p class="text-left">เลขที่/No.</p>
                    <p class="text-left">วันที่/Date. </p>
                </td>
                <td style="width:120px; text-align: right;">
                    <p class="underline"> <span>&nbsp;&nbsp;'.$infoquo['quo_no'].' &nbsp;&nbsp; </span> </p>
                    <p class=" underline"> <span>&nbsp;'.$infoquo['quo_date'].' &nbsp; </span> </p>
                </td>
            </tr>

        </table>
    </div>

    <div>
    <table style="margin-top: 5px;">
        <tr>
            <td style="width:150px;">
                <p class="text-left ">โครงการ</p>
            </td>
            <td class="underline" style="width:692px;">
                <p class="text-left "> <span>&nbsp; '.$infoquo['quo_namepj'].' &nbsp;&nbsp;</span> </p>
            </td>
        </tr>
        <tr>
            <td style="width:150px;">
                <p class="text-left ">ลูกค้า /หน่วยงาน </p>
            </td>
            <td class="underline" style="width:692px;">
                <p class="text-left "> <span>&nbsp; '.$infoquo['quo_name'].' &nbsp;&nbsp;</span> </p>
            </td>
        </tr>
        <tr>
            <td style="width:150px;">
                <p class="text-left ">ที่อยู่ </p>
            </td>
            <td class="underline" style="width:692px;">
                <p class="text-left"> <span>&nbsp;'.$infoquo['quo_address'].' &nbsp;&nbsp;</span> </p>
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
        </tr>

';
}


$sql = "SELECT * FROM `quotation_appraisal_details` WHERE quode_quoid = '$id' ;";
$result = mysqli_query($connect, $sql);
$contentitems = "";
if (mysqli_num_rows($result) > 0) {
    $i=0;
    while($infoquoitems = mysqli_fetch_assoc($result)) {
        $i++;
        $contentitems .= '  <tr>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">'.$i.'</td>
        <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;">'.$infoquoitems['quode_item'].'</td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">'.$infoquoitems['quode_amount'].'</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">'.$infoquoitems['quode_price'].'</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">'.$infoquoitems['quode_result'].'</td>
    </tr>';
      
    }
}


$sql = "SELECT * FROM `quotation_appraisal` WHERE quo_id = '$id'";
$result = mysqli_query($connect, $sql);
$connectsum = "";
if (mysqli_num_rows($result) > 0) {
    
    while($infoquosum = mysqli_fetch_assoc($result)) {
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


$a = file_get_contents('./invoicebill_PDF/invoicebill_content.php');
$stylesheet = file_get_contents('./PDF_set/PDF.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($a, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('./invoicebill_PDF/invoicebill.pdf'); //link web of file pdf

?>

<body>

    <div class="container py-md-5 px-md-4" style="width: 100%; ">
        <p class="text-end text-danger ">** โปรดตรวจสอบความถูกต้องของข้อมูลก่อนกด พิมพ์เอกสาร</p>
        <div class="mx-auto d-flex justify-content-end ">
            <a class="btn btn-outline-success px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold" role="button" href="./invoicebill_PDF/invoicebill.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
            <a class="btn btn-outline-danger px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold ms-3" role="button" href="./invoicebill_list.php"><i class="fa-regular fa-rectangle-xmark"></i> ยกเลิก</a>
        </div>
        <hr>
        <?php
        include("./invoicebill_PDF/invoicebill_content.php");
        ?>
    </div>

</body>

</html>