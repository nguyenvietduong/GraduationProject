<div class="card-header">
    <div class="row align-items-center">
        <div class="col"></div><!--end col-->
    </div><!--end row-->
</div><!--end card-header-->
<div class="col-lg-12">
    <div class="card-body pt-0">
        <div id="infoDisplay">
            <ul class="list-unstyled mb-0">
                <li class="mt-2"><i class="las la-utensils me-2 text-secondary fs-22 align-middle"></i>
                    <b> Bàn </b> : {{ $data->table->name[App::getLocale()] ?? 'Không có dữ liệu' }}
                </li>                
                <li class="mt-2"><i class="las la-user me-2 text-secondary fs-22 align-middle"></i>
                    <b> Họ và Tên </b> : {{ $data->name ?? 'Không có dữ liệu' }}
                </li>
                <li class="mt-2"><i class="las la-phone-alt me-2 text-secondary fs-22 align-middle"></i>
                    <b> Số điện thoại </b> : {{ $data->phone ?? 'Không có dữ liệu' }}
                </li>
                <li class="mt-2"><i class="las la-envelope text-secondary fs-22 align-middle me-2"></i>
                    <b> Email </b> : {{ $data->email ?? 'Không có dữ liệu' }}
                </li>
                <li class="mt-2"><i class="las la-users me-2 text-secondary fs-22 align-middle"></i>
                    <b> Số khách </b> : {{ $data->guests ?? 'Không có dữ liệu' }}
                </li>
                <li class="mt-2"><i class="las la-calendar-check me-2 text-secondary fs-22 align-middle"></i>
                    <b> Thời gian đặt </b> : {{ $data->reservation_time ?? 'Không có dữ liệu' }}
                </li>
                <li class="mt-2"><i class="las la-clipboard-list me-2 text-secondary fs-22 align-middle"></i>
                    <b> Yêu cầu đặc biệt </b> : {{ $data->special_request ?? 'Không có dữ liệu' }}
                </li>
                <li class="mt-2"><i class="las la-info-circle me-2 text-secondary fs-22 align-middle"></i>
                    <b> Trạng thái </b> : {{ $data->status ?? 'Không có dữ liệu' }}
                </li>
            </ul>
        </div>
    </div>
</div>