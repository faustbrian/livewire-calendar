<?php

declare(strict_types=1);

namespace PreemStudio\LivewireCalendar\Http\Livewire;

use Livewire\Component;

final class Calendar extends Component
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
