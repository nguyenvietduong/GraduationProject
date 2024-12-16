$(document).ready(function () {
    // VẼ BIỂU ĐỒ

    let revenueChart = null;

    fetchRevenueData('revenue');  

    // Biều đồ doanh thu
    function fetchRevenueData() {
        let dayOld = $('#day').val();
        let monthOld = $('#month').val();
        let yearOld = $('#year').val();

        $('#reset_btn_statistical').on('click', function () {
            alert('Đã reset dữ liệu!');
            
            $('#day').val('');
            $('#month').val(0);
            $('#year').val(0);
    
            fetchDataAndRenderChart('', 0, 0);
        });

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
                    } else if (day == '' && month == '' && year == ''){
                        const currentDate = new Date();
                        const currentDay = currentDate.getDate();
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
});
