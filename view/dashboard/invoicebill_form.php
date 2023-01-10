<?php
include_once './PDF_set/PDF_conn.php';
include_once('./PDF_set/readprice.php');
$id = $_GET["pdfinvbill_id"];
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

$sql = "SELECT * FROM `invoicebill` WHERE invbill_id = '$id'";
$query = $conn->query($sql);
$infoinvb = $query->fetch_assoc();
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
            
                <td class="text-center" style="width:200px; border: 1.4px solid;">
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

        <table style="width: 842px; border:1.4px solid; border-collapse: collapse; padding: 0; margin: 0; ">
            <tr style="border-bottom: 1.4px solid;">
                <td align="left" style="border-left: 1.4px solid ; width: 642px;">
                    <label>ชื่อลูกค้า / Customer :</label> &nbsp;&nbsp;' . $infoinvb['invbill_name']  . '<br>
                    <label>ที่อยู่ / Address :</label> &nbsp;&nbsp;' . $infoinvb['invbill_address']  . '<br>
                    <label>เลขประจำตัวผู้เสียภาษี :</label> &nbsp;&nbsp;' . $infoinvb['invbill_cusid']  . '
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1.4px solid ; width: 200px;">
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

        <div >
            <table style="width: 842px;  border-collapse: collapse; padding: 0; margin: 0; margin-top:0px;">
                <tr style="border-top:1.4px solid #3585c6; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 8%;">ลำดับที่</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 15%;">รายการ</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 14%;">วันที่ใบแจ้งหนี้/<br>ใบกำกับภาษี</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 14%;">กำหนดชำระ</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 13%;">จำนวนก่อน<br>ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 13%;">ภาษีมูลค่าเพิ่ม</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 12%;">จำนวนเงินรวม</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; width: 11%;">หมายเหตุ</td>
                </tr>
                <tr style=" border-bottom:1.4px solid #3585c6; border-collapse: collapse; padding: 0; margin: 0;">
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 8%;"><br>Item</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 15%;"><br>Order</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 14%;"><br>invoice Date</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 14%;"><br>Due Date</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 13%;"><br>Amount</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 13%;"><br>Vat</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; width: 12%;"><br>Total Amount</td>
                    <td class="text-center" style="border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; width: 11%;"><br>Remark</td>

                    <td VALIGN="TOP" style="text-align: right; border-right: 1.4px solid #3585c6; border-bottom:1.4px solid #3585c6; height:20px;" ROWSPAN="10" ></td>
                </tr>';


$sql = "SELECT * FROM `invoicebill_details` WHERE invbilld_bid = '$id' ;";
$result = mysqli_query($conn, $sql);
$contentitems = "";
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($infoinvbitems = mysqli_fetch_assoc($result)) {
        $i++;
        $contentitems .= '<tr>
        <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:20px;">' . $i . '</td>
        <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; height:20px;">' . $infoinvbitems['invbilld_item'] . ' </td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:20px;">' . $infoinvbitems['invbilld_inv_date'] . '</td>
        <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:20px;">' . $infoinvbitems['invbilld_due_date'] . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:20px;">' . number_format($infoinvbitems['invbilld_price'], 2) . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:20px;">' . number_format($infoinvbitems['invbilld_vat'], 2) . '</td>
        <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; height:20px;">' . number_format($infoinvbitems['invbilld_result'], 2) . '</td>
        
    </tr>';
    }
    
    $i=$i+1;
    $contentitems .= '<tr>
    <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:50px;">' . $i . '</td>
    <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; height:50px;">ค่าขนส่ง</td>
    <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:50px;"></td>
    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:50px;"></td>
    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:50px;">' . number_format($infoinvb['invbill_deli'], 2) . '</td>
    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:50px;"></td>
    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; height:50px;">' . number_format($infoinvb['invbill_deli'], 2) . '</td>
    
</tr>';
}


$head1 = ' ';
$sql = "SELECT * FROM invoicebill WHERE invbill_id = '$id'";
$result = mysqli_query($conn, $sql);
$contentsum = "";
if (mysqli_num_rows($result) > 0) {

    while ($infoinvbsum = mysqli_fetch_assoc($result)) {
        $contentsum .= ' 
        
        <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; height:50px;"></td>
                
            </tr>
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:50px;"></td>
                
            </tr>
        
            <tr style="border-collapse: collapse;">
                <td style="text-align:center; height:30px;" >รวม</td>
                <td style="text-align: center; height:30px; border-bottom:1.3px dotted #3585c6;">' . $infoinvbsum['invbill_page'] . '</td>
                <td style="text-align: left; border-right: 1.4px solid #3585c6; height:30px;" colspan="2">ฉบับ</td>

                <td VALIGN="middle" style="height:30px; background-color:#b4dfee; border-bottom:1.4px solid #3585c6; text-align:center; padding:0;  border-collapse: collapse; padding: 5px; margin: 0;" ROWSPAN="2" colspan="2">
                    ยอดรวมทั้งสิ้น(บาท)
                </td>
                <td VALIGN="middle" style="height:30px; text-align:right; padding:0; border-bottom:1.4px solid #3585c6; border-right:1.4px solid #3585c6; border-collapse: collapse; padding: 5px; margin: 0;" ROWSPAN="2" >
                    ' . number_format($infoinvbsum['invbill_total'], 2) . '
                </td>
                
            </tr>


            <tr style="border-bottom: 1.4px solid ;">
                <td style="text-align: center; background-color:#b4dfee; height:30px;">ตัวอักษร</td>
                <td style="text-align: center; border-right: 1.4px solid #3585c6; height:30px;" colspan="3">' . Convert($infoinvbsum['invbill_total']) . '</td>
            </tr>
            
        </table>
        <table>
            <tr>
                <td style="width:592px;">
                    <label>&nbsp;ข้าพเจ้าได้รับวางบิลตามรายการข้างต้นเรียบร้อยแล้ว</label>
                </td>
            </tr>
        </table>

    </div>

    <div>
            <table style="width: 842px; border:1.4px solid #3585c6; border-collapse: collapse; padding: 0; margin-top: 10px; ">
                <tr>
                    <td VALIGN="TOP" style="text-align: ; width: 50%; border:1.4px solid #3585c6; border-collapse: collapse; padding: 5px; margin: 0; ">
                        <table>
                            <tr style="height:20px;">
                                <td style="width: 55%;">ผู้รับวางบิล (Received By)</td>
                                <td style="width: 45%;">สำหรับลูกค้า (For Customer)</td>
                            </tr>
                            <tr style="height:80px;"></tr>
                            <tr style="height:40px;">
                                <td style="width: 55%;">(.......................................)</td>
                                <td style="width: 45%;">(.......................................)</td>
                            </tr>
                            <tr style="height:25px;">
                                <td style="width: 55%;">วันที่รับวางบิล (Received Date)</td>
                                <td style="width: 45%;">........../.............../..............</td>
                            </tr>
                            <tr style="height:25px;">
                                <td style="width: 55%;">กำหนดชำระ (Payment Date)</td>
                                <td style="width: 45%;">........../.............../..............</td>
                            </tr>
                            <tr style="height:25px;">
                                <td style="width: 55%;">เบอร์ติดต่อ</td>
                                <td style="width: 45%;"></td>
                            </tr>
                        </table>
                    </td>

                    <td VALIGN="TOP" style="text-align: center; width: 50%; border:1.4px solid #3585c6; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                        <table>
                            <tr style="height:20px;">ผู้วางบิล</tr>
                            <tr style="height:55px;"></tr>
                            <tr style="height:40px;"></tr>
                            <tr style="height:25px;">
                                <td style=" text-align: left;">ติดต่อเรา Tel 058-4964855</td>
                            </tr>
                            <tr style="height:25px;">
                                <td style=" text-align: left;">สอบถามเพื่มเติมเรื่องการชำระเงินกรุณาติดต่อ</td>
                            </tr>
                            <tr style="height:25px;">
                                <td style=" text-align: left;">เจ้าหน้าที่ : คุณจิติรัตน์ 045-317123</td>
                            </tr>
                        </table>
                    </td>

            </table>
        </div>

    </div>';
    }
}


$stylesheet = file_get_contents('./PDF_set/PDF.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($contentitems);
$mpdf->WriteHTML($contentsum);
$mpdf->WriteHTML($head1);

mysqli_close($conn);

$mpdf->Output('./invoicebill_PDF/invoice_bill0.pdf');

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
            <a class="btn btn-pdf text-light px-2 px-md-4 mt-2 rounded-3 fs-5 fw-bold" role="button" href="./invoicebill_PDF/invoice_bill0.pdf"><i class="fa-solid fa-print"></i> พิมพ์เอกสาร</a>
        </div>
        <hr>
        <?php
        include("./invoicebill_PDF/invoicebill_content.php");
        ?>
    </div>

</body>

</html>