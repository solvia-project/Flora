<x-app>
    <x-slot name="navbar">
        <x-navbar />
    </x-slot>

    {{-- Konten utama diambil dari folder lain --}}
    @include('content.home')

    <x-slot name="footer">
        <x-footer />
    </x-slot>
</x-app>
