<?php
	include("config.php");
	$stmt ="";
	if($_GET['OrderDate']!=""&&$_GET['BranchID']=='cheese'&&$_GET['OrderNo']==""){
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,
pk.Checked
--case when pk.DeliveryStatus=0 AND pk.IsCheckerVerify=1 then 0 else 1 end as IsStatus
FROM (ops_order oo
INNER JOIN
    (SELECT distinct  case when MAX(SubProcessID)=5 then 1 else 0 end as Checked,odd.OrderNo
    FROM ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID
	Group by odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.IsActive=1";

		$stmt1 = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,pk.Checked1
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked1
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo,subodd.SubOrderDetailID) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.IsActive=1";

	$stmt2 = "SELECT distinct bb.BranchNameTH,bb.BranchID
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.IsActive=1
Group By bb.BranchNameTH,bb.BranchID";
	}elseif($_GET['OrderDate']!=""&&$_GET['BranchID']!='cheese'&&$_GET['OrderNo']==""){
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,
pk.Checked
--case when pk.DeliveryStatus=0 AND pk.IsCheckerVerify=1 then 0 else 1 end as IsStatus
FROM (ops_order oo
INNER JOIN
    (SELECT distinct  case when MAX(SubProcessID)=5 then 1 else 0 end as Checked,odd.OrderNo
    FROM ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID
	Group by odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where bb.BranchID = '".$_GET['BranchID']."' AND oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.IsActive=1";

$stmt1 = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,pk.Checked1
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked1
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo,subodd.SubOrderDetailID) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.IsActive=1 and oo.AppointmentDate='".$_GET['OrderDate']."' AND bb.BranchID = '".$_GET['BranchID']."'";

$stmt2 = "SELECT distinct bb.BranchNameTH,bb.BranchID
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.IsActive=1
Group By bb.BranchNameTH,bb.BranchID";
	}elseif($_GET['OrderDate']!=""&&$_GET['BranchID']!='cheese'&&$_GET['OrderNo']!=""){
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,
pk.Checked
--case when pk.DeliveryStatus=0 AND pk.IsCheckerVerify=1 then 0 else 1 end as IsStatus
FROM (ops_order oo
INNER JOIN
    (SELECT distinct  case when MAX(SubProcessID)=5 then 1 else 0 end as Checked,odd.OrderNo
    FROM ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID
	Group by odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where bb.BranchID = '".$_GET['BranchID']."' AND oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.OrderNo = '".$_GET['OrderNo']."' AND oo.IsActive=1";


$stmt1 = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,pk.Checked1
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked1
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo,subodd.SubOrderDetailID) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where bb.BranchID = '".$_GET['BranchID']."' AND oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.OrderNo = '".$_GET['OrderNo']."' AND oo.IsActive=1";

$stmt2 = "SELECT distinct bb.BranchNameTH,bb.BranchID
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.IsActive=1
Group By bb.BranchNameTH,bb.BranchID";
	}elseif($_GET['OrderDate']==""&&$_GET['BranchID']!='cheese'&&$_GET['OrderNo']==""){
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,
pk.Checked
--case when pk.DeliveryStatus=0 AND pk.IsCheckerVerify=1 then 0 else 1 end as IsStatus
FROM (ops_order oo
INNER JOIN
    (SELECT distinct  case when MAX(SubProcessID)=5 then 1 else 0 end as Checked,odd.OrderNo
    FROM ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID
	Group by odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where bb.BranchID = '".$_GET['BranchID']."' AND oo.IsActive=1";
	}elseif($_GET['OrderDate']!=""&&$_GET['BranchID']=='cheese'&&$_GET['OrderNo']!=""){
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,pk.Checked
--case when pk.DeliveryStatus=0 AND pk.IsCheckerVerify=1 then 0 else 1 end as IsStatus
FROM (ops_order oo
INNER JOIN
    (SELECT distinct  case when MAX(SubProcessID)=5 then 1 else 0 end as Checked,odd.OrderNo
    FROM ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID
	Group by odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".$_GET['OrderDate']."' AND oo.OrderNo = '".$_GET['OrderNo']."' AND oo.IsActive=1";
	}else{
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,pk.Checked
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".date("Y-m-d")."' AND oo.IsActive=1";

$stmt1 = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
oo.AppointmentDate,oo.IsExpressLevel,pk.Checked1
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked1
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo,subodd.SubOrderDetailID) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".date("Y-m-d")."' AND oo.IsActive=1";

		$stmt2 = "SELECT distinct bb.BranchNameTH,bb.BranchID
FROM (ops_order oo
INNER JOIN
    (SELECT distinct odd.OrderNo,
	case when MAX(pc.SubProcessID)=5 then 1 else 0 end as Checked
    FROM (ops_subprocess subpc
	left join (
	ops_suborderdetail subodd
	left join ops_orderdetail odd on subodd.OrderDetailID=odd.OrderDetailID)
	on subpc.SubOrderDetailID=subodd.SubOrderDetailID)
	left join mas_subprocess pc on subpc.SubProcessID=pc.SubProcessID
	Group BY  odd.OrderNo) pk 
ON oo.OrderNo = pk.OrderNo)
left join mas_branch bb on oo.BranchID=bb.BranchID
where oo.AppointmentDate = '".date("Y-m-d")."' AND oo.IsActive=1
Group By bb.BranchNameTH,bb.BranchID";
	}
    $query = sqlsrv_query($conn, $stmt);
	$query1 = sqlsrv_query($conn, $stmt2);
	$query2 = sqlsrv_query($conn, $stmt1);
	$object_array = array();
	$object_array1 = array();
	$object_array2 = array();
	$object_array3 = array();
	while($row = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array1,$row);
    }
	while($row = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC))
    {
 		//array_push($object_array2,$row);
		array_push($object_array2,$row['OrderNo']);	
		array_push($object_array3,$row['BranchNameTH']);	
    }
	$bb= array_count_values ($object_array2);
	$aa= array_count_values ($object_array3);
	$cc= array();
	$dd= array();
	foreach ($aa  as $key => $value)  
		array_push($dd,array('BranchNameTH' => $key));
	foreach ($bb  as $key => $value)  
		array_push($cc,$value);
		
	$i=0;
	while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
		array_push($object_array,array('OrderNo' => $row['OrderNo'], 'DeliveryStatus' => $row['DeliveryStatus']
		,'BranchNameTH' => $row['BranchNameTH'],'AppointmentDate' => $row['AppointmentDate']
		,'IsExpressLevel' => $row['IsExpressLevel'],'Checked' => $row['Checked'],'Checked1' => $cc[$i],'Data' => $object_array1));
		$i++;	
	}
    $json_array=json_encode($object_array);
	echo $json_array;
?>
