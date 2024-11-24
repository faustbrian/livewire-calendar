<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\LivewireCalendar\Contracts;

/**
 * @property string $name
 */
interface DayLabelInterface
{
    public function getName(): string;

    public function getCharacter(): string;

    public function getCharacterSuffix(): string;
}
