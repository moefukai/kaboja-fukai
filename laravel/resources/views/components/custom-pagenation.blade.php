@if ($paginator->hasPages())
    <style>
        .pagination a {
            background-color: #F6AE2C;
            color: white;
            border-color: #F6AE2C;
        }

        .pagination a:hover {
            background-color: #db9b1c;
        }

        .pagination span {
            pointer-events: none;
        }
    </style>

    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 cursor-not-allowed">前へ</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">前へ</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">次へ</a>
        @else
            <span class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 cursor-not-allowed">次へ</span>
        @endif
    </div>
@endif
