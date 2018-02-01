<?php
/**
 * PHP Version 5 and above
 *
 * @category  PHP_Editor_Scripts
 * @package   PHP_Easy_Source
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2016 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @link      https://github.com/phhpro/easy-source
 *
 * Demo index
 */


//** Load the script
require './source.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Easy Source Demo</title>
        <link rel=stylesheet href="source.css" type="text/css"/>
    </head>
    <body>
        <h1>PHP Easy Source Demo</h1>
        <p>This page demonstrates how to render a source code view of a given input file.</p>
        <h2>Example <code>source.php</code> (the script)</h2>
<?php src('/easy-source/source.php'); ?>
        <h2>Example <code>index.php</code> (this file)</h2>
<?php src('/easy-source/index.php'); ?>
    </body>
</html>
