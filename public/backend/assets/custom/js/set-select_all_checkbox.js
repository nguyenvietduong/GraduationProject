document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="check"]');
    const deleteButton = document.getElementById('delete-button'); // Giả sử bạn có nút xóa với id này

    // Function to update the "Select All" checkbox state
    function updateSelectAll() {
        const checkedCount = document.querySelectorAll('input[name="check"]:checked').length;
        if (checkedCount === checkboxes.length) {
            selectAllCheckbox.checked = true;
            selectAllCheckbox.indeterminate = false;
        } else if (checkedCount > 0) {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = true;
        } else {
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
        }
    }

    // When "Select All" checkbox is clicked
    selectAllCheckbox.addEventListener('change', function () {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        toggleDeleteButton();
    });

    // When an individual checkbox is clicked
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            updateSelectAll();
            toggleDeleteButton();
        });
    });

    // Function to toggle the delete button based on checked checkboxes
    function toggleDeleteButton() {
        const anyChecked = document.querySelectorAll('input[name="check"]:checked').length > 0;
        deleteButton.style.display = anyChecked ? 'block' : 'none'; // Hiển thị/xóa nút xóa
    }

    // When delete button is clicked
    deleteButton.addEventListener('click', function () {
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                checkbox.parentElement.remove(); // Xóa checkbox được chọn cùng với thẻ cha
            }
        });
        updateSelectAll();
        toggleDeleteButton();
    });
});
