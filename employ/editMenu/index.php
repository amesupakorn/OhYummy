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

    <title>จัดการเมนู</title>
</head>
<body style="background-color: #f6f9fc; color: black; font-family: Noto Sans Thai, sans-serif;">
    <nav class="nav">
        <a href="../editMenu/index.php" class="nav__link nav__link--active">
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
		<a href="../billHistory/index.php" class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>
    
    <?php
          session_start();
          include('../../connectDatabase/connectToDatabase.php');

          $conn = new database();

        

          if(isset($_POST['save'])){

            $menu_name = $_POST['menu_name'];
            $menu_price = $_POST['menu_price'];
            $menu_type = $_POST['menu_type'];

            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
            
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            
            $allowed = array('jpg', 'jpeg', 'png', 'pdf');
            
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../../image_menu/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);            
                    
                    $sql = "INSERT INTO Menu(menu_name, menu_price, menu_status, image_menu, menu_type) VALUES ('$menu_name', '$menu_price', 'on', '$fileNameNew', '$menu_type')";                        
                    mysqli_query($conn->getDatabase(), $sql);
                        
                    } else {
                        echo "error upload";
                }
            }
          }


          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['menu_id']) && isset($_POST['menu_status'])) {
                $menuid = $_POST['menu_id'];
                $menusta = $_POST['menu_status'];

            
                $query = "UPDATE Menu SET menu_status = '$menusta' WHERE menuID = $menuid";
                mysqli_query($conn->getDatabase(), $query);
            

            }

            if(isset($_POST['menu_pri'])){
                $menuprice = $_POST['menu_pri'];
                $menuid = $_POST['menu_id'];
                $menutype = $_POST['menu_ty'];
                
                // ใช้เครื่องหมายเครื่องหมายจุลภาคในคำสั่ง SQL เพื่อระบุค่าแบบข้อความ
                $querymenu = "UPDATE Menu SET menu_price = $menuprice, menu_type = '$menutype' WHERE menuID = $menuid";
                
                // ส่ Exec คำสั่ง SQL
                mysqli_query($conn->getDatabase(), $querymenu);
                
                
            }


            if(isset($_POST['menuDelete'])){
                $menuDelete = $_POST['menuDelete'];

                $querydel = "DELETE FROM Menu WHERE menuID = $menuDelete";
                mysqli_query($conn->getDatabase(), $querydel);

            }
            
        }



            
        
    ?>
    <div style="height: 20px;"></div>
    <div class="container-fluid mx-3">
     <div class="texthead">
        <div style="height: 20px;"></div>
        <?php 
                $num = mysqli_num_rows($conn->executeQuery("Menu"));
                echo  "<h3>&nbsp;&nbsp;&nbsp;รายการอาหารทั้งหมด $num รายการ | <span id=clock></span></h3>";
            ?>
        <div style="height: 10px;"></div>
      </div>
    </div>
            



<div class="container">
    
  <div class="row py-4">
    <div class="headcenter"> 
        <div class="headmenu">
                <div class="row">
                    <div class="col-md-3 my-2">
                        <h4>ชนิดของอาหาร : </h4>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6 col-md-4 col-lg-2 my-3">
                                    <button style="padding: 2px 15px;"  id="filterAllButton" type="button" class="btn btn-dark">ทั้งหมด</button>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2 my-3">
                                    <button style="padding: 2px 10px;" id="filterMainButton" type="button" class="btn btn-light">&nbsp;เมนูหลัก&nbsp;</button>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2 my-3">
                                    <button style="padding: 2px 10px;" id="filterPlayButton" type="button" class="btn btn-light">&nbsp;&nbsp;กินเล่น&nbsp;&nbsp;</button>
                                </div>
                    
                                <div class="col-6 col-md-4 col-lg-2 my-3">
                                    <button  style="padding: 2px 10px;" id="filterSweetButton" type="button" class="btn btn-light">ของหวาน</button>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2 my-3">
                                    <button style="padding: 2px 10px;" id="filterDrinkButton" type="button" class="btn btn-light">เครื่องดื่ม</button>
                                </div>
                                <div class="col-6 col-md-4 col-lg-2 my-3">
                                    <button style="padding: 2px 10px;" id="filterSoupButton" type="button" class="btn btn-light">&nbsp;&nbsp;&nbsp;&nbsp;ซุป&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 my-3">
                            <button style="padding: 4px 10px;" type="button" onclick="openCard()" class="btn btn-success">เพิ่มรายการอาหาร</button>
                        </div>
                    </div>
            </div>
            <div style="height: 20px"></div>

    </div>
    
    <div class="col-12">
      <table id="example" class="table table-hover responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th></th>
            <th>สถานะ</th>
            <th>เมนูที่</th>
            <th>ชื่อเมนู</th>
            <th>ราคาเมนู</th>
            <th>ชนิดของเมนู</th>
            <th>แก้ไขข้อมูล</th>
            <th>เปลี่ยนแปลงสถานะ</th>
          </tr>
        </thead>
        <tbody>
            <?php
                $sqlMenu = "SELECT * FROM Menu;";
                $result = mysqli_query($conn->getDatabase(), $sqlMenu);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                       echo '<tr>
                                <td>
                                   <img src="../../image_menu/'.$row['image_menu'].'" style="height: 110px;" alt="">
                                </td>
                                <td style="vertical-align: middle;">';  
                               if($row['menu_status'] == 'on'){
                                echo '<button type="button" class="btn btn-success" style="padding: 2px 10px;">เปิดใช้งาน</button>';
                               } 
                               elseif($row['menu_status'] == 'off'){
                                echo '<button type="button" class="btn btn-secondary" style="padding: 2px 10px;">ปิดใช้งาน</button>';
                               }
                        
                                   
                       echo     '</td>
                                <td style="vertical-align: middle;">
                                    '.$row['menuID'].'
                                </td>
                                <td style="vertical-align: middle;">
                                    '.$row['menu_name'].'
                                </td>
                                <td style="vertical-align: middle;">
                                    '.$row['menu_price'].'
                                </td>
                                <td style="vertical-align: middle;">';
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
                      
                                echo '</td>';

                                if($row['menu_status'] == 'off'){
                                    echo  '<td style="vertical-align: middle;">
                                                <button  id="confirmButton"  type="button" class="btn btn-success" onclick="updateMenuStatus('.$row['menuID'].', \'on\')" style="padding: 2px 10px;">เปิดใช้งาน</button>
                                            </td>';

                                }
                                elseif($row['menu_status'] == 'on'){
                                    echo  '<td style="vertical-align: middle;">
                                         <button  id="confirmButton"  type="button" class="btn btn-secondary" onclick="updateMenuStatus('.$row['menuID'].', \'off\')" style="padding: 2px 10px;">ปิดใช้งาน</button>
                                        </td>';
                                }
                                
                                
                                echo   '<td style="vertical-align: middle;">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded" data-toggle="tooltip" data-placement="top"
                                                    title="แก้ไขข้อมูล"></i>
                                                </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <a class="dropdown-item" onclick="openCardEdit('.$row['menuID'].')" ><i class="bx bxs-pencil mr-2"></i>แก้ไขข้อมูล</a>
                                                <a class="dropdown-item text-danger" onclick="deleteMenu('.$row['menuID'].')"><i class="bx bxs-trash mr-2"></i>ลบข้อมูลออก</a>
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

        <div id="addMenu" class="card-window">
            <div class="card-add">
                    <span class="close-button" onclick="closeCard()">&times;</span>         
                 <div class="card-content">
                    <div class="container">
                                 <div style="height: 50px;"></div>
                                 <h3>เพิ่มรายการอาหาร</h3>
                                 <hr color=black size=30>
                                <form action="index.php" method="post"  enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">ชื่อเมนู</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="menu_name" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ราคาเมนู</label>
                                        <div class="col-sm-9">
                                        <input type="number" name="menu_price" class="form-control"  placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">ชนิดของเมนู</label>
                                        <div class="col-sm-9">
                                            <select name="menu_type" class="custom-select">
                                                <option selected>เลือกชนิดของเมนู</option>
                                                <option value="main">เมนูหลัก</option>
                                                <option value="snack">ของกินเล่น</option>
                                                <option value="dessert">ของหวาน</option>
                                                <option value="drink">เครื่องดื่ม</option>
                                                <option value="soup">ซุป</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3 col-form-label">เลือกไฟล์รูปภาพ</label>
                                        <div class="col-sm-9">
                                                <input type="file" name="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="exampleFormControlFile1" onchange="previewImage(event)">
                                        </div>
                                    </div>


                                 <div style="height: 50px;"></div>


                                <img id="previewImage" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 50%;">

                                <button id="confirmButton" name="save" class="btn btn-primary">เพิ่มรายการอาหาร</button>
                                </form>
                            </div>
                         </div>
                     </div>
                 </div>


        <?php
            $sqlMe = "SELECT * FROM Menu;";
            $resultmenu = mysqli_query($conn->getDatabase(), $sqlMe);
            if (mysqli_num_rows($resultmenu) > 0) {
                while($rowmenu = mysqli_fetch_assoc($resultmenu)) {
                
                echo '<div id="editMenu'.$rowmenu['menuID'].'" class="card-window">
                            <div class="card-add">
                                    <span class="close-button" onclick="closeCardEdit('.$rowmenu['menuID'].')">&times;</span>         
                            <div class="card-content">
                                    <div class="container">
                                                <div style="height: 50px;"></div>
                                                <h3>แก้ไขข้อมูล รายการอาหาร</h3>
                                                <hr color=black size=30>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">ชื่อเมนู</label>
                                                        <div class="col-sm-9">
                                                        <input id="menu_name" type="text" name="menu_name" class="form-control" placeholder="'.$rowmenu['menu_name'].'" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">ราคาเมนู</label>
                                                        <div class="col-sm-9">
                                                        <input id="menu_price'.$rowmenu['menuID'].'" type="number" name="menu_price" class="form-control"  placeholder="'.$rowmenu['menu_price'].'">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">ชนิดของเมนู</label>
                                                        <div class="col-sm-9">
                                                            <select id="menu_type'.$rowmenu['menuID'].'" name="menu_type" class="custom-select">
                                                                <option selected>เลือกชนิดของเมนู</option>
                                                                <option value="main">เมนูหลัก</option>
                                                                <option value="snack">ของกินเล่น</option>
                                                                <option value="dessert">ของหวาน</option>
                                                                <option value="drink">เครื่องดื่ม</option>
                                                                <option value="soup">ซุป</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div style="height: 50px;"></div>

                                                    <button id="confirmButton" class="btn btn-primary" onclick="updateMenu('.$rowmenu['menuID'].')">เปลี่ยนแปลง รายการอาหาร</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>';
                    }
                }

            ?>




<div style="height: 100px;"></div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script><script  src="./script.js"></script>

</body>
</html> 