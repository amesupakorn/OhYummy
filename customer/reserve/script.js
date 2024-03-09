(function($) { "use strict";

	$(function() {
		var header = $(".start-style");
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
		
			if (scroll >= 10) {
				header.removeClass('start-style').addClass("scroll-on");
			} else {
				header.removeClass("scroll-on").addClass('start-style');
			}
		});
	});		
		
	//Menu On Hover
		
	$('body').on('mouseenter mouseleave','.nav-item',function(e){
			if ($(window).width() > 1000) {
				var _d=$(e.target).closest('.nav-item');_d.addClass('show');
				setTimeout(function(){
				_d[_d.is(':hover')?'addClass':'removeClass']('show');
				},1);
			}
	});	


	  
	
  })(jQuery);



document.addEventListener('DOMContentLoaded', createSelect, false);
function createSelect() {
    var select = document.getElementsByTagName('select'),
      liElement,
      ulElement,
      optionValue,
      iElement,
      optionText,
      selectDropdown,
      elementParentSpan;

      for (var select_i = 0, len = select.length; select_i < len; select_i++) {
        //console.log('selects init');

      select[select_i].style.display = 'none';
      wrapElement(document.getElementById(select[select_i].id), document.createElement('div'), select_i, select[select_i].getAttribute('placeholder-text'));

      for (var i = 0; i < select[select_i].options.length; i++) {
        liElement = document.createElement("li");
        optionValue = select[select_i].options[i].value;
        optionText = document.createTextNode(select[select_i].options[i].text);
        liElement.className = 'select-dropdown__list-item';
        liElement.setAttribute('data-value', optionValue);
        liElement.appendChild(optionText);
        ulElement.appendChild(liElement);

        liElement.addEventListener('click', function () {
          displyUl(this);
        }, false);
      }
    }
    function wrapElement(el, wrapper, i, placeholder) {
      el.parentNode.insertBefore(wrapper, el);
      wrapper.appendChild(el);

      document.addEventListener('click', function (e) {
        let clickInside = wrapper.contains(e.target);
        if (!clickInside) {
          let menu = wrapper.getElementsByClassName('select-dropdown__list');
          menu[0].classList.remove('active');
        }
      });

      var buttonElement = document.createElement("button"),
        spanElement = document.createElement("span"),
        spanText = document.createTextNode(placeholder);
        iElement = document.createElement("i");
        ulElement = document.createElement("ul");

      wrapper.className = 'select-dropdown select-dropdown--' + i;
      buttonElement.className = 'select-dropdown__button select-dropdown__button--' + i;
      buttonElement.setAttribute('data-value', '');
      buttonElement.setAttribute('type', 'button');
      spanElement.className = 'select-dropdown select-dropdown--' + i;
      iElement.className = 'zmdi zmdi-chevron-down';
      ulElement.className = 'select-dropdown__list select-dropdown__list--' + i;
      ulElement.id = 'select-dropdown__list-' + i;

      wrapper.appendChild(buttonElement);
      spanElement.appendChild(spanText);
      buttonElement.appendChild(spanElement);
      buttonElement.appendChild(iElement);
      wrapper.appendChild(ulElement);
    }

    function displyUl(element) {

      if (element.tagName == 'BUTTON') {
        selectDropdown = element.parentNode.getElementsByTagName('ul');
        //var labelWrapper = document.getElementsByClassName('js-label-wrapper');
        for (var i = 0, len = selectDropdown.length; i < len; i++) {
          selectDropdown[i].classList.toggle("active");
          //var parentNode = $(selectDropdown[i]).closest('.js-label-wrapper');
          //parentNode[0].classList.toggle("active");
        }
      } else if (element.tagName == 'LI') {
        var selectId = element.parentNode.parentNode.getElementsByTagName('select')[0];
        selectElement(selectId.id, element.getAttribute('data-value'));
        elementParentSpan = element.parentNode.parentNode.getElementsByTagName('span');
        element.parentNode.classList.toggle("active");
        elementParentSpan[0].textContent = element.textContent;
        elementParentSpan[0].parentNode.setAttribute('data-value', element.getAttribute('data-value'));
      }

    }
    function selectElement(id, valueToSelect) {
      var element = document.getElementById(id);
      element.value = valueToSelect;
      element.setAttribute('selected', 'selected');

    }
    var buttonSelect = document.getElementsByClassName('select-dropdown__button');
    for (var i = 0, len = buttonSelect.length; i < len; i++) {
      buttonSelect[i].addEventListener('click', function (e) {
				e.preventDefault();
				displyUl(this);
			}, false);
		}
}




// ----------------datepicker--------------------

const MONTH_NAMES = [
  "มกราคม",
  "กุมภาพันธ์",
  "มีนาคม",
  "เมษายน",
  "พฤษภาคม",
  "มิถุนายน",
  "กรกฎาคม",
  "สิงหาคม",
  "กันยายน",
  "ตุลาคม",
  "พฤศจิกายน",
  "ธันวาคม",
];
const MONTH_SHORT_NAMES = [
  "ม.ค.",
  "ก.พ.",
  "มี.ค.",
  "เม.ย.",
  "พ.ค.",
  "มิ.ย.",
  "ก.ค.",
  "ส.ค.",
  "ก.ย.",
  "ต.ค.",
  "พ.ย.",
  "ธ.ค.",
];
const DAYS = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์"];

function app() {
  return {
    showDatepicker: false,
    datepickerValue: "",
    dateFormat: "DD-MM-YYYY",
    month: "",
    year: "",
    no_of_days: [],
    blankdays: [],
    initDate() {
      let today;
      if (this.selectedDate) {
        today = new Date(Date.parse(this.selectedDate));
      } else {
        today = new Date();
      }
      this.month = today.getMonth();
      this.year = today.getFullYear();
      this.datepickerValue = this.formatDateForDisplay(
        today
      );
    },
    formatDateForDisplay(date) {
      let formattedDay = DAYS[date.getDay()];
      let formattedDate = ("0" + date.getDate()).slice(
        -2
      ); // appends 0 (zero) in single digit date
      let formattedMonth = MONTH_NAMES[date.getMonth()];
      let formattedMonthShortName =
        MONTH_SHORT_NAMES[date.getMonth()];
      let formattedMonthInNumber = (
        "0" +
        (parseInt(date.getMonth()) + 1)
      ).slice(-2);
      let formattedYear = date.getFullYear();
      if (this.dateFormat === "DD-MM-YYYY") {
        return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`; // 09-03-2024
      }
      if (this.dateFormat === "YYYY-MM-DD") {
        
        return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`; // 2024-03-09
      }
      if (this.dateFormat === "D d M, Y") {
        return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`; // Tue 09 March 2024
      }
      return `${formattedDay} ${formattedDate} ${formattedMonth} ${formattedYear}`;
    },
    isSelectedDate(date) {
      const d = new Date(this.year, this.month, date);
      return this.datepickerValue ===
        this.formatDateForDisplay(d) ?
        true :
        false;
    },
    isToday(date) {
      const today = new Date();
      const d = new Date(this.year, this.month, date);
      return today.toDateString() === d.toDateString() ?
        true :
        false;
    },
    getDateValue(date) {
        let selectedDate = new Date(this.year, this.month, date);
        let currentDate = new Date(); // วันที่ปัจจุบัน
        // Check if the selected date is not in the past
        if (selectedDate >= currentDate) {
          this.datepickerValue = this.formatDateForDisplay(selectedDate);
          this.isSelectedDate(date);
          this.showDatepicker = false;
        } else {
          Swal.fire({
            icon: "error",
            title: "โปรดเลือกวันให้ถูกต้อง"
        });
         
        }      
    
    },
    getNoOfDays() {
      let daysInMonth = new Date(
        this.year,
        this.month + 1,
        0
      ).getDate();
      // find where to start calendar day of week
      let dayOfWeek = new Date(
        this.year,
        this.month
      ).getDay();
      let blankdaysArray = [];
      for (var i = 1; i <= dayOfWeek; i++) {
        blankdaysArray.push(i);
      }
      let daysArray = [];
      for (var i = 1; i <= daysInMonth; i++) {
        daysArray.push(i);
      }
      this.blankdays = blankdaysArray;
      this.no_of_days = daysArray;
    },
  };
}






  var buttons = document.querySelectorAll(".button");

  buttons.forEach(function(button) {
    button.addEventListener("click", function() {
      // ถ้าปุ่มถูกเลือกอยู่แล้วให้เอา class "selected" ออก
      var selectedButton = document.querySelector(".button.selected");
      if (selectedButton) {
        selectedButton.classList.remove("selected");
      }
      // เพิ่ม class "selected" ให้กับปุ่มที่ถูกคลิก
      this.classList.add("selected");
    });
  });

  

  var selectedTime = ''; // ตัวแปรเพื่อเก็บค่าเวลาที่เลือก

  function handleClick(timeValue) {
    selectedTime = timeValue; // อัพเดทค่าเวลาที่เลือกเมื่อมีการคลิกปุ่มเวลา

  }


  async function reserveNow(date, seat){
    var email = document.getElementById('email').value
    var name = document.getElementById('name').value
    var phone= document.getElementById('phone').value
    // var date= document.getElementById('date').value
    if(email.trim() === "" || name.trim() === "" || phone.trim() === ""){
      Swal.fire({
        icon: "error",
        title: "โปรดกรอกข้อมูลให้ครบ"
    });
    } 
    else{
      let formData = new URLSearchParams();
      formData.append('reserveDate', date);
      formData.append('table', seat);
      formData.append('name', name);
      formData.append('email', email);
      formData.append('phone', phone);
      formData.append('time', selectedTime);
      
      Swal.fire({
      title: "ยืนยันการจอง",
      text: "โปรดมายืนยันตัวตนภายใน 15 นาที",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#137BFF",
      cancelButtonColor: "#d33",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก"
    
    }).then((result) => {
    
      if (result.isConfirmed) {
        
        fetch('./reserve.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData.toString()
          })
          .then(response => {
            if (response.ok) {
              Swal.fire({
                title: "ขอบคุณสำหรับการจอง",
                icon: "success",
                showConfirmButton: false,
                timer: 3000
  
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
}}
    
    




function openCard() {
    document.getElementById("addReserve").style.display = "block";
    document.getElementById("cardOverlay").style.display = "block";
}

function closeCard() {
    document.getElementById("addReserve").style.display = "none";
    document.getElementById("cardOverlay").style.display = "none";
}


