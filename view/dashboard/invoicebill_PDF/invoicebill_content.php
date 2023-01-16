<?php
include('./PDF_set/PDF_conn.php');
$id = $_GET["pdfinvbill_id"];
$sql = "SELECT * FROM `invoicebill` WHERE invbill_id = '$id'";
$query = $conn->query($sql);
$infoinvb = $query->fetch_assoc();

echo '
<div id="invoicebillForm" class="content container mt-5" style="width: 842px;">
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
                <td>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรียน แผนกบัญชีและการเงิน</p>
                </td>
            </tr>
        </table>

        <table style="width: 842px; border:1.4px solid; border-collapse: collapse; padding: 0; margin: 0; overflow: wrap;">
            <tr style="border-bottom: 0 solid;">
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 220px; padding:3px 0 3px 60px;">
                    <b>ชื่อลูกค้า / Customer :</b> <br>
                </td>
                <td VALIGN="TOP" align="left" style=" width: 422px; padding:3px 100px 3px 0;">
                    ' .  $infoinvb['invbill_name']  . '><br>
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 200px;">
                    <b>เลขที่ / No.</b> &nbsp;&nbsp;' .  $infoinvb['invbill_no']  . '<br>
                </td>
            </tr>
            <tr style="border-bottom: 0 solid;">
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 220px; padding:3px 0 3px 60px;">
                    <b>ที่อยู่ / Address :</b><br>
                </td>
                <td VALIGN="TOP" align="left" style="width: 422px; padding:3px 100px 3px 0; word-break:break-all;">
                    ' . $infoinvb['invbill_address'] . '<br>
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 200px;">
                    <b>วันที่ / Date.</b> &nbsp;&nbsp;' . ConvDate($infoinvb['invbill_date'])  . '
                </td>
            </tr>
            <tr style="border-bottom: 0 solid;">
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 220px;padding:3px 0 3px 60px;">
                    <b>เลขประจำตัวผู้เสียภาษี :</b>
                </td>
                <td VALIGN="TOP" align="left" style=" width: 422px; padding:3px 100px 3px 0;">
                    ' . $infoinvb['invbill_cusid']  . '
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 200px;">
                </td>
            </tr>


        </table>
        <table style="width: 842px;">
            <tr>
                <td>
                    <p>&nbsp;ได้รับวางบิลจาก บริษัท แอดเพย์ เซอร์วิสพอยท์ จำกัด ตามรายการต่อไปนี้</p>
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
                </tr>
            ';


// <!--  -->
// <!--php  ดึงข้อมูลรายการ-->
// <!--  -->


$sql = "SELECT * FROM `invoicebill_details` WHERE invbilld_bid = '$id' ;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $sp =mysqli_num_rows($result);
    $i = 0;
    while ($infoinvbitems = mysqli_fetch_assoc($result)) {
        $i ++;
        $invd='';
        $dued='';
        
        if($infoinvbitems['invbilld_inv_date']>0){
            $invd=ConvDate($infoinvbitems['invbilld_inv_date']);
        }
        if($infoinvbitems['invbilld_due_date']>0){
            $dued=ConvDate($infoinvbitems['invbilld_due_date']);
        }
        echo ' 
                <tr>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;">' . $i . '</td>
                    <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; line-height:20px;">' . $infoinvbitems['invbilld_item'] . ' </td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;">' . $invd . '</td>
                    <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;">' . $dued . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; line-height:20px;">' . number_format($infoinvbitems['invbilld_price'], 2) . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; line-height:20px;">' . number_format($infoinvbitems['invbilld_vat'], 2) . '</td>
                    <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; line-height:20px;">' . number_format($infoinvbitems['invbilld_result'], 2) . '</td>';
                    if($i==1){
                        $sp=$sp+5;
                        echo '<td VALIGN="TOP" rowspan='.$sp.' style="text-align: left; border-bottom: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6;"><div style="padding:0 5px ;width: 89.11px; word-break:break-all">' . $infoinvb['invbill_remark'] . '</div></td>';
                    }
        echo    '</tr>';
    }
    $i ++;
    echo '
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;">' . $i . '</td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; line-height:20px;">ค่าขนส่ง</td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; line-height:20px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; line-height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; line-height:20px;">' . number_format($infoinvb['invbill_deli'], 2) . '</td>
                
            </tr>';
}

//<!-- blank area -->
$sql = "SELECT * FROM invoicebill WHERE invbill_id = '$id'";
$result = mysqli_query($conn, $sql);
while ($infoinvbsum = mysqli_fetch_array($result)) {
    echo '
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; height:20px;"></td>
            </tr>
            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1.4px solid #3585c6; border-right: 1.4px solid #3585c6; border-bottom: 1.4px solid #3585c6; height:20px;"></td>
        </td>
                
            </tr>
        
            <tr style="border-collapse: collapse;">
                <td style="text-align:center; height:30px; " >รวม</td>
                <td style="text-align: center; height:30px; border-bottom:1.3px dotted #3585c6;">' . $infoinvbsum['invbill_page'] . '</td>
                <td style="text-align: left; border-right: 1.4px solid #3585c6; height:30px;" colspan="2">ฉบับ</td>

                <td VALIGN="middle" style="height:30px; background-color:#b4dfee; border-bottom:1.4px solid #3585c6; text-align:center; padding:0;  border-collapse: collapse; padding: 5px; margin: 0;" ROWSPAN="2" colspan="2">
                    ยอดรวมทั้งสิ้น(บาท)
                </td>
                <td VALIGN="middle" style="height:30px; text-align:right; padding:0; border-bottom:1.4px solid #3585c6; border-right:1.4px solid #3585c6; border-collapse: collapse; padding: 5px; margin: 0;" ROWSPAN="2" >
                    ' . number_format($infoinvbsum['invbill_total'], 2) . '
                </td>
                
            </tr>


            <tr style="">
                <td style="text-align: center; background-color:#b4dfee; height:30px;border-bottom: 1.4px solid ;">ตัวอักษร</td>
                <td style="text-align: center; border-right: 1.4px solid #3585c6;border-bottom: 1.4px solid ; height:30px;" colspan="3">' . Convert($infoinvbsum['invbill_total']) . '</td>
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
                <td VALIGN="TOP" style="text-align: ; width: 50%; border:1.4px solid #3585c6; border-collapse: collapse; padding: 5px; margin: 0; "ROWSPAN="2">
                    <p>&nbsp;&nbsp;ผู้รับวางบิล (Received By) &nbsp;&nbsp;&nbsp;&nbsp; สำหรับลูกค้า (For Customer)</p>
                    <br>
                    <br>
                    <br>
                    <p>&nbsp;&nbsp;(.......................................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (.......................................)</p>
                    <p>วันที่รับวางบิล (Received Date)&nbsp;&nbsp; ........../.............../..............</p>
                    
                    <p>กำหนดชำระ (Payment Date)&nbsp;&nbsp; ........../.............../..............</p>
                
                    <p>เบอร์ติดต่อ</p>
                
                </td>

                <td VALIGN="TOP" style="text-align: center; width: 50%; border:0; border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                        <p>ผู้วางบิล</p>
                        <br>
                        <br>
                        <br>
                        <br>
                </td>
            </tr>
            <tr>
                <td style=" border-collapse: collapse; padding: 10px; margin: 0; height: 100px;">
                    <p>
                        ติดต่อเรา Tel 058-4964855<br>
                        สอบถามเพื่มเติมเรื่องการชำระเงินกรุณาติดต่อ<br>
                        เจ้าหน้าที่ : คุณจิติรัตน์ 045-317123
                    </p>
                </td>
            </tr>
        </table>
        <table style="margin-top:10px;">
            <tr>
                <td style="width:842px; text-align: center;">
                    <label>&nbsp;กรุณาตรวจสอบเอกสารและหัก ณ ที่จ่าย (ถ้ามี) พร้อมส่งหนังสือรับรองการหักภาษี ณ ที่จ่ายมาด้วยทุกครั้งที่ชำระเงิน</label>
                </td>
            </tr>
        </table>
    </div>
</div>';
}