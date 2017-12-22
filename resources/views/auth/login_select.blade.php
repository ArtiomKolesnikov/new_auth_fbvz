@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login Select</div>

                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a data-toggle="tab" href="#panel1">Phone</a></li>
                    <li><a data-toggle="tab" href="#panel2">E-mail</a></li>
                </ul>

                <div class="tab-content">
                    <div id="panel1" class="tab-pane fade in active">
                        @include('auth.login_tab',['type'=>'phone'])

                    </div>
                    <div id="panel2" class="tab-pane fade">
                        @include('auth.login_tab',['type'=>'email'])

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
