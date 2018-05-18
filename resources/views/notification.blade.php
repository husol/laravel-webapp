@extends('main')
@section('body')
<div class="NTT-cauhoi-content">
    <div class="container">
        <label>Thông báo:</label> <b>{{ $notification->name }}</b>
        <div class="jumbotron text-justify">
            {!! $notification->data !!}
        </div>
    </div>
    <div class="container">
        <h3><span class="glyphicon glyphicon-bullhorn blue"></span> Thông báo khác</h3>
        <div class="row">
            <div class="col-xs-6"><ul class="v-noti-line">
                    <li><span class="glyphicon glyphicon-book blue"></span>
                        <a href="#">Thông báo: Khẩn trương abc</a>
                    </li>
                    <li><span class="glyphicon glyphicon-book blue"></span>
                        <a href="#">Thông báo: Khẩn trương xyz</a>
                    </li>
                </ul></div>
            <div class="col-xs-6">
                <ul class="v-noti-line">
                    <li><span class="glyphicon glyphicon-book blue"></span>
                        <a href="#">Thông báo: Khẩn trương abc</a>
                    </li>
                    <li><span class="glyphicon glyphicon-book blue"></span>
                        <a href="#">Thông báo: Khẩn trương xyz</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection