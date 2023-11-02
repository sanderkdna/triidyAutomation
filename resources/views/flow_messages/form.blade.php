<div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
    <div class="col-md-10">
        <textarea name="message" id="message" cols="30" rows="10" style="width:100%">{{ old('message', optional($flowMessages)->message) }}</textarea>

        {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
    </div>
</div>
