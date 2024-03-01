<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="png" sizes="96x96" href="logo.png" />
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
    <title>status</title>
</head>
<body style="background-color: #F0F0F0; font-family: Noto Sans Thai, sans-serif;">
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
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">dashboard</i>
			<span class="nav__text">Dashboard</span>
		</a>
        <a href="../editTable/index.php" class="nav__link">
			<i class="material-icons nav__icon">table_restaurant</i>
			<span class="nav__text">จัดการโต๊ะ</span>
		</a>
	
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">payments</i>
			<span class="nav__text">เช็คบิล</span>
		</a>
		<a href="#" class="nav__link">
			<i class="material-icons nav__icon">receipt_long</i>
			<span class="nav__text">ประวัติใบเสร็จ</span>
		</a>
	</nav>

    <div style="height: auto; background-color: white;">
      <div class="container">
        <div style="height: 30px;"></div>
            <h3>สถานะออเดอร์</h3>
        <div style="height: 10px;"></div>
      </div>
    </div>

          <div class="container">
            <div class="row py-5">
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
                    <tr>
                      <td style="vertical-align: middle;">1</td>
                      <td style="vertical-align: middle;">
                        <button type="button" class="btn btn-success" style="padding: 2px 10px;">เสร็จแล้ว</button>
                      </td>
                      <td style="vertical-align: middle;">1</td>
                      <td style="vertical-align: middle;">1</td>
                      <td style="vertical-align: middle;">
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
                                  <th scope="col">จำนวน</th>
                                </tr>
                                <tr>
                                  <td class="menu">รามยอน</td>
                                  <td>2</td>
                                </tr>
                                <tr>
                                  <td class="menu">บิบิมบับ</td>
                                  <td>1</td>
                                </tr>
                              </table>
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
            
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
