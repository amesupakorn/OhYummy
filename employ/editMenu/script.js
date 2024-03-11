


$(document).ready(function() {
        $("#example").DataTable({
          "language": {
            "lengthMenu": "แสดง _MENU_ แถว",
            "zeroRecords": "ไม่พบข้อมูล",
          "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
          "infoEmpty": "ข้อมูลไม่พร้อมใช้งาน",
          "search": "ค้นหาเมนู",
          "paginate": {
            "first": "หน้าแรก",
            "previous": "ก่อนหน้า",
            "next": "ถัดไป",
            "last": "หน้าสุดท้าย"
          }
        },
        aaSorting: [],
        responsive: true,
        columnDefs: [
            { targets: [0, 6, 7], orderable: false }, // เลขคอลัมน์ที่ไม่ต้องการให้เรียง
        ]
        
    });


    $(".dataTables_filter input")
    .attr("placeholder", "ค้นหา...")
    .css({
      width: "300px",
      display: "inline-block"
    });

  $('[data-toggle="tooltip"]').tooltip();

  $('#filterAllButton').click(function() {
    $('#example').DataTable().column(5).search('').draw();
  });

  $('#filterMainButton').click(function() {
    $('#example').DataTable().column(5).search('เมนูหลัก').draw();

  });
  $('#filterPlayButton').click(function() {
    $('#example').DataTable().column(5).search('กินเล่น').draw();

  });
  $('#filterSweetButton').click(function() {
    $('#example').DataTable().column(5).search('ของหวาน').draw();

  });
  $('#filterDrinkButton').click(function() {
    $('#example').DataTable().column(5).search('เครื่องดื่ม').draw();

  });
  $('#filterSoupButton').click(function() {
    $('#example').DataTable().column(5).search('ซุป').draw();

  });
});



function openCard() {
    document.getElementById("addMenu").style.display = "block";
    document.getElementById("cardOverlay").style.display = "block";
}

function closeCard() {
    document.getElementById("addMenu").style.display = "none";
    document.getElementById("cardOverlay").style.display = "none";
}


function openCardEdit(id) {
  document.getElementById("editMenu" + id).style.display = "block";
  document.getElementById("cardOverlay").style.display = "block";
}

function closeCardEdit(id) {
  document.getElementById("editMenu" + id).style.display = "none";
  document.getElementById("cardOverlay").style.display = "none";
}

function updateMenuStatus(id, status) {
    
    let formData = new URLSearchParams();
    formData.append('menu_id', id);
    formData.append('menu_status', status);
    
    fetch('./index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: formData.toString()
    })
    .then(response => {
        if (response.ok) {
            Swal.fire({
                icon: "success",
                title: "เปลี่ยนสถานะเมนูเสร็จสิ้น",
                showConfirmButton: false,
                timer: 3500
              });
            setTimeout(function() {
                location.reload();
            }, 1000);
            return response.text();
        }
        throw new Error('Network response was not ok.');
    })
    .catch(error => {
        alert('There was a problem with the fetch operation: ' + error.message);
    });
    
}

function updateMenu(id){

  let price = document.getElementById('menu_price' + id).value;
  let type = document.getElementById('menu_type' + id).value;

  let formData = new URLSearchParams();
    formData.append('menu_id', id);
    formData.append('menu_ty', type)
    formData.append('menu_pri', price);


    fetch('./index.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: formData.toString()
  })
  .then(response => {
      if (response.ok) {
          Swal.fire({
              icon: "success",
              title: "เปลี่ยนข้อมูลเสร็จสิ้น",
              showConfirmButton: false,
              timer: 3500
            });
          setTimeout(function() {
              location.reload();
          }, 1000);
          return response.text();
      }
      throw new Error('Network response was not ok.');
  })
  .catch(error => {
      alert('There was a problem with the fetch operation: ' + error.message);
  });
    
}


function deleteMenu(id) {
  let formData = new URLSearchParams();
  formData.append('menuDelete', id);

  Swal.fire({
      title: "คุณต้องการลบใช่ไหม?",
      text: "รายการอาหารนี้จะถูกลบ",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#137BFF",
      cancelButtonColor: "#d33",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก"

  }).then((result) => {

      if (result.isConfirmed) {
        
          fetch('./index.php', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/x-www-form-urlencoded',
                  },
                  body: formData.toString()
              })
              .then(response => {
                  if (response.ok) {
                      Swal.fire({
                          title: "ลบข้อมูลสำเร็จ",
                          icon: "success",
                          showConfirmButton: false,
                          timer: 1000

                      });
                      setTimeout(function() {
                          location.reload();
                      }, 1000);
                      return response.text();
                  }
                  throw new Error('Network response was not ok.');
              })
              .catch(error => {
                  alert('There was a problem with the fetch operation: ' + error.message);
              });
      }
  })
}

             
        
    


  function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewImage');
            output.src = reader.result;
            output.style.display = 'block'; // แสดงรูปภาพ
        }
        reader.readAsDataURL(event.target.files[0]);
    }


var clockElement = document.getElementById('clock');

function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    var timeString = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);

    clockElement.textContent = timeString;
}

function pad(num) {
    return (num < 10 ? "0" : "") + num;
}

setInterval(updateClock, 1000);
updateClock();