@extends('main')
@section('body')
<!-- Admin content -->
<div class="NTT-quantri-content">
    <div class="container">
        <h2><span class="glyphicon glyphicon-briefcase"></span> QUẢN TRỊ</h2>
        <div class="row content-wrap">
            <div class="col-xs-3 menu">
                <ul class="nav nav-pills nav-stacked admin-menu">
                    @if (isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true")
                    <li class="active"><a data-toggle="pill" class="nguoidung" href="#home">Người dùng</a></li>
                    @endif
                    @if (isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true" || isset(getRole(Auth::user())->vtb) && getRole(Auth::user())->vtb == "true")
                    <li><a data-toggle="pill" class="thongbao" href="#menu1">Thông báo</a></li>
                    @endif
                    @if (isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true" || isset(getRole(Auth::user())->sch) && getRole(Auth::user())->sch == "true")
                    <li><a data-toggle="pill" class="cauhoimau" href="#menu2">Câu hỏi mẫu</a></li>
                    @endif
                    @if (isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == "true")
                    <li><a data-toggle="pill" class="doanhnghiep" href="#menu3">Doanh nghiệp</a></li>
                    <li><a data-toggle="pill" class="tieuchuan" href="#menu4">Tiêu chuẩn</a></li>
                    <li><a data-toggle="pill" class="tieuchi" href="#menu5">Tiêu chí</a></li>
                    <li><a data-toggle="pill" class="minhchung" href="#menu6">Minh chứng</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-xs-9">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ NGƯỜI DÙNG</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#themuser"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th class="text-center">Hình đại diện</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $user)
                                <tr>
                                    <td class="w50 text-right">{{ $index + 1 }}</td>
                                    <td>{{ $user->info->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center"><span class="glyphicon glyphicon-user"></span></td>
                                    <td class="text-center action"><a href="#" class="edit"  data-toggle="modal" data-target="#themuser" data="{{ $user->strinfo }}" title="Sửa" ><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoanguoidung/{{ $user->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ THÔNG BÁO</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#thongbao"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Tên thông báo</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notifs as $index => $notif)
                                <tr>
                                    <td class="w50 text-right">{{ $index + 1 }}</td>
                                    <td>{{ $notif->name }}</td>
                                    <td class="text-center action"><a href="#" class="edit" data-toggle="modal" data-target="#thongbao" data="{{ $notif->strinfo }}" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoathongbao/{{ $notif->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ CÂU HỎI MẪU</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#cauhoi"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Câu hỏi mẫu</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questionaires as $index => $questionaire)
                                <tr>
                                    <td class="w50 text-right">{{ $index + 1 }}</td>
                                    <td>{{ $questionaire->question }}</td>
                                    <td class="text-center action"><a href="#" class='edit' data-toggle="modal" data-target="#cauhoi" data="{{ $questionaire->strinfo }}" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoacauhoi/{{ $questionaire->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ DOANH NGHIỆP</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#doanhnghiep"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Tên Doanh nghiệp</th>
                                    <th>Người Liên Hệ</th>
                                    <th>Số điện thoại</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $index => $company)
                                <tr>
                                    <td class="w50 text-right">{{ $index + 1 }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->info->contactor }}</td>
                                    <td>{{ $company->info->phone }}</td>
                                    <td class="text-center action"><a href="#" class="edit" data-toggle="modal" data-target="#doanhnghiep" data="{{ $company->strinfo }}" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoadoanhnghiep/{{ $company->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ TIÊU CHUẨN</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#tieuchuan"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Tên Tiêu chuẩn</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0; ?>
                                @forelse ($standardArticles as $standardArticle)
                                <tr>
                                    <td class="w50 text-right">{{ ++$stt }}</td>
                                    <td>{{ $standardArticle->title }}</td>
                                    <td class="text-center action"><a class="edit" href="#" data-toggle="modal" data-target="#tieuchuan" data="{{ $standardArticle->strinfo }}" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoatieuchuan/{{ $standardArticle->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu5" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ TIÊU CHÍ</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#tieuchi"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th class="w50 text-right">STT</th>
                                    <th>Tên tiêu chí</th>
                                    <th>Tên tiêu chuẩn</th>
                                    <th class="w120 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($criteriaArticles as $index => $criteriaArticle)
                                <tr>
                                    <td class="w50 text-right">{{ $index + 1 }}</td>
                                    <td>{{ $criteriaArticle->title }}</td>
                                    <td>{{ $criteriaArticle->standardName }}</td>
                                    <td class="text-center action"><a class="edit" href="#" data-toggle="modal" data-target="#tieuchi" data="{{ $criteriaArticle->strinfo }}" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoatieuchi/{{ $criteriaArticle->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Chưa có dữ liệu</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="menu6" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5>QUẢN LÝ MINH CHỨNG</h5>
                            </div>
                            <div class="col-xs-6"><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#minhchung"><span class="glyphicon glyphicon-plus"></span> Thêm</button></div>
                        </div>
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
                                    <td class="text-center action"><a class="edit" href="#" data-toggle="modal" data-target="#minhchung" data="{{ $proof->strinfo }}" title="Sửa"><span class="glyphicon glyphicon-edit"></span></a><a class="delete" href="xoaminhchung/{{ $proof->id }}" data-toggle="tooltip" title="Xóa"><span class="glyphicon glyphicon-remove red"></span></a></td>
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
        <!-- End Div Row content --> 
    </div>
    <!-- End container Div --> 
</div>
<!-- End Admin content -->

<!-- Modal content User-->
<div id="themuser" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Người Dùng</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themnguoidung" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" />
                        <div class="form-group required">
                            <label for="tendangnhap" class="control-label col-xs-3">Tên Đăng Nhập</label>
                            <div class="col-xs-8">
                                <input id="username" type="text" class="form-control" placeholder="Nhập tên đăng nhập" name="username" required minlength="3"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="email" class="control-label col-xs-3">Email</label>
                            <div class="col-xs-8">
                                <input type="email" class="form-control" placeholder="Nhập email người dùng" name="email" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="hoten" class="control-label col-xs-3">Họ Tên</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Nhập họ tên người dùng" name="info[name]" required minlength="3">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="pasword" class="control-label col-xs-3">Mật Khẩu</label>
                            <div class="col-xs-8">
                                <input type="password" id="passuser" class="form-control" placeholder="Nhập mật khẩu" name="password" minlength="6">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="repasword" class="control-label col-xs-3">Nhập Lại Mật Khẩu</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repassword" equalTo="#passuser">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-xs-offset-0 col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                        </div>
                        <div class="btn-group col-xs-offset-3 col-xs-9">
                            <button id="UserSubmitBtn" type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>	
    </div>
</div>
<!-- End Modal content user-->
<!-- Modal content thong bao-->
<div id="thongbao" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Thông Báo</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themthongbao" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" />
                        <div class="form-group required">
                            <label for="tenthongbao" class="control-label col-xs-3">Tên Thông Báo</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Nhập tên thông báo" name="name" required minlength="5">
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="noidung" class="control-label col-xs-3">Nội Dung</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" id="textnoidung" name="data"></textarea>
                                <script>CKEDITOR.replace('textnoidung');</script>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                        </div>
                        <div class="btn-group col-xs-offset-3 col-xs-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal content thong bao-->
<!-- Modal content cau hoi mau-->
<div id="cauhoi" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Câu Hỏi</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themcauhoi" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" />
                        <div class="form-group required group-inline">
                            <label for="hoten" class="control-label col-xs-3">Câu Hỏi</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="textcauhoi" placeholder="Nhập câu hỏi mẫu" name="question" required minlength="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="traloi" class="control-label col-xs-3">Trả Lời</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="texttraloi" placeholder="Nhập câu trả lời " name="answer" required minlength="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                        </div>
                        <div class="btn-group col-xs-offset-3 col-xs-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>				 
    </div>
</div>
<!-- End Modal content cau hoi mau-->
<!-- Modal content doanh nghiep---->
<div id="doanhnghiep" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Doanh Nghiệp</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themdoanhnghiep" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" />
                        <div class="form-group required">
                            <label for="tendoanhnghiep" class="control-label col-xs-3">Tên Doanh Nghiệp</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Nhập tên doanh nghiệp" name="name" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="nguoilienhe" class="control-label col-xs-3">Người Liên Hệ</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Nhập người liên hệ" name="info[contactor]" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="sdt" class="control-label col-xs-3">Số Điện Thoại</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="info[phone]" required minlength="6">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="diachi" class="control-label col-xs-3">Địa Chỉ</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="info[address]" required>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal content doanh nghiep---->
<!-- Modal content tieu chuan---->
<div id="tieuchuan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Tiêu Chuẩn</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themtieuchuan" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" />
                        <div class="form-group required group-inline">
                            <label for="matcn" class="control-label col-xs-3">Mã tiêu chuẩn</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <input type="digits" class="form-control" id="matcn" name="code" required>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="tentieuchuan" class="control-label col-xs-3">Tên Tiêu Chuẩn</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="tentieuchuan" name="title" placeholder="Nhập tiêu chuẩn" required minlength="3"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group required">
                            <label class="control-label col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                        </div>
                        <div class="btn-group col-xs-offset-3 col-xs-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal content tieu chuan-->

<!-- Modal content tieu chi---->
<div id="tieuchi" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Tiêu Chí</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themtieuchi" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="" />
                        <div class="form-group required group-inline">
                            <label for="matci" class="control-label col-xs-3">Mã tiêu chí</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <input type="text" class="form-control" id="matci" name="code" required minlength="3">
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="tentieuchi" class="control-label col-xs-3">Tên Tiêu Chí</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="texttieuchuan" placeholder="Nhập tiêu chí" name="title" required minlength="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="tentieuchi" class="control-label col-xs-3">Từ Khóa</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="texttukhoa" placeholder="Nhập từ khóa" name="keyword" required></textarea>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="mota" class="control-label col-xs-3">Mô Tả</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea type="cktext" class="form-control" id="textmota" name="content" required></textarea>
                                <script>CKEDITOR.replace('textmota');</script>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="tentieuchuan" class="control-label col-xs-3">Tiêu Chuẩn</label>
                            <div class="col-xs-offset-0 col-xs-3">
                                <select class="form-control" id="selecttieuchuan" name="id_parent" required="">
                                    <option value="">Chọn tiêu chuẩn</option>
                                    @foreach ($standardArticles as $standardArticle)
                                        <option value="{{ $standardArticle->id }}">{{ $standardArticle->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                        </div>
                        <div class="btn-group col-xs-offset-3 col-xs-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal content tieu chi--> 
<!-- Modal content minh chung-------->
<div id="minhchung" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title text-center"><b>Thông Tin Minh Chứng</b></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" action="themminhchung" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value=""/>
                        <div class="form-group required group-inline">
                            <label for="tenminhchung" class="control-label col-xs-3">Mã Minh Chứng</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <input type="text" class="form-control" id="textcode" placeholder="Nhập mã minh chứng" name="code" required minlength="7">
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="tenminhchung" class="control-label col-xs-3">Tên Minh Chứng</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="textminhchung" placeholder="Nhập tên minh chứng" name="name" required minlength="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="ngaybanhanh" class="control-label col-xs-3">Ngày Ban Hành</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <textarea class="form-control" rows="3" id="textngay" placeholder="Nhập mô tả" name="issue" required date></textarea>
                            </div>
                        </div>

                        <div class="form-group required group-inline">
                            <label for="noibanhanh" class="control-label col-xs-3">Nơi Ban Hành</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <input class="form-control" id="txtnoibanhanh" name="source" required>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="dinhkem" class="control-label col-xs-3">File Đính Kèm</label>
                            <div class="col-xs-offset-0 col-xs-8">
                                <input type="file" name="file" required>
                            </div>
                        </div>
                        <div class="form-group required group-inline">
                            <label for="tentieuchuan" class="control-label col-xs-3">Tiêu Chí</label>
                            <div class="col-xs-offset-0 col-xs-3">
                                <select class="form-control" id="selecttieuchi" name="id_article" required="">
                                    <option value="">Chọn tiêu chí</option>
                                    @foreach ($criteriaArticles as $criteriaArticle)
                                        <option value="{{ $criteriaArticle->id }}">{{ $criteriaArticle->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="control-label col-xs-8">Thông tin bắt buộc được đánh dấu</label>
                        </div>
                        <div class="btn-group col-xs-offset-3 col-xs-9">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal content minh chung---->
@endsection

@push('scripts')
    <script src="{{asset('js/usermanagement.js')}}"></script>
@endpush