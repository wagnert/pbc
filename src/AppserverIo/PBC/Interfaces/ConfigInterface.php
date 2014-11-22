<?php

/**
 * AppserverIo\PBC\Interfaces\ConfigInterface
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
 * @subpackage Interfaces
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\Interfaces;

/**
 * An interface defining the functionality of any possible configuration class.
 *
 * @category   Library
 * @package    PBC
 * @subpackage Interfaces
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */
interface ConfigInterface
{
    /**
     * Will load a certain configuration file into this instance. Might throw an exception if the file is not valid
     *
     * @param string $file The path of the configuration file we should load
     *
     * @return null
     *
     * @throws \Exception
     */
    public function load($file);

    /**
     * Will validate a potential configuration file. Returns false if file is no valid PBC configuration, true otherwise
     *
     * @param string $file Path of the potential configuration file
     *
     * @return bool
     * @throws \Exception
     */
    public function isValidConfigFile($file);
}
