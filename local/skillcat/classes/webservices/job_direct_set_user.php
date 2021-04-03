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

namespace local_skillcat\webservice;

global $CFG;
require_once("$CFG->libdir/externallib.php");

/**
 * skillcat job_get_jobs class
 * @copyright --
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class job_direct_set_user  extends \external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function set_user_parameters() {
        return new \external_function_parameters(
            array(
                'userid' => new \external_value(PARAM_INT, 'the user.id of the user responding to the link', VALUE_REQUIRED, '', NULL_NOT_ALLOWED),
                'companyuserid' => new \external_value(PARAM_INT, 'the user.id of the worker user who sent the link', VALUE_REQUIRED, '', NULL_NOT_ALLOWED),
                'compid' => new \external_value(PARAM_INT, 'the competency.id of the assessment in the link', VALUE_REQUIRED, '', NULL_NOT_ALLOWED),
            )
        );
    }

    /**
     * Get records
     *
     * @param int $userid userid
     * @params int $jobid jobid
     * @return array An array of records
     * @throws coding_exception
     * @throws dml_exception
     * @throws invalid_parameter_exception
     */
    public static function set_user(int $userid, int $companyuserid, int $compid) {
        global $DB;

        $params = self::validate_parameters(
            self::set_user_parameters(),
            array(
                'userid' => $userid,
                'companyuserid' => $companyuserid,
                'compid' => $compid
            )
        );

        // Clean the values.
        foreach ($params as $param) {
            $cleanedvalue = clean_param($param, PARAM_INT);
            if ( $param != $cleanedvalue) {
                throw new \invalid_parameter_exception('Param invalid: ' . $param . '(cleaned value: '.$cleanedvalue.')');
            }
        }

        // check the user exists en db
        if(!$DB->record_exists('user', array('id' => $params['userid']))) {
            throw new \moodle_exception("User not exists: " . $params['userid']);
        }

        // check the companyuserid exists en db
        if(!$DB->record_exists('user', array('id' => $params['companyuserid']))) {
            throw new \moodle_exception("Companyuserid not exists: " . $params['companyuserid']);
        }
        
        // check the competency exists en db
        if(!$DB->record_exists('competency', array('id' => $params['compid']))) {
            throw new \moodle_exception("Skillcat Job not exists: " . $params['jobid']);
        }

        $record = new \stdClass();
        $record->userid = $params['userid'];
        $record->companyuserid = $params['companyuserid'];
        $record->competencyid = $params['compid'];
        $record->timecreated = time();
        if (!$record->id = $DB->insert_record('local_skillcat_direct_user', $record)) {
            throw new \moodle_exception("There was a problem saving in the database the device with key: " . $params['userid'] . "-" . $params['companyuserid'] . "-" . $params['compid']);
        }
        return $record;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function set_user_returns() {
        return new \external_single_structure(
            array(
                'id' => new \external_value(PARAM_INT, 'ID'),
                'userid' => new \external_value(PARAM_INT, 'userid', VALUE_REQUIRED),
                'companyuserid' => new \external_value(PARAM_INT, 'companyuserid', VALUE_REQUIRED),
                'competencyid' => new \external_value(PARAM_INT, 'competencyid', VALUE_REQUIRED),
                'timecreated' => new \external_value(PARAM_RAW, 'timecreated', VALUE_REQUIRED),
            )
        );
    }
}