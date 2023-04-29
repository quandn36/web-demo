@extends('layouts.master-dashboard')

@section('content')
<div class="page-content" bis_skin_checked="1">
    <div class="container-fluid" bis_skin_checked="1">
        <div class="row" bis_skin_checked="1">
            <div class="col-sm-6" bis_skin_checked="1">
                <div class="page-title-box" bis_skin_checked="1">
                    <h4>Dashboard</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Trang tổng quan</li>
                        </ol>
                </div>
            </div>
        </div>
        <div class="row" bis_skin_checked="1">
            <div class="col-xl-3 col-sm-6" bis_skin_checked="1">
                <div class="card mini-stat bg-primary" bis_skin_checked="1">
                    <div class="card-body mini-stat-img" bis_skin_checked="1">
                        <div class="mini-stat-icon" bis_skin_checked="1">
                            <i class="mdi mdi-cube-outline float-end"></i>
                        </div>
                        <div class="text-white" bis_skin_checked="1">
                            <h6 class="text-uppercase mb-3 font-size-16 text-white">Cửa hàng</h6>
                            <h2 class="mb-4 text-white" id="total-store">0</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6" bis_skin_checked="1">
                <div class="card mini-stat bg-primary" bis_skin_checked="1">
                    <div class="card-body mini-stat-img" bis_skin_checked="1">
                        <div class="mini-stat-icon" bis_skin_checked="1">
                            <i class="mdi mdi-buffer float-end"></i>
                        </div>
                        <div class="text-white" bis_skin_checked="1">
                            <h6 class="text-uppercase mb-3 font-size-16 text-white">Sản phẩm</h6>
                            <h2 class="mb-4 text-white" id="total-product">0</h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('script')
    <script>
        $(document).ready(function(){
            var dataReq = {};
            $.ajax({
                type: 'GET',
                url: '/total-data',
                data: dataReq,
                success: function (response) {
                    $('#total-store').html(response.totalStore);
                    $('#total-product').html(response.totalProduct);
                },
                error: function (response) {
                     console.log('Lấy dữ liệu thất bại, vui lòng kiểm tra');
                }
            });
        });
    </script>
@stop
