<?php
/**
 * PHP Version 5 and above
 *
 * Renders source view of given file with basic syntax high-lightning
 *
 * @category  PHP_Editor
 * @package   PHP_Easy_Source
 * @author    P H Claus <phhpro@gmail.com>
 * @copyright 2016 - 2019 P H Claus
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
 * Function src()
 *
 * @param string $src_file string input
 *
 * @return string output
 * @syntax src('/path/to/file.ext');
 */
function src($src_file) 
{
    /**
     * Document root and decimal offset
     *
     * Full path without trailing / if SERVER has wrong value
     * %04d prints max 9999 lines, %05d max 99999, etc.
     */
    $src_root = $_SERVER['DOCUMENT_ROOT'];
    $src_deci = "%04d";

    //** Link source and script version
    $src_file = $src_root . $src_file;
    $src_make = 20190121;

    //** Check file
    if (is_file($src_file)) {
        $src_data = file_get_contents($src_file);

        //** Entity, quote
        $src_data = htmlentities($src_data);
        $src_data = str_replace('"', '&quot;', $src_data);

        //** Tag
        $src_data = preg_replace(
            "/&lt;(.+?)&gt;/",
            "<span class=src_tag>$0</span>", $src_data
        );

        //** Attrib
        $src_data = preg_replace(
            "/&quot;(.+?)&quot;/",
            "<span class=src_att>$0</span>", $src_data
        );

        $src_data = preg_replace(
            "/'(.+?)'/",
            "<span class=src_att>$0</span>", $src_data
        );

        //** Comment
        $src_data = preg_replace(
            "~(?:#|//)[^\r\n]*|/\*.*?\*/~s",
            "<span class=src_com>$0</span>", $src_data
        );

        //** Line counter
        $src_line = explode("\n", $src_data);
        $src_cntr = 1;

        echo "        <div class=src_out>";

        foreach ($src_line as $src_span) {
            echo "<span class=src_lc>" .
                 sprintf($src_deci, $src_cntr++) .
                 "</span> $src_span\n";
        }

        unset($src_span);
        echo "EOF</div>\n";
    } else {
        echo "        <p>File $src_file does not exist!</p>";
    }

    echo "        <div id=src_by>Powered by " .
         "<a href=\"https://github.com/phhpro/easy-source\" " .
         "title=\"Click here to get a free copy of this script\">" .
         "PHP Easy Source v$src_make</a></div>\n";
}
