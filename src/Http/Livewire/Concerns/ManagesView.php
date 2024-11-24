<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Http\Livewire\Concerns;

trait ManagesView
{
    public string $selectedView = 'month';

    public function selectView(string $view): void
    {
        $this->selectedView = $view;
    }
}
