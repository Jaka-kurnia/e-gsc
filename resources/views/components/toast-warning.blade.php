<div id="toast-warning"
    class="fixed top-24 right-4 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-700 bg-white rounded-lg shadow transition-transform duration-300 ease-in-out transform translate-x-full opacity-0 border-l-2 border-yellow-400"
    role="alert">

    <div class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 bg-yellow-100 rounded-lg">
        <svg class="w-5 h-5 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path d="M10 1L1 18h18L10 1zm0 3.5L15.5 16h-11L10 4.5z" />
            <path d="M10 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0-8a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V6a1 1 0 0 0-1-1z" />
        </svg>
        <span class="sr-only">Warning icon</span>
    </div>

    <div class="ms-3 text-sm font-normal">
        {{ $slot }}
    </div>

    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 text-gray-500 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
        onclick="closeToast()">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>


<script>
    function showToast() {
        const toast = document.getElementById('toast-warning');
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }

    function closeToast() {
        const toast = document.getElementById('toast-warning');
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 500);
    }

    window.onload = function() {
        showToast();
        setTimeout(closeToast, 4000);
    };
</script>
