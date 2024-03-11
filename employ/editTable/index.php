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
        <a href="../editTable/index.php" class="nav__link  nav__link--active">
			<i class="material-icons nav__icon">table_restaurant</i>
			<span class="nav__text">จัดการโต๊ะ</span>
		</a>
        <a href="../status_reserve/index.php" class="nav__link">
			<i class="material-icons nav__icon">install_mobile</i>
			<span class="nav__text">จัดการจองโต๊ะ</span>
		</a>
	
		<a href="../bill/index.php"  class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="../billHistory/index.php"class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>

      <?php
            session_start();
            include('../../connectDatabase/connectToDatabase.php');

            $conn = new database();

            // ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาหรือไม่
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // ตรวจสอบว่ามีค่าที่ถูกส่งมากับชื่อ table_id และ table_status หรือไม่
                if (isset($_POST['table_id']) && isset($_POST['table_status'])) {
                    // รับค่า table_id และ table_status จากการส่งคำขอ HTTP POST
                    $tableID = $_POST['table_id'];
                    $tableStatus = $_POST['table_status'];
                    
                    if($tableStatus == 'full'){
                        $query = "UPDATE Tables SET table_status = '$tableStatus', checkIn = CONVERT_TZ(NOW(),@@session.time_zone,'+07:00') 
                        WHERE tableID = $tableID";
                        mysqli_query($conn->getDatabase(), $query);
                    }
                    else{
                        $query = "UPDATE Tables SET table_status = '$tableStatus', checkIn = NULL WHERE tableID = $tableID";
                        mysqli_query($conn->getDatabase(), $query);
                    }              
                }

                if(isset($_POST['table_id']) && isset($_POST['seattable'])){
                    $tableID = $_POST['table_id'];
                    $seat = $_POST['seattable'];
                    
                    $query = "UPDATE Tables SET seat = $seat WHERE tableID = $tableID";
                    mysqli_query($conn->getDatabase(), $query);
                }
                if(isset($_POST['insertSeat'])){
               
                    $seat = $_POST['insertSeat'];
                    
                    $insert = "INSERT INTO Tables(seat, table_status) VALUES ($seat, 'empty')";
                    mysqli_query($conn->getDatabase(), $insert);


                }
            }
           
      
      
      ?>


    <div style="height: 20px;"></div>
    <div class="container-fluid mx-3">
     <div class="texthead">
        <div style="height: 20px;"></div>
        <?php 
                $num = mysqli_num_rows($conn->executeQuery("Tables"));
                echo  "<h3>&nbsp;&nbsp;&nbsp;&nbsp;สถานะโต๊ะทั้งหมด $num โต๊ะ | <span id='clock'></span></h3>";
            ?>
        <div style="height: 10px;"></div>
      </div>
    </div>
    <div style="height: 30px;"></div>

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
                                        if($row['table_status'] == 'empty'){
                                            echo '<img src="table_image/tablefree.png" onclick="openCardQr('.$row['tableID'].')" alt="1"></a>';
                                         }
                                        elseif ($row['table_status'] == 'full'){
                                            echo '<img src="table_image/tablefull.png" onclick="openCardQr('.$row['tableID'].')" alt="1"></a>';
                                        }
                                        elseif ($row['table_status'] == 'reserve'){
                                            echo '<img src="table_image/tablere.png" onclick="openCardQr('.$row['tableID'].')" alt="1"></a>';
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
            <div class="col12 col-lg-12">
                <div class="container-fluid tableedit"> 
                    <div class="headedit">
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-6 col-lg-9">
                                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จัดการโต๊ะ</h5>
                            </div>
                            <div class="col-6 col-lg-3">
                                <a href="#" class="circle-button" onclick="openCardWindow()">
                                <i class="material-icons nav__icon" style="margin-top: 8%;">add</i></a>
                                <p style="color: #007bff; display: inline-block; margin-left: 5px; vertical-align: middle; ">เพิ่มจำนวนโต๊ะ</p>
                            </div> 
                        </div>
                    </div>
                    <table class="table table-hover" style="text-align: center;">
                        <thead>
                          <tr>
                            <th scope="col">สถานะโต๊ะ</th>
                            <th scope="col">โต๊ะเลขที่</th>
                            <th scope="col">จำนวนที่นั่ง</th>
                            <th scope="col">เวลาที่เข้า</th>
                            <th scope="col">เปลี่ยนแปลงสถานะ</th>
                            <th scope="col">เปลี่ยนแปลงโต๊ะ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <?php
                                $sql = "SELECT * FROM Tables;";
                                $result = mysqli_query($conn->getDatabase(), $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        if($row['table_status'] == 'empty'){
                                            echo '<th><button type="button" style="padding: 3px 10px;" class="btn btn-secondary">ว่าง</button></th>';
                                        }
                                        elseif($row['table_status'] == 'full'){
                                            echo '<th><button type="button"  style="padding: 3px 10px;" class="btn btn-primary">เต็ม</button></th>';
                                        }
                                        elseif($row['table_status'] == 'reserve'){
                                            echo '<th><button type="button" style="padding: 3px 10px;" class="btn btn-warning">จอง</button></th>';
                                        }
                                      
                                        echo '<td>'.$row['tableID'].'</td>';
                                        echo '<td>'.$row['seat'].'</td>';
                                        echo '<td>'.$row['checkIn'].'</td>';
                                        echo '
                                            <td>
                                                <a href="#" class="circle-button2" onclick="openCardWindow2('.$row['tableID'].')">
                                                <i class="material-icons nav__icon" style="margin-top: 8%; color: #DB2700;">edit_note</i></a>
                                            </td>
                                            <td>
                                                <button id="button_empty" style="padding: 3px 10px; type="button" 
                                                onclick="updateTableStatus('.$row['tableID'].',\'empty\');" class="btn btn-secondary">ว่าง</button>
                                                <button id="button_full" style="padding: 3px 10px; type="button" 
                                                onclick="updateTableStatus('.$row['tableID'].',\'full\');" class="btn btn-primary">เต็ม</button>                    
                                            </td>
                                              
                                            </tr>';
                                
                                    
                                    }
                                }
                            
                            ?>
                           
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>

    <div id="cardWindow" class="card-window">
        <div class="card-add">
            <span class="close-button" onclick="closeCardWindow()">&times;</span>
            <!-- เนื้อหาของการ์ด -->
            <div class="card-content">
                <div class="container">
                        <div style="height: 50px;"></div>
                        <h3>เพิ่มจำนวนโต๊ะ</h3>
                        <hr color=black size=30>
                        <img class="cardimg" src="table_image/tablefree.png" alt="1"></a>
                        <form me>
                            <div class="form-row">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">จำนวนที่นั่ง</label>
                                <select class="custom-select mr-sm-2" name="seatTable" id="seatTable">
                                    <option selected>เลือกจำนวนที่นั่ง</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="6">6</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="insertTable()">เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>


    <?php
     $sql = "SELECT * FROM Tables;";
     $result = mysqli_query($conn->getDatabase(), $sql);
     if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
             echo '<div id="cardWindow'.$row['tableID'].'" class="card-window">
                     <div class="card-add">
                         <span class="close-button" onclick="closeCardWindow2('.$row['tableID'].')">&times;</span>
                     
                         <div class="card-content">
                             <div class="container">
                                 <div style="height: 50px;"></div>
                                 <h3>เปลี่ยนแปลงจำนวนที่นั่ง</h3>
                                 <hr color=black size=30>
                                 <div class="number-image">
                                    <img class="cardimg" src="table_image/tablefree.png" alt="1"></a>
                                    <span class="number-text">'.$row['tableID'].'</span>
                                </div>
                                 <div class="form-row">
                                     <label class="mr-sm-2" for="inlineFormCustomSelect">จำนวนที่นั่ง</label>
                                     <select id=\'seat'.$row['tableID'].'\' class="custom-select mr-sm-2" name="seat">
                                         <option selected>เลือกจำนวนที่นั่ง</option>
                                         <option value="2">2</option>
                                         <option value="4">4</option>
                                         <option value="6">6</option>
                                         <option value="8">8</option>
                                     </select>
                                 </div>
                                 <button id="confirmButton"  class="btn btn-primary" onclick="updateTable('.$row['tableID'].',
                                  document.getElementById(\'seat'.$row['tableID'].'\').value)">ยืนยัน</button>
                             </div>
                         </div>
                     </div>
                 </div>';
         
         }
     }                         
                            
    ?>     
    
    <?php

     $sql = "SELECT * FROM Tables;";

     $result = mysqli_query($conn->getDatabase(), $sql);
     if (mysqli_num_rows($result) > 0) {
         while($row = mysqli_fetch_assoc($result)) {
             echo '<div id="cardQr'.$row['tableID'].'" class="card-window">
                     <div class="card-add">
                         <span class="close-button" onclick="closeCardQr('.$row['tableID'].')">&times;</span>
                     
                         <div class="card-content">
                             <div class="container">
                                 <div style="height: 50px;"></div>
                                 <h3>QR CODE สำหรับลูกค้าโต๊ะ '.$row['tableID'].'</h3>
                                 <hr color=black size=30>
                                 <div class="number-image">
                                    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https://amesupakorn.github.io/webyummy?tableId='.$row['tableID'].'" title="Link to my Website" /> </div>
                               
                             </div>
                             <button id="confirmButton"  class="btn btn-primary" onclick="printQRCode('.$row['tableID'].')">พิมพ์ QR Code</button>
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