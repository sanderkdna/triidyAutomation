@extends('../layout/' . $layout)

@section('subhead')
    <title>Triidy - Plataforma de Comunicaciones</title>
@endsection

@section('subcontent')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">Create New Ticket</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('tickets.ticket.index') }}" class="btn btn-primary" title="Show All Ticket">
                    <i data-lucide="list" class="w-4 h-4 text-white"></i>
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

            <form method="POST" action="{{ route('tickets.ticket.store') }}" accept-charset="UTF-8" id="create_ticket_form" name="create_ticket_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('tickets.form', [
                                        'ticket' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


