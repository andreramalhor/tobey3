var ficha =
    '<div class="callout p-2" style="'+item.color_interesse+'">'+
      '<div class="d-flex bd-highlight">'+
        '<span class="w-100">'+
          '<a class="bd-highlight" style="cursor: pointer;" onClick="lead_modal('+item.id+')">'+
            '<strong>'+item.id+' - '+item.nome+'</strong>'+
          '</a>'+
          '</span>'+
            '<span class="flex-shrink-1 bd-highlight collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_'+item.id+'" aria-expanded="false" aria-controls="collapse_'+item.id+'">'+
              '<i class="fa-solid fa-caret-down"></i>'+
              '<i class="fa-solid fa-caret-up"></i>'+
            '</span>&nbsp;&nbsp;'+
          '</div>'+
          '<div>'+
            '<p class="p-0 m-0">'+
              '<span>'+item.telefone+'</span>&nbsp;&nbsp;'+
              '<a '+
                'href="'+item.link_whatsapp+'"'+
                'target="_blank"'+
                'data-tt="tooltip"'+
                'data-bs-original-title="Whatsapp"'+
                'aria-label="Whatsapp"'+
                '>'+
                '<i class="fa-brands fa-whatsapp"></i>'+
              '</a>'+
              '<span" class="float-end" style="color: '+color+';">'+moment().diff(item.updated_at, 'days')+' dia'+(moment().diff(item.updated_at, 'days') != 1 ? 's' : '')+'</span>'+
            '</p>'+
          '</div>'+

          '<div id="collapse_'+item.id+'" class="collapse" data-bs-parent="#accordion" style="border-top: 1px solid lightgray">'+
            '<div class="card-body" style="padding: 10px 5px;">'+
              '<small><strong>Nome:</strong> '+item.nome+'</small></br>'+
              '<small><strong>Cursos:</strong> '+curso+'</small></br>'+
              '<small><strong>Turma:</strong> '+turma+'</small></br></br>'+
              '<small><strong>Último Contato:</strong> '+moment(item.updated_at).format('DD/MM/YYYY [às] HH:mm')+'h </small></br></br>'+
              '<small><strong>Convesas:</strong></small></br>'+
              '<small>';

              collect(item.fghtvxswwryiiil).sortByDesc('created_at').each((conversa) =>
              {
                // console.log(conversa)
                ficha = ficha +
                '<li>'+
                  conversa.conversa+
                '</li>';
              })

              ficha = ficha +
            '</small></br>'+
          '<small><strong>Data de Cadastro:</strong> '+moment(item.created_at).format('DD/MM/YYYY [às] HH:mm')+'h </small></br>'+
        '</div>'+
      '</div>'+
    '</div>';
