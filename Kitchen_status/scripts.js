function updateOrderStatus(id, status, tableid, orderTotal) {
    // ส่งค่า table_status และ tableID ไปยัง PHP script ด้วย Fetch API
    let formData = new URLSearchParams();
    formData.append('order_id', id);
    formData.append('order_status', status);
    formData.append('table_id', tableid);
    formData.append('order_Total', orderTotal);

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

