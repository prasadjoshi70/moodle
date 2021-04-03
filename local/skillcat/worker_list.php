<?php
// This file is part of Moodle - http://moodle.org/
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
 * Skill Cat
 *
 * @package    local_skillcat
 * @copyright --
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__ . '/../../config.php');
require_login(0, false);
if (isguestuser()) {
    throw new require_login_exception('Guests are not allowed here.');
}

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_url('/local/skillcat/worker_list.php');
$PAGE->set_title(get_string('workerdatabase', 'local_skillcat'));
$PAGE->set_heading(get_string('workerdatabase', 'local_skillcat'));

$PAGE->requires->js_call_amd('local_skillcat/worker_list', 'init');
$PAGE->requires->css('/local/skillcat/styles/worker_list.css');
$PAGE->requires->css('/local/skillcat/styles/multiple_select.css');
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_skillcat/worker_list', array());
echo $OUTPUT->footer();
