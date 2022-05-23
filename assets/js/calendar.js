    const urlRequest = window.location.search;
    const urlParams = new URLSearchParams(urlRequest);
    const coachId = urlParams.get('coachId');
    const optionsDate = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: '2-digit'
    };
    const slots = ['09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'];

    //  Chargement fullCalendar

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            dateClick: function (info) {

                coachingSlots.innerHTML = '';

                // On attrape la tr parent de la td.
                let row = info.dayEl.parentNode

                //on gère le BGColor des tr
                allRows = document.querySelectorAll('.fc-scrollgrid-sync-table tbody tr');
                console.log(allRows)
                
                
                allRows.forEach(element => {
                    element.style.backgroundColor = '';
                });

                row.style.backgroundColor = "#50ff004a";
                //on choppe les td de notre tr
                tdList = row.querySelectorAll('td');


                let dayNumber = 1

                let dayList = []
                tdList.forEach(element => {
                    dayList.push(element.dataset.date);
                });

                let form = new FormData()
                form.append('date', dayList)
                form.append('coachId', coachId)
                
                fetch(`/controllers/ajax/coaching-slots-ajax-controller.php`, {
                    method: "POST",
                    body: form
                    })

                    .then(function (response) {
                        return response.json();
                    })

                    .then(function (coachingList) {


                        tdList.forEach(element => {

                        

                            // slotsUsed =[];
                            // if (datas.length != 0) {
                            //     datas.forEach(slot => {
                            //         slotsUsed.push(slot.id_time_slots);
                            //     });
                            // }




                            let date = new Date(element.dataset.date)
                            date = date.toLocaleDateString("fr-FR", optionsDate)

                            isDateAvailable = '';

                            isToday = element.classList.contains('fc-day-today');
                            isFutur = element.classList.contains('fc-day-future');

                                slotList = '';
                                
                                    
                                    slots.forEach((slot, index) => {

                                        actualTime = new Date();

                                        coachingTime = new Date(element.dataset.date+' '+slot)
                                        
                                        if (actualTime<coachingTime) {

                                            isDateAvailable = 'available';
                                        }

                                        coachingList.forEach(coaching => {
                                        

                                            if ((element.dataset.date == coaching.date) && (coaching.id_coach == coachId) && (coaching.id_time_slots == index+1)) {
                                                isDateAvailable='reserved';
                                            }  
                                            if (actualTime>coachingTime) {
                                                isDateAvailable = '';
                                            }
                                        });

                                        slotList += `<a href="/reserver-un-coaching?coachId=${coachId}&date=${element.dataset.date}&slots=${index+1}" class="coachingSlot ${isDateAvailable}">${slot}</a>`

                                    });

                            coachingSlots.innerHTML +=
                                `<div class="coachingDaySlots${(dayNumber%2==0)? 2 : ''}">
                                <div class="dateCoachingSlots">${date}</div>
                                <div class="slotsContainer">
                                    ${slotList}
                                </div>
                            </div>`;
                            dayNumber++;
                        });
                    });
            }
        })

        calendar.render();
    });