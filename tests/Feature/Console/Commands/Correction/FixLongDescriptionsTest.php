<?php
/*
 * FixLongDescriptionsTest.php
 * Copyright (c) 2020 james@firefly-iii.org
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

namespace Tests\Feature\Console\Commands\Correction;


use Tests\TestCase;

/**
 * Class FixLongDescriptionsTest
 */
class FixLongDescriptionsTest extends TestCase
{
    /**
     * @covers \FireflyIII\Console\Commands\Correction\FixLongDescriptions
     */
    public function testHandle(): void
    {
        $journal              = $this->getRandomWithdrawal();
        $original             = $journal->description;
        $journal->description = str_repeat('ABCDEF123456x', 200);
        $journal->save();


        $this->artisan('firefly-iii:fix-long-descriptions')
             ->expectsOutput(sprintf('Truncated description of transaction journal #%d', $journal->id))
             ->expectsOutput('Verified all transaction group and journal title lengths.')
             ->assertExitCode(0);

        $journal->description = $original;
        $journal->save();
    }

    /**
     * @covers \FireflyIII\Console\Commands\Correction\FixLongDescriptions
     */
    public function testHandleGroup(): void
    {
        $journal      = $this->getRandomWithdrawal();
        $group        = $journal->transactionGroup;
        $original     = $group->title;
        $group->title = str_repeat('ABCDEF123456x', 200);
        $group->save();


        $this->artisan('firefly-iii:fix-long-descriptions')
             ->expectsOutput(sprintf('Truncated description of transaction group #%d', $group->id))
             ->expectsOutput('Verified all transaction group and journal title lengths.')
             ->assertExitCode(0);

        $group->title = $original;
        $group->save();
    }

}