@extends('main')
@section('body')
<div class="NTT-content">
    <div class="container">
        <div class="table-responsive">
            <div><h3><b>Thông tin doanh nghiệp</b></h3></div>
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Doanh Nghiệp</th>
                        <th>Người Liên Hệ</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companies as $index => $company)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->info->contactor }}</td>
                        <td>{{ $company->info->phone }}</td>
                        <td>{{ $company->info->address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Chưa có doanh nghiệp</td>
                    </tr>
                    @endforelse      
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection