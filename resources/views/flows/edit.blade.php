@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')
    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($flow->title) ? $flow->title : 'Flow' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('flows.flow.index') }}" class="btn btn-primary" title="Show All Flow">
                    <i data-lucide="list" class="w-4 h-4 text-white"></i>
                </a>

                <a href="{{ route('flows.flow.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Flow">
                    <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                </a>

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

            <form method="POST" action="{{ route('flows.flow.update', $flow->id) }}" id="edit_flow_form" name="edit_flow_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('flows.form', [
                                        'flow' => $flow,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
