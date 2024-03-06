<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="png" sizes="96x96" href="logo.png" />
    <link href="style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <link rel="stylesheet" href="style.css" />
    <title>จองโต๊ะ</title>

  </head>
  <body
    style="
      background-color: #1a1a1a;
      color: azure;
      font-family: Noto Sans Thai, sans-serif;
    "
  >
  <?php
     session_set_cookie_params(0);
	 session_start();
	 include('../connectDatabase/connectToDatabase.php');

	 $conn = new database();  

	 if(isset($_GET['tableId'])) {
		// กำหนดค่าใน $_COOKIE โดยตรง
		setcookie('tableId', $_GET['tableId'], 0, '/'); // 0 คือ session cookie จะหมดอายุเมื่อเบราว์เซอร์ปิด
	}


?>
	<div class="navigation-wrap start-header start-style">
		<div class="container" >
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
								echo '<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
										<a class="nav-link" href="../reserve/reserve.php">จองโต๊ะ</a>
									</li>';
							}else{
								echo '<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
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



  <div class="fixed-image">

</div>
  <div class="texthead">
      <h1>จองโต๊ะ</h1>
      <p>เพื่อช่วยเราค้นหาโต๊ะที่ดีที่สุดสำหรับคุณ ให้เลือกจำนวนคน วันที่ และเวลาที่คุณต้องการจอง</p>
    </div>

<div class=container-fluid>
  

</div>


    <div class="content" style="height: 50px"></div>

    <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['name']) && isset($_POST['tel']) && isset($_POST['seat']) && isset($_POST['email']) && isset($_POST['date'])){
              
              $name = $_POST['name'];
              $tel = $_POST['tel'];
              $email = $_POST['email'];
              $seat = $_POST['seat'];
              $date = $_POST['date'];
              echo 'dd';
              $sql = "INSERT INTO Reserve(cust_Name, cust_Tel, email, Reserve_time) VALUES ('$name', '$tel', '$email', $date)";
              mysqli_query($conn->getDatabase(), $sql);
            }
          
          }
    ?>

    
    <div class="container">
      <div class="form-row">
          <div class="form-group col-md-6">
              <label for="input">จำนวนที่นั่ง</label>
  
                  <select id="countries" class="border-gray-300 py-2 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a country</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                  </select>
              
            </div>
            <div class="form-group col-md-6">
              <label for="input">&nbsp;&nbsp;&nbsp;&nbsp;วันที่</label>
              <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                <div class="mb-5 w-100 ">
                  <div class="relative">
                    <input type="hidden" name="date" x-ref="date" :value="datepickerValue" />
                    <input type="text" x-on:click="showDatepicker = !showDatepicker" x-model="datepickerValue" x-on:keydown.escape="showDatepicker = false" class=" bg-white w-full pl-4 py-2 leading-none rounded-lg shadow-sm focus:outline-none text-gray-600 font-medium focus:ring focus:ring-blue-600 focus:ring-opacity-50" placeholder="Select date" readonly />

                    <div class="absolute top-0 right-0 px-3 py-2">
                      <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
                    <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0" style="width: 30rem" x-show.transition="showDatepicker" @click.away="showDatepicker = false">
                      <div class="flex justify-between items-center mb-2">
                        <div>
                          <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                          <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div>
                          <button type="button" class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full" @click="if (month == 0) {
                                  year--;
                                  month = 12;
                                } month--; getNoOfDays()">
                            <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                          </button>
                          <button type="button" class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full" @click="if (month == 11) {
                                  month = 0; 
                                  year++;
                                } else {
                                  month++; 
                                } getNoOfDays()">
                            <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                          </button>
                        </div>
                      </div>

                      <div class="flex flex-wrap mb-3 -mx-1">
                        <template x-for="(day, index) in DAYS" :key="index">
                          <div style="width: 14.26%" class="px-0.5">
                            <div x-text="day" class="text-gray-800 font-medium text-center text-xs"></div>
                          </div>
                        </template>
                      </div>

                      <div class="flex flex-wrap -mx-1">
                        <template x-for="blankday in blankdays">
                          <div style="width: 14.28%" class="text-center p-1 border-transparent text-sm"></div>
                        </template>
                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                          <div style="width: 14.28%" class="px-1 mb-1">
                            <div @click="getDateValue(date)" x-text="date" class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100" :class="{
                                'bg-indigo-200': isToday(date) == true, 
                                'text-gray-600 hover:bg-indigo-200': isToday(date) == false && isSelectedDate(date) == false,
                                'bg-indigo-500 text-white hover:bg-opacity-75': isSelectedDate(date) == true 
                              }"></div>
                          </div>
                        </template>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          


    <hr style="width: 100%; ">
    <div style="height: 30px"></div> 
    
    <h5>เลือกช่วงเวลาที่มี:</h5>

    <div class="button-container">
    <button class="button">11.00 น.</button>
    <button class="button">11.30 น.</button>
    <button class="button">12.00 น.</button>
    <button class="button">12.30 น.</button>
    <button class="button">13.00 น.</button>
  </div>
  <div class="button-container">
    <button class="button">13.30 น.</button>
    <button class="button">14.00 น.</button>
    <button class="button">14.30 น.</button>
    <button class="button">15.00 น.</button>
    <button class="button">15.30 น.</button>
  </div>
  <div class="button-container">
    <button class="button">16.00 น.</button>
    <button class="button">16.30 น.</button>
    <button class="button">17.00 น.</button>
    <button class="button">17.30 น.</button>
    <button class="button">18.00 น.</button>
  </div>

      <div class="center-container"><br>
        <button style="width: 300px;" id="confirmButton" class="btn btn-danger" onclick="updateReview()" >ยืนยัน</button><br><br>
      </div>
    </div>
    <!-- --------------------------------------------------------------------------------- -->


    <div style="height: 100px;"></div>

  <footer>
    <div style="height: 30px;"></div>

        <div>
          <p>หน้าหลัก | รายการอาหาร | จองโต๊ะ | รีวิวจากลูกค้า</p>
        </div>
        <img src="../image_logo/logotab.png" alt="">
          <div style="height: 30px;"></div>
          <div class="copyright">
            &copy; OHYUMMY 2024
        </div>
        <div style="height: 30px;"></div>

	</footer>


    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="./reserve.js"></script>
    
  </body>
</html>