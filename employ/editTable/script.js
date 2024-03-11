
function openCardWindow() {
    document.getElementById("cardWindow").style.display = "block";
    document.getElementById("cardOverlay").style.display = "block";
}

function closeCardWindow() {
    document.getElementById("cardWindow").style.display = "none";
    document.getElementById("cardOverlay").style.display = "none";
}



function openCardWindow2(numId) {
    document.getElementById("cardWindow" + numId).style.display = "block";
    document.getElementById("cardOverlay").style.display = "block";
}

function closeCardWindow2(numId) {
    document.getElementById("cardWindow" + numId).style.display = "none";
    document.getElementById("cardOverlay").style.display = "none";
}

function openCardQr(numId) {
    document.getElementById("cardQr" + numId).style.display = "block";
    document.getElementById("cardOverlay").style.display = "block";
}

function closeCardQr(numId) {
    document.getElementById("cardQr" + numId).style.display = "none";
    document.getElementById("cardOverlay").style.display = "none";
}



function updateTableStatus(id, status) {
    // ส่งค่า table_status และ tableID ไปยัง PHP script ด้วย Fetch API
    let formData = new URLSearchParams();
    formData.append('table_id', id);
    formData.append('table_status', status);
    
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
                title: "เปลี่ยนสถานะโต๊ะเสร็จสิ้น",
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

function updateTable(id, seat) {
    if(seat != "เลือกจำนวนที่นั่ง"){
        let formData = new URLSearchParams();
        formData.append('table_id', id)
        formData.append('seattable', seat)
        
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
                    title: "เปลี่ยนแปลงเสร็จสิ้น",
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
    else{
        Swal.fire({
            icon: "error",
            title: "โปรดใส่ข้อมูล",
          });
    }
    
}


function insertTable() {
    let seat = document.getElementById('seatTable').value;
        let formData = new URLSearchParams();
        formData.append('insertSeat', seat)
        
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
                    title: "เสร็จสิ้น",
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

function printQRCode(id) {
    // สร้างตัวแปรใหม่สำหรับ QR Code
    
    const qrCodeImg = document.createElement('img');
    qrCodeImg.src = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https://amesupakorn.github.io/webyummy/?tabled='+ id;

    // สร้างตัวพิมพ์ใหม่
    const printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>QR Code</title></head><body style="text-align: center;">');
    printWindow.document.write('<h1>QR Code โต๊ะที่ '+ id +'</h1>');
    printWindow.document.write('<img src="' + qrCodeImg.src + '" alt="QR Code">');
    printWindow.document.write('</body></html>');

    // ปิดการเขียนเอกสารในหน้าพิมพ์
    printWindow.document.close();

    // พิมพ์เอกสาร
    printWindow.print();
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
