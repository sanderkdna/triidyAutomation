@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-11">
                        <span class="pull-left">
                            <h4 class="mt-5 mb-5">Create New User</h4>
                        </span>

                        <div class="btn-group btn-group-sm pull-right" role="group">
                            <a href="{{ route('users.user.index') }}" class="btn btn-primary" title="Show All User">
                                <i data-lucide="list" class="w-4 h-4 text-white"></i>
                            </a>
                        </div>
                </div>
            </div>


        </div>

        <div class="panel-body">
        
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row">
                <div class="col-md-12">
                        <form method="POST" action="{{ route('users.user.store') }}" accept-charset="UTF-8" id="create_user_form" name="create_user_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off" >
                        {{ csrf_field() }}
                        @php
                            $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $longitud = 32;
                            $rand =  substr(str_shuffle($caracteres_permitidos), 0, $longitud);
                        @endphp
                        @include ('users.form', [
                                                    'user' => null,
                                                    'code' => $rand
                                                  ])

                            <div class="form-group" style="margin-top:20px">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-primary" type="submit" value="Crear Usuario">
                                </div>
                            </div>

                        </form>

                </div>
            </div>

        </div>
    </div>

@endsection


