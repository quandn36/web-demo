
@if (isset($data) && isset($data->data) && count($data->data) > 0)
@foreach ($data->data as $index => $item)
<?php $idx = $index + 1; ?>
<div class="table-row">
    <div class="row-item">{{$idx}}</div>
    <div class="row-item">{{isset($item->name) ? $item->name : '_'}}</div>
    <div class="row-item">{{isset($item->address) ? $item->address : '_'}}</div>
    <div class="row-item">{{isset($item->phone) ? $item->phone : '_'}}</div>
    <div class="row-item" style="font-size: 18px;">
        <div class="action edit" style="padding: 0px 5px;">
            <i class="mdi mdi-file-document-edit edit-store"
            data-store-id="{{isset($item->store_id) ? $item->store_id : ''}}"
            data-name="{{isset($item->name) ? $item->name : ''}}"
            data-address="{{isset($item->address) ? $item->address : ''}}"
            data-phone="{{isset($item->phone) ? $item->phone : ''}}"
            data-description="{{isset($item->description) ? $item->description : ''}}"
        ></i>
        </div>
        <div class="action delete" data-store-id="{{isset($item->store_id) ? $item->store_id : ''}}" data-name="{{isset($item->name) ? $item->name : ''}}" style="padding: 0px 5px;">
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
