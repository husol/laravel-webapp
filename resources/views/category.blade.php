@extends('main')
@section('body')
<div class="NTT-baocao-content">
    <div id="panel-category" class="container">
        <h2 class="Content-tit-color"><span class="glyphicon glyphicon-tasks"></span>Danh mục</h2>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#panel-category" href="#collapse1"><span class="glyphicon glyphicon-equalizer"></span> Các tiêu chuẩn</a></h4>
            </div>
            <div id="collapse1" class="panel-collapse m20 collapse">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        @foreach ($standardArticles as $standardArticle)
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $standardArticle->id }}a"><span class="glyphicon glyphicon-collapse-down"></span> {{ $standardArticle->title }}</a>
                            </h4>
                        </div>
                        <div id="collapse{{ $standardArticle->id }}a" class="panel-collapse collapse m20">
                            @foreach ($standardArticle['subArticle'] as $criteriaArticle)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}tc{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-collapse-down"></span> {{ $criteriaArticle->title }}</a>
                                        <a href="#"><span class="glyphicon glyphicon-save"></span></a>
                                    </h4>
                                </div>
                                <div class="panel-title m20">
                                    {!! $criteriaArticle->content !!}
                                </div>
                                <div id="collapse{{ $standardArticle->id }}tc{{ $criteriaArticle->id }}" class="panel-collapse collapse m20"> 
                                    <!-- start mo ta -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}a">Mô tả </a><a href="#"></a></h4>
                                        </div>
                                        <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}a" class="panel-collapse collapse m20">
                                            {!! $criteriaArticle->description !!}
                                        </div>
                                    </div>
                                    <!-- End mo ta --> 

                                    <!-- start diem manh -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}b">Điểm mạnh </a><a href="#"></a></h4>
                                        </div>
                                        <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}b" class="panel-collapse collapse m20">
                                            {!! $criteriaArticle->strong !!}
                                        </div>
                                    </div>
                                    <!-- End diem manh --> 

                                    <!-- start ton tai -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}c">Tồn tại </a><a href="#"></a></h4>
                                        </div>
                                        <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}c" class="panel-collapse collapse m20">
                                            {!! $criteriaArticle->remain !!}
                                        </div>
                                    </div>
                                    <!-- End ton tai --> 

                                    <!-- start ke hoach hanh dong -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}d">Kế hoạch hành động </a><a href="#"></a></h4>
                                        </div>
                                        <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}d" class="panel-collapse collapse m20">
                                            {!! $criteriaArticle->action_plan !!}
                                        </div>
                                    </div>
                                    <!-- End ke hoach hanh dong --> 

                                    <!-- start tu danh gia -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}e">Tự đánh giá </a><a href="#"></a></h4>
                                        </div>
                                        <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}e" class="panel-collapse collapse m20">
                                            @if ($criteriaArticle->rate == 1)
                                                Đạt
                                            @else
                                                Không đạt
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End tu danh gia --> 
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#panel-category" href="#collapse2"><span class="glyphicon glyphicon-equalizer"></span> Các minh chứng</a> </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <table class="table table-hover">
                    <thead class="tr-grey">
                        <tr>
                            <th>Mã Minh Chứng</th>
                            <th>Tên minh chứng</th>
                            <th>Số, ngày/tháng ban hành</th>
                            <th>Nơi ban hành</th>
                            <th class="text-center">Link</th>
                        </tr>
                    </thead>
                    @foreach ($standardArticles as $standardArticle)
                    <tbody>
                        <tr data-toggle="collapse" href=".tcn{{ $standardArticle->id }}" class="tr-blue">
                            <td colspan="5">{{ $standardArticle->title }}</td>
                        </tr>
                    </tbody>
                        @foreach ($standardArticle['subArticle'] as $criteriaArticle)
                            <tbody class="collapse tcn{{ $standardArticle->id }}">
                                <tr data-toggle="collapse" href=".tci-{{ $standardArticle->id }}-{{ $criteriaArticle->id }}" class="tr-lblue">
                                    <td colspan="5">{{ $criteriaArticle->title }}</td>
                                </tr>
                                @foreach ($proofs as $proof)
                                    @if ($proof->id_article != $criteriaArticle->id)
                                        @continue
                                    @endif
                                    <tr class="collapse tci-{{ $standardArticle->id }}-{{ $criteriaArticle->id }}">
                                        <td>{{ $proof->code }}</td>
                                        <td>{{ $proof->name }}</td>
                                        <td>{{ $proof->issue }}</td>
                                        <td>{{ $proof->source }}</td>
                                        <td class="text-center"><a target="_blank" href="{{ $proof->file }}"><span class="glyphicon glyphicon-save"></span></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Content-->
@endsection