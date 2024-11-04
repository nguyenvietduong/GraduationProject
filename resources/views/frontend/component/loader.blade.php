<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div>

<!-- Loading overlay -->
<div id="loadingOverlay" style="display: none;">
    <div class="spinner"></div>
</div>

<style>
    /* Loading overlay styles */
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        z-index: 9999;
        /* Ensure overlay is on top */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Spinner styles */
    .spinner {
        border: 8px solid #f3f3f3;
        /* Light gray */
        border-top: 8px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        /* Spin animation */
    }

    /* Spin animation */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>