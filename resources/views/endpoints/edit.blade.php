@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($endpoint->title) ? $endpoint->title : 'Endpoint' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('endpoints.endpoint.index') }}" class="btn btn-primary" title="Show All Endpoint">
                    <i data-lucide="list" class="w-4 h-4 text-white"></i>
                </a>

                <a href="{{ route('endpoints.endpoint.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Endpoint">
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

            <form method="POST" action="{{ route('endpoints.endpoint.update', $endpoint->id) }}" id="edit_endpoint_form" name="edit_endpoint_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('endpoints.form', [
                                        'endpoint' => $endpoint,
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
