<?php

/**
 * AppserverIo\PBC\Tests\Data\Stack\FixedStack
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Library
 * @package    PBC
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\Tests\Data\Stack;

/**
 * @category   Library
 * @package    PBC
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 *
 * @invariant $this->size() <= $this->limit
 */
class FixedStack extends AbstractStack
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * @requires    is_int($_limit)
     */
    public function __construct($_limit)
    {
        $this->limit = $_limit;
    }

    /**
     * @requires $this->size() < $this->limit
     */
    public function push($obj)
    {
        return parent::push($obj);
    }
}
