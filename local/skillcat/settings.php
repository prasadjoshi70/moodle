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

defined('MOODLE_INTERNAL') || die();
global $OUTPUT, $PAGE, $CFG;

// workerlist
$ADMIN->add('localplugins', new admin_externalpage('skillcat', get_string('pluginname', 'local_skillcat'),
    "$CFG->wwwroot/local/skillcat/pages/worker_list.php"));


$settings = new admin_settingpage('local_skillcat', get_string('pluginname', 'local_skillcat'));
$ADMIN->add('localplugins', $settings);
$settings->add(new admin_setting_heading('local_skillcat', '', get_string('pluginname', 'local_skillcat')));

$settings->add( new admin_setting_confightmleditor (
    'local_skillcat/schedule_interview',
    new lang_string('setting_schedule_interview','local_skillcat'),
    new lang_string('setting_schedule_interview_desc','local_skillcat'),
    new lang_string('setting_schedule_interview_default','local_skillcat'),
    PARAM_TEXT
));
