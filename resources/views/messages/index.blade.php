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
                <h4 class="mt-5 mb-5">Messages</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('messages.messages.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Messages">
                    <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                </a>
            </div>

        </div>
        
        @if(count($messagesObjects) == 0)
            <div class="panel-body text-center">
                <h4>No Messages Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Ticketid</th>
                            <th>Contact Name</th>
                            <th>Node</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($messagesObjects as $messages)
                        <tr>
                            <td>{{ $messages->ticketid }}</td>
                            <td>{{ $messages->contact_name }}</td>
                            <td>{{ $messages->node }}</td>

                            <td>

                                <form method="POST" action="{!! route('messages.messages.destroy', $messages->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('messages.messages.show', $messages->id ) }}" class="btn btn-secondary" title="Show Messages">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('messages.messages.edit', $messages->id ) }}" class="btn btn-primary" title="Edit Messages">
                                            <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Messages" onclick="return confirm(&quot;Click Ok to delete Messages.&quot;)">
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
            {!! $messagesObjects->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
