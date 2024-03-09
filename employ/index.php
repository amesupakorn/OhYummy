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
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'><link rel="stylesheet" href="./style.css">

    <title>สรุปผล</title>
</head>
<body style="background-color: #F0F0F0; color: black; font-family: Noto Sans Thai, sans-serif; ">
<nav class="nav">
        <a href="editMenu/index.php" class="nav__link">
			<i class="material-icons nav__icon">restaurant_menu</i>
			<span class="nav__text">จัดการเมนู</span>
		</a>
		
		<a href="status_menu/index.php" class="nav__link">
			<i class="material-icons nav__icon">reorder</i>
			<span class="nav__text">ดูสถานะออเดอร์</span>
		</a>
		<a href="kitchen_status/index.php" class="nav__link">
			<i class="material-icons nav__icon">soup_kitchen</i>
			<span class="nav__text">จัดการออเดอร์ (ครัว)</span>
		</a>
		<a href="#" class="nav__link nav__link--active">
			<i class="material-icons nav__icon">dashboard</i>
			<span class="nav__text">หน้าหลัก</span>
		</a>
        <a href="editTable/index.php" class="nav__link">
			<i class="material-icons nav__icon">table_restaurant</i>
			<span class="nav__text">จัดการโต๊ะ</span>
		</a>
        <a href="status_reserve/index.php" class="nav__link">
			<i class="material-icons nav__icon">install_mobile</i>
			<span class="nav__text">จัดการจองโต๊ะ</span>
		</a>
		<a href="bill/index.php"  class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="billHistory/index.php"class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>
    
    <?php
          session_start();
          include('../connectDatabase/connectToDatabase.php');

          $conn = new database();
    ?>


<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0 d-flex align-items-center">                            <!-- Title -->
                            <img alt="..." src="../image_logo/logo.png" class="avatar avatar-lg rounded-circle me-2">
                            <h1 class="h2 mb-0 ls-tight">&nbsp;&nbsp;โอ้อร่อย</h1>
                        </div>
                        <div style="height: 20px;"></div>
                        
                    </div>
                    <!-- Nav -->
                  
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary" >
            <div class="container-fluid">
                <!-- Card stats -->
                <div class="row g-6 mb-6">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-lg d-block mb-2">รายการอาหาร</span>
                                    <?php
                                        $sql = "SELECT * FROM Menu WHERE menu_status = 'on'";
                                        $num = mysqli_num_rows(mysqli_query($conn->getDatabase(), $sql));
        
                                        echo '<span class="h3 font-bold mb-0">'.$num.'</span>';
                                    ?>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                            <i class="bi bi-cart-check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                    <span class="text-nowrap text-sm text-muted">รายการอาหารที่ลงขายประจำวัน</span>
                                    <a href="../editMenu/index.php"><button type="button" style="padding: 2px 2px; background-color: #f6f9fc; color: black;"
                                     class="avatar avatar-xs rounded-circle ">></button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-lg d-block mb-2">จำนวนโต๊ะว่าง</span>
                                        <?php
                                        $sql = "SELECT * FROM Tables WHERE table_status = 'empty'";
                                        $num = mysqli_num_rows(mysqli_query($conn->getDatabase(), $sql));
        
                                        echo '<span class="h3 font-bold mb-0">'.$num.'</span>';
                                    ?>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                        <i class="bi bi-shop"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                 
                                    <span class="text-nowrap text-sm text-muted">สถานะโต๊ะว่าง</span>
                                    <a href="../editTable/index.php"><button type="button" style="padding: 2px 2px; background-color: #f6f9fc; color: black;" class="avatar avatar-xs rounded-circle ">></button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-lg d-block mb-2">ออเดอร์ทั้งหมด</span>
                                        <?php
                                        $sql = "SELECT * FROM OrderTable";
                                        $num = mysqli_num_rows(mysqli_query($conn->getDatabase(), $sql));
        
                                        echo '<span class="h3 font-bold mb-0">'.$num.'</span>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                        <i class="bi bi-bag-check"></i>
                                      </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                 
                                    <span class="text-nowrap text-sm text-muted">ออเดอร์ที่กำลังดำเนินการ</span>
                                    <a href="../Kitchen_status/index.php"><button type="button" style="padding: 2px 2px; background-color: #f6f9fc; color: black;" class="avatar avatar-xs rounded-circle ">></button></a>

                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card shadow border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h6 font-semibold text-muted text-lg d-block mb-2">จำนวนเงินทั้งหมด</span>
                                        <?php
                                        $total = 0;
                                        $sql = "SELECT * FROM Bill WHERE billStatus = 'yes'";
                                        $num = mysqli_query($conn->getDatabase(), $sql);
                                    
                                        if (mysqli_num_rows($num) > 0) {
                                            while($row = mysqli_fetch_assoc($num)) {
                                                $total += $row['billTotal'];
                                            }
                                        }
                                        echo '<span class="h3 font-bold mb-0">'.$total.'.00</span>';
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white text-lg rounded-circle">
                                        <i class="bi bi-credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-0 text-sm">
                                 
                                    <span class="text-nowrap text-sm text-muted">จำนวนบิลที่สำเร็จ</span>
                                    <a href="../billHistory/index.php"><button type="button" style="padding: 2px 2px; background-color: #f6f9fc; color: black;" class="avatar avatar-xs rounded-circle ">></button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    

                
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <div class="row">

                            <h5 class="mb-0 col-11">โต๊ะภายในร้าน</h5>
                            <a href="../editTable/index.php" class="col-1"><button type="button" style="padding: 2px 10px" class="btn btn-primary">รายละเอียด</button></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">โต๊ะเลขที่</th>
                                    <th scope="col">จำนวนที่นั่ง</th>
                                    <th scope="col">สถานะเมนู</th>
                                    <th scope="col">เวลาที่เข้า</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sqlMenu = "SELECT * FROM Tables LIMIT 3;";
                                    $result = mysqli_query($conn->getDatabase(), $sqlMenu);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                                    <tr>
                                                        <td>
                                                            <a class="text-heading font-semibold" href="#">
                                                                '.$row['tableID'].'
                                                            </a>
                                                        </td>
                                                        <td>
                                                            '.$row['seat'].'
                                                        </td>
                                                        <td>';
                                                            if($row['table_status'] == 'empty'){
                                                                echo '<span class="badge badge-lg badge-dot">
                                                                <i class="bg-secondary"></i>ว่าง
                                                            </span>';
                                                            }elseif($row['table_status'] == 'full'){
                                                                echo '<span class="badge badge-lg badge-dot">
                                                                <i class="bg-success"></i>มีลูกค้า
                                                            </span>';
                                                            }elseif($row['table_status'] == 'reserve'){
                                                                echo '<span class="badge badge-lg badge-dot">
                                                                <i class="bg-warning"></i>จอง
                                                            </span>';
                                                            }

                                                          
                                                       echo '</td>
                                                            <td>';

                                                            if($row['checkIn'] == NULL){
                                                                echo 'ยังไม่มีเวลาเข้า';
                                                            }else{
                                                                echo $row['checkIn'];
                                                            }

                                                            '</td>
                                                
                                                    </tr>';
                                        }
                                    }
                                ?>
         
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0 py-5">
                    </div>
                </div>



                
                <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <div class="row">

                            <h5 class="mb-0 col-11">เมนูอาหาร</h5>
                            <a href="../editMenu/index.php" class="col-1"><button type="button" style="padding: 2px 10px" class="btn btn-primary">รายละเอียด</button></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th scope="col">ราคาเมนู</th>
                                    <th scope="col">สถานะเมนู</th>
                                    <th scope="col">ชนิดของเมนู</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sqlMenu = "SELECT * FROM Menu LIMIT 3;";
                                    $result = mysqli_query($conn->getDatabase(), $sqlMenu);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                                    <tr>
                                                        <td>
                                                            <img alt="..." src="../image_menu/'.$row['image_menu'].'" class="avatar avatar-sm rounded-circle me-2">
                                                            <a class="text-heading font-semibold" href="#">
                                                                '.$row['menu_name'].'
                                                            </a>
                                                        </td>
                                                        <td>
                                                            '.$row['menu_price'].' ฿
                                                        </td>
                                                        <td>';
                                                            if($row['menu_status'] == 'on'){
                                                                echo '<span class="badge badge-lg badge-dot">
                                                                <i class="bg-success"></i>เปิดใช้งาน
                                                            </span>';
                                                            }else{
                                                                echo '<span class="badge badge-lg badge-dot">
                                                                <i class="bg-danger"></i>เปิดใช้งาน
                                                            </span>';
                                                            }

                                                          
                                                       echo '</td>
                                                        <td>'; 
                                                        if($row['menu_type'] == 'main'){
                                                            echo 'เมนูหลัก';
                                                        }
                                                        elseif($row['menu_type'] == 'snack'){
                                                            echo 'ของกินเล่น';
                                                        }
                                                        elseif($row['menu_type'] == 'drink'){
                                                            echo 'เครื่องดื่ม';
                                                        }
                                                        elseif($row['menu_type'] == 'dessert'){
                                                            echo 'ของหวาน';
                                                        }
                                                        elseif($row['menu_type'] == 'soup'){
                                                            echo 'ซุป';
                                                        }
                                                            
                                                      echo  '</td>
                                                
                                                    </tr>';
                                        }
                                    }
                                ?>
         
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-0 py-5">
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- partial -->
  
</body>
</html>
