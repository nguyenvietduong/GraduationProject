$(document).ready(function () {
    let customerChart = null;

    fetchCustomerData('customer');  // Updated for customer data

    // Thống kê số lượng khách hàng
    function fetchCustomerData() {
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
            $('#customerChart').hide();
            $('.no-data-message').hide();

            $.ajax({
                url: '/admin/statistical/top-clients',  // Ensure this endpoint provides customer data
                method: 'GET',
                data: { day, month, year },
                success: function (response) {
                    $('.loading-spinner').hide();

                    const periods = [];
                    const customerCounts = [];

                    // Assuming the correct response structure is 'response.user_statistics'
                    for (let period in response.user_statistics) {
                        if (response.user_statistics.hasOwnProperty(period)) {
                            periods.push(period);
                            customerCounts.push(response.user_statistics[period]);
                        }
                    }

                    if (periods.length === 0 || customerCounts.length === 0) {
                        $('.no-data-message').show();
                        return;
                    }

                    $('#customerChart').show();

                    if (customerChart) {
                        customerChart.destroy(); // Destroy the previous chart if exists
                    }

                    const ctx = document.getElementById('customerChart').getContext('2d');
                    let labelCustomerChart = '';
                    let titleText = '';

                    // Update labels and titles for customer tracking
                    if (day) {
                        labelCustomerChart = 'Ngày';
                        titleText = 'Ngày';
                    } else if (month) {
                        labelCustomerChart = 'Tháng';
                        titleText = 'Tháng';
                    } else if (year) {
                        labelCustomerChart = 'Năm';
                        titleText = 'Năm';
                    } else {
                        labelCustomerChart = 'Thời gian';
                        titleText = 'Thời gian';
                    }

                    customerChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: periods,
                            datasets: [{
                                label: 'Số lượng khách hàng ' + labelCustomerChart,
                                data: customerCounts,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointBorderColor: 'rgba(75, 192, 192, 1)',
                                pointRadius: 5,
                                pointHoverRadius: 7
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'top' },
                                tooltip: {
                                    callbacks: {
                                        label: function (tooltipItem) {
                                            return `Số lượng khách hàng: ${tooltipItem.raw}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: { display: true, text: 'Thời gian ' + titleText }
                                },
                                y: {
                                    title: { display: true, text: 'Số lượng khách hàng' },
                                    ticks: {
                                        beginAtZero: true,
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
