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
        eventContent: function(arg) {
            // Manually format the date in French
            const formatDateToFrench = (dateStr) => {
                const date = new Date(dateStr);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                return date.toLocaleDateString('fr-FR', options);
            };

            const matureDate = formatDateToFrench(arg.event.extendedProps.mature);

            return {
                html: `
                    <div>
                        <b>${arg.event.title}</b><br/>
                        <i>Mature: ${matureDate}</i>
                    </div>
                `
            };
        }


    })
    calendar.render()
})