document.addEventListener('DOMContentLoaded', function() {

  /* initialize the external events
  -----------------------------------------------------------------*/

  var containerEl = document.getElementById('external-events-list');
  new FullCalendar.Draggable(containerEl, {
    itemSelector: '.fc-event',
    eventData: function(eventEl) {
      return {
        title: eventEl.innerText.trim()
      }
    }
  });

  /* initialize the calendar
  -----------------------------------------------------------------*/

  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    locale: 'pt-br',
    navLinks: true,
    dayMaxEventRows: true, // eventeLimit
    selectable: true,
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    drop: function(element) {
      let Event = JSON.parse(element.draggedEl.dataset.event)

      let inicio = moment(`${element.dateStr} ${Event.inicio} `).format('YYYY-MM-DD HH:mm:ss');
      let final  = moment(`${element.dateStr} ${Event.final} `).format('YYYY-MM-DD HH:mm:ss');

      Event.inicio = inicio;
      Event.final   = final;

      delete Event.id;

      sendEvent(routeEvents('routeEventStore'), Event);

      // is the "remove after drop" checkbox checked?
      if (document.getElementById('drop-remove').checked) {
        // if so, remove the element from the "Draggable Events" list
        element.draggedEl.parentNode.removeChild(element.draggedEl);
      }
    },
    eventDrop: function(element){
      let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
      let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');

      let newEvent = {
        _method:  'PUT',
        id:       element.event.id,
        obs:      element.event.title,
        inicio:   start,
        final:    end,
      };

      sendEvent(routeEvents('routeEventUpdate'), newEvent);
    },
    eventClick: function(element){
      clearMessage('#message')
      resetForm('#formEvent')
      $('#modal-calendar #id').val(element.event.id);
      $('#modal-calendar #title').val(element.event.title);
      $('#modal-calendar #start').val(moment(element.event.start).format('DD/MM/YYYY HH:mm:ss'));
      $('#modal-calendar #end').val(moment(element.event.end).format('DD/MM/YYYY HH:mm:ss'));
      $('#modal-calendar #color').val(element.event.backgroundColor);
      $('#modal-calendar #titleModal').text('Editar Evento');
      $('#modal-calendar button.deleteEvent').css('display', 'flex');
      $('#modal-calendar').modal('show');
    },
    eventResize: function(element){
      let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
      let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');

      let newEvent = {
        _method:  'PUT',
        id:       element.event.id,
        obs:      element.event.title,
        inicio:   start,
        final:    end,
      };

      sendEvent(routeEvents('routeEventUpdate'), newEvent);
    },
    select: function(element){
      clearMessage('#message')
      resetForm('#formEvent')
      $('#modal-calendar #start').val(moment(element.start).format('DD/MM/YYYY HH:mm:ss'));
      $('#modal-calendar #end').val(moment(element.end).format('DD/MM/YYYY HH:mm:ss'));
      $('#modal-calendar #color').val();
      $('#modal-calendar #titleModal').text('Adicionar Evento');
      $('#modal-calendar button.deleteEvent').css('display', 'none');
      $('#modal-calendar').modal('show');
      calendar.unselect();
    },
    eventReceive: function(element){
      element.event.remove();
    },
    events: routeEvents('routeLoadEvents'),
  });
  
  objCalendar = calendar;

  calendar.render();

});