<?php
/**
 * HelpControllerTest.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-19 at 15:39:28.
 */
class HelpControllerTest extends TestCase
{

    /**
     * @covers FireflyIII\Http\Controllers\HelpController::show
     * @covers FireflyIII\Http\Controllers\HelpController::__construct
     */
    public function testShow()
    {
        $this->be($this->user());
        $this->call('GET', '/help/index');

        $this->assertResponseStatus(200);
    }

    /**
     * @covers FireflyIII\Http\Controllers\HelpController::show
     */
    public function testShowNoRoute()
    {
        $this->be($this->user());
        $this->call('GET', '/help/indxxex');

        $this->assertResponseStatus(200);
    }
}
