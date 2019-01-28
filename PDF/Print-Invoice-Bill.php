<html>
<head>
<title>Report PDF</title>
</head>
<body>

<?php
require('fpdf_thai.php');
define('FPDF_FONTPATH','font/');
class PDF extends FPDF
{
//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}
//Simple table
function BasicTable($header,$data,$dates,$branchName,$branchCode)
{
	//Header
	$this->SetFillColor(230, 230, 230);
	$this->SetFont('AngsanaNew','',18);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','วันที่นัดรับ : '.$dates),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : '.$branchName.' ('.$branchCode.')'),0, 'C', 'C');
	$this->Ln();
	
	$this->SetFont('AngsanaNew','',13);
	$this->Cell(8,21,iconv( 'UTF-8','TIS-620','ลำดับ'),1, 'C', 'C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','เลขที่ออเดอร์'),'1','C','C',true);
	$this->Cell(120,7,iconv( 'UTF-8','TIS-620','รายการผ้าส่งสาขา'),1,'C','C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','ผู้ตรวจนับผ้า'),1,'C','C',true);
	$this->Cell(26,21,iconv( 'UTF-8','TIS-620','หมายเหตุ'),1,'C','C',true);
	
	
	
	$this->Cell(0,7,'',0,1);
	$this->Cell(8,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ผ้าแขวน'),1,'C','C',true);
	$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ค้างแขวน'),1,'C','C',true);
	$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ผ้าพับ'),1,'C','C',true);
	$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ค้างพับ'),1,'C','C',true);
	$this->Cell(0,7,'',0,1);
	
	
	$this->Cell(8,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	
	$this->Ln();
	//Data
	$j=0;
	
		$data1=0;
		$data2=0;
		$data3=0;
		$data4=0;
		$data5=0;
		
		$data6=0;
		$data7=0;
		$data8=0;
		$data9_1=0;
		$data9_2=0;
		$data10=0;
		$data11=0;
		
		
   	foreach ($data as $eachResult) 
	{
		$this->Cell(8,6,number_format($j+1),1,'C','C');
		$this->Cell(18,6,$eachResult["OrderNo"],1,'C','C');
		if($eachResult["CountService1_1"]!=0){
			$this->Cell(10,6,number_format($eachResult["CountService1_1"]),1,'C','C');
		}else{
			$this->Cell(10,6,'',1,'C','C');
		}
		if($eachResult["CountService1_2"]!=0){
			$this->Cell(10,6,number_format($eachResult["CountService1_2"]),1,'R','R');
		}else{
			$this->Cell(10,6,'',1,'R','R');
		}
		if($eachResult["CountService1_3"]!=0){
			$this->Cell(10,6,number_format($eachResult["CountService1_3"]),1,'C','C');
		}else{
			$this->Cell(10,6,'',1,'C','C');
		}
		$this->Cell(10,6,'',1,'R','R');
		$this->Cell(10,6,'',1,'R','R');
		$this->Cell(10,6,'',1,'R','R');
		
		if($eachResult["CountService2_1"]!=0){
			$this->Cell(10,6,number_format($eachResult["CountService2_1"]),1,'C','C');
		}else{
			$this->Cell(10,6,'',1,'C','C');
		}
		if($eachResult["CountService2_2"]!=0){
			$this->Cell(10,6,number_format($eachResult["CountService2_2"]),1,'R','R');
		}else{
			$this->Cell(10,6,'',1,'R','R');
		}
		if($eachResult["CountService2_3"]!=0){
			$this->Cell(10,6,number_format($eachResult["CountService2_3"]),1,'C','C');
		}else{
			$this->Cell(10,6,'',1,'C','C');
		}
		$this->Cell(10,6,'',1,'R','R');
		$this->Cell(10,6,'',1,'R','R');
		$this->Cell(10,6,'',1,'R','R');
		
		$this->Cell(18,6,'',1,'R','R');
		$this->Cell(26,6,'',1,'R','R');
		
		
        $this->Ln();
		
		$j++;
	}
}
function Footer()
{
    $this->SetY(-15);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

	include("config.php");
	
	$stmt_b="select Distinct mas_branch.BranchID,mas_branch.BranchCode,mas_branch.BranchNameTH,mas_branchtype.BranchTypeNameTH,
mas_branch.TelephoneNo,mas_branch.Address
		from ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) 
		on ops_order.BranchID=mas_branch.BranchID
		where mas_branch.BranchNameTH ='".$_GET['branchID']."'";
    $query_b = sqlsrv_query($conn, $stmt_b);
	$branchData = "";
	$branchCode = "";
	$branchName = "";
	$branchType = "";
	$branchTel = "-";
	$branchAddress = "-";
    while($row = sqlsrv_fetch_array($query_b, SQLSRV_FETCH_ASSOC))
    {
 		$branchData=$row['BranchID'];
		$branchCode=$row['BranchCode'];
		$branchName=$row['BranchNameTH'];
		$branchType=$row['BranchTypeNameTH'];
		$branchTel=$row['TelephoneNo'];
		$branchAddress=$row['Address'];
    }
	
	$stmt = "select ops_order.OrderNo,
coalesce (SUM(CASE WHEN mas_product.ServiceType=1 AND SpecialDetial !='พับธรรมดา' then 1 else null end),0) AS CountService1_1,
coalesce (SUM(CASE WHEN (mas_product.ServiceType=2 OR mas_product.ServiceType=4) AND SpecialDetial !='พับธรรมดา' then 1 else null end),0) AS CountService1_2,
coalesce (SUM(CASE WHEN mas_product.ServiceType=5 AND SpecialDetial !='พับธรรมดา' then 1 else null end),0) AS CountService1_3,
coalesce (SUM(CASE WHEN mas_product.ServiceType=1 AND SpecialDetial ='พับธรรมดา' then 1 else null end),0) AS CountService2_1,
coalesce (SUM(CASE WHEN (mas_product.ServiceType=2 OR mas_product.ServiceType=4) AND SpecialDetial ='พับธรรมดา' then 1 else null end),0) AS CountService2_2,
coalesce (SUM(CASE WHEN mas_product.ServiceType=5 AND SpecialDetial ='พับธรรมดา' then 1 else null end),0) AS CountService2_3
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
left join ops_transportpackage on ops_order.OrderNo=ops_transportpackage.OrderNo
WHERE  ops_order.AppointmentDate = '".$_GET['dates']."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$branchData."'
AND DeliveryStatus=0 AND IsDriverVerify=1
Group By ops_order.OrderNo";


		$resultData=array();
		$query = sqlsrv_query($conn, $stmt);
    	while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    	{
 			array_push($resultData,$row);
    	}
		$header=array('ลำดับ','วันที่','เลขที่บิล','ซักแห้ง','ซักน้ำ','สปาหนัง','รีด','');

		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->AddFont('AngsanaNew','','angsa.php');
		$pdf->AddFont('AngsanaNew','B','angsab.php');
		$pdf->SetFont('AngsanaNew','',12);
		$pdf->BasicTable($header,$resultData,$_GET['dates'],$branchName,$branchCode);
		$pdf->Output("MyPDF/File-Invoice.pdf","F");
		header("Location: MyPDF/File-Invoice.pdf");
		
?>
</body>
</html>