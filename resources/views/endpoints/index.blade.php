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
                <h4 class="mt-5 mb-5">Endpoints</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('endpoints.endpoint.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Endpoint">
                    <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                </a>
            </div>

        </div>
        
        @if(count($endpoints) == 0)
            <div class="panel-body text-center">
                <h4>No Endpoints Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Title</th>
                            <th>Url</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($endpoints as $endpoint)
                        <tr>
                            <td>{{ $endpoint->userId }}</td>
                            <td>{{ $endpoint->title }}</td>
                            <td>{{ $endpoint->url }}</td>

                            <td>

                                <form method="POST" action="{!! route('endpoints.endpoint.destroy', $endpoint->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('endpoints.endpoint.show', $endpoint->id ) }}" class="btn btn-info" title="Show Endpoint">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('endpoints.endpoint.edit', $endpoint->id ) }}" class="btn btn-primary" title="Edit Endpoint">
                                            <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Endpoint" onclick="return confirm(&quot;Click Ok to delete Endpoint.&quot;)">
                                            <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $endpoints->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
