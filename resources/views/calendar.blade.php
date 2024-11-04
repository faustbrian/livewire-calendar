<div class="lg:flex lg:h-screen lg:flex-col">
    <header class="flex h-20 flex-none items-center justify-between border-b border-gray-200 px-4 py-10 sm:px-6 lg:px-8">
        <div>
            @if ($selectedView === 'day')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time
                        class="sm:hidden"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        {{ $day->date->format(config('livewire-calendar.formats.full')) }}
                    </time>

                    <time
                        class="hidden sm:inline"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        {{ $day->date->format(config('livewire-calendar.formats.full')) }}
                    </time>
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $selectedDateTime->format(config('livewire-calendar.formats.day')) }}
                </p>
            @endif

            @if ($selectedView === 'week')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    @php($weekOfYear = $week->days->first()->date->weekOfYear)

                    <time
                        class="sm:hidden"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        @lang('Week') {{ $weekOfYear }}
                    </time>

                    <time
                        class="hidden sm:inline"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        @lang('Week') {{ $weekOfYear }}
                    </time>
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $selectedDateTime->format(config('livewire-calendar.formats.month')) }}
                </p>
            @endif

            @if ($selectedView === 'month')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time
                        class="sm:hidden"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        {{ $selectedDateTime->format(config('livewire-calendar.formats.month_year')) }}
                    </time>

                    <time
                        class="hidden sm:inline"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        {{ $selectedDateTime->format(config('livewire-calendar.formats.month_year')) }}
                    </time>
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $selectedDateTime->format(config('livewire-calendar.formats.month')) }}
                </p>
            @endif

            @if ($selectedView === 'year')
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    <time
                        class="sm:hidden"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        {{ $selectedDateTime->format(config('livewire-calendar.formats.full')) }}
                    </time>

                    <time
                        class="hidden sm:inline"
                        datetime="{{ $selectedDateTime->toDateString() }}"
                    >
                        {{ $selectedDateTime->format(config('livewire-calendar.formats.full')) }}
                    </time>
                </h1>
            @endif
        </div>

        <div class="flex items-center">
            <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
                <div
                    class="pointer-events-none absolute inset-0 rounded-md ring-1 ring-inset ring-gray-300"
                    aria-hidden="true"
                ></div>

                <button
                    class="flex items-center justify-center rounded-l-md py-2 pl-3 pr-4 text-gray-400 hover:text-gray-500 md:w-9 md:px-2 md:hover:bg-gray-50"
                    type="button"
                    wire:click="moveCursor('previous')"
                >
                    <span class="sr-only">@lang('Previous') {{ $selectedView }}</span>

                    <svg
                        class="h-5 w-5"
                        aria-hidden="true"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>

                <button
                    class="hidden px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 md:block"
                    type="button"
                    wire:click="moveCursor('today')"
                >Today</button>

                <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"></span>

                <button
                    class="flex items-center justify-center rounded-r-md py-2 pl-4 pr-3 text-gray-400 hover:text-gray-500 md:w-9 md:px-2 md:hover:bg-gray-50"
                    type="button"
                    wire:click="moveCursor('next')"
                >
                    <span class="sr-only">@lang('Next') {{ $selectedView }}</span>

                    <svg
                        class="h-5 w-5"
                        aria-hidden="true"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
            </div>

            <div
                class="hidden md:ml-4 md:flex md:items-center"
                x-data="{ isOpen: false }"
                @keydown.escape="isOpen = false"
            >
                <div class="relative">
                    <button
                        class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                        type="button"
                        @click="isOpen = ! isOpen"
                    >
                        {{ \BaseCodeOy\LivewireCalendar\Enum\CalendarView::from($selectedView)->getLabel() }}

                        <svg
                            class="-mr-1 h-5 w-5 text-gray-400"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>

                    <div
                        class="absolute right-0 z-10 mt-3 w-32 origin-top-right overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        x-show="isOpen"
                        x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        @click.outside="isOpen = false"
                    >
                        <div
                            class="py-1"
                            role="none"
                        >
                            @foreach(\BaseCodeOy\LivewireCalendar\Enum\CalendarView::cases() as $view)
                                <button
                                    type="button"
                                    role="menuitem"
                                    tabindex="-1"
                                    wire:click="$set('selectedView', '{{ $view->value }}')"
                                    @click="isOpen = false"
                                    @class([
                                        'bg-gray-100 text-gray-900' => $selectedView === $view->value,
                                        'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                                    ])
                                >
                                    {{ $view->getViewLabel() }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="relative ml-6 md:hidden"
                x-data="{ isOpen: false }"
            >
                <button
                    class="-mx-2 flex items-center rounded-full border border-transparent p-2 text-gray-400 hover:text-gray-500"
                    id="menu-0-button"
                    type="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    @click="isOpen = ! isOpen"
                >
                    <span class="sr-only">Open menu</span>

                    <svg
                        class="h-5 w-5"
                        aria-hidden="true"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z"
                        />
                    </svg>
                </button>

                <div
                    class="absolute right-0 z-10 mt-3 w-36 origin-top-right divide-y divide-gray-100 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="menu-0-button"
                    tabindex="-1"
                    x-show="isOpen"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    @click.outside="isOpen = false"
                >
                    <div
                        class="py-1"
                        role="none"
                    >
                        <a
                            class="block px-4 py-2 text-sm text-gray-700"
                            href="#"
                            role="menuitem"
                            tabindex="-1"
                            wire:click="moveCursor('today')"
                        >Go to today</a>
                    </div>

                    <div
                        class="py-1"
                        role="none"
                    >
                        <button
                            type="button"
                            role="menuitem"
                            tabindex="-1"
                            wire:click="$set('selectedView', 'day')"
                            @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'day',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])
                        >Day view</button>

                        <button
                            type="button"
                            role="menuitem"
                            tabindex="-1"
                            wire:click="$set('selectedView', 'week')"
                            @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'week',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])
                        >Week view</button>

                        <button
                            type="button"
                            role="menuitem"
                            tabindex="-1"
                            wire:click="$set('selectedView', 'month')"
                            @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'month',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])
                        >Month view</button>

                        <button
                            type="button"
                            role="menuitem"
                            tabindex="-1"
                            wire:click="$set('selectedView', 'year')"
                            @click="isOpen = false"
                            @class([
                                'bg-gray-100 text-gray-900' => $selectedView === 'year',
                                'block w-full px-4 py-2 text-sm text-gray-700 text-left',
                            ])
                        >Year view</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white lg:h-full">
        @if ($selectedView === 'day')
            @include(config('livewire-calendar.views.day'))
        @endif

        @if ($selectedView === 'week')
            @include(config('livewire-calendar.views.week'))
        @endif

        @if ($selectedView === 'month')
            @include(config('livewire-calendar.views.month'))
        @endif

        @if ($selectedView === 'year')
            @include(config('livewire-calendar.views.year'))
        @endif
    </div>
</div>
