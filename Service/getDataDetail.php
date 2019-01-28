<?php
	include("config.php");
	$stmt = "select subodd.Barcode,odd.ProductNameTH,odd.ServiceNameTH,
coalesce(pk.SubProcessName,'checker in') as SubProcessName,
coalesce(odd.ReturnReason,'') as ReturnReason,
od.OrderNo,cust.FirstName+' '+cust.LastName as FirstName, cust.TelephoneNo
from uac_customer cust left join 
(ops_order od left join (ops_orderdetail odd 
left join (ops_suborderdetail subodd
left join
    (SELECT sub.SubOrderDetailID,msub.SubProcessName,
	case when sub.SubProcessID=5 then 1 else 0 end as cheked
    FROM ops_subprocess sub left join mas_subprocess msub on sub.SubProcessID=msub.SubProcessID
	where sub.SubProcessID=5
	Group BY sub.SubProcessID,sub.SubOrderDetailID,msub.SubProcessName) pk 
ON subodd.SubOrderDetailID = pk.SubOrderDetailID
)
on odd.OrderDetailID=subodd.OrderDetailID)
on od.OrderNo=odd.OrderNo)
on cust.CustomerID=od.CustomerID
where odd.OrderNo='".$_GET['OrderNo']."'";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
