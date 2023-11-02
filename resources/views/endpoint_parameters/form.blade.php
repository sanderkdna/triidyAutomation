
<div class="form-group {{ $errors->has('endpointId') ? 'has-error' : '' }}">
    <label for="endpointId" class="col-md-2 control-label">Endpoint Id</label>
    <div class="col-md-10">
        <input class="form-control" name="endpointId" type="text" id="endpointId" value="{{ old('endpointId', optional($endpointParameter)->endpointId) }}" minlength="1" placeholder="Enter endpoint id here...">
        {!! $errors->first('endpointId', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('parameter') ? 'has-error' : '' }}">
    <label for="parameter" class="col-md-2 control-label">Parameter</label>
    <div class="col-md-10">
        <input class="form-control" name="parameter" type="text" id="parameter" value="{{ old('parameter', optional($endpointParameter)->parameter) }}" minlength="1" placeholder="Enter parameter here...">
        {!! $errors->first('parameter', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="col-md-2 control-label">Description</label>
    <div class="col-md-10">
        <textarea class="form-control" name="description" cols="50" rows="10" id="description" minlength="1" maxlength="1000">{{ old('description', optional($endpointParameter)->description) }}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('userId') ? 'has-error' : '' }}">
    <label for="userId" class="col-md-2 control-label">User Id</label>
    <div class="col-md-10">
        <input class="form-control" name="userId" type="text" id="userId" value="{{ old('userId', optional($endpointParameter)->userId) }}" minlength="1" placeholder="Enter user id here...">
        {!! $errors->first('userId', '<p class="help-block">:message</p>') !!}
    </div>
</div>

