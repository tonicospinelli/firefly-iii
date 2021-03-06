<?php
/**
 * ChartPiggyBankControllerTest.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-19 at 15:39:57.
 */
class ChartPiggyBankControllerTest extends TestCase
{

    /**
     * @covers FireflyIII\Http\Controllers\Chart\PiggyBankController::history
     * @covers FireflyIII\Http\Controllers\Chart\PiggyBankController::__construct
     */
    public function testHistory()
    {
        $this->be($this->user());
        $this->call('GET', '/chart/piggy-bank/1');
        $this->assertResponseStatus(200);
    }
}
