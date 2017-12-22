<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    @if($type === 'email')
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    @else
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    @endif
        <label for="{{$type === 'email' ? 'email' : 'phone'}}" class="col-md-4 control-label">{{$type === 'email' ? 'E-Mail Address' : 'Phone'}}</label>

        <div class="col-md-6">
            @if($type === 'email')
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            @else
                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="+ 7" required autofocus>
                @if ($errors->has('phone'))
                    <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            @endif

        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </div>
</form>