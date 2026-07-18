<x-app-layout>
    <x-slot name="title">Riwayat Aktivitas</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Aktivitas Sistem') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="activityLogManager()">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <form action="{{ url()->current() }}" method="GET" class="w-full sm:w-auto">
                <x-search name="search" placeholder="Cari aktivitas..." value="{{ request('search') }}" />
            </form>
        </div>

        <x-table>
            <thead>
                <tr>
                    <x-th class="text-center w-12">No</x-th>
                    <x-th>Waktu</x-th>
                    <x-th>Pengguna</x-th>
                    <x-th>Aksi</x-th>
                    <x-th>Modul / Target</x-th>
                    <x-th class="text-center">Aksi</x-th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $log)
                <tr>
                    <x-td class="text-center">{{ $loop->iteration + ($activities->currentPage() - 1) * $activities->perPage() }}</x-td>
                    <x-td>
                        <span class="text-sm font-medium text-gray-900">{{ $log->created_at->format('d M Y') }}</span><br>
                        <span class="text-xs text-gray-500">{{ $log->created_at->format('H:i:s') }}</span>
                    </x-td>
                    <x-td>
                        @if ($log->causer)
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                {{ strtoupper(substr($log->causer->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-900">{{ $log->causer->name }}</span>
                        </div>
                        @else
                        <span class="text-gray-500 italic">Sistem / Tidak Diketahui</span>
                        @endif
                    </x-td>
                    <x-td>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold text-white 
                                @if($log->description == 'created') bg-green-600 
                                @elseif($log->description == 'updated') bg-blue-600 
                                @elseif($log->description == 'deleted') bg-red-600 
                                @else bg-gray-600 @endif">
                            {{ ucfirst($log->description) }}
                        </span>
                    </x-td>
                    <x-td>
                        <span class="font-medium text-gray-700">{{ class_basename($log->subject_type) }}</span>
                        @if($log->subject_id)
                        <span class="text-xs text-gray-400">#{{ $log->subject_id }}</span>
                        @endif
                    </x-td>
                    <x-td class="text-center">
                        <x-btn-primary type="button"
                            class="w-9 h-9 p-0! flex items-center justify-center shadow-sm mx-auto" title="Lihat Detail"
                            x-on:click="openDetail({{ json_encode($log->properties) }}, '{{ ucfirst($log->description) }}', '{{ class_basename($log->subject_type) }}')">
                            <i class="fi fi-rr-eye text-base leading-none"></i>
                        </x-btn-primary>
                    </x-td>
                </tr>
                @empty
                <tr>
                    <x-td colspan="6" class="text-center p-0">
                        <div class="flex items-center justify-center py-10 w-full">
                            @if (request('search'))
                            <span class="text-sm text-white bg-red-700 font-semibold px-4 py-2.5 rounded-lg flex items-center justify-center gap-2 border border-amber-200 shadow-sm mx-auto">
                                <i class="fi fi-rr-search-alt text-lg leading-none"></i>
                                <span>Riwayat dengan kata kunci "{{ request('search') }}" tidak ditemukan</span>
                            </span>
                            @else
                            <span class="text-sm text-gray-500 flex flex-col items-center gap-2 mx-auto">
                                <i class="fi fi-rr-time-past text-3xl"></i>
                                <span>Belum ada riwayat aktivitas yang tercatat.</span>
                            </span>
                            @endif
                        </div>
                    </x-td>
                </tr>
                @endforelse
            </tbody>
        </x-table>

        <x-paginate :paginator="$activities" />

        <!-- Modal Detail -->
        <x-modal name="modal_detail_activity">
            <div class="p-6 text-gray-800">
                <div class="mb-5 pb-3 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Detail Aktivitas (<span x-text="detail.action"></span> <span x-text="detail.model"></span>)
                    </h3>
                </div>

                <div class="max-h-96 overflow-y-auto">
                    <!-- Attributes (New Data) -->
                    <template x-if="detail.properties && detail.properties.attributes">
                        <div class="mb-4">
                            <h4 class="font-medium text-gray-700 mb-2">Data Baru (Attributes):</h4>
                            <div class="bg-gray-50 rounded border border-gray-200 p-3">
                                <template x-for="(value, key) in detail.properties.attributes" :key="key">
                                    <div class="flex border-b border-gray-100 last:border-0 py-1.5">
                                        <div class="w-1/3 font-medium text-gray-500 text-sm" x-text="key"></div>
                                        <div class="w-2/3 text-gray-900 text-sm wrap-break-word" x-text="formatValue(value)"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- Old Data -->
                    <template x-if="detail.properties && detail.properties.old">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Data Lama (Old):</h4>
                            <div class="bg-red-50 rounded border border-red-100 p-3">
                                <template x-for="(value, key) in detail.properties.old" :key="key">
                                    <div class="flex border-b border-red-100 last:border-0 py-1.5">
                                        <div class="w-1/3 font-medium text-gray-500 text-sm" x-text="key"></div>
                                        <div class="w-2/3 text-gray-900 text-sm wrap-break-word line-through" x-text="formatValue(value)"></div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <template x-if="!detail.properties || (!detail.properties.attributes && !detail.properties.old)">
                        <div class="text-center text-gray-500 py-4 italic">
                            Tidak ada detail perubahan (properti) yang tersimpan.
                        </div>
                    </template>
                </div>

                <div class="flex justify-end pt-4 mt-6 border-t border-gray-100">
                    <x-btn-secondary type="button" x-on:click="$dispatch('close-modal', 'modal_detail_activity')">
                        Tutup
                    </x-btn-secondary>
                </div>
            </div>
        </x-modal>
    </div>

    <script>
        function activityLogManager() {
            return {
                detail: {
                    properties: null,
                    action: '',
                    model: ''
                },
                openDetail(properties, action, model) {
                    this.detail = {
                        properties,
                        action,
                        model
                    };
                    this.$dispatch('open-modal', 'modal_detail_activity');
                },
                formatValue(val) {
                    if (val === null || val === undefined) return '-';
                    if (typeof val === 'object') return JSON.stringify(val);
                    return val;
                }
            }
        }
    </script>
</x-app-layout>