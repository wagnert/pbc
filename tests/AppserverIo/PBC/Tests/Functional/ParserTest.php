<?php

/**
 * AppserverIo\PBC\Tests\Functional\ParserTest
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

use AppserverIo\PBC\Config;
use AppserverIo\PBC\Tests\Data\AnnotationTestClass;
use AppserverIo\PBC\Tests\Data\MethodTestClass;
use AppserverIo\PBC\Tests\Data\MultiRegex\A\Data\RegexTestClass1;
use AppserverIo\PBC\Tests\Data\MultiRegex\B\Data\RegexTestClass2;
use AppserverIo\PBC\Tests\Data\RegexTest1\RegexTestClass;

/**
 * Will test basic parser usage.
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
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Will test parsing of special annotations like typed arrays
     *
     * @return null
     */
    public function testAnnotationParsing()
    {
        // Get the object to test
        $annotationTestClass = new AnnotationTestClass();

        $e = null;
        try {

            $annotationTestClass->typeCollection(array(new \Exception(), new \Exception(), new \Exception()));

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);

        $e = null;
        try {

            $annotationTestClass->typeCollection(array(new \Exception(), 'failure', new \Exception()));

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertInstanceOf("AppserverIo\\PBC\\Exceptions\\BrokenPreconditionException", $e);

        // Get the object to test
        $annotationTestClass = new AnnotationTestClass();

        $e = null;
        try {

            $annotationTestClass->typeCollectionReturn(array(new \Exception(), new \Exception(), new \Exception()));

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);

        $e = null;
        try {

            $annotationTestClass->typeCollectionReturn(array(new \Exception(), 'failure', new \Exception()));

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertInstanceOf("AppserverIo\\PBC\\Exceptions\\BrokenPostconditionException", $e);

        $e = null;
        try {

            $annotationTestClass->orCombinator(new \Exception());
            $annotationTestClass->orCombinator(null);

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);

        $e = null;
        try {

            $annotationTestClass->orCombinator(array());

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertInstanceOf("AppserverIo\\PBC\\Exceptions\\BrokenPreconditionException", $e);
    }

    /**
     * Will check for proper method parsing
     *
     * @return null
     */
    public function testMethodParsing()
    {
        $e = null;
        try {

            $methodTestClass = new MethodTestClass();

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);
    }

    /**
     * Will test if a configuration using regexed paths can be used properly
     *
     * @return null
     */
    public function testRegexMapping()
    {
        // We have to load the config for regular expressions in the project dirs
        $config = new Config();
        $config->load(
            str_replace(DIRECTORY_SEPARATOR . 'Functional', '', __DIR__) . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . 'RegexTest' .
            DIRECTORY_SEPARATOR . 'regextest.conf.json'
        );

        $e = null;
        try {

            $regexTestClass1 = new RegexTestClass1();

        } catch (Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);

        $e = null;
        try {

            $regexTestClass2 = new RegexTestClass2();

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);

        $e = null;
        try {

            $regexTestClass = new RegexTestClass();

        } catch (\Exception $e) {
        }

        // Did we get the right $e?
        $this->assertNull($e);
    }
}
