<div
    class="mx-auto grid max-w-3xl grid-cols-1 gap-x-8 gap-y-16 px-4 py-16 sm:grid-cols-2 sm:px-6 xl:max-w-none xl:grid-cols-3 xl:px-8 2xl:grid-cols-4">
    @foreach ($year->months as $month)
        <section class="text-center">
            <h2
                class="text-sm font-semibold text-gray-900"
                wire:click="setMonth({{ $month->number }})"
            >
                {{ $month->getName() }}
            </h2>

            <div class="mt-6 grid grid-cols-7 text-xs leading-6 text-gray-500">
                @foreach ($dayLabels as $dayLabel)
                    <div>{{ $dayLabel->getCharacter() }}</div>
                @endforeach
            </div>

            <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
                @foreach ($month->weeks as $week)
                    @foreach ($week->days as $dayIdx => $day)
                        <button
                            type="button"
                            @class([
                                'bg-white text-gray-900' => $day->isCurrentMonth,
                                'bg-gray-50 text-gray-400' => !$day->isCurrentMonth,
                                'rounded-tl-lg' => $loop->parent->first && $loop->first,
                                'rounded-tr-lg' => $loop->parent->first && $loop->last,
                                'rounded-bl-lg' => $loop->parent->last && $loop->first,
                                'rounded-br-lg' => $loop->parent->last && $loop->last,
                                'py-1.5 hover:bg-gray-100 focus:z-10',
                            ])
                            wire:click="setDay('{{ $day->date }}')"
                        >
                            <time
                                datetime=""
                                @class([
                                    'bg-indigo-600 font-semibold text-white' => $day->isToday,
                                    'mx-auto flex h-7 w-7 items-center justify-center rounded-full',
                                ])
                            >
                                {{ $day->getNumber() }}
                            </time>
                        </button>
                    @endforeach
                @endforeach
            </div>
        </section>
    @endforeach
</div>
