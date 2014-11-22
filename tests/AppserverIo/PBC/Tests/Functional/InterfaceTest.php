<?php

/**
 * AppserverIo\PBC\Tests\Functional\InterfaceTest
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

namespace AppserverIo\PBC\Tests\Functional;

use AppserverIo\PBC\Tests\Data\InterfaceClass;

/**
 * Will test basic interface usage.
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
class InterfaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test proper handling of classes which implement an interface
     *
     * @return null
     */
    public function testInstantiation()
    {
        $interfaceClass = new InterfaceClass();
    }

    /**
     * Will test operation on said class
     *
     * @return null
     */
    public function testStackUsage()
    {
        $interfaceClass = new InterfaceClass();

        $someStrings = array('sdfsafsf', 'rzutrzutfzj', 'OUHuISGZduisd0', 'skfse', 'd', 'fdghdfg', 'srfxcf');

        // push the strings into the stack
        foreach ($someStrings as $someString) {

            $interfaceClass->push($someString);
        }
        // and pop some of them again
        $interfaceClass->pop();
        $interfaceClass->pop();
        $interfaceClass->pop();
        $interfaceClass->pop();
        $interfaceClass->pop();
        $interfaceClass->pop();

        $this->assertEquals($interfaceClass->peek(), $interfaceClass->pop());
    }
}
