<?php

function DateThai($strDate) {
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));

$strMonthname = Array("","มกราคม","กุมภาพันธ์",
"มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม",
"สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

// $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.",
// "เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.",
// "ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

$strMonthThai=$strMonthname[$strMonth];

return "$strDay $strMonthThai $strYear";

}

function ConvDate($strDate) {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    
    // $strMonthname = Array("","มกราคม","กุมภาพันธ์",
    // "มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม",
    // "สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    
    // $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.",
    // "เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.",
    // "ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    
    // $strMonthThai=$strMonthname[$strMonth];
    
    return "$strDay / $strMonth / $strYear";
    
    }

?>