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
                    <h4>Danh sách cửa hàng</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Danh sách</li>
                        </ol>
                </div>
            </div>
            <div class="btn-create">
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#searchBox">Tìm kiếm</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btn-add-store">Thêm mới</button>
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
                                    <div class="row-item">Tên cửa hàng</div>
                                    <div class="row-item">Địa chỉ</div>
                                    <div class="row-item">Số điện thoại</div>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" bis_skin_checked="1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document" bis_skin_checked="1">
        <div class="modal-content" bis_skin_checked="1">
            <div class="modal-header" bis_skin_checked="1">
                <h5 class="modal-title" id="staticBackdropLabel">Thông tin cửa hàng
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" bis_skin_checked="1">
                <input type="hidden" class="form-control" id="store-id" value="">
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-name">Tên cửa hàng</label>
                    <input type="text" class="form-control" id="store-name" placeholder="Nhập vào tên cửa hàng" name="name" value="">
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-address">Địa chỉ</label>
                    <input type="text" class="form-control" id="store-address" placeholder="Nhập vào địa chỉ cửa hàng" value="">
                </div>
                {{-- <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-address">Đơn vị tính</label>
                    <select class="form-control">
                        <option>Chọn đơn vị</option>
                        <option>Large select</option>
                        <option>Small select</option>
                    </select>
                </div> --}}
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="phone">Số điện thoại</label>
                    <input class="form-control" type="number" value="" id="phone" placeholder="EX: 0989.488.390" >
                </div>

                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="phone">Mô tả</label>
                    <textarea class="form-control" type="text" value="" id="description" rows='7'></textarea>
                </div>
            </div>
            <div class="modal-footer" bis_skin_checked="1">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="save-store">Lưu</button>
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
                <input type="hidden" class="form-control" id="store-id" value="">
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-name">Tên cửa hàng</label>
                    <input type="text" class="form-control" id="store-name-search" placeholder="Nhập vào tên cửa hàng" name="name" value="">
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="store-address">Địa chỉ</label>
                    <input type="text" class="form-control" id="store-address-search" placeholder="Nhập vào địa chỉ cửa hàng" value="">
                </div>
                <div class="mb-3" bis_skin_checked="1">
                    <label class="form-label" for="phone">Số điện thoại</label>
                    <input class="form-control" type="number" value="" id="phone-search" placeholder="EX: 0989.488.390" >
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
            <div class="modal-body" style="display:flex;justify-content: center;">
                <input type="hidden" id="store-id-delete" value="">
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
            loadListOfStore();
            saveStore();
            saerchStore();
            eventClickBtnCreate();
        });

        function deleteStore() {
            $('.row-item .action.delete').off().on('click', function(e){
                $('#confirm-delete-modal').modal('show');
                var storeId = $(this).attr('data-store-id');
                $('#store-id-delete[type="hidden"]').val(storeId);
                var productName = $(this).attr('data-name');
                $('#confirm-delete-name').empty();
                $('.confirm-delete-name').html('`'+productName+'`');

                $('.accept').off().on('click', function(e){
                    $('#confirm-delete-modal').modal('hide');
                    $.ajax({
                        type: 'GET',
                        url: '/stores/delete',
                        data: {
                            'store_id': storeId
                        }
                    }).done(function (response){
                        if(response.success == true) {
                            toastr.success(response.message);
                            loadListOfStore();
                        }else{
                            toastr.error(response.message);
                            console.log('error occurred', response);
                        }
                    });

                });
            });
        }


        function eventClickBtnCreate() {
            $('#btn-add-store').off().on('click', function(){
                $('#staticBackdrop').find("input[type=text],input[type=hidden], textarea, input[type=number]").val("");
            });
        };

        function loadListOfStore(dataReq = {}) {
            $.ajax({
                type: 'GET',
                url: '/stores',
                data: dataReq,
                success: function (response) {
                    if( !JSON.parse(JSON.stringify(response)) ) {
                        toastr.error('Lấy danh sách thất bại, vui lòng liên hệ admin');
                    }else{
                        $('#data-stores').empty();
                        $('#data-stores').append(response);
                        paginateEvent();
                        editStore();
                        deleteStore();
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
                loadListOfStore(dataReq);
            });
        };

        function saveStore() {
            $('#save-store').off().on('click', function (e) {
                var isError = false;
                var name = $('#store-name').val();
                var address = $('#store-address').val();
                var phone = $('#phone').val();
                var description = $('#description').val();
                var storeId = $('#store-id').val();
                if(name == '') {
                    toastr.error('Vui lòng nhập tên cửa hàng');
                    isError = true;
                    return 0;
                }

                if(address == '') {
                    toastr.error('Vui lòng nhập địa chỉ');
                    isError = true;
                    return 0;
                }

                if(phone == '') {
                    toastr.error('Vui lòng nhập số điện thoại');
                    isError = true;
                    return 0;
                }

                if(isError == false) {
                    var dataReq = {
                        'name': name,
                        'address': address,
                        'phone': phone,
                        'store_id': storeId,
                        'description':description,
                    };

                    submitSaveStore(dataReq);
                }
            });
        }

        function submitSaveStore(dataReq = {}) {
            $.ajax({
                type: 'POST',
                url: '/stores/save',
                data: dataReq,
                success: function (response) {
                    toastr.success(response.message);
                    loadListOfStore();
                    $('#staticBackdrop').modal('hide');
                    $('#staticBackdrop').find("input[type=text],input[type=hidden], textarea, input[type=number]").val("");
                },
                error: function (response) {
                    toastr.error('Lưu thông tin thất bại');
                }
            });
        }

        function editStore() {
            $('.edit-store').off().on('click', function (e) {
                var storeId = $(this).attr('data-store-id');
                var storeName = $(this).attr('data-name');
                var storeAddress = $(this).attr('data-address');
                var storePhone = $(this).attr('data-phone');
                var description = $(this).attr('data-description');

                $('#store-id').val(storeId);
                $('#store-name').val(storeName);
                $('#store-address').val(storeAddress);
                $('#phone').val(storePhone);
                $('#description').val(description);

                $('#staticBackdrop').modal('show');
                saveStore();
            });
        }

        function saerchStore() {
            $('#search').off().on('click', function (e) {
                var name = $('#store-name-search').val();
                var address = $('#store-address-search').val();
                var phone = $('#phone-search').val();
                var dataReq = {
                    'name': name,
                    'address': address,
                    'phone': phone,
                };

                loadListOfStore(dataReq);

                $('#searchBox').modal('hide');
            });
        }
    </script>
@stop
