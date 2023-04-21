<p align="center">
    <a href="https://preem.studio" target="_blank">
        <img src="https://raw.githubusercontent.com/PreemStudio/assets/main/logo-text.svg" width="128" alt="Preem Studio Logo" />
    </a>
</p>

<p align="center">
    <a href="https://github.com/PreemStudio/livewire-calendar/actions">
        <img src="https://badge.sh/github/check-runs/PreemStudio/livewire-calendar" alt="Checks" />
    </a>
    <a href="https://packagist.org/packages/preemstudio/livewire-calendar">
        <img src="https://badge.sh/packagist/downloads/PreemStudio/livewire-calendar" alt="Downloads" />
    </a>
    <a href="https://packagist.org/packages/preemstudio/livewire-calendar">
        <img src="https://badge.sh/packagist/version/PreemStudio/livewire-calendar" alt="Version" />
    </a>
    <a href="https://packagist.org/packages/preemstudio/livewire-calendar">
        <img src="https://badge.sh/packagist/license/PreemStudio/livewire-calendar" alt="License" />
    </a>
</p>

## About Livewire Calendar

This project was created by, and is maintained by [Preem Studio](https://github.com/PreemStudio), and is a package to build calendars with Laravel Livewire. Be sure to browse through the [changelog](CHANGELOG.md), [code of conduct](.github/CODE_OF_CONDUCT.md), [contribution guidelines](.github/CONTRIBUTING.md), [license](LICENSE), and [security policy](.github/SECURITY.md).

## Installation

> **Note**
> This package requires [PHP](https://www.php.net/) 8.2 or later, and it supports [Laravel](https://laravel.com/) 10 or later.

To get the latest version, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require preemstudio/livewire-calendar
```

## Usage

> **Note**
> Please review the contents of [our test suite](/tests) for detailed usage examples.

In order to use this component, you must create a new Livewire component that extends the `AbstractCalendar` class. This class provides the basic functionality for the calendar, and you can override the methods to customize the calendar to your needs. The `events()` function is the only required method, and it must return a `Collection` of `Event` objects.

```php
<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Event;
use PreemStudio\LivewireCalendar\Http\Livewire\AbstractCalendar;

final class Calendar extends AbstractCalendar
{
    public function events(): Collection
    {
        return new Collection([
            new Event(
                id: 'unique-id',
                name: 'Sales Meeting',
                description: 'Review the sales for the month',
                href: 'https://openai.com/',
                startTime: Carbon::today()->addHours(8),
                endTime: Carbon::today()->addHours(16),
            ),
            new Event(
                id: 'another-unique-id',
                name: 'Marketing Meeting',
                description: 'Review the marketing for the month',
                href: 'https://openai.com/',
                startTime: Carbon::tomorrow()->addHours(8),
                endTime: Carbon::tomorrow()->addHours(16),
            ),
        ]);
    }
}
```

If you want to load events from the database with Eloquent you will need to create a new `Event` object for each record. You can use the `map()` method to create a new `Collection` of `Event` objects.

```php
<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use PreemStudio\LivewireCalendar\Data\Event;
use PreemStudio\LivewireCalendar\Http\Livewire\AbstractCalendar;

final class Calendar extends AbstractCalendar
{
    public function events(): Collection
    {
        return Model::get()->map(
            fn (Model $model): Event => new Event(
                id: $model->id,
                name: $model->name,
                description: $model->description,
                href: route('event', $model->id),
                startTime: $model->starts_at,
                endTime: $model->ends_at,
            )
        );
    }
}
```

The most basic way to render this Livewire component on a page is using the `<livewire:` tag syntax:

```blade
<livewire:calendar />
```

Alternatively you can use the `@livewire` blade directive:

```php
@livewire('calendar')
```
