<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../image_logo/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./stepbar.css">
    <!-- Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Check_status</title>
</head>
<?php
session_start();
include('../connectDatabase/connectToDatabase.php');

$conn = new database();
if(isset($_COOKIE['tableId'])){
    $tableID = $_COOKIE['tableId'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ order_id และ order_status หรือไม่
    if (isset($_POST['order_id']) && isset($_POST['order_status']) && isset($_POST['table_id'])) {
        $orderID = $_POST['order_id'];
        $orderStatus = $_POST['order_status'];
    }
}
$order_status = "";

?>

<body style="background-color: #1a1a1a; font-family: Noto Sans Thai, sans-serif; color: #000;">
    <div class="navigation-wrap start-header start-style">

        <div class="container">
            <div class="row">
                <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">
					
					<a class="navbar-brand" ><img src="../image_logo/logotab2.png" alt=""></a>	
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto py-4 py-md-0" style="text-align: center;" >
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../home/index.php">หน้าหลัก</a>
							</li>
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../menuorder/menu.php">รายการอาหาร</a>
							</li>
							<?php
							if(!isset($_COOKIE['tableId'])) {
								echo '<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="#">จองโต๊ะ</a>
									</li>';
							}else{
								echo '<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
								<a class="nav-link" href="../Check_status/index.php">สถานะออเดอร์ของฉัน</a>
							</li>';
							}


							?>
							
							
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../review/index.php">รีวิวและรายงานปัญหา</a>
							</li>
							
						
							<?php
							if(isset($_COOKIE['tableId'])) {
								echo '<a class=" pl-4 pl-md-0 ml-0 ml-md-4 customnav">&nbsp;&nbsp;&nbsp;&nbsp;ลูกค้าโต๊ะที่ '.$_COOKIE['tableId'].'</a>
										';
							}
							?>
							</ul>

					</div>
					
				</nav>	
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = "SELECT * FROM OrderTable 
    JOIN Tables ON OrderTable.tableid = Tables.tableID
    WHERE Tables.tableID = $tableID";
    $result = mysqli_query($conn->getDatabase(), $sql);

    if ($result) {
        echo "การดึงข้อมูลผ่านจ้าาา: ";
    } else {
        echo "การดึงข้อมูลผิดพลาด: " . mysqli_error($conn->getDatabase());
    }


    if ($row = mysqli_fetch_assoc($result)) {
        $order_status = $row['orderStatus'];
        echo '<div style="height: 90px;"></div>
                    <div class="container">
                        <div class="centeritem">
                        <div class="texthead">
                            <div style="height: 8px"></div>
                            <h2 class="text-center">ออเดอร์ที่สั่ง</h2>
                            <div style="height: 2px"></div>
                                </div>
                            </div>
                        </div>
                             <div class="row justify-content-center">
                                <div class="col-12 col-md-12">
                                    <div class="progress-wrapper">
                                        <div id="progress-bar-container">
                        <ul>
                     ';
        if ($row['orderStatus'] == "take") {
            echo '
                    <li class="step step01 active">
                        <div class="step-inner">กำลังรับออเดอร์</div>
                    </li>
                    <li class="step step02">
                        <div class="step-inner">กำลังทำอาหาร</div>
                    </li>
                    <li class="step step03">
                        <div class="step-inner">เสร็จสิ้น</div>
                    </li>';
        } elseif ($row['orderStatus'] == "doing") {
            echo '
                    <li class="step step01 active">
                        <div class="step-inner">กำลังรับออเดอร์</div>
                    </li>
                    <li class="step step02 active">
                        <div class="step-inner">กำลังทำอาหาร</div>
                    </li>
                    <li class="step step03">
                        <div class="step-inner">เสร็จสิ้น</div>
                    </li>';
        } else if ($row['orderStatus'] == "finish") {
            echo '
                        <li class="step step01 active">
                            <div class="step-inner">กำลังรับออเดอร์</div>
                        </li>
                        <li class="step step02 active">
                            <div class="step-inner">กำลังทำอาหาร</div>
                        </li>
                        <li class="step step03 active">
                            <div class="step-inner">เสร็จสิ้น</div>
                        </li>';
        }
        echo '    </ul>
        <div id="line">
            <div id="line-progress"></div>
        </div>
        <div id="progress-content-section">';

        $orderid = $row['orderID'];
        $tableid = $row['tableid'];
        $orderTotal = $row['orderTotal'];
        $orderStatus = $row['orderStatus'];

        $select_sql = "SELECT orderMenu FROM OrderTable WHERE orderid = '$orderid'";
        $resultorder = mysqli_query($conn->getDatabase(), $select_sql);
        if ($resultorder->num_rows > 0) {
            while ($row = $resultorder->fetch_assoc()) {
                $order_menu_json = $row['orderMenu'];

                // แปลง JSON เป็น associative array
                $order_menu_data = json_decode($order_menu_json, true);
                if (isset($order_menu_data['order'])) {
                    $order_items = $order_menu_data['order'];

                    if ($orderStatus == "take") {
                        echo '<div class="section-content step1 active">
                        <h2 class="text-center">กำลังรับออเดอร์</h2>
                        <hr>
                        <div class="container">';
                    } elseif ($orderStatus == "doing") {
                        echo '<div class="section-content step2 active">
                        <h2 class="text-center">กำลังทำอาหาร</h2>
                        <hr>
                        <div class="container">';
                    } else {
                        echo '<div class="section-content step3 active">
                        <h2 class="text-center">เสร็จสิ้น</h2>
                        <hr>
                        <div class="container">';
                    }

                    foreach ($order_items as $order_item) {
                        $menu_id =  $order_item['menuId'];
                        $name = "SELECT * FROM Menu WHERE menuID = $menu_id;";
                        $resultmenu = mysqli_query($conn->getDatabase(), $name);

                        if (mysqli_num_rows($resultmenu) > 0) {
                            while ($row = mysqli_fetch_assoc($resultmenu)) {
                                echo '<div class="row">
                                <div class="col-5 col-md-4 d-flex">
                                    <img src="../image_menu/' . $row['image_menu'] . '" class="img"> 
                                </div>
                                <div class="menu col-4 col-md-4 d-flex justify-content-center align-items-center">
                                    ' . $row['menu_name'] . '
                                </div>
                                <div class="count col-3 col-md-4 d-flex justify-content-center align-items-center" style="text-align: center;">
                                    x ' . $order_item['menuCount'] . '
                                </div>
                            </div>
                            <hr>';
                            }
                        }
                    }
                    echo '</div>
                    </div>';
                }
            }
        }
    }
    ?>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    <!-- --------------------------------------------------------------------------------- -->



    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src="./scripts.js"></script>
    <script>
        if ('<?php echo $order_status ?>' === "take") {
            $("#line-progress").css("width", "8%");
            $(".step1").addClass("active").siblings().removeClass("active");

        } else if ('<?php echo $order_status ?>' === "doing") {
            $("#line-progress").css("width", "50%");
            $(".step2").addClass("active").siblings().removeClass("active");

        } else if ('<?php echo $order_status ?>' === "finish") {
            $("#line-progress").css("width", "100%");
            $(".step3").addClass("active").siblings().removeClass("active");
        }
        console.log('  ?>')
    </script>

</body>

</html>