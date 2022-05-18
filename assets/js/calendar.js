    


        //  Chargement fullCalendar

    document.addEventListener('DOMContentLoaded',  function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        dateClick: function(info) {
            console.log(info);
            
        }
        });
        calendar.render();
    });
    

        

    
    
    