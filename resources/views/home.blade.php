@extends('main')
@section('body')
<div class="NTT-content">
    <div class="container">
        <ul>
            @forelse ($notifications as $notification)
            <li>
                <span class="glyphicon glyphicon-book blue"></span>
                <a href="thongbao/{{ $notification->id }}">Thông báo: {{ $notification->name }}</a>
            </li>
            @empty
            <div class="text-center">Chưa có thông báo</div>
            @endforelse
        </ul>
    </div>
</div>
<!-- End of Content-->
@endsection