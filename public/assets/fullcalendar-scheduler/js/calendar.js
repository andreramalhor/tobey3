
//   /* initialize the external events
//   -----------------------------------------------------------------*/

//   var containerEl = document.getElementById('external-events-list');
//   new FullCalendar.Draggable(containerEl, {
//     itemSelector: '.fc-event',
//     eventData: function(eventEl) {
//       return {
//         title: eventEl.innerText.trim()
//       }
//     }
//   });

//   /* initialize the calendar
//   -----------------------------------------------------------------*/




//     drop: function(element) {
//       let Event = JSON.parse(element.draggedEl.dataset.event)

//       let inicio = moment(`${element.dateStr} ${Event.inicio} `).format('YYYY-MM-DD HH:mm:ss');
//       let final  = moment(`${element.dateStr} ${Event.final} `).format('YYYY-MM-DD HH:mm:ss');

//       Event.inicio = inicio;
//       Event.final   = final;

//       delete Event.id;

//       sendEvent(routeEvents('routeEventStore'), Event);

//       // is the "remove after drop" checkbox checked?
//       if (document.getElementById('drop-remove').checked) {
//         // if so, remove the element from the "Draggable Events" list
//         element.draggedEl.parentNode.removeChild(element.draggedEl);
//       }
//     },
//     eventDrop: function(element){
//       let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
//       let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');

//       let newEvent = {
//         _method:  'PUT',
//         id:       element.event.id,
//         obs:      element.event.title,
//         inicio:   start,
//         final:    end,
//       };

//       sendEvent(routeEvents('routeEventUpdate'), newEvent);
//     },
//     eventClick: function(element){
//       clearMessage('#message')
//       resetForm('#formEvent')
//       $('#modal-calendar #id').val(element.event.id);
//       $('#modal-calendar #title').val(element.event.title);
//       $('#modal-calendar #start').val(moment(element.event.start).format('DD/MM/YYYY HH:mm:ss'));
//       $('#modal-calendar #end').val(moment(element.event.end).format('DD/MM/YYYY HH:mm:ss'));
//       $('#modal-calendar #color').val(element.event.backgroundColor);
//       $('#modal-calendar #titleModal').text('Editar Evento');
//       $('#modal-calendar button.deleteEvent').css('display', 'flex');
//       $('#modal-calendar').modal('show');
//     },
//     eventResize: function(element){
//       let start = moment(element.event.start).format('YYYY-MM-DD HH:mm:ss');
//       let end   = moment(element.event.end).format('YYYY-MM-DD HH:mm:ss');

//       let newEvent = {
//         _method:  'PUT',
//         id:       element.event.id,
//         obs:      element.event.title,
//         inicio:   start,
//         final:    end,
//       };

//       sendEvent(routeEvents('routeEventUpdate'), newEvent);
//     },
//     select: function(element){
//       clearMessage('#message')
//       resetForm('#formEvent')
//       $('#modal-calendar #start').val(moment(element.start).format('DD/MM/YYYY HH:mm:ss'));
//       $('#modal-calendar #end').val(moment(element.end).format('DD/MM/YYYY HH:mm:ss'));
//       $('#modal-calendar #color').val();
//       $('#modal-calendar #titleModal').text('Adicionar Evento');
//       $('#modal-calendar button.deleteEvent').css('display', 'none');
//       $('#modal-calendar').modal('show');
//       calendar.unselect();
//     },
//     eventReceive: function(element){
//       element.event.remove();
//     },
//     events: routeEvents('routeLoadEvents'),
//   });
  
//   objCalendar = calendar;

//   calendar.render();

// });

  document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'resourceTimeGridDay,resourceTimeGridTwoDay,resourceTimeGridWeek,dayGridMonth'
    },
    locale: 'pt-br',
    nowIndicator: true,
    initialView: 'resourceTimeGridDay',
    // initialDate: '2020-09-07',
    
//     navLinks: true,
//     dayMaxEventRows: true, // eventeLimit
      dayMaxEvents: true, // allow "more" link when too many events
      selectable: true,
      editable: true,
//     droppable: true, // this allows things to be dropped onto the calendar

      dayMinWidth: 200,
      views: {
        resourceTimeGridTwoDay: {
          type: 'resourceTimeGrid',
          duration: { days: 2 },
          buttonText: '2 days',
        }
      },

      //// uncomment this line to hide the all-day slot
      //allDaySlot: false,

      resources: [
        { id: 'a', title: 'Room A' },
        { id: 'b', title: 'Room B', eventColor: 'green' },
        { id: 'c', title: 'Room C', eventColor: 'orange' },
        { id: 'd', title: 'Room D', eventColor: 'red' }
      ],
      events: [
        { id: '1', resourceId: 'a', start: '2020-11-06', end: '2020-11-08', title: 'event 1' },
        { id: '2', resourceId: 'a', start: '2020-11-07T09:00:00', end: '2020-11-07T14:00:00', title: 'event 2' },
        { id: '3', resourceId: 'b', start: '2020-11-07T12:00:00', end: '2020-11-08T06:00:00', title: 'event 3' },
        { id: '4', resourceId: 'c', start: '2020-11-07T07:30:00', end: '2020-11-07T09:30:00', title: 'event 4' },
        { id: '5', resourceId: 'd', start: '2020-11-07T10:00:00', end: '2020-11-07T15:00:00', title: 'event 5' }
      ],

      // select: function(arg) {
      //   console.log(
      //     'select',
      //     arg.startStr,
      //     arg.endStr,
      //     arg.resource ? arg.resource.id : '(no resource)'
      //   );
      // },
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

      dateClick: function(arg) {
        console.log(
          'dateClick',
          arg.date,
          arg.resource ? arg.resource.id : '(no resource)'
        );
      }
    });

  objCalendar = calendar;

    calendar.render();
  });