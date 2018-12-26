<?php
/**
 * PHP Version 5 and above
 *
 * Demo index
 *
 * @category  PHP_Editor_Scripts
 * @package   PHP_Easy_Source
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2016 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @version   GIT: Latest
 * @link      https://github.com/phhpro/easy-source
 */


//** Load script
require "./source.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Easy Source Demo</title>
        <link rel=stylesheet href="source.css"/>
    </head>
    <body>
        <h1>PHP Easy Source Demo</h1>
        <p>Render source view of given file.</p>
        <p><code>source.php</code> -- the main script</p>
<?php src('/easy-source/source.php'); ?>
        <p><code>index.php</code> -- this file</p>
<?php src('/easy-source/index.php'); ?>
    </body>
</html>
