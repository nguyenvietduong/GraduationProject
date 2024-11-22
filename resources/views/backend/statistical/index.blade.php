@extends('layout.backend')
@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" id="revenue-form">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab">
                                    <a class="nav-link py-2 active" id="revenue" data-bs-toggle="tab" href="#step1"
                                        checked>Thống
                                        kê doanh thu</a>
                                    <a class="nav-link py-2" id="client" data-bs-toggle="tab" href="#step2">Thống kê
                                        khách hàng đặt bàn</a>
                                    <a class="nav-link py-2" id="menu" data-bs-toggle="tab" href="#step3">Thống kê món
                                        ăn</a>
                                    <a class="nav-link py-2" id="table" data-bs-toggle="tab" href="#step4">Thống kê bàn
                                        ăn</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane active" id="step1">
                                    @include('backend.statistical.component.revenue')
                                </div>
                                <div class="tab-pane" id="step2">
                                    @include('backend.statistical.component.client')
                                </div>
                                <div class="tab-pane" id="step3">
                                    @include('backend.statistical.component.menu')
                                </div>
                                <div class="tab-pane" id="step4">
                                    @include('backend.statistical.component.table')
                                </div>
                            </div>
                        </form><!--end form-->
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!--end col-->
        </div><!--end row-->
    </div><!-- container -->
    <div id="custom-tooltip" style="display: none;"></div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="{{ asset('backend/assets/custom/js/statistical/statistical.js') }}"></script>
    <script src="{{ asset('backend/assets/custom/js/statistical/exportPDF.js') }}"></script>
@endpush
