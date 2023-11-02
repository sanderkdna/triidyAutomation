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
                            <div class="table-responsive" style='    max-height: 100vh; overflow-y: auto;'>

                                @if(count($tickets) == 0)
                                    <div class="panel-body text-center">
                                        <h4>No Hay nuevos Tickets Disponibles.</h4>
                                    </div>
                                @else
                                    <table class="table table-striped " id='datos'>
                                        <tbody>
                                        @foreach($tickets as $ticket)

                                              <tr>
                                                @if($ticket->ticketid == $id)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900  text-white" style='background-color:rgb(132,204,22)'>
                                                @else
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @endif
                                                        {{ $ticket->ticketid }}<br>
                                                        {{ $ticket->contact_name }}<br>
                                                        <small>
                                                            {{ 'Creado el: '.($ticket->created_at == '')?$ticket->last_message:$ticket->created_at }}                                                        
                                                        </small>
                                                    </td>
                                                @if($ticket->ticketid == $id)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium bg-gray-50 text-white" style="width:50px; background-color:rgb(132,204,22)">
                                                @else
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="width:50px">
                                                @endif
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
                <div class="chat__box box">
                    <div class="h-full flex flex-col">
                        <div class="leading-relaxed text-slate-500 text-xs mt-3">
                            <div class="flex flex-col sm:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                                <div class="flex items-center">
                                    <div class="ml-3 mr-auto">
                                        <div class="font-medium text-base">Historial de la Conversación {{$id}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1">
                                @foreach ($mensajes as $mensaje)
                                    @if($mensaje->contact_name == "WEBBOT")
                                        <div class="chat__box__text-box flex items-end float-right mb-4" style="width:55%">
                                            <div class="bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md">
                                    @else
                                        <div class="chat__box__text-box flex items-end float-left mb-4" style="width:55%">
                                            <div class="bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                                    @endif
                                                {{ $mensaje->contact_name }}<br>
                                                {!! $mensaje->message !!}
                                            <div class="mt-1 text-xs text-slate-500">{{$mensaje->created_at}}</div>
                                        </div>
                                    </div>
                                    <div class="clear-both"></div>
                                @endforeach
                            </div>

                        </div>
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
