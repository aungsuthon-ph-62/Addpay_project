<div id="quotationForm" class="container mt-5" style="width: 842px;">
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
                <td class="text-center" style="width:200px;  border: 1px solid; padding:5px; margin:0;">
                    <b>ใบแจ้งหนี้ / ใบกำกับภาษี</b>
                </td>
            </tr>

        </table>



        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; ">
            <tr style="border-bottom: 1px solid;">
                <td align="left" style="border-left: 1px solid; width: 500px;">
                    <label>ชื่อลูกค้า / Customer :</label> &nbsp;&nbsp;อุบลยูเนี่ยน 2558 จำกัด<br>
                    <label>ที่อยู่ / Address :</label> &nbsp;&nbsp;11/1 ถ.แจ้งสนิท ต.ในเมือง อ.เมือง จ.อุบลราชธานี34000 <br>
                    <label>เลขประจำตัวผู้เสียภาษี :</label> &nbsp;&nbsp;0345558000306
                </td>
                <td VALIGN="TOP" align="left" style="border-left: 1px solid; width: 342px;">
                    <label>เลขที่ / No.</label> &nbsp;&nbsp;0345558000306<br>
                    <label>วันที่ / Date.</label> &nbsp;&nbsp;7/10/2021
                </td>
            </tr>


        </table>



        <!-- <table>

            <tr style=" border-collapse: collapse; padding: 0; margin: 0;">
                <td class="text-center" style="width: 200px;  padding: 8px;" ROWSPAN="3">
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">โครงการ</p>
                </td>
                <td style="width:692px;">
                    <p class="text-left "> <span>&nbsp; ตู้พ่นน้ำ ยาฆ่าเชื้อโควิคเคลีย &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">ลูกค้า /หน่วยงาน </p>
                </td>
                <td style="width:692px;">
                    <p class="text-left "> <span>&nbsp; บริษัท อาเคโบโน เบรค(ประเทศไทย) จำกัด &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">ที่อยู่ </p>
                </td>
                <td style="width:692px;">
                    <p class="text-left"> <span>&nbsp;700/800 นิคมอุตสาหกรรมอมตะซิตี้ ชลบุรี หมู่ที่ 1 ตำบลพานทอง อำเภอพานทอง จังหวัดชลบุรี 20160 &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            </td>
            <td style="text-align: right; width: 500px; border-collapse: collapse; padding: 0; margin: 0;">เลขที่/No.</td>

            <td class="underline" style="text-align: center; width: 142px;">
                <p class="text-left"> <span>&nbsp;' . $infoquo['quo_no'] . ' &nbsp;&nbsp;</span> </p>
            </td>

            </tr>
            <tr>
                <td style="text-align: right; border-collapse: collapse; padding: 0; margin: 0;">วันที่/Date.</td>
                <td class="underline" style="text-align: center;">
                    <p class="text-left"> <span>&nbsp;' . $infoquo['quo_date'] . ' &nbsp;&nbsp;</span> </p>
                </td>

            </tr>

        </table>

        <table>
            <tr style=" border-collapse: collapse; padding: 0; margin: 0;">
                <td class="text-center" style="width: 700px;" ROWSPAN="2"></td>

                <td style="width:100px;  text-align: right;">
                    <p class="text-left">เลขที่/No.</p>
                    <p class="text-left">วันที่/Date. </p>
                </td>
                <td style="width:120px; text-align: right;">
                    <p> <span>&nbsp;&nbsp; 6401001 &nbsp;&nbsp; </span> </p>
                    <p class=" underline"> <span>&nbsp; 11/1/2564 &nbsp; </span> </p>
                </td>
            </tr>

        </table> -->
    </div>

    <!--  -->
    <!--php  ดึงข้อมูลลูกค้า -->
    <!--  -->
    <!-- <div>
        <table style="margin-top: 5px;">
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">โครงการ</p>
                </td>
                <td style="width:692px;">
                    <p class="text-left "> <span>&nbsp; ตู้พ่นน้ำ ยาฆ่าเชื้อโควิคเคลีย &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">ลูกค้า /หน่วยงาน </p>
                </td>
                <td style="width:692px;">
                    <p class="text-left "> <span>&nbsp; บริษัท อาเคโบโน เบรค(ประเทศไทย) จำกัด &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
            <tr>
                <td style="width:150px;">
                    <p class="text-left ">ที่อยู่ </p>
                </td>
                <td style="width:692px;">
                    <p class="text-left"> <span>&nbsp;700/800 นิคมอุตสาหกรรมอมตะซิตี้ ชลบุรี หมู่ที่ 1 ตำบลพานทอง อำเภอพานทอง จังหวัดชลบุรี 20160 &nbsp;&nbsp;</span> </p>
                </td>
            </tr>
        </table>
    </div> -->


    <div>
        <table style="width: 842px; border:1px solid; border-collapse: collapse; padding: 0; margin: 0; margin-top:0px;">
            <tr style="background-color:LightGray; border:1px solid; border-collapse: collapse; padding: 0; margin: 0;">
                <th class="text-center" style="border-left: 1px solid; width: 57px;">ลำดับที่ Item</th>
                <th class="text-center" style="border-left: 1px solid; width: 490px;">รายการ Order</th>
                <th class="text-center" style="border-left: 1px solid; width: 77px;">จำนวน<br>Amount</th>
                <th class="text-center" style="border-left: 1px solid; width: 109px;">ราคา / หน่วย<br>Unit / Price</th>
                <th class="text-center" style="border-left: 1px solid; width: 109px;">จำนวนเงินรวม<br>Total</th>
            </tr>


            <!--  -->
            <!--php  ดึงข้อมูลรายการ-->
            <!--  -->

            <tr>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">1</td>
                <td VALIGN="TOP" style="text-align: left; border-left: 1px solid; height:50px;">กล่อง Ultrasonic</td>
                <td VALIGN="TOP" style="text-align: center; border-left: 1px solid; height:50px;">2</td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">7,009.35</td>
                <td VALIGN="TOP" style="text-align: right; border-left: 1px solid; height:50px;">14,018.69</td>
            </tr>

            <!-- blank area -->
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
                <td VALIGN="middle"  style=" text-align:center;padding:20px 0; border:1px solid; border-collapse: collapse; padding: 5px; margin: 0;" VALIGN="TOP" ROWSPAN="5" colspan="2">
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

    </div>


    <!-- ดึงข้อมูลเงินเป็นตัวอักษร -->
    <!-- text price -->
    <div>
        <!-- <table style="text-align: left; width:842px; border:1px solid; border-collapse: collapse; padding: 0; margin-top: 10px;">
            <tr style="border-bottom: 1px solid;">
                <td VALIGN="TOP" style="text-align: left;  width: 20%; padding:5px 10px;">จำนวนเงินตัวอักษร <br> The Sum Of Bahts </td>
                <td VALIGN="TOP" style="text-align: left;  width: 80%; padding:5px 10px;">หนึ่งหมื่นห้าพันบาทถ้วน </td>
            </tr>
        </table> -->
        <!-- footer -->
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

</div>