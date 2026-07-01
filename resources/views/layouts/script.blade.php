 <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            // Toggle sidebar visibility
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');

            // Toggle overlay visibility
            if (sidebar.classList.contains('translate-x-full')) {
                overlay.classList.remove('hidden');
            } else {
                overlay.classList.add('hidden');
            }
        }

        // Modal
        document.addEventListener('DOMContentLoaded', function() {
            // Buka modal
            document.querySelectorAll('[data-modal-target]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-modal-target');
                    const modal = document.getElementById(modalId);
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
            });

            // Tutup modal
            document.querySelectorAll('[data-modal-hide]').forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-modal-hide');
                    const modal = document.getElementById(modalId);
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            });

            // Tutup saat klik backdrop
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            });
        });
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    @stack('js')