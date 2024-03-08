<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="image_logo/logo.png" />
    <link href="styles.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"><script src="https://kit.fontawesome.com/c1134aa968.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">
    <title></title>
</head>
<body style="background-color: #f6f9fc; font-family: Noto Sans Thai, sans-serif;">

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
	
		<a href="../bill/index.php"  class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="../billHistory/index.php" class="nav__link nav__link--active">
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
                $num = mysqli_num_rows($conn->executeQuery("Bill"));
                echo  "  <h3>&nbsp;&nbsp;&nbsp;ประวัติใบเสร็จ $num | <span id='clock'></span></h3>";
            ?>
        <div style="height: 10px;"></div>
      </div>
    </div>

   

          <div class="container">
            <div class="row py-5">
              <div class="col-12">
                <table id="example" class="table table-hover responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>ออเดอร์</th>
                      <th>โต๊ะเลขที่</th>
                      <th>วันที่จ่ายเงิน</th>
                      <th>ราคารวม</th>
                      <th>รายการอาหารทั้งหมด</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sqlB = "SELECT * FROM Bill  WHERE billStatus = 'yes';";
                      $resultBill = (mysqli_query($conn->getDatabase(), $sqlB));
                      $object = mysqli_fetch_assoc(mysqli_query($conn->getDatabase(), $sqlB));
                  
                      $orderidbill = $object['orderid'];

                      $select_sql = "SELECT orderMenu FROM OrderTable WHERE orderid = '$orderidbill'";
                      $resultorder = mysqli_query($conn->getDatabase(), $select_sql);
                      
                        if (mysqli_num_rows($resultBill) > 0) {
                          while ($row = mysqli_fetch_assoc($resultBill)) {
                            $orderid = $row['orderid'];
                            echo '<tr>
                                    <td style="vertical-align: middle;">'.$orderid.'</td>
                                    <td style="vertical-align: middle;">'.$row['tableID'].'</td>
                                    <td style="vertical-align: middle;">'.$row['billTime'].'</td>
                                    <td style="vertical-align: middle;">'.$row['billTotal'].'</td> 
              
                                    <td>
                                      <div class="dropdown">
                                        <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                                                title="Actions"></i>
                                            </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                          <a class="dropdown-item">
                                            <table border="0" style="text-align: left;" class="col-12">
                                              <tr class="th">
                                                <th class="menu" scope="col">รายการอาหาร</th>
                                                <th scope="col" >ราคา(฿)</th>
                                                <th scope="col">จำนวน</th>
                                                <th scope="col">ราคารวม(฿)</th>
                                              </tr>';
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
                                  echo              '<tr>
                                                      <td class="menu">'.$rowmenu['menu_name'].'</td>
                                                      <td>'.$rowmenu['menu_price'].'.00</td>
                                                      <td>'.$menu_count.'</td>
                                                      <td>'.$rowmenu['menu_price']*$menu_count.'.00</td>
                                                    </tr>';
                                                  }
                                                }

                                 
                                }

                                echo '  </table>
                                      </a>
                                    </div>
                                  </div>
                                </td>
                              </tr>';
                              }
                            }
                          }
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