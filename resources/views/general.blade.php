@extends('main')
@section('body')
<div class="NTT-baocao-content tonghop-cursor">
    <div class="container">
        <h2>Tổng hợp <a target="_blank" href="taibaocao"><span class="glyphicon glyphicon-save"</span></a></h2>

        @forelse ($standardArticles as $standardArticle)
        <!-- Start Tieu chuan -->
        <div class="col-xs-12 panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><span class="glyphicon glyphicon-triangle-bottom"></span> {{ $standardArticle->title }}</h4>
                </div>
                <div class="panel-collapse m20">
                    @forelse ($standardArticle['subArticle'] as $criteriaArticle)
                    <!-- Start Tieu chi 1.1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><span class="glyphicon glyphicon-collapse-down"></span> {{ $criteriaArticle->title }}</h4>
                        </div>
                        <div class="panel-collapse m20"> 
                            <!-- start Mo ta -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><span class="glyphicon glyphicon-play-circle"></span>Mô tả</h4>
                                </div>
                                <div class="panel-collapse m20">
                                    {!! $criteriaArticle->description !!}
                                </div>
                            </div>
                            <!-- End Mo ta --> 

                            <!-- start Diem manh -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><span class="glyphicon glyphicon-play-circle"></span>Điểm mạnh</h4>
                                </div>
                                <div class="panel-collapse m20">
                                    {!! $criteriaArticle->strong !!}
                                </div>
                            </div>
                            <!-- End Diem manh --> 

                            <!-- start Ton tai -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><span class="glyphicon glyphicon-play-circle"></span>Tồn tại</h4>
                                </div>
                                <div class="panel-collapse m20">
                                    {!! $criteriaArticle->remain !!}
                                </div>
                            </div>
                            <!-- End ton tai --> 

                            <!-- start ke hoach hanh dong -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><span class="glyphicon glyphicon-play-circle"></span>Kế hoạch hành động</h4>
                                </div>
                                <div class="panel-collapse m20">
                                    {!! $criteriaArticle->action_plan !!}
                                </div>
                            </div>
                            <!-- End ke hoach hanh dong --> 

                            <!-- start tu danh gia -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><span class="glyphicon glyphicon-play-circle"></span>Tự đánh giá</h4>
                                </div>
                                <div class="panel-collapse m20">
                                    @if ($criteriaArticle->rate == 1)
                                        Đạt
                                    @else
                                        Không Đạt
                                    @endif
                                </div>
                            </div>
                            <!-- End tu danh gia --> 
                        </div>
                    </div>
                    <!-- End Tieu chi 1.1 -->
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        <div class="page-break"></div>
        <br/>
        <!-- End Tieu chuan -->
        @empty
        @endforelse
    </div>
</div>
@endsection