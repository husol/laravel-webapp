<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ĐẢM BẢO CHẤT LƯỢNG - TRƯỜNG ĐẠI HỌC NGUYỄN TẤT THÀNH</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link type="text/css" href="{{asset('css/bootstrap-3.3.7.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{asset('css/home.css')}}" rel="stylesheet"> 
        <script type="text/javascript" src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap-3.3.7.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery-validation/jquery.validate-1.15.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery-validation/additional-methods.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery-validation/localization/messages_vi.js')}}"></script>
        <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery.showMessage.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/common.js')}}"></script>
        @stack('scripts')
    </head>
    <body>
        <div id="container">
            <div id="header">
                @if (Auth::check())
                <ul class="text-inline">
                    <li><a class="padtop-3" href="#" data-toggle="modal" data-target="#profile">Xin chào thầy/cô {!! json_decode(Auth::user()->info)->name !!}</a></li>
                    <li><a href="dangxuat">Thoát</a></li>
                </ul>
                @endif
                <div class="banner"> <img width="100%" class="img-responsive" src="{{asset('img/banner.png')}}"></div>
                <nav class="navbar navbar-custom">
                    <div class="navbar-header res-menu">
                        <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#myNavbar"><i class="glyphicon glyphicon-th"></i> Menu</button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li @if(getController(Route::currentRouteAction()) == 'HomeController')class="active"@endif>
                                <a class="menu-s" href="{{url('')}}">
                                    <span class="glyphicon glyphicon-home"></span> TRANG CHỦ</a>
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'ShareController')class="active"@endif>
                                @if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true" || isset(getRole(Auth::user())->cse) && getRole(Auth::user())->cse == "true")
                                    <a class="menu-s" href="{{url('chiase')}}">CHIA SẺ</a>
                                @else
                                    <a class="menu-s not-active">CHIA SẺ</a>
                                @endif
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'ReportController')class="active"@endif>
                                @if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true" || isset(getRole(Auth::user())->cse) && getRole(Auth::user())->vbc == "true")
                                    <a class="menu-s" href="{{url('baocao')}}">VIẾT BÁO CÁO</a>
                                @else
                                    <a class="menu-s not-active">VIẾT BÁO CÁO</a>
                                @endif
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'CategoryController')class="active"@endif>
                                <a class="menu-s" href="{{url('danhmuc')}}">DANH MỤC</a>
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'RoleController')class="active"@endif>
                                @if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true")
                                    <a class="menu-s" href="{{url('phanquyen')}}">PHÂN QUYỀN</a>
                                @else
                                    <a class="menu-s not-active">PHÂN QUYỀN</a>
                                @endif
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'CommentController')class="active"@endif>
                                 <a class="menu-s" href="{{url('nhanxet')}}">NHẬN XÉT</a>
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'GeneralController')class="active"@endif>
                                 <a class="menu-s" href="{{url('tonghop')}}">TỔNG HỢP</a>
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'CompanyController')class="active"@endif>
                                 <a class="menu-s" href="{{url('doanhnghiep')}}">DOANH NGHIỆP</a>
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'QuestionaireController')class="active"@endif>
                                 <a class="menu-s" href="{{url('cauhoi')}}">CÂU HỎI MẪU</a>
                            </li>
                            <li @if(getController(Route::currentRouteAction()) == 'ManagementController')class="active"@endif>
                                @if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true" || isset(getRole(Auth::user())->vtb) && getRole(Auth::user())->vtb == "true" || isset(getRole(Auth::user())->sch) && getRole(Auth::user())->sch == "true")
                                    <a class="menu-s" href="{{url('quantri')}}">QUẢN TRỊ</a>
                                @else
                                    <a class="menu-s not-active">QUẢN TRỊ</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- End of Header--> 

            <div id="body">
                @yield('body')
            </div>
        <!-- start profile-->
        <div id="profile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title text-center"><b>Thông Tin Tài Khoản</b></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @if (Auth::check())
                            <form class="not-clear form-horizontal" action="suathongtin" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::User()->id }}" />
                                <div class="form-group required">
                                    <label for="hoten" class="control-label col-xs-3">Họ Tên</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" placeholder="Nhập họ tên người dùng" name="info[name]" required minlength="3" value="{{ json_decode(Auth::User()->info)->name }}">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label for="email" class="control-label col-xs-3">Email</label>
                                    <div class="col-xs-8">
                                        <input type="email" class="form-control" placeholder="Nhập email người dùng" name="email" required value="{{ Auth::User()->email }}">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label for="pasword" class="control-label col-xs-3">Mật Khẩu</label>
                                    <div class="col-xs-8">
                                        <input type="password" id="passuserinfo" class="form-control" placeholder="Nhập mật khẩu" name="password" minlength="6" value="{{ Auth::User()->password }}">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label for="repasword" class="control-label col-xs-3">Nhập Lại Mật Khẩu</label>
                                    <div class="col-xs-8">
                                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repassword" equalTo="#passuserinfo" value="{{ Auth::User()->password }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sdt" class="control-label col-xs-3">Số Điện Thoại</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="info[phone]" minlength="6" value="{{ isset(json_decode(Auth::User()->info)->phone) ? json_decode(Auth::User()->info)->phone : '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="diachi" class="control-label col-xs-3">Địa Chỉ</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="info[address]" value="{{ isset(json_decode(Auth::User()->info)->address) ? json_decode(Auth::User()->info)->address : '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="avatar" class="control-label col-xs-3">Avatar</label>
                                    <div class="col-xs-8">
                                        <input type="file" name="avatar">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="control-label col-xs-offset-0 col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                                </div>
                                <div class="btn-group col-xs-offset-3 col-xs-9">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <!--End profile -->
            <div id="footer">
                <div class="footer">
                    <ul>
                        <li>ĐẢM BẢO CHẤT LƯỢNG - TRƯỜNG ĐẠI HỌC NGUYỄN TẤT THÀNH</li>
                        <li>Địa chỉ liên hệ: Tầng 2, Cơ sở 300A, Nguyễn Tất Thành, Phường 13, Quận 4, TP.HCM</li>
                        <li>Điện thoại: (08) 3940 4272. Email: nhbtrung89@gmail.com</li>
                        <li>Thiết kế bởi Trung nguyễn</li>
                    </ul>
                </div>
            </div>
        <!-- End of Footer-->
        </div>
        <!-- Proof browse -->
        @if (isset($proofs))
        <div id="proofbrowse" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-clearCK="false" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title text-center"><b>QUẢN LÝ MINH CHỨNG</b></h3>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Tên minh chứng</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($proofs as $index => $proof)
                                <tr>
                                    <td class="w50 text-right">{{ $index + 1 }}</td>
                                    <td>{{ $proof->name }}</td>
                                    <td class="text-center action">
                                        <button class="btn btn-default" type="button" onClick="returnFileUrl('{{ $proof->file }}')">Chọn</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- End Proof browse -->
        <script type="text/javascript">
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var BASE_URL = {!! json_encode(url('/')) !!}
        </script>
    </body>
</html>
