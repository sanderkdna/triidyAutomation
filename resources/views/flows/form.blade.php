
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($flow)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
    <label for="type" class="col-md-2 control-label">Type</label>
    <div class="col-md-10">
        <input class="form-control" name="type" type="text" id="type" value="{{ old('type', optional($flow)->type) }}" minlength="1" placeholder="Enter type here...">
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('userId') ? 'has-error' : '' }}">
    <label for="userId" class="col-md-2 control-label">User Id</label>
    <div class="col-md-10">
        <input class="form-control" name="userId" type="text" id="userId" value="{{ old('userId', optional($flow)->userId) }}" minlength="1" placeholder="Enter user id here...">
        {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
    </div>
</div>

