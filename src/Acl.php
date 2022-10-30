<?php
/**
 * This file is part of the Acl package.
 *
 * (c) WebsvcPT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace websvc\acl;

use Yii;
use yii\base\Component;

/**
 *
 *
 * @author Nelson Dias
 */
class Acl extends Component
{
    /**
     * Use user session
     * @var boolean
     */
    public $useUserSession = false;


    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * For debug purpose - Display user ACLs
     */
    public static function dumpUserACL($id)
    {
    }

}
