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


$(document).ready(function() {
    $("#example").DataTable({
      "language": {
        "lengthMenu": "แสดง _MENU_ แถว",
        "zeroRecords": "ไม่พบข้อมูล",
      "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
      "infoEmpty": "ข้อมูลไม่พร้อมใช้งาน",
      "search": "ค้นหาประวัติ",
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
        {
          responsivePriority: 1,
          targets: 0
        },
        {
          responsivePriority: 2,
          targets: -1
        }
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


