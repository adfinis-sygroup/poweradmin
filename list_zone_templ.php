<?php

/*  Poweradmin, a friendly web-based admin tool for PowerDNS.
 *  See <http://www.poweradmin.org> for more details.
 *
 *  Copyright 2007-2010  Rejo Zenger <rejo@zenger.nl>
 *  Copyright 2010-2014  Poweradmin Development Team
 *      <http://www.poweradmin.org/credits.html>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Script that displays list of zone templates
 *
 * @package     Poweradmin
 * @copyright   2007-2010 Rejo Zenger <rejo@zenger.nl>
 * @copyright   2010-2014 Poweradmin Development Team
 * @license     http://opensource.org/licenses/GPL-3.0 GPL
 */
require_once("inc/toolkit.inc.php");
include_once("inc/header.inc.php");

$perm_zone_master_add    = (bool)do_hook('verify_permission', 'zone_master_add');
$perm_zone_master_global = (bool)do_hook('verify_permission', 'zone_master_global');

$zone_templates = get_list_zone_templ($_SESSION['userid']);
$username = do_hook('get_fullname_from_userid', $_SESSION['userid']);

if (!$perm_zone_master_add) {
    error(ERR_PERM_EDIT_ZONE_TEMPL);
} else {
    echo "    <h2>" . _('Zone templates for') . " " . $username . "</h2>\n";
    echo "     <table>\n";
    echo "      <tr>\n";
    echo "       <th>&nbsp;</th>\n";
    echo "       <th>" . _('Name') . "</th>\n";
    echo "       <th>" . _('Description') . "</th>\n";

    if ($perm_zone_master_global) {
        echo "       <th>" . _('Global') . "</th>\n";
    }

    echo "      </tr>\n";

    foreach ($zone_templates as $template) {

        echo "      <tr>\n";
        if ($perm_zone_master_add) {
            echo "       <td>\n";
            if (($template['global'] && $perm_zone_master_global) || !$template['global']) {
                echo "        <a href=\"edit_zone_templ.php?id=" . $template["id"] . "\"><img src=\"images/edit.gif\" alt=\"[ " . _('Edit template') . " ]\"></a>\n";
                echo "        <a href=\"delete_zone_templ.php?id=" . $template["id"] . "\"><img src=\"images/delete.gif\" alt=\"[ " . _('Delete template') . " ]\"></a>\n";
            }
            echo "       </td>\n";
        } else {
            echo "       <td>&nbsp;</td>\n";
        }
        echo "       <td class=\"y\">" . $template['name'] . "</td>\n";
        echo "       <td class=\"y\">" . $template['descr'] . "</td>\n";

        if ($perm_zone_master_global) {
            echo "       <td class=\"y\">" . ($template['global'] ? _('Yes') : _('No')) . "</td>\n";
        }

        echo "      </tr>\n";
    }

    echo "     </table>\n";
    echo "     <ul>\n";
    echo "      <li><a href=\"add_zone_templ.php\">" . _('Add zone template') . "</a>.</li>\n";
    echo "     </ul>\n";
}

include_once("inc/footer.inc.php");
