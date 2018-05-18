@extends('main')
@section('body')

<div class="NTT-baocao-content">
    <div class="container">
        <h2 class="Content-tit-color"><span class="glyphicon glyphicon-tasks"></span>Phân quyền</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <label>Vui lòng chọn người dùng: </label>
                <div class="row">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4">
                        <select class="form-control" name="id_user" id="id_user_role">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" data="{{ $user->userRole }}">{!! json_decode($user->info)->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-4"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-offset-1 col-xs-3">
                        <ul class="text-bold left-line left-bo">
                            <li>
                                <input type="checkbox" name="vtb" id="vtb">
                                <label for="vtb">Viết thông báo</label>
                            </li>
                            <li>
                                <input type="checkbox" name="vbc" id="vbc">
                                <label for="vbc">Viết báo cáo</label>
                            </li>
                            <li>
                                <input type="checkbox" name="sch" id="sch">
                                <label for="sch">Soạn câu hỏi</label>
                            </li>
                            <li>
                                <input type="checkbox" name="cse" id="cse">
                                <label for="cse">Chia sẻ</label>
                            </li>
                            <li>
                                <input type="checkbox" name="isAdmin" id="qti">
                                <label for="qti">Quản trị</label>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <div class="row" id="accordion">
                            <div class="col-xs-6 panel panel-default no-border">
                                <ul class="text-bold left-bo">
                                    @foreach ($standardArticles as $standardIndex => $standardArticle)
                                    <li><a data-toggle="collapse" data-parent="#accordion" href="#mtcn{{ $standardIndex }}"><span class="glyphicon glyphicon-equalizer"></span>Tiêu chuẩn {{ $standardArticle->code }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-xs-6 panel panel-default no-border">
                                @foreach ($standardArticles as $standardIndex => $standardArticle)
                                @if ($standardIndex == 1)
                                <div id="mtcn{{ $standardIndex }}" class="panel-collapse collapse in">
                                @else
                                <div id="mtcn{{ $standardIndex }}" class="panel-collapse collapse">
                                @endif
                                    <ul class="text-bold left-bo">
                                        <li>
                                            <input type="checkbox" id="tcn{{ $standardIndex }}">
                                            <label for="tcn{{ $standardIndex }}">Chọn tất cả</label>
                                            <ul>
                                                @foreach ($criteriaArticles[$standardArticle->id] as $index => $criteriaArticle)
                                                <li>
                                                    <input type="checkbox" name="tci{{ $criteriaArticle->id }}" id="tci{{ $standardIndex }}-{{ $index }}">
                                                    <label for="tci{{ $standardIndex }}-{{ $index }}">Tiêu chí {{ $criteriaArticle->code }}</label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-offset-7 col-xs-3">
                    <button type="button" class="btn btn-primary pull-right submit-role">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('js/role.js')}}"></script>
@endpush