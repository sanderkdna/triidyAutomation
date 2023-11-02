
<div class="form-group {{ $errors->has('userId') ? 'has-error' : '' }}">
    <label for="userId" class="col-md-2 control-label">User Id</label>
    <div class="col-md-10">
        <input class="form-control" name="userId" type="text" id="userId" value="{{ old('userId', optional($endpoint)->userId) }}" minlength="1" placeholder="Enter user id here...">
        {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-10">
        <input class="form-control" name="title" type="text" id="title" value="{{ old('title', optional($endpoint)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
    <label for="url" class="col-md-2 control-label">Url</label>
    <div class="col-md-10">
        <input class="form-control" name="url" type="text" id="url" value="{{ old('url', optional($endpoint)->url) }}" minlength="1" placeholder="Enter url here...">
        {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

