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
require_once("$CFG->dirroot/user/externallib.php");
require_once("$CFG->dirroot/user/lib.php");

/**
 * skillcat job_get_jobs class
 * @copyright --
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class job_get_company extends \external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function get_company_parameters() {
        return new \external_function_parameters(
            array(
                'userid' => new \external_value(PARAM_INT, 'the user.id of the user responding to the link', VALUE_REQUIRED, '', NULL_NOT_ALLOWED)
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
    public static function get_company(int $userid) {
        global $DB;

        $params = self::validate_parameters(
            self::get_company_parameters(),
            array(
                'userid' => $userid
            )
        );

        // Clean the values.
        foreach ($params as $param) {
            $cleanedvalue = clean_param($param, PARAM_INT);
            if ( $param != $cleanedvalue) {
                throw new \invalid_parameter_exception('Param invalid: ' . $param . '(cleaned value: '.$cleanedvalue.')');
            }
        }

        // Retrieve the users.
        $user = $DB->get_record('user', array('id' => $params['userid']), '*', MUST_EXIST);

        $context = \context_system::instance();
        \core_user_external::validate_context($context);

        // Finally retrieve each users information.
        $userdetails = \user_get_user_details_courses($user);

        return $userdetails;
    }

    /**
     * Returns description of method result value
     *
     * @return external_multiple_structure
     * @since Moodle 2.4
     */
    public static function get_company_returns() {
        return \core_user_external::user_description();
    }
}