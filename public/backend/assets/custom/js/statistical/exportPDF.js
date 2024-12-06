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

    const canvas = document.getElementById('customerChart');

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

$('#export_btn_revenue').click(function (e) {
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