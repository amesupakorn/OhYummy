
$(document).ready(function() {
    $("#example").DataTable({
        "language": {
          "lengthMenu": "แสดง _MENU_ แถว",
          "zeroRecords": "ไม่พบข้อมูล",
        "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
        "infoEmpty": "ข้อมูลไม่พร้อมใช้งาน",
        "search": "ค้นหาออเดอร์",
        
  
        "paginate": {
          "first": "หน้าแรก",
          "previous": "ก่อนหน้า",
          "next": "ถัดไป",
          "last": "หน้าสุดท้าย"
      },
        },
        aaSorting: [],
        responsive: true,
        columnDefs: [
            { targets: [2,3,4], orderable: false }, // เลขคอลัมน์ที่ไม่ต้องการให้เรียง
        ]
    });
  
    $(".dataTables_filter input")
    .attr("placeholder", "ค้นหา...")
    .css({
      width: "300px",
      display: "inline-block"
    });
  
    
    $('[data-toggle="tooltip"]').tooltip();
  

  
  });
  
  
  
  var clockElement = document.getElementById('clock');
  
  function updateClock() {
      var now = new Date();
      var hours = now.getHours();
      var minutes = now.getMinutes();
      var seconds = now.getSeconds();
      var currentDate = new Date().toLocaleDateString()

      var timeString = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
  
      clockElement.textContent = currentDate + ' | ' + timeString;
  }
  
  function pad(num) {
      return (num < 10 ? "0" : "") + num;
  }
  
  setInterval(updateClock, 1000);
  updateClock();



  function updateStatus(id, status){
    let formData = new URLSearchParams();
    formData.append('reserve', id);
    formData.append('status', status);
    
    if(status == 'cancel'){
        Swal.fire({
            title: "ยกเลิกการจองใช่หรือไม่",
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
                                title: "ยกเลิกการจองสำเร็จ",
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
    }else{
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
                    title: "เปลี่ยนสถานะเสร็จสิ้น",
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
  }