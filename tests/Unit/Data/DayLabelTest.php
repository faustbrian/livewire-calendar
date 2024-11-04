<?php

declare(strict_types=1);

namespace Tests\Unit\Data;

use BaseCodeOy\LivewireCalendar\Data\DayLabel;
use ReflectionClass;

it('can get name', function (): void {
    $name = 'Sunday';
    $dayLabel = new DayLabel($name);

    expect($dayLabel->getName())->toBe($name);
});

it('can get character', function (): void {
    $name = 'Sunday';
    $dayLabel = new DayLabel($name);

    expect($dayLabel->getCharacter())->toBe('S');
});

it('can get character suffix', function (): void {
    $name = 'Sunday';
    $dayLabel = new DayLabel($name);

    expect($dayLabel->getCharacterSuffix())->toBe('un');
});

it('can be initialized with name property', function (): void {
    $name = 'Sunday';
    $dayLabel = new DayLabel($name);

    // Use reflection to access the private property for testing
    $reflection = new ReflectionClass(DayLabel::class);
    $property = $reflection->getProperty('name');
    $property->setAccessible(true);

    expect($property->getValue($dayLabel))->toBe($name);
});
