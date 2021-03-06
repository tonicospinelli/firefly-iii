<?php
declare(strict_types = 1);
/**
 * TestRuleFormRequest.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

declare(strict_types = 1);
/**
 * TestRuleFormRequest.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FireflyIII\Http\Requests;

use Auth;
use Config;

/**
 * Class RuleFormRequest
 *
 *
 * @package FireflyIII\Http\Requests
 */
class TestRuleFormRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        // Only allow logged in users
        return Auth::check();
    }

    /**
     * @return array
     */
    public function rules()
    {

        $validTriggers = array_keys(Config::get('firefly.rule-triggers'));
        $rules         = [
            'rule-trigger.*'       => 'required|min:1|in:' . join(',', $validTriggers),
            'rule-trigger-value.*' => 'required|min:1|ruleTriggerValue',
        ];

        return $rules;
    }
}
