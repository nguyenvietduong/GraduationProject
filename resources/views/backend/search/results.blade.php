@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Kết quả tìm kiếm cho "{{ $searchTerm }}"</h2>

                <div class="card-body pt-0">
                    @if (
                        $results['reservation']->isEmpty() &&
                            $results['user']->isEmpty() &&
                            $results['category']->isEmpty() &&
                            $results['menu']->isEmpty() &&
                            $results['table']->isEmpty() &&
                            $results['blog']->isEmpty() &&
                            $results['promotion']->isEmpty())
                        <p class="text-muted">No results found.</p>
                    @else
                        @foreach (['reservation' => 'Đơn hàng', 'user' => 'Tài khoản', 'category' => 'Danh mục', 'menu' => 'Món ăn', 'table' => 'Bàn ăn', 'blog' => 'Blog', 'promotion' => 'Mã giảm giá'] as $key => $title)
                            @if (!$results[$key]->isEmpty())
                                <h5 class="mt-4">{{ $title }}</h5>
                                <div class="card mb-3 shadow-sm">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    @if ($key === 'reservation')
                                                        <th>Tên khách hàng</th>
                                                        <th>Email</th>
                                                        <th>Số điện thoại</th>
                                                    @elseif ($key === 'user')
                                                        <th>Tên</th>
                                                        <th>Email</th>
                                                        <th>Số điện thoại</th>
                                                    @elseif ($key === 'category')
                                                        <th>Tên danh mục</th>
                                                    @elseif ($key === 'menu')
                                                        <th>Món ăn</th>
                                                        <th>Mô tả</th>
                                                    @elseif ($key === 'table')
                                                        <th>Tên bàn</th>
                                                        <th>Mô tả</th>
                                                    @elseif ($key === 'blog')
                                                        <th>Tiêu đề bài viết</th>
                                                        <th>Nội dung</th>
                                                    @elseif ($key === 'promotion')
                                                        <th>Mã giảm giá</th>
                                                        <th>Mô tả</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $route =
                                                        $key === 'reservation'
                                                            ? 'admin.reservation.detail'
                                                            : 'admin.' . $key . '.edit';
                                                @endphp
                                                @foreach ($results[$key] as $index => $item)
                                                    <tr onclick="window.location.href='{{ route($route, $item->id) }}'"
                                                        style="cursor: pointer;">
                                                        <td>{{ $index + 1 }}</td>
                                                        @if ($key === 'reservation')
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->phone }}</td>
                                                        @elseif ($key === 'user')
                                                            <td>{{ $item->full_name }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ $item->phone }}</td>
                                                        @elseif ($key === 'category')
                                                            <td>{{ $item->name }}</td>
                                                        @elseif ($key === 'menu')
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->description }}</td>
                                                        @elseif ($key === 'table')
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->description }}</td>
                                                        @elseif ($key === 'blog')
                                                            <td>{{ $item->title }}</td>
                                                            <td>{{ Str::limit($item->content, 50) }}</td>
                                                        @elseif ($key === 'promotion')
                                                            <td>{{ $item->title }}</td>
                                                            <td>{{ $item->description }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
