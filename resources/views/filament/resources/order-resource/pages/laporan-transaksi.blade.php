<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="mt-4">
            <x-filament::button type="submit">Tampilkan</x-filament::button>
        </div>
    </form>

    <div class="mt-6">
        <table class="table-auto w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->getData() as $item)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $item->tanggal }}</td>
                        <td class="px-4 py-2">{{ $item->kode }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament::page>
