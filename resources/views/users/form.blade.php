<div style='clear:both; height:20px'></div>
<br>
<h4 class="hrform" style="font-size: 20px;margin-top:20px;margin-bottom: 15px;">Datos del Perfil</h4>
<div  style="margin-top:20px" class="form-group  {{ $errors->has('shop_name') ? 'has-error' : '' }}">
    <label for="shop_name" class="col-md-2 control-label">Nombre de la tienda</label>
    <div class="col-md-10">
        <input class="form-control" name="shop_name" type="text" id="shop_name" value="{{ old('shop_name', optional($user)->shop_name) }}" minlength="1" placeholder="Enter shop name here...">
        {!! $errors->first('shop_name', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Nombre del Contacto</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($user)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', optional($user)->email) }}" placeholder="Enter email here...">
        {!! $errors->first('email', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-2 control-label">
        Contraseña
        <small class='text-gray'>Ingrese aqui una nueva contraseña si desea cambiarla.</small>
    </label>
    <div class="col-md-10">
        <input class="form-control" name="password" type="password"  autocomplete="new-password" id="password" value="" placeholder="Enter password here...">
        {!! $errors->first('password', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('tipo_usuario') ? 'has-error' : '' }}">
    <label for="tipo_usuario" class="col-md-2 control-label">Tipo de Usuario</label>
    <div class="col-md-10">
        <select name="tipo_usuario" id="tipo_usuario" class="form-control">
            <option value="0">Seleccione el Perfil del Usuario</option>
            <option {{ (old('tipo_usuario', optional($user)->tipo_usuario) == 1)?'selected="selected"':'' }} value="1">Administrador</option>
            <option {{ (old('tipo_usuario', optional($user)->tipo_usuario) == 0)?'selected="selected"':'' }} value="0">Tienda</option>
        </select>

    </div>
</div>
<br>
<br>
<hr/>
<h4 class="hrform" style="font-size: 20px;margin-top:20px;margin-bottom: 15px;">Ajustes Generales de Integración</h4>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('token_code') ? 'has-error' : '' }}">
    <label for="token_code" class="col-md-2 control-label">Token Code</label>
    <div class="col-md-10">
        @php

            $tokencode = ($code != '')?$code:old('token_code', optional($user)->token_code);

            if ($tokencode == '') {
                $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $longitud = 32;
                $rand =  substr(str_shuffle($caracteres_permitidos), 0, $longitud);

                $tokencode = $rand;
            }

        @endphp
        <input class="form-control" name="token_code" type="text" disabled id="token_code" value="{{ $tokencode }}" minlength="1" placeholder="Enter token code here...">
        {!! $errors->first('token_code', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>
<div  style="margin-top:20px" class="form-group  {{ $errors->has('commerse_code') ? 'has-error' : '' }}">
    <label for="commerse_code" class="col-md-2 control-label">Código del E-commerce</label>
    <div class="col-md-10">
        <input class="form-control" name="commerse_code" type="number" id="commerse_code" value="{{ old('commerse_code', optional($user)->commerse_code) }}" minlength="1" placeholder="Enter commerse code here...">
        {!! $errors->first('commerse_code', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<br>
<br>
<hr/>
<h4 class="hrform" style="font-size: 20px;margin-top:20px;margin-bottom: 15px;">Integración con Triidy App</h4>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('triidyUser') ? 'has-error' : '' }}">
    <label for="triidyUser" class="col-md-2 control-label">Usuario de Triidy</label>
    <div class="col-md-10">
        <input class="form-control" name="triidyUser" type="text" id="triidyUser" value="{{ old('triidyUser', optional($user)->triidyUser) }}" minlength="1" placeholder="Enter commerse code here...">
        {!! $errors->first('triidyUser', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('triidyPass') ? 'has-error' : '' }}">
    <label for="triidyPass" class="col-md-2 control-label">Token de Triidy</label>
    <div class="col-md-10">
        <input class="form-control" name="triidyPass" type="text" id="triidyPass" value="{{ old('triidyPass', optional($user)->triidyPass) }}" minlength="1" placeholder="Enter commerse code here...">
        {!! $errors->first('triidyPass', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>
<br>
<br>
<hr/>
<h4 class="hrform" style="font-size: 20px;margin-top:20px;margin-bottom: 15px;">Integración WhatsApp</h4>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('whatsapp_token') ? 'has-error' : '' }}">
    <label for="whatsapp_token" class="col-md-2 control-label">Whatsapp Permanent Token</label>
    <div class="col-md-10">
        <input class="form-control" name="whatsapp_token" type="text" id="whatsapp_token" value="{{ old('whatsapp_token', optional($user)->whatsapp_token) }}" minlength="1" placeholder="Whatsapp Permanent Token...">
        {!! $errors->first('whatsapp_token', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

<div  style="margin-top:20px" class="form-group  {{ $errors->has('phone_number') ? 'has-error' : '' }}">
    <label for="phone_number" class="col-md-2 control-label">Identificador de Número de Teléfono</label>
    <div class="col-md-10">
        <input class="form-control" name="phone_number" type="text" id="phone_number" value="{{ old('phone_number', optional($user)->phone_number) }}" placeholder="">
        {!! $errors->first('phone_number', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>
<br>
<br>
<hr/>
<h4 class="hrform" style="font-size: 20px;margin-top:20px;margin-bottom: 15px;">Integración WooCommerce</h4>
<div  style="margin-top:20px" class="form-group  {{ $errors->has('url_wordpress') ? 'has-error' : '' }}">
    <label for="url_wordpress" class="col-md-2 control-label">Url E-Commerce Wordpress <small class='text-danger'>Ingrese solo la dirección web SIN https://, www, http://</small></label>
    <div class="col-md-10">
        <input class="form-control" name="url_wordpress" type="text" id="url_wordpress" value="{{ old('url_wordpress', optional($user)->url_wordpress) }}" placeholder="">
        {!! $errors->first('url_wordpress', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>
<br>
<br>
<hr/>
<h4 class="hrform" style="font-size: 20px;margin-top:20px;margin-bottom: 15px;">Integración Shopify</h4>
<div  style="margin-top:20px" class="form-group  {{ $errors->has('url_api_shopify') ? 'has-error' : '' }}">
    <label for="url_api_shopify" class="col-md-2 control-label">URL E-Commerce Shopify <small class='text-danger'>Ingrese solo la dirección web SIN https://, www, http://</small></label>
    <div class="col-md-10">
        <input class="form-control" name="url_api_shopify" type="text" id="url_api_shopify" value="{{ old('url_api_shopify', optional($user)->url_api_shopify) }}" placeholder="">
        {!! $errors->first('url_api_shopify', '<p class="help-block  text-danger">:message</p>') !!}
    </div>
</div>

















