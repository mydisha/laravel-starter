<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }} | Admin Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/flat-admin.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/blue-sky.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/blue.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/red.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/theme/yellow.css') }}">
    </head>
    <body>
        <div class="app app-default">
            <div class="app-container app-login">
                <div class="flex-center">
                    <div class="app-header"></div>
                    <div class="app-body">
                        <div class="app-block">
                            <div class="app-form">
                                <div class="form-header">
                                    <div class="app-brand"><span class="highlight">{{ config('app.name') }}</span> Admin</div>
                                </div>
                                <form action="{{ route('login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <span class="input-group-addon" id="basic-addon1">
                                        <i class="fa fa-user" aria-hidden="true"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" value="{{ old('email') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <span class="input-group-addon" id="basic-addon2">
                                        <i class="fa fa-key" aria-hidden="true"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" required>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-submit">Masuk</button>
                                        {{-- <a class="btn btn-primary btn-submit" href="{{ URL::route('register') }}">Daftar</a> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="app-footer">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>