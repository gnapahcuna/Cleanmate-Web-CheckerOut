<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: Login.php');
}

?>
<?php
include('config.php')
?>
<!doctype html>
<html lang="en">

<head>
    <title>ตรวจสอบสิตค้าขาออก</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/linearicons/style.css">
    <link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="assets/css/demo.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

</head>
<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script>
    var BRANCH=0;
    function getDataFromDb()
    {
        var data=document.getElementById("date_start").value;
        var getOrderNo = document.getElementById("getOrderNo").value;
        var getBranch = document.getElementById("my_select").value;
        var getBranchName=$('#my_select option:selected').text();
        if(getBranch!='cheese'){
            $("#search").text(getBranchName);
        }else{
            $("#search").text("");
        }
        $.ajax({
            url: "http://119.59.115.80/WebCheckerOut/Service/getData.php?OrderDate="+data+"&OrderNo="+getOrderNo+"&BranchID="+getBranch,
            type: "POST",
            data: ''
        })
            .success(function(result) {
                var obj = jQuery.parseJSON(result);
                var i=0;
                var test="";
                if(obj != '') {
                    //$("#myTable tbody tr:not(:first-child)").remove();
                    $("#myBody").empty();
                    /* $('#my_select').empty();*/
                    $.each(obj, function (key, val) {
                        i++;
                        $('#my_select').empty();
                        $('#my_select').append($('<option>', {
                            value: "cheese",
                            text : "--เลือกสาขา--"
                        }));
                        $.each(val["Data"], function (key, val) {
                            $('#my_select').append($('<option>', {
                                value: val["BranchID"],
                                text : val["BranchNameTH"]
                            }));
                        })


                        var tr = "<tr>";
                        tr = tr + "<td style='color: #0f0f0f'> <center>" + i+test + "</center></td>";
                        tr = tr + "<td style='color: #0f0f0f'><center>" + val["OrderNo"] + "</center></td>";
                        tr = tr + "<td style='color: #0f0f0f'><center>" + val["BranchNameTH"] + "</center></td>";
                        tr = tr + "<td style='color: #0f0f0f'><center>" + val["AppointmentDate"] + "</center></td>";
                        if(val["IsExpressLevel"]==1){
                            tr = tr + "<td style='color: #0f0f0f'><center>" + "ซักด่วน" + "</center></td>";
                        }else{
                            tr = tr + "<td style='color: #0f0f0f'><center>" + "ซักธรรมดา" + "</center></td>";
                        }
                        if(val["Checked"]==1&&val["Checked1"]==1){
                            tr = tr + "<td style='color: #0f0f0f'><center><i class=\"\tglyphicon glyphicon-ok-sign\" style=\"font-size:28px;color: #00aa00;\"></i></center></td>";
                        }else{
                            tr = tr + "<td style='color: #0f0f0f'><center><i class=\"\tglyphicon glyphicon-remove-circle\" style=\"font-size:28px;color: #e50914;\"></i></center></td>";
                        }
                        tr = tr + "<td><center><a href=\"#myModal\" data-toggle=\"modal\" id="+val["OrderNo"]+" data-target=\"#edit-modal\"><i class=\"\tglyphicon glyphicon-list-alt\" style=\"font-size:28px;color: #0f0f0f;\"></a></center></td>";
                        tr = tr + "</tr>";
                        $('#myTable > tbody:last').append(tr);
                    });

                }else{
                    $("#myBody").empty();
                    $('#my_select').empty();
                    $('#my_select').append($('<option>', {
                        value: "cheese",
                        text : "--เลือกสาขา--"
                    }));
                    $.each(obj, function(key, val) {
                        $.each(val["Data"], function (key, val) {
                            $('#my_select').append($('<option>', {
                                value: val["BranchID"],
                                text : val["BranchNameTH"]
                            }));
                        })

                        var tr = "<tr>";
                        tr = tr + "<td style='color: #0f0f0f'> <center>" + i + "</center></td>";
                        tr = tr + "<td style='color: #0f0f0f'><center>" + val["OrderNo"] + "</center></td>";
                        tr = tr + "<td style='color: #0f0f0f'><center>" + val["BranchNameTH"] + "</center></td>";
                        tr = tr + "<td style='color: #0f0f0f'><center>" + val["AppointmentDate"] + "</center></td>";
                        if(val["Checked"]==1){
                            tr = tr + "<td style='color: #0f0f0f'><center>" + "ซักด่วน" + "</center></td>";
                        }else{
                            tr = tr + "<td style='color: #0f0f0f'><center>" + "ซักธรรมดา" + "</center></td>";
                        }
                        if(i%2!=0){
                            tr = tr + "<td style='color: #0f0f0f'><center><i class=\"\tglyphicon glyphicon-ok-sign\" style=\"font-size:28px;color: #00aa00;\"></i></center></td>";
                        }else{
                            tr = tr + "<td style='color: #0f0f0f'><center><i class=\"\tglyphicon glyphicon-remove-circle\" style=\"font-size:28px;color: #e50914;\"></i></center></td>";
                        }
                        tr = tr + "<td><center><a href=\"#myModal\" data-toggle=\"modal\" id="+val["OrderNo"]+" data-target=\"#edit-modal\"><i class=\"\tglyphicon glyphicon-list-alt\" style=\"font-size:28px;color: #0f0f0f\"></a></center></td>";
                        tr = tr + "</tr>";
                        $('#myTable > tbody:last').append(tr);
                    });
                }
            });
    }
    function logout() {
        $.get("path.txt", function (data) {
            var resourceContent = data;
            var id="<?php echo $_SESSION['id'];?>";
            $.ajax({
                url: resourceContent + "/getLogout.php?IsSignOn=0&id="+id,
                type: "POST",
                data: ''
            })
                .success(function (result) {
                    //
                    window.location = 'Logout.php';
                });
        });
    }
    //setInterval(getDataFromDb, 1300);
</script>
<body onload="getDataFromDb()">
<!-- WRAPPER -->
<div id="wrapper">
    <!-- NAVBAR -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="brand" style="background-color: #f9f9f9">
            <a href="index.php"><img src="assets/img/Logo-CLEANMATE-2.png" alt="Klorofil Logo" class="img-responsive logo"></a>
        </div>
        <div class="container-fluid" style="background-color: #f9f9f9">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
            </div>
            <!--<form class="navbar-form navbar-left">
                <div class="input-group">
                    <select class="form-control input-group-sm">
                        <option value="cheese">Cheese</option>
                        <option value="tomatoes">Tomatoes</option>
                        <option value="mozarella">Mozzarella</option>
                        <option value="mushrooms">Mushrooms</option>
                        <option value="pepperoni">Pepperoni</option>
                        <option value="onions">Onions</option>
                    </select>
                    <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                </div>
            </form>-->
            <!--<div class="navbar-btn navbar-btn-right">
                <a class="btn btn-success update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
            </div>-->
            <div class="navbar-btn navbar-btn-right">
                <a class="btn btn-default" onclick="logout()"><i class="lnr lnr-exit"></i> <span>Logout</span></a>
            </div>
            <div id="navbar-menu">
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/icon.png" class="img-circle" alt="Avatar"> <span><?php echo $_SESSION['FirstName'].' '.$_SESSION['LastName'].' ('.$_SESSION['BranchNameTH'].')';?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a onclick="logout()"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->
    <!-- LEFT SIDEBAR -->
    <div id="sidebar-nav" class="sidebar">
        <div class="sidebar-scroll">
            <nav>
                <ul class="nav">
                    <br>
                    <!--<li><a href="index.html" class="active"><i class="lnr lnr-home"></i> <span>ตรวจสอบสินค้าเข้าโรงงาน</span></a></li>
                    <li><a href="elements.html" class=""><i class="lnr lnr-code"></i> <span>ตรวจสอบสินค้าจากโรงงาน</span></a></li>
                    <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>แจ้งเตือนสินค้าผิดประเภท</span></a></li>-->
                    <li><a href="index.php" class=""><i class="lnr lnr-chart-bars"></i> <span>ตรวจสอบสินค้าขาออก</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- END LEFT SIDEBAR -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">
                <h3 class="page-title">สินค้าขาออก</h3>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">กรุณากรอกเลขที่ออเดอร์ของท่าน</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="date" id="date_start" name="date_start" class="form-control" value="<?php echo date("Y-m-d");?>" onchange="getDataFromDb()" required>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="branch" id="my_select" onchange="getDataFromDb()" required >
                                    <option value="cheese">&#45;&#45;เลือกสาขา&#45;&#45;</option>
                                    <?php
									            $stmt="select distinct ops_order.BranchID,BranchNameTH from ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID where ops_order.IsActive=1 and ops_order.AppointmentDate='".date("Y-m-d")."'";
									            $query = sqlsrv_query($conn,$stmt);
									            while($row = sqlsrv_fetch_array($query)){
									        ?>
                                    <option value="<?php echo $row["BranchID"];?>"><?php echo $row["BranchNameTH"];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input class="form-control" id="getOrderNo" name="getOrderNo" type="text" placeholder="เลขออเดอร์">
                                    <span class="input-group-btn"><button class="btn btn-primary" type="button" onclick="getDataFromDb()">ค้นหา</button></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a id='not_null' class="btn btn-success update-pro" href="" onclick="toggle_visibility()"><i class="fa fa-print"></i> <span>พิมพ์ใบเช็คสินค้าขาออก</span></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">
                                <span class="label label-default" style="align-content: right" id="search"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead align="center">
                            <tr bgcolor="#2b333e">
                                <th style="color: #f1f1f1"><center>ลำดับ</center></th>
                                <th style="color: #f1f1f1"><center>เลขที่ออเดอร์</center></th>
                                <th style="color: #f1f1f1"><center>ชื่อสาขา</center></th>
                                <th style="color: #f1f1f1"><center>วันนัดรับ</center></th>
                                <th style="color: #f1f1f1"><center>สินค้าพิเศษ</center></th>
                                <th style="color: #f1f1f1"><center>ตรวจสอบสินค้า</center></th>
                                <th style="color: #f1f1f1"><center>รายละเอียดสินค้า</center></th>
                            </tr>
                            </thead>
                            <tbody id="myBody">
                        </table>
                    </div>

                    <!-- Modal -->
                    <!-- <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-lg">-->
                    <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">รายละเอียดสินค้า</h4>
                                </div>
                                <br>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-2"align="right"><font size="3">เลขที่ออเดอร์ : </font></div>
                                        <div class="col-md-2"><font size="3"><span  class="edit-content1"></span></font></div>

                                        <div class="col-md-2" align="right"><font size="3">ชื่อลูกค้า : </font></div>
                                        <div class="col-md-2"><font size="3"><span  class="edit-content2"></span></font></div>

                                        <div class="col-md-2" align="right"><font size="3">เบอร์มือถือลูกค้า : </font></div>
                                        <div class="col-md-2"><font size="3"><span  class="edit-content3"></span></font></div>
                                    </div>
                                    <br>
                                    <!--<li>เลขที่ใบรับฝากผ้า : <span  class="edit-content1"></span></li>
                                    <li>สาขา : <span  class="edit-content2"></span></li>
                                    <li>ชื่อลูกค้า : <span  class="edit-content3"></span></li>
                                    <li>เบอร์ติดต่อ : <span  class="edit-content4"></span></li>
                                    <li>วันที่ทำรายการ : <span  class="edit-content5"></span></li>
                                    <li>วันที่นัดรับผ้า : <span  class="edit-content6"></span></li>-->


                                    <div class="table-responsive">
                                        <table class="table table-striped" id="myTable1">
                                            <thead>
                                            <tr bgcolor="#2b333e">
                                                <th style="color: #f1f1f1"><center>ลำดับ</center></th>
                                                <th style="color: #f1f1f1"><center>บาร์โค้ดสินค้า</center></th>
                                                <th style="color: #f1f1f1"><center>รายการสินค้า</center></th>
                                                <th style="color: #f1f1f1"><center>ประเภทการซัก</center></th>
                                                <th style="color: #f1f1f1"><center>สถานะสินค้าในโรงงาน</center></th>
                                                <th style="color: #f1f1f1"><center>สินค้า Reject</center></th>
                                            </tr>
                                            </thead >
                                            <tbody id="myBody1">
                                            </tbody>
                                        </table>
                                    </div><br>

                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var ORDERNO=0;
                        $('#edit-modal').on('show.bs.modal', function(e) {
                            var $modal = $(this),
                                esseyId = e.relatedTarget.id;
                            //$modal.find('.edit-content').html(esseyId);
                            ORDERNO=esseyId;
                            $.ajax({
                                url: "http://119.59.115.80/WebCheckerOut/Service/getDataDetail.php?OrderNo="+esseyId,
                                type: "POST",
                                data: ''
                            })
                                .success(function(result) {
                                    var obj = jQuery.parseJSON(result);
                                    var i=0;
                                    if(obj != '') {
                                        $("#myBody1").empty();
                                        $.each(obj, function (key, val) {
                                            i++;
                                            $modal.find('.edit-content1').html("\t\t\t" + val["OrderNo"]);
                                            $modal.find('.edit-content2').html("\t\t\t" + val["FirstName"]);
                                            $modal.find('.edit-content3').html("\t\t\t" + val["TelephoneNo"]);

                                            var tr = "<tr>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["Barcode"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["ProductNameTH"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["ServiceNameTH"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["SubProcessName"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["ReturnReason"] + "</center></td>";
                                            tr = tr + "</tr>";
                                            $('#myTable1 > tbody:last').append(tr);

                                        });
                                    }else{
                                        $("#myBody1").empty();
                                        $.each(obj, function (key, val) {
                                            i++;
                                            $modal.find('.edit-content1').html("\t\t\t" + val["OrderNo"]);
                                            $modal.find('.edit-content2').html("\t\t\t" + val["FirstName"]);
                                            $modal.find('.edit-content3').html("\t\t\t" + val["TelephoneNo"]);

                                            var tr = "<tr>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["Barcode"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["ProductNameTH"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["ServiceNameTH"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["SubProcessName"] + "</center></td>";
                                            tr = tr + "<td style='color: #0c1312'><center>" + val["ReturnReason"] + "</center></td>";
                                            tr = tr + "</tr>";
                                            $('#myTable1 > tbody:last').append(tr);

                                        });
                                    }
                                });
                        });

                    </script>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">

            </p>
        </div>
    </footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="assets/vendor/chartist/js/chartist.min.js"></script>
<script src="assets/scripts/klorofil-common.js"></script>
<script>
    $(function() {
        var data, options;

        // headline charts
        data = {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            series: [
                [23, 29, 24, 40, 25, 24, 35],
                [14, 25, 18, 34, 29, 38, 44],
            ]
        };

        options = {
            height: 300,
            showArea: true,
            showLine: false,
            showPoint: false,
            fullWidth: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: false,
        };

        new Chartist.Line('#headline-chart', data, options);


        // visits trend charts
        data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            series: [{
                name: 'series-real',
                data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
            }, {
                name: 'series-projection',
                data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
            }]
        };

        options = {
            fullWidth: true,
            lineSmooth: false,
            height: "270px",
            low: 0,
            high: 'auto',
            series: {
                'series-projection': {
                    showArea: true,
                    showPoint: false,
                    showLine: false
                },
            },
            axisX: {
                showGrid: false,

            },
            axisY: {
                showGrid: false,
                onlyInteger: true,
                offset: 0,
            },
            chartPadding: {
                left: 20,
                right: 20
            }
        };

        new Chartist.Line('#visits-trends-chart', data, options);


        // visits chart
        data = {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            series: [
                [6384, 6342, 5437, 2764, 3958, 5068, 7654]
            ]
        };

        options = {
            height: 300,
            axisX: {
                showGrid: false
            },
        };

        new Chartist.Bar('#visits-chart', data, options);


        // real-time pie chart
        var sysLoad = $('#system-load').easyPieChart({
            size: 130,
            barColor: function(percent) {
                return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
            },
            trackColor: 'rgba(245, 245, 245, 0.8)',
            scaleColor: false,
            lineWidth: 5,
            lineCap: "square",
            animate: 800
        });

        var updateInterval = 3000; // in milliseconds

        setInterval(function() {
            var randomVal;
            randomVal = getRandomInt(0, 100);

            sysLoad.data('easyPieChart').update(randomVal);
            sysLoad.find('.percent').text(randomVal);
        }, updateInterval);

        function getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

    });

    function toggle_visibility() {
        var data=document.getElementById("date_start").value;
        //var getBranch = document.getElementById("search").value;
        var al = $("#search").text();
        var x = document.getElementById('not_null');

        if (al!="")//Here you are missing
        {
            x.target="blank";
            x.rel="noopener noreferrer";
            x.href="PDF/Print-Invoice-Bill.php?branchID="+al+"&dates="+data;
        }else{
            var answer = alert("กรุณาเลือกสาขาก่อน!!");
            if (answer) {
                data="";
                al="";
            }
        }
        data="";
        al="";
    }

</script>
</body>

</html>
