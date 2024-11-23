$(document).ready(function () {
    // VẼ BIỂU ĐỒ
    let menuChart = null;
    fetchDishData();

    // Biều đồ món ăn
    function fetchDishData() {
        let startDate = $('#startDateMenu').val();
        let endDate = $('#endDateMenu').val();
        let limit = $('#limitMenu').val(); // Nếu không có limit, mặc định là 'all'
        let sortBy = $('select#sortMenuType').val() || 'most'; // Mặc định là 'most'

        // Sự kiện khi thay đổi tham số lọc
        $('#startDateMenu, #endDateMenu, #limitMenu, #sortMenuType').on('change', function () {
            startDate = $('#startDateMenu').val();
            endDate = $('#endDateMenu').val();
            limit = $('#limitMenu').val();
            sortBy = $('select#sortMenuType').val() || 'most';
            fetchDataAndRenderChart(startDate, endDate, limit, sortBy);
        });

        // Fetch và render data khi mới load trang
        fetchDataAndRenderChart(startDate, endDate, limit, sortBy);

        function fetchDataAndRenderChart(startDate, endDate, limit, sortBy) {
            $('.loading-spinner').show(); // Hiển thị spinner khi tải dữ liệu
            $('#menuChart').hide();
            $('.no-data-message').hide(); // Ẩn thông báo không có dữ liệu

            $.ajax({
                url: '/admin/statistical/top-menus',
                method: 'GET',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    limit: limit,
                    sort: sortBy, // Truyền tham số lọc
                },
                success: function (response) {
                    $('.loading-spinner').hide();

                    const menuItems = response.menu_items || [];
                    const menuNames = menuItems.map(item => item.name);
                    const reservationCounts = menuItems.map(item => item.total_quantity);

                    if (menuNames.length === 0 || reservationCounts.length === 0) {
                        $('.no-data-message').show();
                        $('#menuChart').hide();
                    } else {
                        $('.no-data-message').hide();
                        $('#menuChart').show();
                        renderChart(menuNames, reservationCounts);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                    $('.loading-spinner').hide();
                    $('.no-data-message').show();
                    $('#menuChart').hide();
                },
            });
        }

        function renderChart(menuNames, reservationCounts) {
            const canvas = document.getElementById('menuChart');
            const ctx = canvas.getContext('2d');

            // Kiểm tra và hủy biểu đồ trước đó nếu đã tồn tại
            if (menuChart) {
                menuChart.destroy(); // Hủy biểu đồ cũ nếu có
                menuChart = null; // Đặt lại biến menuChart
            }

            // Tạo màu ngẫu nhiên cho mỗi món ăn
            const randomColors = reservationCounts.map(() => getRandomColor());

            // Tạo biểu đồ mới
            menuChart = new Chart(ctx, {
                type: 'pie', // Dạng biểu đồ bánh
                data: {
                    labels: menuNames,
                    datasets: [{
                        label: 'Số lượng đặt món',
                        data: reservationCounts,
                        backgroundColor: randomColors,
                        borderColor: randomColors,
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Biểu đồ thống kê Món ăn - Số lượng đặt món',
                            font: {
                                size: 16
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return `Số lượng đặt món: ${tooltipItem.raw}`;
                                },
                            },
                        },
                    },
                },
            });
        }

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    }
});
