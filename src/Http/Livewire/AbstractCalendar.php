<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire;

use Livewire\Component;

abstract class AbstractCalendar extends Component
{
    use Concerns\ManagesComponent;
    use Concerns\ManagesConfiguration;
    use Concerns\ManagesCursor;
    use Concerns\ManagesDays;
    use Concerns\ManagesEvents;
    use Concerns\ManagesGrid;
    use Concerns\ManagesHooks;
    use Concerns\ManagesMonths;
    use Concerns\ManagesView;
    use Concerns\ManagesWeeks;
    use Concerns\ManagesYears;
}
