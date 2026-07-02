<x-app-layout>
    <div class="p-6">
        <x-btn-primary x-data x-on:click="$dispatch('open-modal', 'modal-test')">
            Buka Modal
        </x-btn-primary>

        <x-modal name="modal-test">
            <div class="p-6">
                <h3 class="text-lg font-bold">Halo! Modal Berhasil Jalan</h3>
                <p class="text-sm text-gray-600 mt-2">Jika Anda melihat ini, berarti sistem event Alpine.js sudah
                    sinkron.</p>

                <x-btn-danger x-data x-on:click="$dispatch('close-modal', 'modal-test')">
                    Tutup Modal
                </x-btn-danger>
            </div>
        </x-modal>
    </div>
</x-app-layout>
