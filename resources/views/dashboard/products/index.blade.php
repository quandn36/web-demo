@extends('layouts.master-dashboard')

@section('section_css')
<link href="{{asset('custom.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="page-content" bis_skin_checked="1">
    <div class="container-fluid" bis_skin_checked="1">
        <div class="" bis_skin_checked="1" style="display: flex;justify-content: space-between;">
            <div class="" bis_skin_checked="1">
                <div class="page-title-box" bis_skin_checked="1">
                    <h4>Danh sách sản phẩm</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Danh sách</li>
                        </ol>
                </div>
            </div>
            <div class="btn-create">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#searchBox">Tìm kiếm</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#product-modal" id="btn-create-product">Thêm mới</button>
            </div>
        </div>

        <div class="row" bis_skin_checked="1">
            <div class="col-12" bis_skin_checked="1">
                <div class="card" bis_skin_checked="1">
                    <div class="card-body" bis_skin_checked="1">
                        <div class="main-container">
                            <div class="table-container">
                                <div class="table-row heading">
                                    <div class="row-item">#</div>
                                    <div class="row-item">Tên sản phẩm</div>
                                    <div class="row-item">Đơn vị tính</div>
                                    <div class="row-item">Cửa hàng</div>
                                    <div class="row-item"></div>
                                </div>
                                <div id="data-stores"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>
@stop

@section('modals')
<div class="modal fade" id="product-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" bis_skin_checked="1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document" bis_skin_checked="1">
        <div class="modal-content" bis_skin_checked="1">
            <div class="modal-header" bis_skin_checked="1">
                <h5 class="modal-title" id="staticBackdropLabel">Thông tin sản phẩm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" bis_skin_checked="1">
                <input type="hidden" class="form-control" id="product-id" value="">
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="product-name">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="product-name" placeholder="Nhập vào tên sản phẩm" name="name" value="">
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="unit-id">Chọn đơn vị</label>
                    <select class="form-control" id="unit-id">
                        @if(isset($units) && count($units))
                        @foreach ($units as $index => $unit)
                        <option value="{{isset($unit->id) ? $unit->id : ''}}" <?php ($index == 0) ? 'selected' : '' ?>>{{isset($unit->name) ? $unit->name : ''}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-id">Chọn cửa hàng</label>
                    <select class="form-control" id="store-id">
                        @if(isset($stores) && count($stores))
                        @foreach ($stores as $index => $store)
                        <option value="{{isset($store->store_id) ? $store->store_id : ''}}" <?php ($index == 0) ? 'selected' : '' ?>>{{isset($store->name) ? $store->name : ''}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="description">Mô tả</label>
                    <textarea class="form-control" type="text" value="" id="description" rows='7'></textarea>
                </div>
            </div>
            <div class="modal-footer" bis_skin_checked="1">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="save-product">Lưu</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="searchBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" bis_skin_checked="1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document" bis_skin_checked="1">
        <div class="modal-content" bis_skin_checked="1">
            <div class="modal-header" bis_skin_checked="1">
                <h5 class="modal-title" id="staticBackdropLabel">Thông tin tìm kiếm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" bis_skin_checked="1">
                <input type="hidden" class="form-control" id="product-id" value="">
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="product-name-search">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="product-name-search" placeholder="Nhập vào tên sản phẩm" name="name" value="">
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="unit-id-search">Chọn đơn vị</label>
                    <select class="form-control" id="unit-id-search">
                        <option value="" selected>Vui lòng chọn</option>
                        @if(isset($units) && count($units))
                        @foreach ($units as $index => $unit)
                        <option value="{{isset($unit->id) ? $unit->id : ''}}">{{isset($unit->name) ? $unit->name : ''}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-id-search">Chọn cửa hàng</label>
                    <select class="form-control" id="store-id-search">
                        <option value="" selected>Vui lòng chọn</option>
                        @if(isset($stores) && count($stores))
                        @foreach ($stores as $index => $store)
                        <option value="{{isset($store->store_id) ? $store->store_id : ''}}">{{isset($store->name) ? $store->name : ''}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="modal-footer" bis_skin_checked="1">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="search">Tìm kiếm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="" style="text-align:center;padding: 3px 0px;">
                <h5 class="modal-title mt-0">Xác nhận xoá?</h5>
            </div>
            <div class="confirm-delete-name"></div>
            <div class="modal-body">
                <input type="hidden" id="product-id-delete" value="">
                <div style="padding: 0px 30px;">
                    <button class="btn btn-outline-primary accept">Đồng ý</button>
                </div>
                <div style="padding: 0px 30px;">
                    <button class="btn btn-outline-dark cancel" data-bs-dismiss="modal">Huỷ</button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('script')
    <script>
        $(document).ready(function(){
            loadListOfProducts();
            saveProduct();
            searchProduct();
            eventClickBtnCreate();

        });

        function deleteProduct() {
            $('.row-item .action.delete').off().on('click', function(e){
                $('#confirm-delete-modal').modal('show');
                var productId = $(this).attr('data-product-id');
                var productName = $(this).attr('data-name');
                $('#product-id-delete[type="hidden"]').val(productId);
                $('#confirm-delete-name').empty();
                $('.confirm-delete-name').html('`'+productName+'`');

                $('.accept').off().on('click', function(e){
                    $('#confirm-delete-modal').modal('hide');
                    $.ajax({
                        type: 'GET',
                        url: '/product/delete',
                        data: {
                            'product_id': productId
                        }
                    }).done(function (response){
                        if(response.success == true) {
                            toastr.success(response.message);
                            loadListOfProducts();
                        }else{
                            toastr.error(response.message);
                            console.log('error occurred', response);
                        }
                    });

                });
            });
        }

        function eventClickBtnCreate(){
            $('#btn-create-product').off().on('click', function(){
                $('#product-modal').find("input[type=text],input[type=hidden], textarea, input[type=number]").val("");
            });
        };

        function loadListOfProducts(dataReq = {}) {
            $.ajax({
                type: 'GET',
                url: '/products',
                data: dataReq,
                success: function (response) {
                    if( !JSON.parse(JSON.stringify(response)) ) {
                        toastr.error('Lấy danh sách thất bại, vui lòng liên hệ admin');
                    }else{
                        $('#data-stores').empty();
                        $('#data-stores').append(response);
                        paginateEvent();
                        editProduct();
                        deleteProduct();
                    }
                },
                error: function (response) {
                    toastr.error('Lấy danh sách thất bại');
                }
            });
        }

        function paginateEvent() {
            $('#data-stores .paginate-item .pagination a').off().on('click', function (e) {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var dataReq = {
                    'page': page
                };
                loadListOfProducts(dataReq);
            });
        };

        function saveProduct() {
            $('#save-product').off().on('click', function (e) {
                var isError = false;
                var name = $('#product-name').val();
                var unitId = $('#unit-id').val();
                var storeId = $('#store-id').val();
                var description = $('#description').val();
                var productId = $('#product-id').val();
                if(name == '') {
                    toastr.error('Vui lòng nhập tên sản phẩm');
                    isError = true;
                    return 0;
                }

                if(unitId == '') {
                    toastr.error('Vui lòng chọn đơn vị');
                    isError = true;
                    return 0;
                }

                if(storeId == '') {
                    toastr.error('Vui lòng chọn cửa hàng');
                    isError = true;
                    return 0;
                }

                if(isError == false) {
                    var dataReq = {
                        'name': name,
                        'unit_id': unitId,
                        'store_id': storeId,
                        'product_id': productId,
                        'description':description,
                    };
                    submitSaveProduct(dataReq);
                }
            });
        }

        function submitSaveProduct(dataReq = {}) {
            $.ajax({
                type: 'POST',
                url: '/products/save',
                data: dataReq,
                success: function (response) {
                    toastr.success(response.message);
                    loadListOfProducts();
                    $('#product-modal').modal('hide');
                    $('#product-modal').find("input[type=text],input[type=hidden], textarea, input[type=number]").val("");
                },
                error: function (response) {
                    toastr.error('Lưu thông tin thất bại');
                }
            });
        }

        function editProduct() {
            $('.edit-product').off().on('click', function (e) {
                var productId = $(this).attr('data-product-id');
                var storeId = $(this).attr('data-store-id');
                var productName = $(this).attr('data-name');
                var description = $(this).attr('data-description');
                var unitId = $(this).attr('data-unit-id');

                $('#product-id').val(productId);
                $('#unit-id').val(unitId).change();
                $('#product-name').val(productName);
                $('#store-id').val(storeId);
                $('#description').val(description);

                $('#product-modal').modal('show');
                saveProduct();
            });
        }

        function searchProduct() {
            $('#search').off().on('click', function (e) {
                var unitId = $('#unit-id-search').val();
                var productName = $('#product-name-search').val();
                var storeId = $('#store-id-search').val();

                var dataReq = {
                    'name': productName,
                    'unit_id': unitId,
                    'store_id': storeId,
                };

                loadListOfProducts(dataReq);

                $('#searchBox').modal('hide');
            });
        }
    </script>
@stop
