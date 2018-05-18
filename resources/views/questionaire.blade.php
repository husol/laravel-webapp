@extends('main')
@section('body')
<div class="NTT-cauhoi-content">
    <div class="container">
        @forelse ($questionaires as $index => $questionaire)
        <label>Câu hỏi {{ $index + 1 }}:</label> <b>{{ $questionaire->question }}</b>
        <div class="jumbotron text-justify">
            <label>Trả lời:</label>
            <p>{{ $questionaire->answer }}</p>
        </div>
        @empty
        <div class="text-center">Chưa có câu hỏi mẫu</div>
        @endforelse
    </div>
</div>
@endsection