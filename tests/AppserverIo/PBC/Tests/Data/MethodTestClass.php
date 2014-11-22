<?php

/**
 * AppserverIo\PBC\Tests\Data\MethodTestClass
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
 */
class MethodTestClass
{
    /**
     * @param string $req
     */
    public function bumpyBrackets($req)
    {
        $part = $req->getPart('file');

        file_put_contents("/opt/appserver/deploy/{$part->getFilename()}", $part->getInputStream());

        $application = new \stdClass();
        $application->name = $part->getFilename();

        $this->service->create($application);
    }

    /**
     * @return string
     */
    public function returnDir()
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    public function returnFile()
    {
        return __FILE__;
    }

    public function iHaveALambdaFunction()
    {
        // Process can not handle env values that are arrays
        $test = array_filter(
            array(array(), 'test'),
            function ($value) {
                if (!is_array($value)) {
                    return true;
                }
            }
        );

        return $test;
    }
}
