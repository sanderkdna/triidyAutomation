    <div class="pull-left">
        <h4 class="mt-5 mb-5">Editar Mensaje</h4>
    </div>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

<form method="POST" action="{{ route('flow_messages.flow_messages.update', $flowMessages->id) }}" id="edit_flow_messages_form" name="edit_flow_messages_form" accept-charset="UTF-8" class="form-horizontal">
    {{ csrf_field() }}
    <input name="id" type="hidden" value="{{ $flowMessages->id }}">
        @include ('flow_messages.form', [
                                'flowMessages' => $flowMessages,
                              ])

    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input class="btn btn-primary" type="submit" value="Actualizar Mensaje">
        </div>
    </div>
</form>

