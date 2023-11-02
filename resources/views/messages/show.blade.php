@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Messages' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('messages.messages.destroy', $messages->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('messages.messages.index') }}" class="btn btn-primary" title="Show All Messages">
                        <i data-lucide="list" class="w-4 h-4 text-white"></i>
                    </a>

                    <a href="{{ route('messages.messages.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Messages">
                        <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                    </a>
                    
                    <a href="{{ route('messages.messages.edit', $messages->id ) }}" class="btn btn-primary" title="Edit Messages">
                        <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Messages" onclick="return confirm(&quot;Click Ok to delete Messages.?&quot;)">
                        <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Ticketid</dt>
            <dd>{{ $messages->ticketid }}</dd>
            <dt>Contact Name</dt>
            <dd>{{ $messages->contact_name }}</dd>
            <dt>Message</dt>
            <dd>{{ $messages->message }}</dd>
            <dt>Node</dt>
            <dd>{{ $messages->node }}</dd>
            <dt>Created At</dt>
            <dd>{{ $messages->created_at }}</dd>

        </dl>

    </div>
</div>

@endsection
