@extends('layout.backend')

@section('adminContent')
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Search Results for "{{ $searchTerm }}"</h2>

                @if ($results['reservations']->isEmpty() && $results['users']->isEmpty() && $results['products']->isEmpty())
                    <p>No results found.</p>
                @else
                    <h3>Đơn hàng</h3>
                    <ul>
                        @foreach ($results['reservations'] as $reservation)
                            <li>{{ $reservation->name }} - {{ $reservation->email }} - {{ $reservation->phone }}</li>
                        @endforeach
                    </ul>

                    <h3>Tài khoản</h3>
                    <ul>
                        @foreach ($results['users'] as $user)
                            <li>{{ $user->name }} - {{ $user->email }}</li>
                        @endforeach
                    </ul>

                    <h3>Danh mục</h3>
                    <ul>
                        @foreach ($results['categories'] as $category)
                            <li>{{ $category->name }} - {{ $category->description }}</li>
                        @endforeach
                    </ul>

                    <h3>Món ăn</h3>
                    <ul>
                        @foreach ($results['menus'] as $menu)
                            <li>{{ $menu->name }} - {{ $menu->description }}</li>
                        @endforeach
                    </ul>

                    <h3>Bàn ăn</h3>
                    <ul>
                        @foreach ($results['tables'] as $table)
                            <li>{{ $table->name }} - {{ $table->description }}</li>
                        @endforeach
                    </ul>

                    <h3>Bàn ăn</h3>
                    <ul>
                        @foreach ($results['blogs'] as $blog)
                            <li>{{ $blog->name }} - {{ $blog->description }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script></script>
@endpush
