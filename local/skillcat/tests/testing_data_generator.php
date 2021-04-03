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
 * Data generator.
 *
 * @package    core
 * @category   test
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_skillcat\tests;

defined('MOODLE_INTERNAL') || die();

/**
 * Data generator class for unit tests and other tools that need to create fake test sites.
 *
 * @package    core
 * @category   test
 * @copyright  2012 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class testing_data_generator {

    /**
     * Create a job
     * @param String $type
     * @param StdClass $user record
     * @return stdClass skillcat_job record
     */
    public function create_job($user, $type = SKILLCAT_TYPE_JOB) {
        global $DB;
        
        $record = new \stdClass();
        $record->userid = $user->id;
        $record->type   = $type;
        $record->title  = 'title job';
        $record->description = 'Description job';
        $record->role   = 'role job';
        $record->industry  = 'industry job';
        $record->state     = 'state job';
        $record->city      = 'City job';
        $record->rate      = 'Rate job';
        $record->drugtest  = SKILLCAT_ACTIVE;
        $record->backgroundcheck = SKILLCAT_ACTIVE;
        $record->drivingcheck = SKILLCAT_ACTIVE;
        $record->equipment = 'equipment job';
        $record->benefits  = 'benefits job';
        $record->certifications = 'certifications jobs';
        $record->active    = SKILLCAT_ACTIVE;
        $record->skills    = 'skills job';
        $record->timecreated = time();
        $record->id = $DB->insert_record('local_skillcat_job', $record);
        return $record;
    }
}
