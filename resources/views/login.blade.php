@extends('main')
@section('body')
<div class="NTT-content">
    <div class="row">
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
        <div class="col-xs-offset-2 col-xs-8 col-sm-offset-4 col-sm-4">
          <form class="dangnhap" action="kiemtrataikhoan" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputEmail1">Tên đăng nhập</label>
              <input type="username" name="username" class="form-control" id="username" placeholder="Tên đăng nhập" value="{{ old('username') }}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Mật khẩu</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu">
            </div>
            <div class="checkbox col-xs-12 col-sm-8">
              <label><input type="checkbox"> Nhớ mật khẩu </label>
            </div>
            <div class="row">
              <div class="col-xs-offset-4 col-xs-8">
                <button type="submit" class="btn btn-default">Đăng Nhập</button>
              </div>
            </div>
          </form>
        </div>
    </div>
    <!-- End of Form-->
</div>
<!-- End of Content-->
@endsection