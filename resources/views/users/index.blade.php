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

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Users</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('users.user.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New User">
                    <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                </a>
            </div>

        </div>
        
        @if(count($users) == 0)
            <div class="panel-body text-center">
                <h4>No Users Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div style='clear:both; width:100%; margin-bottom:25px; padding-top:50px; text-align: right;'>
                
                 <form>
                    <span style='font-size: 18px; font-weight: bold;'>
                        Buscar Usuario 
                    </span>
                    <input id="searchTerm" type="text" onkeyup="doSearch()" style='margin-left: 15px; border-radius: 7px;' />

                </form>

            </div>

            <div class="table-responsive">

                <table class="table table-striped " id="datos">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <!--<th>Token</th>
                            <th>Código del Comercio</th>-->
                            <th>Teléfono (Verificado)</th>
                            <th>Status</th>
                            <th>Tipo de Usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style='padding:20px'>
                                <b>{{ $user->shop_name }}</b>
                                <br/>
                                {{ $user->name }}
                                <br/>
                                {{ $user->email }}
                            </td>
                            <!--<td>{{ $user->token_code }}</td>
                            <td>{{ $user->commerse_code }}</td>-->
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ ($user->status == "1")?"Activo":"Inactivo" }}</td>
                            <td>{{ ($user->tipo_usuario == "1")?"Administrador":"Tienda" }}</td>
                            <td>

                                <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('users.user.show', $user->id ) }}" class="btn btn-secondary" title="Show User">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title="Edit User">
                                            <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete User" onclick="return confirm(&quot;Click Ok to delete User.&quot;)">
                                            <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                         <tr class='noSearch hide'>
                            <td colspan="5"></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $users->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
@section('script')
<style>
    
    #datos tr:nth-child(even) {background:#ccc;}
    #datos td {padding:5px;}
    #datos tr.noSearch {background:White;font-size:0.8em;}
    #datos tr.noSearch td {padding-top:10px;text-align:right;}
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
