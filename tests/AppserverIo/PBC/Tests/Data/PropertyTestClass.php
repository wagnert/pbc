<?php

/**
 * AppserverIo\PBC\Tests\Data\PropertyTestClass
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

namespace AppserverIo\PBC\Tests\Data;

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
 * @invariant   $this->privateCheckedProperty === 'test'
 * @invariant   $this->protectedCheckedProperty === 1
 * @invariant   $this->publicCheckedProperty === 27.42
 */
class PropertyTestClass
{
    private $privateNonCheckedProperty;

    private $privateCheckedProperty = 'test';

    protected $protectedNonCheckedProperty;

    protected $protectedCheckedProperty = 1;

    public $publicNonCheckedProperty;

    public $publicCheckedProperty = 27.42;
}
