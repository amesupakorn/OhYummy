$(document).ready(function() {
  $("#example").DataTable({
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
});


