@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="glyphicon glyphicon-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class="form-inline  mt-30 items-start flex-col xl:flex-row mt-30 pt-20 first:mt-0 first:pt-0">
            <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                    <div class="items-center mt-10">
                        
                        <div class="font-medium mb-5">Tickets</div>                        
                        <div style='width: 100%;clear: both;'>
                            <input type="text" placeholder="Buscar una Conversación" class='form-control'  id="searchTerm" onkeyup="doSearch()" style='margin-left: 15px; border-radius: 7px;' >   

                        </div>
                    </div>
                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                        <div class="panel-body panel-body-with-table">
                            <div class="table-responsive">

                                @if(count($tickets) == 0)
                                    <div class="panel-body text-center">
                                        <h4>No Hay nuevos Tickets Disponibles.</h4>
                                    </div>
                                @else
                                    <table class="table table-striped " id='datos'>
                                        <tbody>
                                        @foreach($tickets as $ticket)

                                              <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ $ticket->ticketid }}<br>
                                                        {{ $ticket->contact_name }}<br>
                                                        <small>
                                                            {{ 'Creado el: '.($ticket->created_at == '')?$ticket->last_message:$ticket->created_at }}                                                        
                                                        </small>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="width:50px">

                                                        <a href="{{ route('tickets.ticket.edit', $ticket->ticketid) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Ver</a>
                                                    </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                @endif
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <div class="w-full mt-3 xl:mt-0 flex-1">
                <div class="text-left">
                    <div class="flex items-center">
                        <div class="font-medium">Seleccione una conversación</div>
                    </div>
                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('script')
<style>

    .hide {display:none;}
    .red {color:Red;}
</style>

<script>
      function doSearch()

        {

            const tableReg = document.getElementById('datos');

            const searchText = document.getElementById('searchTerm').value.toLowerCase();

            let total = 0;

 

            // Recorremos todas las filas con contenido de la tabla

            for (let i = 1; i < tableReg.rows.length; i++) {

                // Si el td tiene la clase "noSearch" no se busca en su cntenido

                if (tableReg.rows[i].classList.contains("noSearch")) {

                    continue;

                }

 

                let found = false;

                const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

                // Recorremos todas las celdas

                for (let j = 0; j < cellsOfRow.length && !found; j++) {

                    const compareWith = cellsOfRow[j].innerHTML.toLowerCase();

                    // Buscamos el texto en el contenido de la celda

                    if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {

                        found = true;

                        total++;

                    }

                }

                if (found) {

                    tableReg.rows[i].style.display = '';

                } else {

                    // si no ha encontrado ninguna coincidencia, esconde la

                    // fila de la tabla

                    tableReg.rows[i].style.display = 'none';

                }

            }

 

            // mostramos las coincidencias

            const lastTR=tableReg.rows[tableReg.rows.length-1];

            const td=lastTR.querySelector("td");

            lastTR.classList.remove("hide", "red");

            if (searchText == "") {

                lastTR.classList.add("hide");

            } else if (total) {

                td.innerHTML="Se ha encontrado "+total+" coincidencia"+((total>1)?"s":"");

            } else {

                lastTR.classList.add("red");

                td.innerHTML="No se han encontrado coincidencias";

            }

        }
</script>
@endsection
