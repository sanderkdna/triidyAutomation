
<div class="form-group {{ $errors->has('userid') ? 'has-error' : '' }}">
    <label for="userid" class="col-md-2 control-label">Userid</label>
    <div class="col-md-10">
        <input class="form-control" name="userid" type="text" id="userid" value="{{ old('userid', optional($ticket)->userid) }}" minlength="1" placeholder="Enter userid here...">
        {!! $errors->first('userid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('flowid') ? 'has-error' : '' }}">
    <label for="flowid" class="col-md-2 control-label">Flowid</label>
    <div class="col-md-10">
        <input class="form-control" name="flowid" type="text" id="flowid" value="{{ old('flowid', optional($ticket)->flowid) }}" minlength="1" placeholder="Enter flowid here...">
        {!! $errors->first('flowid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ticketid') ? 'has-error' : '' }}">
    <label for="ticketid" class="col-md-2 control-label">Ticketid</label>
    <div class="col-md-10">
        <input class="form-control" name="ticketid" type="text" id="ticketid" value="{{ old('ticketid', optional($ticket)->ticketid) }}" minlength="1" placeholder="Enter ticketid here...">
        {!! $errors->first('ticketid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('last_message') ? 'has-error' : '' }}">
    <label for="last_message" class="col-md-2 control-label">Last Message</label>
    <div class="col-md-10">
        <input class="form-control" name="last_message" type="number" id="last_message" value="{{ old('last_message', optional($ticket)->last_message) }}" placeholder="Enter last message here...">
        {!! $errors->first('last_message', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('current_node') ? 'has-error' : '' }}">
    <label for="current_node" class="col-md-2 control-label">Current Node</label>
    <div class="col-md-10">
        <input class="form-control" name="current_node" type="text" id="current_node" value="{{ old('current_node', optional($ticket)->current_node) }}" minlength="1" placeholder="Enter current node here...">
        {!! $errors->first('current_node', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
    <label for="contact_name" class="col-md-2 control-label">Contact Name</label>
    <div class="col-md-10">
        <input class="form-control" name="contact_name" type="text" id="contact_name" value="{{ old('contact_name', optional($ticket)->contact_name) }}" minlength="1" placeholder="Enter contact name here...">
        {!! $errors->first('contact_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', optional($ticket)->status) }}" minlength="1" placeholder="Enter status here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

