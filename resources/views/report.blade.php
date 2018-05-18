@extends('main')
@section('body')
<div class="NTT-baocao-content">
    <div class="container">
        <h2 class="Content-tit-color"><span class="glyphicon glyphicon-list-alt"></span>Viết báo cáo</h2>
        <div class="row">
            <div class="col-xs-12 panel-group">
                <div class="panel panel-default no-border">
                    <div class="panel-collapse m20">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                @forelse ($standardArticles as $standardArticle)
                                <div class="panel-heading">
                                    <h3 class="panel-heading"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $standardArticle->id }}a"><span class="glyphicon glyphicon-equalizer"></span> {{ $standardArticle->title }}</a> </h3>
                                </div>
                                <div id="collapse{{ $standardArticle->id }}a" class="panel-collapse collapse m20">
                                    @foreach ($standardArticle['subArticle'] as $criteriaArticle)
                                    @php($tci = 'tci' . $criteriaArticle->id)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"> <a data-toggle="collapse" href="#collapse{{ $standardArticle->id }}tc{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-collapse-down"></span> {{ $criteriaArticle->title }}</a> </h4>
                                        </div>
                                        <div class="panel-title m20">
                                            {!! $criteriaArticle->content !!}
                                        </div>
                                        <div id="collapse{{ $standardArticle->id }}tc{{ $criteriaArticle->id }}" class="panel-collapse collapse m20"> 
                                            <!-- start Mo ta -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <span>Mô tả </span>
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                        <a id="description-edit-report{{ $criteriaArticle->id }}" class="edit-report" for="description_{{ $criteriaArticle->id }}" end="description-end-edit{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                                                        <a id="description-end-edit{{ $criteriaArticle->id }}" class="end-edit" style="display:none;" for="description_{{ $criteriaArticle->id }}" end="description-edit-report{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-ok"></span></a>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}a" class="panel-collapse m20">
                                                    <div id="div_description_{{ $criteriaArticle->id }}">{!! $criteriaArticle->description !!}</div>
                                                    <textarea id="description_{{ $criteriaArticle->id }}" class="form-control" rows="3" style="display:none;">{!! $criteriaArticle->description !!}</textarea>
                                                </div>
                                            </div>
                                            <!-- End Mo ta --> 

                                            <!-- Diem manh -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <span>Điểm mạnh</span>
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                        <a id="strong-edit-report{{ $criteriaArticle->id }}" class="edit-report" for="strong_{{ $criteriaArticle->id }}" end="strong-end-edit{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                                                        <a id="strong-end-edit{{ $criteriaArticle->id }}" class="end-edit" style="display:none;" for="strong_{{ $criteriaArticle->id }}" end="strong-edit-report{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-ok"></span></a>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}b" class="panel-collapse m20">
                                                    <div id="div_strong_{{ $criteriaArticle->id }}">{!! $criteriaArticle->strong !!}</div>
                                                    <textarea id="strong_{{ $criteriaArticle->id }}" class="form-control" rows="3" style="display:none;">{!! $criteriaArticle->strong !!}</textarea>
                                                </div>
                                            </div>
                                            <!-- End Diem manh --> 

                                            <!-- Ton tai -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <span>Tồn tại </span>
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                        <a id="remain-edit-report{{ $criteriaArticle->id }}" class="edit-report" for="remain_{{ $criteriaArticle->id }}" end="remain-end-edit{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                                                        <a id="remain-end-edit{{ $criteriaArticle->id }}" class="end-edit" style="display:none;" for="remain_{{ $criteriaArticle->id }}" end="remain-edit-report{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-ok"></span></a>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}c" class="panel-collapse m20">
                                                    <div id="div_remain_{{ $criteriaArticle->id }}">{!! $criteriaArticle->remain !!}</div>
                                                    <textarea id="remain_{{ $criteriaArticle->id }}" class="form-control" rows="3" style="display:none;">{!! $criteriaArticle->remain !!}</textarea>
                                                </div>
                                            </div>
                                            <!-- End Ton tai -->

                                            <!-- Ke hoach hanh dong -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <span>Kế hoạch hành động</span>
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                        <a id="plan-edit-report{{ $criteriaArticle->id }}" class="edit-report" for="action_plan_{{ $criteriaArticle->id }}" end="plan-end-edit{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                                                        <a id="plan-end-edit{{ $criteriaArticle->id }}" class="end-edit" style="display:none;" for="action_plan_{{ $criteriaArticle->id }}" end="plan-edit-report{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-ok"></span></a>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}d" class="panel-collapse m20">
                                                    <div id="div_action_plan_{{ $criteriaArticle->id }}">{!! $criteriaArticle->action_plan !!}</div>
                                                    <textarea id="action_plan_{{ $criteriaArticle->id }}" class="form-control" rows="3" style="display:none;">{!! $criteriaArticle->action_plan !!}</textarea>
                                                </div>
                                            </div>
                                            <!-- Ke hoach hanh dong --> 

                                            <!--start tu Danh gia -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <span>Tự đánh giá</span>
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                        <a class="start-edit-rate" for="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}"><span class="glyphicon glyphicon-edit"></span></a>
                                                        <a class="end-edit-rate" for="#collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}" data-rel="rate_{{ $criteriaArticle->id }}" style="display:none;"><span class="glyphicon glyphicon-ok"></span></a>
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $standardArticle->id }}{{ $criteriaArticle->id }}" class="panel-collapse collapse m20">
                                                    <label class="checkbox-inline">
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                            @if ($criteriaArticle->rate == 1)
                                                                <input id="rate_{{ $criteriaArticle->id }}" type="checkbox" checked>Đạt
                                                            @else
                                                                <input id="rate_{{ $criteriaArticle->id }}" type="checkbox">Đạt
                                                            @endif
                                                        @else
                                                            @if ($criteriaArticle->rate == 1)
                                                                <input id="rate_{{ $criteriaArticle->id }}" type="checkbox" checked disabled>Đạt
                                                            @else
                                                                <input id="rate_{{ $criteriaArticle->id }}" type="checkbox" disabled>Đạt
                                                            @endif
                                                        @endif
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        @if (isset($roles->$tci) && $roles->$tci == 'true' || $roles->isAdmin == 'true')
                                                            @if ($criteriaArticle->rate == 0)
                                                                <input type="checkbox" checked>Không đạt
                                                            @else
                                                                <input type="checkbox">Không đạt
                                                            @endif
                                                        @else
                                                            @if ($criteriaArticle->rate == 0)
                                                                <input type="checkbox" checked disabled>Không đạt
                                                            @else
                                                                <input type="checkbox" disabled>Không đạt
                                                            @endif
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- End Tu danh gia --> 
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @empty
                                <span>Chưa có Tiêu chí</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('js/report.js')}}"></script>
@endpush