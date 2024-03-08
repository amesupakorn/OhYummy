<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="../image_logo/logo.png" />
    <link href="styles.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"><script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    <title>เช็คสถานะออเดอร์</title>
</head>
<body style="background-color: #f6f9fc; font-family: Noto Sans Thai, sans-serif;">
<nav class="nav">
        <a href="../editMenu/index.php" class="nav__link">
			<i class="material-icons nav__icon">restaurant_menu</i>
			<span class="nav__text">จัดการเมนู</span>
		</a>
		
		<a href="../status_menu/index.php" class="nav__link nav__link--active">
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


    ?>


<div style="height: 20px;"></div>
		<div class="container-fluid mx-3">
			<div class="texthead">
        <div style="height: 20px;"></div>
        <?php 
                $num = mysqli_num_rows($conn->executeQuery("OrderTable"));
                echo  "<h3>&nbsp;&nbsp;&nbsp;สถานะออเดอร์ทั้งหมด $num ออเดอร์ | <span id=clock></span></h3>";
            ?>
        <div style="height: 10px;"></div>
      </div>
    </div>

    
          

      <div class="container">
        <div class="row py-4">
          <div class="headcenter"> 
                    <div class="row">
                          <div class="col-md-5 my-1">
                          <div class="headmenu">
                            <div class="row">
                              <div class="col-6 col-md-4 col-lg-3 my-3">
                                  <button style="padding: 2px 10px;" id="filterAllButton" type="button" class="btn btn-dark">&nbsp;&nbsp;ทั้งหมด&nbsp;&nbsp;</button>
                              </div>
                              <div class="col-6 col-md-4 col-lg-3 my-3">
                                  <button style="padding: 2px 10px;" id="filtertakeButton" type="button" class="btn btn-light">รอดำเนิดการ</button>
                              </div>
                              <div class="col-6 col-md-4 col-lg-3 my-3">
                                  <button style="padding: 2px 10px;" id="filterdoingButton" type="button" class="btn btn-light">&nbsp;&nbsp;&nbsp;&nbsp;กำลังทำ&nbsp;&nbsp;&nbsp;</button>
                              </div>
                              <div class="col-6 col-md-4 col-lg-3 my-3">
                                  <button style="padding: 2px 10px;" id="filterfinButton" type="button" class="btn btn-light">&nbsp;&nbsp;&nbsp;เสร็จสิ้น&nbsp;&nbsp;</button>
                              </div>

                                    </div>
                                </div>
                        </div>
                      </div>
                  </div>
            </div>



            <div class="row">
              <div class="col-12">
                <table id="example" class="table table-hover responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th></th>
                      <th>สถานะ</th>
                      <th>ออเดอร์ที่</th>
                      <th>โต๊ะที่</th>
                      <th>รายการอาหาร</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                      <?php
                      $sqlMenu = "SELECT * FROM OrderTable;";
                      $result = mysqli_query($conn->getDatabase(), $sqlMenu);
                      if (mysqli_num_rows($result) > 0) {
                          $num = 0;
                          while($row = mysqli_fetch_assoc($result)) {
                            $num++;
                            echo '<tr>';
                            echo '<td style="vertical-align: middle;">'.$num.'</td>';
                            echo '<td style="vertical-align: middle;">';
                            if($row['orderStatus'] == 'take'){
                              echo '<button type="button" class="btn btn-danger" style="padding: 2px 10px;">รอดำเนินการ</button>';
                            }
                            elseif($row['orderStatus'] == 'doing'){
                              echo '<button type="button" class="btn btn-warning" style="padding: 2px 20px;">กำลังทำ</button>';
                            }
                            elseif($row['orderStatus'] == 'finish'){
                              echo '<button type="button" class="btn btn-primary" style="padding: 2px 26px;">เสร็จสิ้น</button>';
                            }
            
                                     
                            echo '</td>';
                            echo '<td style="vertical-align: middle;">'.$row['orderID'].'</td>
                                  <td style="vertical-align: middle;">'.$row['tableid'].'</td>';

            
                            echo ' <td style="vertical-align: middle;">
                                      <div class="dropdown">
                                        <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                                                title="Actiosns"></i>
                                            </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                          <a class="dropdown-item">
                                              <div class="row">
                                                <div style="font-weight: bold;" class="col-8">รายการอาหาร</div>
                                                  <div style="font-weight: bold;" class="col-4">จำนวน</div>
                                                </div><br>
                                                <div class="menu">';
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

                                                        foreach ($order_items as $order_item) {
                                                          $menu_id =  $order_item['menuId'];
                                                          $name = "SELECT * FROM Menu WHERE menuID = $menu_id;";
                                                          $resultmenu = mysqli_query($conn->getDatabase(), $name);
                                                          if (mysqli_num_rows($resultmenu) > 0) {
                                                            while ($row = mysqli_fetch_assoc($resultmenu)) {

                                                              echo '<div class="row">
                                                                      <div class="col-9" >' . $row['menu_name'] . '</div>
                                                                      <div class="col-3">' . $order_item['menuCount'] . '</div>
                                                                    </div><br>';
                                                            }
                                                          }
                                                        }
                                                      }
                                                    }
                                                  }
                                                  echo       
                                                                  
                                                                '</div>
                                                                </div>
                                                              </div>
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
          
          <!-- partial -->
          <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js'></script>
          <script src='https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js'></script>
          <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script><script  src="./script.js"></script>
          
</body>
</html> 
