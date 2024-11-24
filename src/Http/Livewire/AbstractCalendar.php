<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire;

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
    use Concerns\ManagesLabels;
    use Concerns\ManagesMonths;
    use Concerns\ManagesView;
    use Concerns\ManagesWeeks;
    use Concerns\ManagesYears;
}
