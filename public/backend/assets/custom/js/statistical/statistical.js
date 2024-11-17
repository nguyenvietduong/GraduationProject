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

    // Biều đồ đặt bàn
    function fetchRevenueData() {
        var revenueChart;
        let startDateTimeout;
        let endDateTimeout;

        $('input[name="type"]').change(function () {
            var selectedValue = $('input[name="type"]:checked').val();
            handleSelection(selectedValue);
        });

        $('#start_date').on('change', function () {
            const selectedDate = $(this).val();

            clearTimeout(startDateTimeout);

            startDateTimeout = setTimeout(() => {
                handleSelection();
            }, 2000);
        });

        $('#end_date').on('change', function () {
            const selectedDate = $(this).val();

            clearTimeout(endDateTimeout);

            endDateTimeout = setTimeout(() => {
                handleSelection();
            }, 2000);
        });

        var initialSelectedValue = $('input[name="type"]:checked').val();
        handleSelection(initialSelectedValue);

        function handleSelection(selectedValue = null) {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            selectedValue = $('input[name="type"]:checked').val();

            fetchDataAndRenderChart(startDate, endDate, selectedValue);
        }

        function fetchDataAndRenderChart(startDate, endDate, type) {
            // Show the loading spinner and hide the canvas and message
            $('.loading-spinner').show();
            $('#revenueChart').hide();
            $('.no-data-message').hide();

            $.ajax({
                url: '/admin/statistical/revenue-statistics',
                method: 'GET',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    type: type
                },
                success: function (response) {
                    // Hide the loading spinner
                    $('.loading-spinner').hide();

                    var periods = [];
                    var revenues = [];

                    const currencyFormatter = new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });

                    const title = 'Doanh thu theo ' + (type === 'year' ? 'Năm ' : type ===
                        'month' ?
                        'Tháng ' : 'Ngày ') + (startDate ? 'Thời gian bắt đầu: ' +
                            startDate +
                            ' ' : ' ') + (startDate ? 'Thời gian kết thúc: ' + endDate : ' ');

                    if (type === 'year') {
                        $.each(response.revenue_statistics, function (year, revenue) {
                            periods.push("Năm " + year);
                            revenues.push(Number(revenue));
                        });
                    } else if (type === 'month') {
                        $.each(response.revenue_statistics, function (key, revenue) {
                            periods.push("Tháng " + key);
                            revenues.push(Number(revenue));
                        });
                    } else if (type === 'day') {
                        $.each(response.revenue_statistics, function (date, revenue) {
                            periods.push(date);
                            revenues.push(Number(revenue));
                        });
                    }

                    // If there's no data, show no-data message and hide canvas
                    if (periods.length === 0 || revenues.length === 0) {
                        $('.no-data-message').show();
                        $('#revenueChart').hide();
                    } else {
                        $('.no-data-message').hide();
                        $('#revenueChart').show();
                    }

                    if (revenueChart) {
                        revenueChart.destroy();
                    }

                    var ctx = document.getElementById('revenueChart').getContext('2d');
                    revenueChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: periods,
                            datasets: [{
                                label: title,
                                data: revenues,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Biểu đồ thống kê doanh thu',
                                    font: {
                                        size: 16
                                    },
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return 'Doanh thu : ' +
                                                currencyFormatter
                                                    .format(tooltipItem.raw);
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: (type === 'day' ? 'Ngày' : type ===
                                            'month' ?
                                            'Tháng' : 'Năm')
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Doanh thu (VND)'
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function (value) {
                                            return currencyFormatter.format(value);
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    $('#revenue-result').html('<p>Không thể lấy được dữ liệu.</p>');
                    $('.loading-spinner').hide();
                }
            });
        }
    }

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

    // ------------------------------------

    // Xuất PDF
    function exportPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();

        const canvas = document.getElementById('revenueChart');

        if (canvas) {
            const imgData = canvas.toDataURL('image/png');

            pdf.addImage(imgData, 'PNG', 10, 10, 180, 90);
            pdf.save("revenue.pdf");
        } else {
            console.error("Canvas không tìm thấy");
        }
    }

    function exportPDFClient() {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();

        const canvas = document.getElementById('clientChart');

        if (canvas) {
            const imgData = canvas.toDataURL('image/png');

            pdf.addImage(imgData, 'PNG', 10, 10, 180, 90);
            pdf.save("cleint.pdf");
        } else {
            console.error("Canvas không tìm thấy");
        }
    }

    function exportPDFMenu() {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();

        const canvas = document.getElementById('menuChart');

        if (canvas) {
            const imgData = canvas.toDataURL('image/png');

            pdf.addImage(imgData, 'PNG', 10, 10, 180, 90);
            pdf.save("menu.pdf");
        } else {
            console.error("Canvas không tìm thấy");
        }
    }

    function exportPDFTable() {
        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();

        const canvas = document.getElementById('tableChart');

        if (canvas) {
            const imgData = canvas.toDataURL('image/png');

            pdf.addImage(imgData, 'PNG', 10, 10, 180, 90);
            pdf.save("table.pdf");
        } else {
            console.error("Canvas không tìm thấy");
        }
    }

    $('#export_btn').click(function (e) {
        e.preventDefault();
        exportPDF();
    });

    $('#export_btn_client').click(function (e) {
        e.preventDefault();
        exportPDFClient();
    });

    $('#export_btn_menu').click(function (e) {
        e.preventDefault();
        exportPDFMenu();
    });

    $('#export_btn_table').click(function (e) {
        e.preventDefault();
        exportPDFTable();
    });

    // END XUẤT PDF
});
