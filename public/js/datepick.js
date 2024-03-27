// Initialize Datepicker
$(document).ready(function () {
    $("#date").datepicker({
        format: "yyyy-mm-dd", // Customize date format if needed
        todayHighlight: false,
        autoclose: true, // Automatically close the datepicker when date is selected
        // Highlight today's date
        beforeShowDay: function (date) {
            var startDate = new Date(date_close); // Convert date_close string to Date object
            var endDate = new Date(date_open);
            var currentDate = new Date();
            
            // Convert date_open string to Date object
            if( currentDate.setHours(0,0,0,0) == date.setHours(0,0,0,0)){
                return{
                    class: "current",
                    enabled: false,
                }
            }
            currentDate.setDate(currentDate.getDate() + 2);
            if (
                (date_close != null &&
                date_open != null &&
                date.setHours(0,0,0,0) >= startDate.setHours(0,0,0,0) &&
                date.setHours(0,0,0,0) <= endDate.setHours(0,0,0,0)&& date.setHours(0,0,0,0))||
                date.setHours(0,0,0,0) < currentDate.setHours(0,0,0,0) && 
                currentDate.setHours(0,0,0,0) != date.setHours(0,0,0,0)
            ) {
              
                return {
                    classes: "highlight-range",
                    enabled: false,
                };
            } else {
                return true; // Enable all other dates
            }
        },
    });
});
