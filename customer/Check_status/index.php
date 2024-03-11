<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../../image_logo/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel="stylesheet" href="./stepbar.css">
    <!-- Font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>สถานะออเดอร์ของฉัน</title>
</head>
<?php
session_start();
include('../../connectDatabase/connectToDatabase.php');

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
					
					<a class="navbar-brand" ><img src="../../image_logo/logotab2.png" alt=""></a>	
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto py-4 py-md-0" style="text-align: center;" >
							<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
								<a class="nav-link" href="../index.php">หน้าหลัก</a>
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
							</li>
              			
                                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="../review/index.php">รีวิวและรายงานปัญหา</a>
                                </li>
                                '
                                ;
							}


							?>
							
						
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
    $sql = "SELECT *
    FROM OrderTable o
    JOIN Bill b ON o.orderid = b.orderid
    JOIN Tables t ON o.tableid = t.tableID
    WHERE t.tableID = $tableID AND b.billStatus = 'no';";
    $result = mysqli_query($conn->getDatabase(), $sql);

    if ($result) {
        echo "การดึงข้อมูลผ่านจ้าาา: ";
    } else {
        echo "การดึงข้อมูลผิดพลาด: " . mysqli_error($conn->getDatabase());
    }


    if($result->num_rows > 0){
    if ($row = mysqli_fetch_assoc($result)) {
        $order_status = $row['orderStatus'];
        echo '<div style="height: 90px;"></div>
                    <div class="container">
                        <div class="centeritem">
                        <div class="texthead">
                            <div style="height: 8px"></div>
                                <div>
                                    <h2 class="orderhead">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 20">
                                            <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                        </svg> ออเดอร์ที่สั่ง
                                    </h2>

                                    <h5 class="detailhead">ข้อมูล ณ เวลา 
                                        <p id="refreshTime"></p>
                                    </h5>
                                </div>
                              <div style="height: 4px"></div>
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
                                    <img src="../../image_menu/' . $row['image_menu'] . '" class="img"> 
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
} else{

    echo '
        <div style="height: 100px;"></div>
            <div class="texthead">
                <div style="height: 8px;"></div>
                    <h4><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-bag-x" viewBox="0 0 16 20">
                    <path fill-rule="evenodd" d="M6.146 8.146a.5.5 0 0 1 .708 0L8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8
                     10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 0 1 0-.708"/> <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 
                     1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                  </svg>&nbsp;<span style="vertical-align: middle;">ไม่พบประวัติการสั่ง</span></h4>
                <div style="height: 2px;"></div>
            </div>
            <div style="height: 400px;"></div>
        ';
}
    ?>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>



    <div style="height: 200px;"></div>
    <!-- --------------------------------------------------------------------------------- -->

    <footer>
    <div style="height: 30px;"></div>

      <div>
        <p>หน้าหลัก | รายการอาหาร | จองโต๊ะ | รีวิวจากลูกค้า</p>
      </div>
      <img src="../../image_logo/logotab.png" alt="">
      <div style="height: 30px;"></div>
      <div class="copyright">
        &copy; OHYUMMY 2024
      </div>
      <div style="height: 30px;"></div>

	</footer>

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