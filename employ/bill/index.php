<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../image_logo/logo.png"/>
    <link href="styles.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
    <title>จัดการโต๊ะ</title>
</head>
<body style="background-color: #f6f9fc; color: black; font-family: Noto Sans Thai, sans-serif;">
    <nav class="nav">
        <a href="../editMenu/index.php" class="nav__link">
			<i class="material-icons nav__icon">restaurant_menu</i>
			<span class="nav__text">จัดการเมนู</span>
		</a>
		
		<a href="../status_menu/index.php" class="nav__link">
			<i class="material-icons nav__icon">reorder</i>
			<span class="nav__text">ดูสถานะออเดอร์</span>
		</a>
		<a href="../kitchen_status/index.php" class="nav__link">
			<i class="material-icons nav__icon">soup_kitchen</i>
			<span class="nav__text">จัดการออเดอร์ (ครัว)</span>
		</a>
        <a href="../index.php" class="nav__link">
			<i class="material-icons nav__icon">dashboard</i>
			<span class="nav__text">หน้าหลัก</span>
		</a>
        <a href="../editTable/index.php" class="nav__link">
			<i class="material-icons nav__icon">table_restaurant</i>
			<span class="nav__text">จัดการโต๊ะ</span>
		</a>
        <a href="../status_reserve/index.php" class="nav__link">
			<i class="material-icons nav__icon">install_mobile</i>
			<span class="nav__text">จัดการจองโต๊ะ</span>
		</a>
	
		<a href="../bill/index.php" class="nav__link nav__link--active">
			<i class="material-icons nav__icon ">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="../billHistory/index.php" class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>

      <?php
            session_start();
            include('../../connectDatabase/connectToDatabase.php');

            $conn = new database();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ table_id และ table_status หรือไม่
                if (isset($_POST['table_id']) && isset($_POST['bill_id'])) {
                    // รับค่า table_id และ table_status จากการส่งคำขอ HTTP POST
                    $tableID = $_POST['table_id'];
                    $tableStatus = "empty";
                    $billID = $_POST['bill_id'];
                    $billStatus = "yes";
                    
                    $query1 = "UPDATE Tables SET table_status = '$tableStatus' WHERE tableID = $tableID";
                    $query2 = "UPDATE Bill SET billStatus = '$billStatus', billTime = CONVERT_TZ(NOW(),@@session.time_zone,'+07:00') WHERE billID = $billID";
                    mysqli_query($conn->getDatabase(), $query1);
                    mysqli_query($conn->getDatabase(), $query2);   
                }
            }
      ?>
    <div style="height: 20px;"></div>


    <div class="container-fluid mx-3">
     <div class="texthead">
        <div style="height: 20px;"></div>
        <?php 
                $num = mysqli_num_rows($conn->executeQuery("Tables"));
                echo  "<h3>&nbsp;&nbsp;&nbsp;&nbsp;เช็คบิล | <span id='clock'></span></h3>";
            ?>
        <div style="height: 10px;"></div>
      </div>
    </div>
    <div style="height: 20px;"></div>

    <div class="container-fluid">
       <div style="height: 5px;"></div>
        <div class="row g-6 mb-6 mx-1" id="main">
            <div class="col-12 col-lg-12">
                <div class="tableshow">
                    <img class="imgtab" src="table_image/tabtable.png" alt="">
                    <div class="container">
                    <div class="grid-container">
                        <div class="grid-item"> 
                        <?php
                            $sql = "SELECT * FROM Tables;";
                            $result = mysqli_query($conn->getDatabase(), $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                        echo '<div class="number-image">';
                                        if($row['table_status'] == 'empty' || $row['table_status'] == 'reserve'){
                                            echo '<img src="table_image/tablefree.png"  alt="1"></a>';
                                         }
                                        elseif ($row['table_status'] == 'full'){
                                            echo '<img src="table_image/tablefull.png" onclick="openCardBill('.$row['tableID'].')" alt="1"></a>';
                                        }
                                        echo '<span class="number-text">'.$row['tableID'].'</span>';
                                        echo '</div>';

                                  }
                              }
                            ?>

                        </div>
                        </div>
                    </div>
                    <div style="height: 100px;">

                </div>
            </div>
    

    <div style="height: 50px;"></div>


    <?php

        $sql = "SELECT * FROM Tables;";
        $result = mysqli_query($conn->getDatabase(), $sql);
        if (mysqli_num_rows($result) > 0) {
            while($rowtable = mysqli_fetch_assoc($result)) {
                $tableid = $rowtable['tableID'];
                echo '<div id="cardBill'.$tableid.'" class="card-window">
                        <div class="card-add">
                        <span class="close-button" onclick="closeCardBill('.$tableid.')">&times;</span>';
                echo '<div class="row">
                        <div class="bill col-12 col-md-12" id="bill'.$tableid.'">
                        <div class="bill-card container">';
                echo        '<h6><br>ยอดการสั่งอาหาร (โต๊ะ '.$tableid.')</h6>';
                echo        '<hr>';
                echo        '<table border="0"  class="col-12" style="text-align: right;">
                                <tr class="th">
                                    <td></td>
                                    <td class="menu">รายการอาหาร</td>
                                    <td>ราคา(฿)</td>
                                    <td>จำนวน</td>
                                    <td>ราคารวม(฿)</td>
                                </tr>';
                                $sqlB = "SELECT * FROM Bill  WHERE tableID = $tableid AND billStatus = 'no'";
                                $resultBill = mysqli_query($conn->getDatabase(), $sqlB);
                                $object = mysqli_fetch_assoc(mysqli_query($conn->getDatabase(), $sqlB));
                                $billId = $object['billID'];
                                $orderid = $object['orderid'];

                                        $select_sql = "SELECT orderMenu FROM OrderTable WHERE orderid = '$orderid'";
                                        $resultorder = mysqli_query($conn->getDatabase(), $select_sql);

                                        if ($resultorder->num_rows > 0) {
                                        while ($row = $resultorder->fetch_assoc()) {
                                            $order_menu_json = $row['orderMenu'];

                                            // แปลง JSON เป็น associative array
                                            $order_menu_data = json_decode($order_menu_json, true);

                                            if (isset($order_menu_data['order'])) {
                                            $order_items = $order_menu_data['order'];

                                            foreach ($order_items as $order_item) {
                                                $menu_id =  $order_item['menuId'];
                                                $menu_count = $order_item['menuCount'];

                                                $name = "SELECT * FROM Menu WHERE menuID = $menu_id;";
                                                $resultmenu = mysqli_query($conn->getDatabase(), $name);

                                                if (mysqli_num_rows($resultmenu) > 0) {
                                                while ($rowmenu = mysqli_fetch_assoc($resultmenu)) {
                                                    echo '<tr style="height: 110px;">
                                                            <td class="menu"><img src="../../image_menu/'.$rowmenu['image_menu'].'" class="img"></td>
                                                            <td class="menu">'.$rowmenu['menu_name'].'</td>
                                                            <td>'.$rowmenu['menu_price'].'.00</td>
                                                            <td>'.$menu_count.'</td>
                                                            <td>'.$rowmenu['menu_price']*$menu_count.'.00</td>
                                                        </tr>';
                                                }
                                                }
                                            }
                                            }
                                        }
                                    }
                     echo  '</table>
                            <hr>';  
                     echo  '<div class="row">
                            <div class="col-6 col-md-6">
                                <p>ราคารวม(บาท)</p>
                            </div>
                            <div class="col-6 col-md-6" style="text-align: right;">';

                   
                                while ($rowobject = mysqli_fetch_assoc($resultBill)) {
                                echo '<p>'.$rowobject['billTotal'].'.00</p>';
                                }

                    echo    '</div>
                           </div>
                            </div> 
                            <div class="container">
                            <div style="text-align: right;">
                            <label>วิธีการจ่าย:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <button type="button" class="btn1 btn btn-success" onclick="toggleHiddenDiv(\'sol1-bill'.$tableid.'\', \'sol2-bill'.$tableid.'\', '.$tableid.')" id="btn1">เงินสด</button>
                            <button type="button" class="btn2 btn btn-success" onclick="toggleHiddenDiv(\'sol2-bill'.$tableid.'\', \'sol1-bill'.$tableid.'\', '.$tableid.')" id="btn2">คิวอาร์โค้ด</button>
                            <div style="height: 20px;"></div>
                            </div>
                        </div>
                    </div>';



                    echo '<div class="sol2-bill col-12 col-md-4" id="sol2-bill'.$tableid.'">
                            <div class="bill-card container">
                            <h6><br>คิวอาร์โค้ด</h6>
                            <img src="Qr.jpg" alt="" class="col-12">';
                    $sqlBill2 = "SELECT * FROM Bill WHERE tableID = $tableid AND billStatus = 'no';";
                    $objectBill2 = mysqli_query($conn->getDatabase(), $sqlBill2);
                    while ($rowobject2 = mysqli_fetch_assoc($objectBill2)) {
                        echo '<div style="text-align: center;"><img src="http://promptpay.io/0900803496/'.$rowobject2['billTotal'].'.png"></div>
                                            <img src="Qr2.jpg" alt="" class="col-12">
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 col-md-6">
                                                <p>จำนวนเงิน</p>
                                                </div>
                                                <div class="col-6 col-md-6" style="text-align: right;">
                                                <p>'.$rowobject2['billTotal'].'.00</p>
                                                </div>
                                            </div>';
                                    }
                    echo '<div style="height: 20px;"></div>
                    </div>
                    <div style="text-align: right;"><button type="button" class="btn2 btn btn-success" onclick="updateBill('.$tableid.', '.$billId.')" id="btn2">เสร็จสิ้น</button></div>
                </div>';




                                    
                echo '<div class="sol1-bill col-12 col-md-4" id="sol1-bill'.$tableid.'">
                        <div class="bill-card container">
                            <h6><br>เงินสด</h6>
                            <hr>
                            <div class="row">
                            <div class="col-8 col-md-8">
                                <p>จำนวนเงินที่รับ (บาท)</p>
                                <p>ราคารวมอาหาร (บาท)</p>
                            </div>
                            <div class="col-4 col-md-4" style="text-align: right;">
                                <input type="text" class="form-control" id="moneyInput'.$tableid.'" style="height: 30px;">
                                <div style="height: 13px;"></div>';

                                $sqlBill3 = "SELECT * FROM Bill WHERE tableID = $tableid AND billStatus = 'no';";
                                $objectBill3 = mysqli_query($conn->getDatabase(), $sqlBill3);
                                while ($rowobject3 = mysqli_fetch_assoc($objectBill3)) {
                                    echo '<p id="billTotal'.$tableid.'">'.$rowobject3['billTotal'].'.00</p>';
                                }
                echo '  </div>
                            </div>
                            <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4" style="text-align: right;"><button type="button" class="btn btn-primary" onclick="calculateChange('.$tableid.')">คำนวณ</button></div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-8 col-md-8">
                                <p>เงินทอน (บาท)</p>
                            </div>
                            <div class="col-4 col-md-4" style="text-align: right;" id="changeAmount'.$tableid.'"> 
                                
                            </div>
                            </div>
                        </div>
                        <div style="text-align: right;"><button type="button" class="btn2 btn btn-success" id="btn2"  onclick="updateBill('.$tableid.', '.$billId.')" >เสร็จสิ้น</button></div>
                    </div>
                    </div>
                    <div style="height: 20px;"></div>
                </div>
                </div>
            </div>';

            }
        }
    ?>
                    
                            
                    
                    

                           




                        
                            
                
                              
   
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script><script  src="./script.js"></script>

</body>
</html> 