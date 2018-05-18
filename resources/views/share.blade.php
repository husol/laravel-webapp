@extends('main')
@section('body')
<div class="NTT-chiase-content">
    <div class="container">
        <h2 class="Content-tit-color"><span class="glyphicon glyphicon-share"></span>Chia sẻ</h2>
        <div class="row">
            <div class="col-xs-12">
                <form action="themchiase" method="post">
                    <div class="form-group">
                        <label for="comment"></label>
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" />
                        <textarea class="form-control" rows="0" id="comment" name="content"></textarea>
                        <script>CKEDITOR.replace('comment', { height: 160 });</script> 
                    </div>
                    <button type="submit" class="btn btn-default pull-right">Đăng chia sẻ</button>
                </form>
            </div>
        </div>
        @forelse ($shares as $share)
        <div class="container martop-15 row-bo">
            <div class="row">
                <div class="col-xs-2">
                    <div class="row text-center">
                        @if ($share->avatar)
                            @if (substr($share->avatar, 0, 4) == 'http' )
                                <img class="img-circle" src="{{ $share->avatar }}" width="100" height="100"/>
                            @else
                                <img class="img-circle" src="{{ asset('avatars/' . $share->avatar) }}" width="100" height="100"/>
                            @endif
                        @else
                        <span class="glyphicon glyphicon-user"></span>
                        @endif
                    </div>
                    <div class="row text-center">{{ $share->author }}</div>
                </div>
                <div class="col-xs-10">
                    <div class="row">
                        <div class="col-xs-9">
                            {!! $share->content !!}
                            <form action="themchiase" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $share->id }}" />
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" />
                                <div class="row bln{{ $share->id }}a collapse">
                                    <div class="col-xs-11 marle">
                                        <textarea class="te-area" rows="3" placeholder="Sửa chia sẻ trên" name="content"></textarea>
                                    </div>
                                    <div class="col-xs-1 martop-10">
                                        <button type="submit" class="btn btn-default">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-3 text-right but-patop">
                            <a class="share-3bu" data-toggle="collapse" data-target=".bln{{ $share->id }}" data-toggle="tooltip" title="Xem và Bình luận"><span class="glyphicon glyphicon-comment com-glyph-size"></span></a>
                            @if ($share->id_user == Auth::user()->id)
                            <a class="share-3bu"><span data-toggle="collapse" data-target=".bln{{ $share->id }}a" class="glyphicon glyphicon-pencil upd-glyph-size" data-toggle="tooltip" title="Chỉnh sửa"></span></a>
                            <a href="xoachiase/{{ $share->id }}" class="share-3bu delete"><span class="glyphicon glyphicon-remove rem-glyph-size" data-toggle="tooltip" title="Xóa"></span></a>
                            @endif
                        </div>
                    </div>
                    @forelse ($share['substatus'] as $subshare)
                    <div class="row row-bo-top bln{{ $share->id }} collapse">
                        <div class="col-xs-1">
                            <div class="row text-center">
                                @if ($subshare->avatar)
                                    @if (substr($subshare->avatar, 0, 4) == 'http' )
                                        <img class="img-circle" src="{{ $subshare->avatar }}" width="50" height="50"/>
                                    @else
                                        <img class="img-circle" src="{{ asset('avatars/' . $subshare->avatar) }}" width="50" height="50"/>
                                    @endif
                                @else
                                <span class="glyphicon glyphicon-user"></span>
                                @endif
                            </div>
                            <div class="row text-center">{{ $subshare->author }}</div>
                        </div>
                        <div class="col-xs-11">
                            <div class="row">
                                <div class="col-xs-10">
                                    {!! $subshare->content !!}
                                    <form action="themchiase" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $subshare->id }}" />
                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" />
                                        <input type="hidden" name="id_parent" value="{{ $share->id }}" />
                                        <div class="row bln{{ $subshare->id }}a collapse">
                                            <div class="col-xs-9 marle">
                                                <textarea class="te-area" rows="1" placeholder="Sửa bình luận trên" name="content"></textarea>
                                            </div>
                                            <div class="col-xs-3 martop-10">
                                                <button type="submit" class="btn btn-default">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xs-2 text-right but-patop">
                                    @if ($subshare->id_user == Auth::user()->id)
                                    <a class="share-3bu"><span data-toggle="collapse" data-target=".bln{{ $subshare->id }}a" class="glyphicon glyphicon-pencil upd-glyph-size" data-toggle="tooltip" title="Chỉnh sửa"></span></a>
                                    <a href="xoachiase/{{ $subshare->id }}" class="share-3bu delete"><span class="glyphicon glyphicon-remove rem-glyph-size" data-toggle="tooltip" title="Xóa"></span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                    <div class="row bln{{ $share->id }} collapse">
                        <form action="themchiase" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" />
                            <input type="hidden" name="id_parent" value="{{ $share->id }}" />
                            <div class="col-xs-8 marle">
                                <textarea class="te-area" rows="1" placeholder="Nhập vào bình luận mới" name="content"></textarea>
                            </div>
                            <div class="col-xs-4 martop-10">
                                <button type="submit" class="btn btn-default">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>

@endsection