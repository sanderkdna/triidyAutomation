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
                <h4 class="mt-5 mb-5">Flujos Creados</h4>
            </div>

        </div>
        
        @if(count($flows) == 0)
            <div class="panel-body text-center">
                <h4>No Flows Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($flows as $flow)
                        <tr>
                            <td>{{ $flow->title }}</td>
                            <td>
                                <div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="{{ route('flows.flow.show', $flow->id ) }}" class="btn btn-secondary" title="Show Flow">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $flows->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
