document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar')
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'dayGridMonth,timeGridWeek,listWeek',
            center: 'title',
            right: 'prev,next today'
        },
        locale: 'fr',
        buttonText: {
            today:    'Aujourd\'hui',
            month:    'Mois',
            week:     'Semaine',
            day:      'Jour',
            list:     'Liste'
        },
        events: {
            url: '/api/animal-events',
            failure: function() {
                alert('Une erreur est survenue pendant le chargement des données...');
            }
        },


    })
    calendar.render()
})