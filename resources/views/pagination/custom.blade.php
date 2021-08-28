@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" style="display: flex;justify-content: center">

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">


            <div>
                <span>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <svg style="height: 30px;width: 30px;margin-bottom: -9px;padding-right: 6px" class="w-5 h-5" fill="currentColor"
                             viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>

                    @else
                        <a style="text-decoration: none" href="{{ $paginator->previousPageUrl() }}">
                      <svg style="margin-bottom: -2px;padding-right: 6px" xmlns="http://www.w3.org/2000/svg" width="26" height="24" fill="currentColor"
                           class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd"
        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"/>
</svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span>{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page"
                                          style="padding-left: 20px;padding-right: 20px;font-weight: bold">
                                        <span>{{ $page }}</span>
                                    </span>
                                @else
                                    <a style="padding-left: 20px;padding-right: 20px;font-weight: bold"
                                       href="{{ $url }}"
                                       aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                           aria-label="{{ __('pagination.next') }}">
                            <svg style="height: 30px;width: 30px ;padding-left: 20px;margin-bottom: -9px"
                                 class="w-5 h-5" fill="currentColor"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @else
                        <svg style="height: 30px;width: 30px;margin-bottom: -9px" class="w-5 h-5" fill="currentColor"
                             viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>

                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
