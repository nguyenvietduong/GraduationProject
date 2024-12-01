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
                                    <a class="nav-link a-tab py-2" id="menu">Thống
                                        kê món
                                        ăn đã đặt</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="">
                                <div class="">
                                    @include('backend.statistical.component.menu')
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
    <script src="{{ asset('backend/assets/custom/js/statistical/menu.js') }}"></script>
    <script src="{{ asset('backend/assets/custom/js/statistical/exportPDF.js') }}"></script>
@endpush
