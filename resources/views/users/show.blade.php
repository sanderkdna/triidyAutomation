@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class="row" style="display: grid;">
            <div class="col-md-12">
                <span class="pull-left">
                    <h4 class="mt-5 mb-5">{{ isset($user->name) ? $user->name : 'User' }}</h4>
                </span>

                <div class="pull-right">
                    <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    <input name="userid" id='userid' value="{{$user->id}}" type="hidden">
                    {{ csrf_field() }}
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('users.user.index') }}" class="btn btn-primary" title="Show All User">
                                <i data-lucide="list" class="w-4 h-4 text-white"></i>
                            </a>

                            <a href="{{ route('users.user.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New User">
                                <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                            </a>

                            <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title="Edit User">
                                <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                            </a>

                            <button type="submit" class="btn btn-danger" title="Delete User" onclick="return confirm(&quot;Click Ok to delete User.?&quot;)">
                                <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <div class="panel-body panel-body-with-table">
        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
            <div class="form-label xl:w-64 xl:!mr-10">
                <div class="text-left">
                    <div class="flex items-center">
                        <div class="font-medium">Datos del Cliente</div>
                    </div>
                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                        <dl class="dl-horizontal">
                            <dt style="margin-top:20px"><b>Nombre</b></dt>
                            <dd>{{ $user->name }}</dd>
                            <dt style="margin-top:20px"><b>Email</b></dt>
                            <dd>{{ $user->email }}</dd>
                            <dt style="margin-top:20px"><b>Código Token (Triidy token)</b></dt>
                            <dd>{{ $user->token_code }}</dd>
                            <dt style="margin-top:20px"><b>Código del Comercio (ecommerceId)</b></dt>
                            <dd>{{ $user->commerse_code }}</dd>
                            <dt style="margin-top:20px"><b>Nombre del Comercio</b></dt>
                            <dd>{{ $user->shop_name }}</dd>
                            <dt style="margin-top:20px"><b>Teléfono (Verificado)</b></dt>
                            <dd>{{ $user->phone_number }}</dd>
                            <dt style="margin-top:20px"><b>Estado</b></dt>
                            <dd>{{ ($user->status == "1")?"Activo":"Inactivo" }}</dd>

                        </dl>

                    </div>
                </div>
            </div>
            <div class="w-full mt-3 xl:mt-0 flex-1">




                <div id="basic-tab" class="p-5">
                    <div class="preview">
                        <ul class="nav nav-tabs" role="tablist">
                            <li id="example-1-tab" class="nav-item flex-1" role="presentation">
                                <button
                                    class="nav-link w-full py-2 active"
                                    data-tw-toggle="pill"
                                    data-tw-target="#example-tab-1"
                                    type="button"
                                    role="tab"
                                    aria-controls="example-tab-1"
                                    aria-selected="true"
                                >
                                    Integración de API Triidy - Whatsapp
                                </button>
                            </li>
                            <li id="example-2-tab" class="nav-item flex-1" role="presentation">
                                <button
                                    class="nav-link w-full py-2"
                                    data-tw-toggle="pill"
                                    data-tw-target="#example-tab-2"
                                    type="button"
                                    role="tab"
                                    aria-controls="example-tab-2"
                                    aria-selected="false"
                                >
                                    Integración de API Triidy - WooCommerce
                                </button>
                            </li>
                            <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                                <button
                                    class="nav-link w-full py-2"
                                    data-tw-toggle="pill"
                                    data-tw-target="#example-tab-3"
                                    type="button"
                                    role="tab"
                                    aria-controls="example-tab-3"
                                    aria-selected="false"
                                >
                                    Integración de API Triidy - Shopify
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content border-l border-r border-b bg-white">
                            <div id="example-tab-1" class="tab-pane leading-relaxed p-5 active" role="tabpanel" aria-labelledby="example-1-tab">
                               
                                <div class="text-left">
                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                        <code>
                                            <b>Url: </b>{{  $_ENV['APP_URL'].'/api/v1/userconnect' }}<br>
                                            <b>Method:</b> POST<br>
                                            <b>Parameters:</b>
                                            <div class="pl-10">
                                                token: <em>{{ $user->token_code }}</em><br>
                                                ecommerceId: <em>{{ $user->commerse_code }}</em><br>
                                                flowId: <em>{{ $flow[0]->id }}</em><br>
                                                currentStatus: <em>{{ '0' }}</em><br>
                                                nombreProducto: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                precioProducto: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                nombreComprador: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                departamentoComprador: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                municipioComprador: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                direccionComprador: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                telefonoComprador: <em>{{ '<Number: 10 caracteres (Sin indicativo +57: Ej; 31520202020)>' }}</em><br>
                                            </div>
                                        </code>
                                    </div>
                                </div>

                            </div>
                            <div id="example-tab-2" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-2-tab">
                               

                                <div class="text-left">
                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                        <code>
                                            <b>Puedes descargar el Plugin para Wordpress - WooCommerce en el siguiente enlace: </b>
                                            <a href="https://triidy.admhost.site/downloads/triidy_automation.zip" target='_blank'>Descargar Plugin</a>
                                        </code>
                                    </div>


                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                        <h2 class="mr-5 truncate text-lg font-medium">Para Crear Productos desde Triidy</h2>
                                        <code>
                                            <b>Url: </b>{{ '{{URL DEL COMERCIO}\}/wp-content/plugins/triidy_automation/createProduct.php' }}<br>
                                            <b>Method:</b> POST<br>
                                            <b>Parameters:</b>
                                            <div class="pl-10">
                                                user: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                password: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                name: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                cost: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                sale_price: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                product_type: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                height: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                width: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                depth: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                volume: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                description: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                weight: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                triidy_product_id: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                            </div>
                                        </code>
                                    </div>
                                </div>

                            </div>
                            <div id="example-tab-3" class="tab-pane leading-relaxed p-5" role="tabpanel" aria-labelledby="example-3-tab">

                               <div class="text-left">
                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                        <h2 class="mr-5 truncate text-lg font-medium">Para Crear Productos desde Triidy</h2>
                                        <code>
                                            <b>Url: </b>{{  $_ENV['APP_URL'].'/api/v1/shopify/CreateProduct' }}<br>
                                            <b>Method:</b> POST<br>
                                            <b>Parameters:</b>
                                            <div class="pl-10">
                                                user: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                password: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                name: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                cost: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                sale_price: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                product_type: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                height: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                width: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                depth: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                volume: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                description: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                                weight: <em>{{ '<String 400 Caracteres>' }}</em><br>
                                                triidy_product_id: <em>{{ '<String: 400 Caracteres>' }}</em><br>
                                            </div>
                                        </code>
                                    </div>
                                </div>
<!--
                                <div class="text-left mt-10">
                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                        <h2 class="mr-5 truncate text-lg font-medium">Obtener Productos</h2>
                                        <div class="relative mt-3 overflow-hidden rounded-md">
                                            <pre class="relative grid">         
                                                <code style='overflow-x: hidden;'>
                                                    <table border='1' class='table table-bordered w-full' style='overflow-x: hidden;'>
                                                        <tr>
                                                            <td width='300px'>Obtener Todos los Productos</td>
                                                            <td width='300px'>Obtener un solo Producto</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class='text-left'>
                                                                <label style="float: left; width: 300px;" for="">Ingrese el Código del Producto</label>
                                                                <input style="float: left; width: 300px;"type="text" class='form-control' id='idproducto'>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><button type="button" onclick="GetProductos()" class='btn btn-primary'>Obtener Productos</button></td>
                                                            <td><button type="button" onclick="GetProducto()" class='btn btn-primary'>Obtener Producto Individual</button></td>
                                                        </tr>
                                                    </table>  
                                                    <div id='resultProductos'></div>
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>


                                <div class="text-left mt-10">
                                    <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                        <h2 class="mr-5 truncate text-lg font-medium">Obtener Pedidos</h2>
                                        <div class="relative mt-3 overflow-hidden rounded-md">
                                            <pre class="relative grid">           
                                                <code style='overflow-x: hidden;'>
                                                    <table border='1' class='table table-bordered w-full' style='overflow-x: hidden;'>
                                                        <tr>
                                                            <td width='300px'>Obtener Todas las Pedidos</td>
                                                            <td width='300px'>Obtener un solo Pedido</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class='text-left'>
                                                                <label style="float: left; width: 300px;" for="">Ingrese el Código de la Pedido</label>
                                                                <input style="float: left; width: 300px;"type="text" class='form-control'  id='idorden'>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><button type="button" onclick="GetPedidos()" class='btn btn-primary'>Obtener Pedidos</button></td>
                                                            <td><button type="button" onclick="GetPedido()" class='btn btn-primary'>Obtener Pedido Individual</button></td>
                                                        </tr>
                                                    </table>  
                                                    <div id='resultPedidos'></div>
                                                </code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>

-->

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        
function GetProductos(){
    $("#resultProductos").html("Cargando...");
    event.preventDefault();
    var url = "{{route('user.getProductos')}}";

    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    var userid = $('#userid').val();
    var data={_token:token,userId:userid};

    $.ajax({
        type:'POST',
        url: url,
        data: data,
        success: function(respuesta){
            $('#resultProductos').html(respuesta);
        },
        error: function (){
            console.log('Error');
        }
    })
}
function GetProducto(){
    $("#resultProductos").html("Cargando...");
    event.preventDefault();
    //Hacemos la peticion
    var value = $("#idproducto").val()
    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    var userid = $('#userid').val();
    var data={id:value,_token:token,userId:userid};
    var url = "{{route('user.getProductoSimple')}}";

    $.ajax({
        type:'POST',
        url: url,
        data: data,
        success: function(respuesta){
            $('#resultProductos').html(respuesta);
        },
        error: function (){
            console.log('Error');
        }
    })
}
function GetPedidos(){
    $("#resultPedidos").html("Cargando...");
    event.preventDefault();
    var url = "{{route('user.getPedidos')}}";
    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    var userid = $('#userid').val();
    var data={_token:token,userId:userid};

    $.ajax({
        type:'POST',
        url: url,
        data: data,
        success: function(respuesta){
            $('#resultPedidos').html(respuesta);
        },
        error: function (){
            console.log('Error');
        }
    })
}
function GetPedido(){
    $("#resultPedidos").html("Cargando...");
    event.preventDefault();
    //Hacemos la peticion
    var value = $("#idorden").val()
    var token = '{{csrf_token()}}';// ó $("#token").val() si lo tienes en una etiqueta html.
    var userid = $('#userid').val();
    var data={id:value,_token:token,userId:userid};

    var url = "{{route('user.getPedidoSimple')}}";
    $.ajax({
        type:'POST',
        url: url,
        data: data,
        success: function(respuesta){
            $('#resultPedidos').html(respuesta);
        },
        error: function (){
            console.log('Error');
        }
    })
}

    </script>
@endsection


