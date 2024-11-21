$(document).ready(function () {
    // VẼ BIỂU ĐỒ

    let clientChart = null;
    let menuChart = null;
    let tableChart = null;
    handleStatistics('revenue');

    // Lắng nghe sự kiện khi người dùng chuyển tab
    $('.nav-link').on('click', function () {
        // Lấy id của tab đang được chọn
        const selectedTabId = $(this).attr('id');

        handleStatistics(selectedTabId);
    });

    // Hàm xử lý thống kê cho từng tab
    function handleStatistics(tabId) {
        switch (tabId) {
            case 'revenue':
                // Gọi hàm xử lý thống kê doanh thu
                fetchRevenueData();
                break;
            case 'client':
                // Gọi hàm xử lý thống kê khách hàng đặt bàn
                fetchClientData();
                break;
            case 'menu':
                // Gọi hàm xử lý thống kê món ăn
                fetchDishData();
                break;
            case 'table':
                // Gọi hàm xử lý thống kê bàn ăn
                fetchTableData();
                break;
            default:
                console.log("Tab không hợp lệ.");
        }
    }

    // Biều đồ doanh thu
    function fetchRevenueData() {
        var revenueChart;
        let dayOld = $('#day').val();
        let monthOld = $('#month').val();
        let yearOld = $('#year').val();

        $('#day, #month, #year').on('change', function () {
            let day = $('#day').val();
            let month = $('#month').val();
            let year = $('#year').val();

            // First check if the year has changed
            if (yearOld !== year) {
                if (year === 'all') {
                    // If year is 'all', reset day and month values to empty
                    if (day || month) {
                        $('#day').val('');  // Clear day
                        $('#month').val('');  // Clear month
                    }
                } else if (year !== 'all' && (day === '' || month === '')) {
                    $('#day').val(dayOld);  // Reset day to the previous value
                    $('#month').val(monthOld);  // Reset month to the previous value
                }
            }

            // Then check if day or month values have changed
            if (dayOld !== day || monthOld !== month) {
                if (year === 'all') {
                    $('#year').val(''); // Clear the year
                }
            }

            // Update old values after handling the changes
            dayOld = $('#day').val();
            monthOld = $('#month').val();
            yearOld = $('#year').val();

            handleSelection();
        });

        function handleSelection() {
            const day = $('#day').val();
            const month = $('#month').val();
            const year = $('#year').val();

            fetchDataAndRenderChart(day, month, year);
        }

        fetchDataAndRenderChart(day, month, year);

        function fetchDataAndRenderChart(day, month, year) {
            $('.loading-spinner').show();
            $('#revenueChart').hide();
            $('.no-data-message').hide();

            $.ajax({
                url: '/admin/statistical/revenue-statistics',
                method: 'GET',
                data: { day, month, year },
                success: function (response) {
                    $('.loading-spinner').hide();

                    const periods = [];
                    const revenues = [];

                    // Iterate through the revenue_statistics object
                    for (let month in response.revenue_statistics) {
                        if (response.revenue_statistics.hasOwnProperty(month)) {
                            periods.push(month); // Add month to periods array
                            revenues.push(response.revenue_statistics[month]); // Add corresponding revenue to revenues array
                        }
                    }

                    // Check if there is no data
                    if (periods.length === 0 || revenues.length === 0) {
                        $('.no-data-message').show();
                        return;
                    }

                    $('#revenueChart').show();

                    if (revenueChart) {
                        revenueChart.destroy(); // Destroy the previous chart if exists
                    }

                    const ctx = document.getElementById('revenueChart').getContext('2d');
                    let labelRevenueChart = '';
                    let titleText = '';
                    if (day == '' && month == '' && year != '') {
                        if (year != 'all') {
                            labelRevenueChart = 'theo tháng của năm ' + year;
                            titleText = '(Tháng)';
                        } else {
                            labelRevenueChart = 'theo năm';
                            titleText = '(Năm)';
                        }
                    } else if (day == '' && month != '' && year != '') {
                        labelRevenueChart = 'theo ngày của tháng ' + month + ' năm ' + year;
                        titleText = '(Ngày)';
                    } else if (day == '' && month != '' && year == '') {
                        labelRevenueChart = 'theo ngày của tháng ' + month + ' năm ' + new Date().getFullYear();
                        titleText = '(Ngày)';
                    } else if (day != '' && month != '' && year == '') {
                        labelRevenueChart = 'theo giờ của ngày ' + day + ' tháng ' + month + ' năm ' + new Date().getFullYear();
                        titleText = '(Giờ)';
                    } else if (day != '' && month == '' && year == '') {
                        const currentDate = new Date();
                        const currentMonth = currentDate.getMonth() + 1; 
                        const currentYear = currentDate.getFullYear();  
                    
                        labelRevenueChart = 'theo giờ của ngày ' + day + ' tháng ' + currentMonth + ' năm ' + currentYear;
                        titleText = '(Giờ)';
                    } else {
                        const currentDate = new Date();
                        const currentDay = currentDate.getDate() + 1; 
                        const currentMonth = currentDate.getMonth() + 1; 
                        const currentYear = currentDate.getFullYear();  
                    
                        labelRevenueChart = 'theo giờ của ngày ' + currentDay + ' tháng ' + currentMonth + ' năm ' + currentYear;
                        titleText = '(Giờ)';
                    }

                    // Ensure type is 'line'
                    revenueChart = new Chart(ctx, {
                        type: 'line', // Ensure line chart
                        data: {
                            labels: periods, // Set periods as labels (e.g., days, months, or years)
                            datasets: [{
                                label: 'Doanh thu ' + labelRevenueChart,
                                data: revenues, // Revenue data
                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Fill color
                                borderColor: 'rgba(75, 192, 192, 1)', // Line color
                                borderWidth: 2,
                                tension: 0.4, // Smooth curves
                                fill: true, // Fill the area under the line
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Points on the line
                                pointBorderColor: 'rgba(75, 192, 192, 1)',
                                pointRadius: 5, // Size of points
                                pointHoverRadius: 7 // Hover size of points
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'top' },
                                tooltip: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return `Doanh thu: ${new Intl.NumberFormat('vi-VN', {
                                                style: 'currency',
                                                currency: 'VND'
                                            }).format(tooltipItem.raw)}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: { display: true, text: 'Thời gian ' + titleText }
                                },
                                y: {
                                    title: { display: true, text: 'Doanh thu (VND)' },
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function (value) {
                                            return new Intl.NumberFormat('vi-VN', {
                                                style: 'currency',
                                                currency: 'VND'
                                            }).format(value);
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function () {
                    $('.loading-spinner').hide();
                    $('.no-data-message').show();
                }
            });
        }
    };

    // Biều đồ khách hàng
    function fetchClientData() {
        var startDate = $('#startDateClient').val();
        var endDate = $('#endDateClient').val();
        var limit = $('#limit').val() || 10;
        $('#limit').val(10);

        // Sự kiện khi thay đổi ngày bắt đầu
        $('#startDateClient').on('change', function () {
            startDate = $(this).val();
            fetchDataAndRenderChart(startDate, endDate, limit);
        });

        $('#endDateClient').on('change', function () {
            endDate = $(this).val();
            fetchDataAndRenderChart(startDate, endDate, limit);
        });

        $('#limit').on('change', function () {
            limit = $(this).val();
            fetchDataAndRenderChart(startDate, endDate, limit);
        });

        fetchDataAndRenderChart(startDate, endDate, limit);

        function fetchDataAndRenderChart(startDate, endDate, limit) {
            $('.loading-spinner').show();
            $('#clientChart').hide();
            $('.no-data-message').hide();

            $.ajax({
                url: '/admin/statistical/top-clients',
                method: 'GET',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    limit: limit
                },
                success: function (response) {
                    $('.loading-spinner').hide();

                    var clients = [];
                    var reservationCounts = [];

                    if (response.top_customers) {
                        $.each(response.top_customers, function (index, client) {
                            var clientLabel = `${client.name} - ${client.phone}`;
                            clients.push(clientLabel);
                            reservationCounts.push(client.reservation_count);
                        });
                    }

                    if (clients.length === 0 || reservationCounts.length === 0) {
                        $('.no-data-message').show();
                        $('#clientChart').hide();
                    } else {
                        $('.no-data-message').hide();
                        $('#clientChart').show();
                        renderChart(clients, reservationCounts);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                    $('.loading-spinner').hide();
                    $('.no-data-message').show();
                    $('#clientChart').hide();
                }
            });
        }

        function renderChart(clients, reservationCounts) {
            var canvas = document.getElementById('clientChart');
            var ctx = canvas.getContext('2d');

            // Kiểm tra và hủy biểu đồ trước đó nếu đã tồn tại
            if (clientChart) {
                clientChart.destroy();
                clientChart = null;
            }

            // Tạo màu ngẫu nhiên cho mỗi khách hàng
            var randomColors = reservationCounts.map(function () {
                return getRandomColor();
            });

            clientChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: clients,
                    datasets: [{
                        label: 'Số lượng đặt bàn',
                        data: reservationCounts,
                        backgroundColor: randomColors,
                        borderColor: randomColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Biểu đồ thống kê khách hàng - Số lượng đặt bàn',
                            font: {
                                size: 16
                            },
                        },
                        legend: {
                            position: 'right',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return 'Số lượng đặt bàn: ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        }

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    }

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

    // Biểu đồ bàn ăn
    function fetchTableData() {
        let startDate = $('#startDateTable').val();
        let endDate = $('#endDateTable').val();
        let limit = $('#limitTable').val(); // Nếu không có limit, mặc định là 'all'
        let sortBy = $('select#sortTableType').val() || 'most'; // Mặc định là 'most'

        // Sự kiện khi thay đổi tham số lọc
        $('#startDateTable, #endDateTable, #limitTable, #sortTableType').on('change', function () {
            startDate = $('#startDateTable').val();
            endDate = $('#endDateTable').val();
            limit = $('#limitTable').val();
            sortBy = $('select#sortTableType').val() || 'most';
            fetchDataAndRenderChart(startDate, endDate, limit, sortBy);
        });

        // Fetch và render data khi mới load trang
        fetchDataAndRenderChart(startDate, endDate, limit, sortBy);

        function fetchDataAndRenderChart(startDate, endDate, limit, sortBy) {
            $('.loading-spinner').show(); // Hiển thị spinner khi tải dữ liệu
            $('#tableChart').hide();
            $('.no-data-message').hide(); // Ẩn thông báo không có dữ liệu

            $.ajax({
                url: '/admin/statistical/top-tables',
                method: 'GET',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    limit: limit,
                    sort: sortBy, // Truyền tham số lọc
                },
                success: function (response) {
                    console.log(response);

                    $('.loading-spinner').hide();

                    // Lấy dữ liệu từ response.tables
                    const tableItems = response.tables ||
                        []; // Sử dụng đúng key `tables` từ API
                    const tableNames = tableItems.map(item => item.name);
                    const reservationCounts = tableItems.map(item => item
                        .reservation_count); // Sửa `total_quantity` thành `reservation_count`

                    if (tableNames.length === 0 || reservationCounts.length === 0) {
                        $('.no-data-message').show();
                        $('#tableChart').hide();
                    } else {
                        $('.no-data-message').hide();
                        $('#tableChart').show();
                        renderChart(tableNames, reservationCounts);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                    $('.loading-spinner').hide();
                    $('.no-data-message').show();
                    $('#tableChart').hide();
                },
            });
        }

        function renderChart(tableNames, reservationCounts) {
            const canvas = document.getElementById('tableChart');
            const ctx = canvas.getContext('2d');

            // Kiểm tra và hủy biểu đồ trước đó nếu đã tồn tại
            if (tableChart) {
                tableChart.destroy(); // Hủy biểu đồ cũ nếu có
                tableChart = null; // Đặt lại biến tableChart
            }

            // Tạo màu ngẫu nhiên cho mỗi cột
            const randomColors = reservationCounts.map(() => getRandomColor());

            // Tạo biểu đồ mới
            tableChart = new Chart(ctx, {
                type: 'bar', // Dạng biểu đồ cột
                data: {
                    labels: tableNames,
                    datasets: [{
                        label: 'Số lượng đặt bàn',
                        data: reservationCounts,
                        backgroundColor: randomColors,
                        borderColor: randomColors,
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false, // Ẩn legend
                        },
                        title: {
                            display: true,
                            text: 'Biểu đồ thống kê bàn ăn',
                            font: {
                                size: 16
                            },
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return `Số lượng đặt: ${tooltipItem.raw}`;
                                },
                            },
                        },
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tên bàn',
                            },
                            ticks: {
                                maxRotation: 90,
                                minRotation: 0,
                            },
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số lượng đặt bàn',
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

    // END VẼ BIỂU ĐỒ
});
