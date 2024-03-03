

function openCardBill(id) {
    document.getElementById("cardBill" + id).style.display = "block";
    document.getElementById("cardOverlay").style.display = "block";

}

function closeCardBill(id) {
    document.getElementById("cardBill" + id).style.display = "none";
    document.getElementById("cardOverlay").style.display = "none";
}


function updateBill(id, billid) {
    // ส่งค่า table_status และ tableID ไปยัง PHP script ด้วย Fetch API
    let formData = new URLSearchParams();
    formData.append('table_id', id);
    formData.append('bill_id', billid);
    
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
                title: "เช็คบิลเสร็จสิ้น",
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
document.addEventListener("DOMContentLoaded", function () {
        // ซ่อน div เมื่อหน้าเว็บโหลด
        var hiddenDivs = document.querySelectorAll(".sol1-bill, .sol2-bill");
        hiddenDivs.forEach(function(hiddenDiv) {
            hiddenDiv.classList.add("d-none");
        });
    });



    
    function toggleHiddenDiv(visibleId, hiddenId, id) {
        var visibleDiv = document.getElementById(visibleId);
        var hiddenDiv = document.getElementById(hiddenId);
    
        // ตรวจสอบว่า div ที่ต้องการซ่อนอยู่หรือไม่
        if (visibleDiv && !visibleDiv.classList.contains("d-none")) {
            // ถ้า div ที่เป็น visible ไม่ถูกซ่อนอยู่อยู่แล้ว
            visibleDiv.classList.add("d-none");
            document.getElementById("bill" + id).classList.remove("col-md-8");
            document.getElementById("bill" + id).classList.add("col-md-12");
        } else {
            // ถ้า div ที่เป็น visible ถูกซ่อนอยู่อยู่แล้ว
            if (visibleDiv) {
                visibleDiv.classList.remove("d-none");
                document.getElementById("bill" + id).classList.remove("col-md-12");
                document.getElementById("bill" + id).classList.add("col-md-8");
            }
        }
    
        // ตรวจสอบว่า div ที่ต้องการแสดงอยู่หรือไม่
        if (hiddenDiv && !hiddenDiv.classList.contains("d-none")) {
            // ถ้า div ที่เป็น hidden ไม่ถูกซ่อนอยู่อยู่แล้ว
            hiddenDiv.classList.add("d-none");
        }
    }
    



  function calculateChange(id) {
  // รับค่าที่ผู้ใช้ป้อน
  var moneyInput = document.getElementById("moneyInput"+id).value;
  var money = parseFloat(moneyInput);
  console.log(money)

  var billTotal = document.getElementById("billTotal"+id).innerText;
  var bill = parseFloat(billTotal);
  console.log(bill)

  // คำนวณเงินทอน
  var change = money - bill;

  // แสดงจำนวนเงินทอน
  document.getElementById("changeAmount"+id).innerHTML = change+".00";
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

