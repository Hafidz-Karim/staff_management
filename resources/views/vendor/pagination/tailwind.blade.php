@if ($paginator->hasPages())
    <nav class="flex justify-center mt-6">
        <ul class="flex items-center space-x-2">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-xl border border-gray-300 cursor-not-allowed">
                        Prev
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-4 py-2 bg-white rounded-xl border shadow-sm hover:bg-blue-50 hover:text-blue-600 hover:border-blue-400 transition">
                        Prev
                    </a>
                </li>
            @endif

            {{-- Number Links --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li>
                        <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded-xl border border-gray-300">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-4 py-2 bg-blue-600 text-white rounded-xl border border-blue-600 shadow-md">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-4 py-2 bg-white rounded-xl border shadow-sm hover:bg-blue-50 hover:text-blue-600 hover:border-blue-400 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-4 py-2 bg-white rounded-xl border shadow-sm hover:bg-blue-50 hover:text-blue-600 hover:border-blue-400 transition">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-xl border border-gray-300 cursor-not-allowed">
                        Next
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
