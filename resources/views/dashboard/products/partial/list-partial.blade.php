
@if (isset($data) && isset($data->data) && count($data->data) > 0)
@foreach ($data->data as $index => $item)
<?php $idx = $index + 1; ?>
<div class="table-row">
    <div class="row-item">{{$idx}}</div>
    <div class="row-item">{{isset($item->name) ? $item->name : '_'}}</div>
    <div class="row-item">{{isset($item->unit_name) ? $item->unit_name : '_'}}</div>
    <div class="row-item">{{isset($item->store_detail->name) ? $item->store_detail->name : '_'}}</div>
    <div class="row-item" style="font-size: 18px;">
        <div class="action edit" style="padding: 0px 5px;">
            <i class="mdi mdi-file-document-edit edit-product"
                data-product-id="{{isset($item->product_id) ? $item->product_id : ''}}"
                data-store-id="{{isset($item->store_id) ? $item->store_id : ''}}"
                data-unit-id="{{isset($item->unit_id) ? $item->unit_id : ''}}"
                data-name="{{isset($item->name) ? $item->name : ''}}"
                data-description="{{isset($item->description) ? $item->description : ''}}"
            ></i>
        </div>
        <div class="action delete" data-product-id="{{isset($item->product_id) ? $item->product_id : ''}}" data-name="{{isset($item->name) ? $item->name : ''}}" style="padding: 0px 5px;">
            <i class="mdi mdi-trash-can-outline"></i>
        </div>
    </div>
</div>
@endforeach
@else
    <div style="text-align:center; padding-top: 30px;">Không có dữ liệu</div>
@endif
<div class="paginate-item">
    {{ isset($pagination) && $pagination ? $pagination->links() : '' }}
</div>
