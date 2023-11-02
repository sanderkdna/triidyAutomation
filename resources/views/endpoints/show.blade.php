@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($endpoint->title) ? $endpoint->title : 'Endpoint' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('endpoints.endpoint.destroy', $endpoint->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('endpoints.endpoint.index') }}" class="btn btn-primary" title="Show All Endpoint">
                        <i data-lucide="list" class="w-4 h-4 text-white"></i>
                    </a>

                    <a href="{{ route('endpoints.endpoint.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Endpoint">
                        <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                    </a>
                    
                    <a href="{{ route('endpoints.endpoint.edit', $endpoint->id ) }}" class="btn btn-primary" title="Edit Endpoint">
                        <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Endpoint" onclick="return confirm(&quot;Click Ok to delete Endpoint.?&quot;)">
                        <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>User Id</dt>
            <dd>{{ $endpoint->userId }}</dd>
            <dt>Title</dt>
            <dd>{{ $endpoint->title }}</dd>
            <dt>Url</dt>
            <dd>{{ $endpoint->url }}</dd>

        </dl>

    </div>
</div>

@endsection
