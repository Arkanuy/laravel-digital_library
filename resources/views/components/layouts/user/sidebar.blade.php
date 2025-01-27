@php
    $list = [
        [
            'icon' =>
                'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25',
            'name' => 'List Buku',
            'link' => route('user.book.index'),
            'route' => 'user.book.index'
        ],
        [
            'icon' =>
                'M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z',
            'name' => 'Peminjaman',
            'link' => route('user.borrow.index'),
            'route' => 'user.borrow.index'
        ],
    ];

    // Debug: Tampilkan current route name
    // dd(Route::currentRouteName());
@endphp

<header class="w-72 bg-white h-screen relative">
    <style>
        header {
            transition: all 0.3s ease;
        }

        main {
            transition: margin-left 0.3s ease;
        }

        .muncul {
            left: 0;
        }

        .sembunyi {
            left: -18rem;
        }

        .content-shift {
            margin-left: 18rem;
        }

        .content-no-shift {
            margin-left: 0;
        }

        .menu-active {
            @apply bg-slate-400 text-slate-100;
        }
    </style>

    <div class="flex flex-col gap-y-3 h-full justify-between mx-4">
        <div class="flex flex-col gap-y-3">
            {{-- image --}}
            <div class="flex flex-row  pt-6 gap-x-4 relative">
                <img src="{{ asset('resources/login/9796597.jpg') }}" alt="as"
                    class="w-16 h-16 rounded-lg shadow-xl">
                <div class="flex flex-col text-slate-700">
                    <h1 class=" font-semibold">Perpustakaan Digital</h1>
                    <p>{{ auth()->user()->nama_lengkap }}</p>
                    <p class="text-sm text-green-500">{{ auth()->user()->role }}</p>
                </div>
            </div>
            <hr class="border border-slate-400 mb-4">
            {{-- menu --}}
            @foreach ($list as $item)
                {{-- Debug: Tampilkan route yang sedang dibandingkan --}}
                {{-- {{ dd(['current' => Route::currentRouteName(), 'menu' => $item['route']]) }} --}}

                <a href="{{ $item['link'] }}"
                    class="border border-slate-400 h-8 px-2 flex flex-row gap-2 items-center rounded-lg hover:bg-slate-400 hover:text-slate-100 duration-200 {{ request()->routeIs($item['route']) ? 'bg-slate-400 text-slate-100' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                    </svg>
                    <p>{{ $item['name'] }}</p>
                </a>
            @endforeach
        </div>
        <form action="{{ route('logout.submit') }}" method="POST" class="mb-5">
            @csrf
            <button type="submit"
                class="border border-slate-400 h-8 px-2 flex flex-row gap-2 items-center rounded-lg hover:bg-slate-400 hover:text-slate-100 duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                </svg>
                <p>Logout</p>
            </button>
        </form>
    </div>
</header>

