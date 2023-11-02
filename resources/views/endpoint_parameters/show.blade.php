@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Endpoint Parameter' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('endpoint_parameters.endpoint_parameter.destroy', $endpointParameter->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('endpoint_parameters.endpoint_parameter.index') }}" class="btn btn-primary" title="Show All Endpoint Parameter">
                        <i data-lucide="list" class="w-4 h-4 text-white"></i>
                    </a>

                    <a href="{{ route('endpoint_parameters.endpoint_parameter.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Endpoint Parameter">
                        <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                    </a>
                    
                    <a href="{{ route('endpoint_parameters.endpoint_parameter.edit', $endpointParameter->id ) }}" class="btn btn-primary" title="Edit Endpoint Parameter">
                        <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Endpoint Parameter" onclick="return confirm(&quot;Click Ok to delete Endpoint Parameter.?&quot;)">
                        <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Endpoint Id</dt>
            <dd>{{ $endpointParameter->endpointId }}</dd>
            <dt>Parameter</dt>
            <dd>{{ $endpointParameter->parameter }}</dd>
            <dt>Description</dt>
            <dd>{{ $endpointParameter->description }}</dd>
            <dt>User Id</dt>
            <dd>{{ $endpointParameter->userId }}</dd>

        </dl>

    </div>
</div>

@endsection
