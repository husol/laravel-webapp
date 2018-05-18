<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" href="{{asset('css/bootstrap-3.3.7.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('css/home.css')}}" rel="stylesheet"> 
    <style type="text/css">
        .tieude-tieuchi{               
                font-size: 13px;
                font-weight: bold;
                width: 100%;
                 margin-left: 15px;
        }
        .tieuchuan{                
                font-size: 17px;
                font-weight: bold;
                width: 100%;
                margin-left: 10px;
        }
        .tieuchi-pdf{                
                font-size: 15px;
                font-weight: bold;
                width: 100%;
                 margin-left: 10px;
        }
        .noidung{              

                margin-left: 40px;
        }
        .div-pdf{
            margin-left: 23px;
            text-align: justify;
            text-justify: inter-word;
            margin-right: 23px;
        }
    </style>
</head>
<body>
    <div class="NTT-baocao-content tonghop-cursor">
        <div class="container">
            <h2 style="text-align: center;">BÁO CÁO TỰ ĐÁNH GIÁ</h2>
        @foreach ($standardArticles as $standardArticle)
            <!-- Start Tieu chuan -->       
            <div>
                <h4 class="tieuchuan">{{ $standardArticle->code }}. {{ $standardArticle->title }}</h4>
            </div>                
            @foreach ($standardArticle['subArticle'] as $criteriaArticle)
                <!-- Start Tieu chi 1.1 -->
                <div>
                    <h4 class="tieuchi-pdf">{{ $criteriaArticle->code }}. {{ $criteriaArticle->title }}</h4>
                </div>                       
                <!-- Start Mo ta -->
                <div class="div-pdf">
                    <div>
                        <h4 class="tieude-tieuchi"><img width="16" height="16" src="{{asset('img/bullet.png')}}"/> Mô tả</h4>
                    </div>
                    <div class="noidung">
                       {!! $criteriaArticle->description !!}
                    </div>
                </div>
                <!-- End Mo ta --> 
                <!-- Start Diem manh -->
                <div class="div-pdf">
                    <div>
                        <h4 class="tieude-tieuchi"><img width="16" height="16" src="{{asset('img/bullet.png')}}"/> Điểm mạnh</h4>
                    </div>
                    <div class="noidung">
                        {!! $criteriaArticle->strong !!}
                    </div>
                </div>
                <!-- End Diem manh --> 
                <!-- Start Ton tai -->
                <div class="div-pdf">
                    <div>
                        <h4 class="tieude-tieuchi"><img width="16" height="16" src="{{asset('img/bullet.png')}}"/> Tồn tại</h4>
                    </div>
                    <div class="noidung">
                        {!! $criteriaArticle->remain !!}
                    </div>
                </div>
                <!-- End Ton tai --> 
                <!-- Start Ke hoach hanh dong -->
                <div class="div-pdf">
                    <div>
                        <h4 class="tieude-tieuchi"><img width="16" height="16" src="{{asset('img/bullet.png')}}"/> Kế hoạch hành động</h4>
                    </div>
                    <div class="noidung">
                        {!! $criteriaArticle->action_plan !!}
                    </div>
                </div>
                <!-- End Ke hoach hanh dong --> 
                <!-- Start Tu danh gia -->
                <div class="div-pdf">
                    <h4 class="tieude-tieuchi"><img width="16" height="16" src="{{asset('img/bullet.png')}}"/> Tự đánh giá</h4>
                    <div class="noidung">
                        @if ($criteriaArticle->rate == 1)
                            Đạt
                        @else
                            Không đạt
                        @endif
                    </div>
                </div>
                <!-- End Tu danh gia -->                        
                <!-- End Tieu chi 1.1 -->
            @endforeach
            <br />
            <!-- End Tieu chuan -->
        @endforeach
        </div>
    </div>
</body>
</html>
