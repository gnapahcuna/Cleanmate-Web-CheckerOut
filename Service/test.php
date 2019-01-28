<?php
include("config.php");
		$stmt = "SELECT distinct oo.OrderNo,bb.BranchNameTH,
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
where oo.AppointmentDate = '2018-10-02'";
    $query = sqlsrv_query($conn, $stmt);
    $object_array = array();
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row['OrderNo']);
    }
	$bb= array_count_values ($object_array);
	$cc=array();
	foreach ($bb  as $key => $value)  
		array_push($cc,$value);
	for($i=0;$i<sizeof($cc);$i++){
		echo $cc[$i].'<br>'; 
	}
?>