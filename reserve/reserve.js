/* Please ❤ this if you like it! */
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

  


      const MONTH_NAMES = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    const MONTH_SHORT_NAMES = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    const DAYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

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
            return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`; // 02-04-2021
          }
          if (this.dateFormat === "YYYY-MM-DD") {
            return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`; // 2021-04-02
          }
          if (this.dateFormat === "D d M, Y") {
            return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`; // Tue 02 Mar 2021
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
          let selectedDate = new Date(
            this.year,
            this.month,
            date
          );
          this.datepickerValue = this.formatDateForDisplay(
            selectedDate
          );
          // this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + formattedMonthInNumber).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);
          this.isSelectedDate(date);
          this.showDatepicker = false;
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