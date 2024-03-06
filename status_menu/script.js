
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
          { targets: [4], orderable: false }, // เลขคอลัมน์ที่ไม่ต้องการให้เรียง
      ]
  });

  $(".dataTables_filter input")
  .attr("placeholder", "ค้นหา...")
  .css({
    width: "300px",
    display: "inline-block"
  });

  
  $('[data-toggle="tooltip"]').tooltip();



// เปลี่ยน jQuery selector เป็นการใช้ id ของปุ่มโดยตรง
$('#filterAllButton').click(function() {
  $('#example').DataTable().column(1).search('').draw();
});

$('#filtertakeButton').click(function() {
  $('#example').DataTable().column(1).search('รอดำเนินการ').draw();
});

$('#filterdoingButton').click(function() {
  $('#example').DataTable().column(1).search('กำลังทำ').draw();
});

$('#filterfinButton').click(function() {
  $('#example').DataTable().column(1).search('เสร็จสิ้น').draw();
});

});



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