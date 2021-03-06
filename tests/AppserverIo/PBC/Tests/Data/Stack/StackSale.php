<?php

/**
 * AppserverIo\PBC\Tests\Data\Stack\StackSale
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
 */
class StackSale
{
    /**
     *
     */
    public function sell()
    {
        $someStrings = array('sdfsafsf', 'rzutrzutfzj', 'OUHuISGZduisd0', 'skfse', 'd', 'fdghdfg', 'srfxcf');

        // Do some string stuff
        $stringStack = new StringStack();
        // push the strings into the stack
        foreach ($someStrings as $someString) {

            $stringStack->push($someString);
        }
        // and pop some of them again
        $stringStack->pop();
        $stringStack->pop();
        $stringStack->pop();
        $stringStack->pop();
        $stringStack->pop();
        $stringStack->pop();
        $stringStack->pop();

        // Work with our unique stacks
        $uniqueStack1 = new UniqueStack1();
        $uniqueStack2 = new UniqueStack2();

        foreach ($someStrings as $someString) {

            $uniqueStack1->push($someString);
            $uniqueStack2->push($someString);
        }
    }
}
