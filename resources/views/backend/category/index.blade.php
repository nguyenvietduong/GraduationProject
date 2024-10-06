@extends('layout.admin')
@section('adminContent')
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ $config['seo']['index']['table'] }} ({{ $categories_back->count() }})</h4>
                            </div><!--end col-->

                            <div class="col-auto">
                                {{-- Filter --}}
                                @include('backend.category.component.filter')
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-header-->

                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            @include('backend.category.component.table')
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
@endsection