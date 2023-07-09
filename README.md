<p align="center">
    <a href="https://bombenprodukt.com" target="_blank">
        <img src="https://raw.githubusercontent.com/faustbrian/assets/main/logo-text.svg" width="128" alt="BombenProdukt Logo" />
    </a>
</p>


## About Livewire Calendar

This project was created by, and is maintained by [Brian Faust](https://github.com/faustbrian), and is a package to build calendars with Laravel Livewire. Be sure to browse through the [changelog](CHANGELOG.md), [code of conduct](.github/CODE_OF_CONDUCT.md), [contribution guidelines](.github/CONTRIBUTING.md), [license](LICENSE), and [security policy](.github/SECURITY.md).

## Installation

> **Note**
> This package requires [PHP](https://www.php.net/) 8.2 or later, and it supports [Laravel](https://laravel.com/) 10 or later.

To get the latest version, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require bombenprodukt/livewire-calendar
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
use BombenProdukt\LivewireCalendar\Calendar;
use BombenProdukt\LivewireCalendar\Http\Livewire\AbstractCalendar;

final class Calendar extends AbstractCalendar
{
    public function events(): Collection
    {
        return new Collection([
            Calendar::createEvent(
                id: 'unique-id',
                name: 'Sales Meeting',
                description: 'Review the sales for the month',
                href: 'https://openai.com/',
                startTime: Carbon::today()->addHours(8),
                endTime: Carbon::today()->addHours(16),
            ),
            Calendar::createEvent(
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
use BombenProdukt\LivewireCalendar\Data\Event;
use BombenProdukt\LivewireCalendar\Http\Livewire\AbstractCalendar;

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

### Drag and Drop

If you want to enable drag and drop functionality you will need to include the following JavaScript in your application. This will allow you to drag and drop events to different days.

> **Note**
> We recommend to put this into your **resources/js/app.js** file.

```js
window.onLivewireCalendarEventDragStart = function(event, eventId) {
	event.dataTransfer.setData('id', eventId);
};

window.onLivewireCalendarEventDragEnter = function(event, componentId, dateString, dragAndDropClasses) {
	event.stopPropagation();
	event.preventDefault();

	const element = document.getElementById(`${componentId}-${dateString}`);
	element.className = `${element.className} ${dragAndDropClasses}`;
};

window.onLivewireCalendarEventDragLeave = function(event, componentId, dateString, dragAndDropClasses) {
	event.stopPropagation();
	event.preventDefault();

	const element = document.getElementById(`${componentId}-${dateString}`);
	element.className = element.className.replace(dragAndDropClasses, '');
};

window.onLivewireCalendarEventDragOver = function(event) {
	event.stopPropagation();
	event.preventDefault();
};

window.onLivewireCalendarEventDrop = function(event, componentId, dateString, dragAndDropClasses) {
	event.stopPropagation();
	event.preventDefault();

	const element = document.getElementById(`${componentId}-${dateString}`);
	element.className = element.className.replace(dragAndDropClasses, '');

	window.Livewire
		.find(componentId)
		.call('onEventDropped', event.dataTransfer.getData('id'), dateString);
};
```

### Troubleshooting

If you are having trouble getting the calendar to render, you should make sure that your `tailwind.config.js` file is configured correctly. You can use the following example as a starting point:

```js
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/bombenprodukt/livewire-calendar/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
```
