
<div class="form-group {{ $errors->has('ticketid') ? 'has-error' : '' }}">
    <label for="ticketid" class="col-md-2 control-label">Ticketid</label>
    <div class="col-md-10">
        <input class="form-control" name="ticketid" type="text" id="ticketid" value="{{ old('ticketid', optional($messages)->ticketid) }}" minlength="1" placeholder="Enter ticketid here...">
        {!! $errors->first('ticketid', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
    <label for="contact_name" class="col-md-2 control-label">Contact Name</label>
    <div class="col-md-10">
        <input class="form-control" name="contact_name" type="text" id="contact_name" value="{{ old('contact_name', optional($messages)->contact_name) }}" minlength="1" placeholder="Enter contact name here...">
        {!! $errors->first('contact_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
    <label for="message" class="col-md-2 control-label">Message</label>
    <div class="col-md-10">
        <input class="form-control" name="message" type="number" id="message" value="{{ old('message', optional($messages)->message) }}" placeholder="Enter message here...">
        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('node') ? 'has-error' : '' }}">
    <label for="node" class="col-md-2 control-label">Node</label>
    <div class="col-md-10">
        <input class="form-control" name="node" type="text" id="node" value="{{ old('node', optional($messages)->node) }}" minlength="1" placeholder="Enter node here...">
        {!! $errors->first('node', '<p class="help-block">:message</p>') !!}
    </div>
</div>

