@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Flow Messages' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('flow_messages.flow_messages.destroy', $flowMessages->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('flow_messages.flow_messages.index') }}" class="btn btn-primary" title="Show All Flow Messages">
                        <i data-lucide="list" class="w-4 h-4 text-white"></i>
                    </a>

                    <a href="{{ route('flow_messages.flow_messages.create') }}" class="btn btn-primary mr-1 mb-2" title="Create New Flow Messages">
                        <i data-lucide="plus" class="w-4 h-4 text-white"></i>
                    </a>
                    
                    <a href="{{ route('flow_messages.flow_messages.edit', $flowMessages->id ) }}" class="btn btn-primary" title="Edit Flow Messages">
                        <i data-lucide="edit" class="w-4 h-4 text-white"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Flow Messages" onclick="return confirm(&quot;Click Ok to delete Flow Messages.?&quot;)">
                        <i data-lucide="trash" class="w-4 h-4 text-white"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Userid</dt>
            <dd>{{ $flowMessages->userid }}</dd>
            <dt>Flowid</dt>
            <dd>{{ $flowMessages->flowid }}</dd>
            <dt>Message</dt>
            <dd>{{ $flowMessages->message }}</dd>
            <dt>Node Parent</dt>
            <dd>{{ $flowMessages->node_parent }}</dd>
            <dt>Node Answer</dt>
            <dd>{{ $flowMessages->node_answer }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $flowMessages->updated_at }}</dd>
            <dt>End Pointid</dt>
            <dd>{{ $flowMessages->end_pointid }}</dd>

        </dl>

    </div>
</div>

@endsection
