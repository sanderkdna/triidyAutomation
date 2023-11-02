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
                <h4 class="mt-5 mb-5">Flow Messages</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('flow_messages.flow_messages.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Flow Messages">
                    <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                </a>
            </div>

        </div>
        
        @if(count($flowMessagesObjects) == 0)
            <div class="panel-body text-center">
                <h4>No Flow Messages Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Userid</th>
                            <th>Flowid</th>
                            <th>Node Parent</th>
                            <th>Node Answer</th>
                            <th>End Pointid</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($flowMessagesObjects as $flowMessages)
                        <tr>
                            <td>{{ $flowMessages->userid }}</td>
                            <td>{{ $flowMessages->flowid }}</td>
                            <td>{{ $flowMessages->node_parent }}</td>
                            <td>{{ $flowMessages->node_answer }}</td>
                            <td>{{ $flowMessages->end_pointid }}</td>

                            <td>

                                <form method="POST" action="{!! route('flow_messages.flow_messages.destroy', $flowMessages->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('flow_messages.flow_messages.show', $flowMessages->id ) }}" class="btn btn-info" title="Show Flow Messages">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('flow_messages.flow_messages.edit', $flowMessages->id ) }}" class="btn btn-primary" title="Edit Flow Messages">
                                            <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Flow Messages" onclick="return confirm(&quot;Click Ok to delete Flow Messages.&quot;)">
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
            {!! $flowMessagesObjects->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
