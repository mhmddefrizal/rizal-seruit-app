<nav class="max-w-screen-xl pt-4 flex mb-4 text-sm text-gray-600" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route($route) }}" class="inline-flex items-center text-gray-600 hover:text-indigo-600">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 20V12H14V20H19V10H22L12 0 2 10H5V20H10Z" />
                </svg>
                {{ $menu }}
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L11.586 9 7.293 4.707a1
                        1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0
                        01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-500">
                    {{ $submenu }}
                </span>
            </div>
        </li>
    </ol>
</nav>
