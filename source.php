<?php
/**
 * PHP Version 5 and above
 *
 * Prints a source code view of the given input file
 * with basic syntax high-lightning.
 *
 * @category  PHP_Editor_Scripts
 * @package   PHP_Easy_Source
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2016 - 2018 P H Claus
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPLv3
 * @version   GIT: Latest
 * @link      https://github.com/phhpro/easy-source
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 */


/**
 * Function src() renders source code view of given file
 *
 * @param string $src_file string input
 *
 * @return string output
 * @syntax src('/path/to/file.ext');
 */
function src($src_file) 
{
    /**
     * Document root
     * Decimal
     *
     * Full "path" without trailing / if SERVER has wrong value
     * %04d prints max 9999 lines, %05d max 99999, etc.
     */
    $src_root = $_SERVER['DOCUMENT_ROOT'];
    $src_deci = "%04d";

    //** Link source file and script version
    $src_file = $src_root . $src_file;
    $src_make = 20180201;

    //** Check if file exists
    if (file_exists($src_file)) {

        //** Link data and filter entities
        $src_data = file_get_contents($src_file);
        $src_data = htmlentities($src_data);
        $src_data = str_replace('"', '&quot;', $src_data);

        //** Filter tags
        $src_data = preg_replace(
            "/&lt;(.+?)&gt;/",
            "<span class=src_tag>$0</span>", $src_data
        );

        //** Filter attributes
        $src_data = preg_replace(
            "/&quot;(.+?)&quot;/",
            "<span class=src_att>$0</span>", $src_data
        );
        $src_data = preg_replace(
            "/'(.+?)'/",
            "<span class=src_att>$0</span>", $src_data
        );

        //** Filter comments
        $src_data = preg_replace(
            "~(?:#|//)[^\r\n]*|/\*.*?\*/~s",
            "<span class=src_com>$0</span>", $src_data
        );

        //** Init line counter
        $src_line = explode("\n", $src_data);
        $src_cntr = 1;

        //** Print results
        echo "        <div class=src_out>";

        //** Parse file and print lines
        foreach ($src_line as $src_span) {
            echo "<span class=src_ln>" .
                 sprintf($src_deci, $src_cntr++) .
                 "</span> $src_span\n";
        }

        //** Clear span and print EOF flag
        unset($src_span);
        echo "EOF</div>\n";
    } else {
        echo "        <p>File $src_file does not exist!</p>";
    }

    echo "        <div id=src_by>Powered by " .
         '<a href="https://github.com/phhpro/easy-source" ' .
         'title="Click here to get a free copy of this script">' .
         "PHP Easy Source v$src_make</a></div>\n";
}