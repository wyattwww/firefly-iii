<?php

/**
 * ObjectGroupUpdateRequest.php
 * Copyright (c) 2019 james@firefly-iii.org
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Api\V1\Requests;

use FireflyIII\Support\Request\ConvertsDataTypes;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccountObjectGroupUpdateRequestUpdateRequest
 *
 * @codeCoverageIgnore
 */
class ObjectGroupUpdateRequest extends FormRequest
{
    use ConvertsDataTypes;

    /**
     * Authorize logged in users.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Only allow authenticated users
        return auth()->check();
    }

    /**
     * @return array
     */
    public function getUpdateData(): array
    {
        return [
            'title' => $this->string('title'),
            'order' => $this->integer('order'),
        ];
    }

    /**
     * The rules that the incoming request must be matched against.
     *
     * @return array
     */
    public function rules(): array
    {
        $objectGroup = $this->route()->parameter('objectGroup');

        return [
            'title' => sprintf('min:1|uniqueObjectGroup:%d', $objectGroup->id),
            'order' => 'numeric',
        ];
    }
}
