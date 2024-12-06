<form action="{{ route('admin.' . $object . '.update', $reservationData->id) }}" id="myForm" method="post">
    @csrf
    @method('put')
    <div class="row justify-content-center">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{ __('messages.promotion.system.cardTop') }} </h4>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#table" role="tab"
                                aria-selected="true">Chọn bàn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#menu" role="tab"
                                aria-selected="false">Chọn món ăn</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane p-3 active" id="table" role="tabpanel">
                            <p id="notiTable" class="text-danger text-uppercase mb-4"></p>
                            <input type="hidden" id="reservationId">
                            <div id="availableTables" class="row">
                                @foreach ($listTables as $table)
                                    <div class="table-info col-3 mb-4">
                                        <p>Bàn: {{ $table->name }}</p>
                                        <p>Số người tối đa: {{ $table->capacity }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane p-3" id="menu" role="tabpanel">
                            <div class="row justify-content-center">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="" class="form-control searchMenu"
                                                placeholder="Tìm kiếm món ăn" aria-describedby="button-addon3">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4">
                                    </div><!--end col-->

                                </div> <!--end row-->
                                <div class="col-md-8 col-lg-8">
                                    <div class="card-header px-0">

                                    </div><!--end card-header-->
                                    <div id="availableMenu" class="row">
                                        <div class="card-body pt-0">
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach ($listMenus as $categories)
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" data-bs-toggle="tab"
                                                            href="#{{ $categories->slug }}" role="tab"
                                                            aria-selected="true">{{ $categories->name }}</a>
                                                    </li>
                                                @endforeach

                                            </ul>

                                            <div class="tab-content">

                                                @foreach ($listMenus as $categories)
                                                @php
                                                    $categories->slug == 'bua-sang' ? $active = 'active show' : $active = '';
                                                @endphp
                                                    <div class="tab-pane p-3 {{$active}}" id="{{ $categories->slug }}"
                                                        role="tabpanel">
                                                        <div class="row">
                                                            @foreach ($categories->menus as $menu)
                                                                <div class="menu-info col-2 mb-4">
                                                                    <img class="my-2"
                                                                        src="/storage/{{ $menu->image_url }}"
                                                                        alt=""
                                                                        style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                                                    <p>{{ $menu->name }}</p>
                                                                    <p>Giá: {{ $menu->price }}đ</p>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div> <!--end col-->
                                <div class="col-md-4 col-lg-4">
                                    <div class="card">
                                        <div class="card-header px-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    {{-- <p>Món đã chọn:</p> --}}
                                                    {{-- <input type="hidden" name="" id="idTable_"> --}}
                                                </div><!--end col-->
                                            </div> <!--end row-->
                                        </div><!--end card-header-->
                                        <div class="card-body pt-0">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="">Món đã chọn:</h5>
                                                    <input type="hidden" name="" id="idTable_">
                                                </div><!--end col-->
                                            </div>
                                            <table border="1" class="table mb-0 checkbox-all" id="datatable_1">
                                                <thead>
                                                    <tr>
                                                        <th>Tên món</th>
                                                        <th class="text-center">Số lượng</th>
                                                        <th class="text-end">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="array-menu"></tbody>
                                            </table>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div> <!--end col-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary me-2"
                        onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.update') }}</button>
                    <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button"
                            class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
                </div>
            </div>
        </div>
    </div>
</form>
