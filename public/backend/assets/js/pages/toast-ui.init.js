function createChart(type, containerId, data, options, themeOptions) {
    const container = document.getElementById(containerId);
    const chartWidth = container.offsetWidth;

    if (themeOptions) {
        tui.chart.registerTheme("customTheme", themeOptions);
        options.theme = "customTheme";
    }

    options.chart.width = chartWidth;

    let chart;
    switch (type) {
        case "bar":
            chart = tui.chart.barChart(container, data, options);
            break;
        case "column":
            chart = tui.chart.columnChart(container, data, options);
            break;
        case "line":
            chart = tui.chart.lineChart(container, data, options);
            break;
        default:
            console.error("Invalid chart type specified.");
            return;
    }

    window.addEventListener("resize", function () {
        const newWidth = container.offsetWidth;
        chart.resize({ width: newWidth, height: options.chart.height });
    });

    return chart;
}

function fetchChartData() {
    alert(123);
    $.ajax({
        url: 'statistical/api/revenue-stats', // Laravel route
        type: 'GET',
        success: function(response) {
            const data = {
                categories: response.categories,
                series: response.series
            };

            const chartOptions = {
                chart: { height: 380, title: { text: "Revenue Statistics", offsetY: -10, align: "right" } },
                yAxis: { title: "Amount", min: 0, max: 9000, suffix: "$" },
                xAxis: { title: "Month" },
                series: { showLabel: false }
            };

            const chartTheme = {
                chart: { background: { color: "#fff", opacity: 0 } },
                title: { color: "#8791af", fontSize: 14, fontWeight: 500 },
                xAxis: { title: { color: "#8791af" }, label: { color: "#8791af" }, tickColor: "#8791af" },
                yAxis: { title: { color: "#8791af" }, label: { color: "#8791af" }, tickColor: "#8791af" },
                plot: { lineColor: "rgba(166, 176, 207, 0.1)" },
                series: { colors: ["#22c55e", "#fac146"] },
                legend: { label: { color: "#8791af" } }
            };

            createChart('column', 'column-charts', data, chartOptions, chartTheme);
        },
        error: function(error) {
            console.error("Error fetching chart data:", error);
        }
    });
}

$(document).ready(function () {
    // Fetch and render chart data on page load
    fetchChartData();
});