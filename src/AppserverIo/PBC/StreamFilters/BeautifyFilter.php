<?php

/**
 * AppserverIo\PBC\StreamFilters\BeautifyFilter
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
 * @subpackage StreamFilters
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\StreamFilters;

/**
 * This filter will buffer the input stream, check it for php syntax errors and beautify it using
 * the nikic/php-parser lib.
 *
 * @category   Library
 * @package    PBC
 * @subpackage StreamFilters
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */
class BeautifyFilter extends AbstractFilter
{

    /**
     * @const integer FILTER_ORDER Order number if filters are used as a stack, higher means below others
     */
    const FILTER_ORDER = 99;

    /**
     * The main filter method.
     * Implemented according to \php_user_filter class. Will loop over all stream buckets, buffer them and perform
     * the needed actions.
     *
     * @param resource $in       Incoming bucket brigade we need to filter
     * @param resource $out      Outgoing bucket brigade with already filtered content
     * @param integer  $consumed The count of altered characters as buckets pass the filter
     * @param boolean  $closing  Is the stream about to close?
     *
     * @throws \Exception
     * @throws \PHPParser_Error
     *
     * @return integer
     *
     * @link http://www.php.net/manual/en/php-user-filter.filter.php
     *
     * TODO The buffering does not work that well, maybe we should implement universal buffering within parent class!
     */
    public function filter($in, $out, &$consumed, $closing)
    {
        // Get our buckets from the stream
        $buffer = '';
        while ($bucket = stream_bucket_make_writeable($in)) {

            $buffer .= $bucket->data;

            // Tell them how much we already processed, and stuff it back into the output
            $consumed += $bucket->datalen;

            // Save a bucket for later reuse
            $bigBucket = $bucket;
        }

        // Beautify all the buckets!
        $parser = new \PHPParser_Parser(new \PHPParser_Lexer);
        $prettyPrinter = new \PHPParser_PrettyPrinter_Default;

        try {
            // parse
            $stmts = $parser->parse($buffer);

            $data = '<?php ' . $prettyPrinter->prettyPrint($stmts);

        } catch (PHPParser_Error $e) {

            throw $e;
        }

        // Refill the bucket with the beautified data
        // Do not forget to set the length!
        $bigBucket->data = $data;
        $bigBucket->datalen = strlen($data);

        // Only append our big bucket
        stream_bucket_append($out, $bigBucket);

        return PSFS_PASS_ON;
    }
}
