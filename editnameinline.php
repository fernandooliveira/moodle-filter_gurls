<?php
// This file is part of portofolio module for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * edit defined URL
 *
 * @package    filter
 * @subpackage gurls
 * @copyright  manolescu.dorel@gmail.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require(dirname(__FILE__) . '/../../config.php');

$groupingid = required_param('groupingid', PARAM_INT); // Grouping id.
$defurlid = required_param('defurlid', PARAM_INT); // Default id.
$value = required_param('value', PARAM_ALPHANUMEXT);

require_login();

$PAGE->set_context(context_system::instance());
require_capability('moodle/site:config', context_system::instance());
$mapping = new stdClass();
$mapping->id = $defurlid;
$mapping->name = $value;
$mapping->timemodified = time();

$DB->update_record('filter_gurls_urls', $mapping);
echo $value;