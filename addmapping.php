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
 * add mapping for default URL
 *
 * @package    filter
 * @subpackage gurls
 * @copyright  manolescu.dorel@gmail.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require(dirname(__FILE__) . '/../../config.php');
require_once('addmapping_form.php');

$groupingid = required_param('groupingid', PARAM_INT); // Grouping id.

require_login();

$PAGE->set_context(context_system::instance());
require_capability('moodle/site:config', context_system::instance());
$navurl = new moodle_url('/filter/gurls/gurlpanel.php', array());

$PAGE->set_url('/filter/gurls/addmapping.php', array('groupingid' => $groupingid));
$PAGE->navbar->add(get_string('gurlpanel', 'filter_gurls'), $navurl);
$PAGE->navbar->add(get_string('addmapping', 'filter_gurls'));
$PAGE->set_pagelayout('standard');

$mform = new filter_gurls_mapping_add_form(null, array('groupingid' => $groupingid));

if ($mform->is_cancelled()) {
    redirect("gurlpanel.php");
} else if ($newmapping = $mform->get_data()) {
    global $DB;
    $mapping = new stdClass();
    $mapping->groupingid = $groupingid;
    $mapping->defaulturl = $newmapping->defaulturl;
    $mapping->timemodified = time();
    $DB->insert_record('filter_gurls_default', $mapping);
    redirect("gurlpanel.php", get_string('defaulturlrecorded', 'filter_gurls'));
} else {
    $PAGE->set_title(format_string(get_string('defaulturl', 'filter_gurls')));
    $PAGE->add_body_class('filter_gurls');
    $PAGE->set_heading(format_string(get_string('addmapping', 'filter_gurls')));
    echo $OUTPUT->header();
    $mform->display();
}
echo '<br />';
echo $OUTPUT->footer();