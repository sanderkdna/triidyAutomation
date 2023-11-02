@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Ticket' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('tickets.ticket.destroy', $ticket->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('tickets.ticket.index') }}" class="btn btn-primary" title="Show All Ticket">
                        <i data-lucide="list" class="w-4 h-4 text-white"></i>
                    </a>

                    <a href="{{ route('tickets.ticket.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Ticket">
                        <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                    </a>
                    
                    <a href="{{ route('tickets.ticket.edit', $ticket->id ) }}" class="btn btn-primary" title="Edit Ticket">
                        <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Ticket" onclick="return confirm(&quot;Click Ok to delete Ticket.?&quot;)">
                        <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Userid</dt>
            <dd>{{ $ticket->userid }}</dd>
            <dt>Flowid</dt>
            <dd>{{ $ticket->flowid }}</dd>
            <dt>Ticketid</dt>
            <dd>{{ $ticket->ticketid }}</dd>
            <dt>Last Message</dt>
            <dd>{{ $ticket->last_message }}</dd>
            <dt>Current Node</dt>
            <dd>{{ $ticket->current_node }}</dd>
            <dt>Contact Name</dt>
            <dd>{{ $ticket->contact_name }}</dd>
            <dt>Status</dt>
            <dd>{{ $ticket->status }}</dd>

        </dl>

    </div>
</div>

@endsection
