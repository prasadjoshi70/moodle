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
class job_get_jobs extends \external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function get_jobs_parameters() {
        return new \external_function_parameters(
            array(
                'type' => new \external_value(PARAM_RAW, 'type: “job”, or “template”', VALUE_REQUIRED, 'job', NULL_NOT_ALLOWED),
            )
        );
    }

    /**
     * Get records
     *
     * @param string $type tiype
     * @return array An array of records
     * @throws coding_exception
     * @throws dml_exception
     * @throws invalid_parameter_exception
     */
    public static function get_jobs($type = 'job') {
        global $DB;

        $param = self::validate_parameters(
            self::get_jobs_parameters(),
            array(
                'type' => $type
            )
        );

        // Clean the values.
        $type = clean_param($param['type'], PARAM_TEXT);
        if(!in_array($type, array('job', 'template'))) throw new invalid_parameter_exception('Param invalid: ' . $type . ' not job or template');


        $sql = 'active = 1 and type = :type';
        $datas = $DB->get_records_select(
            'local_skillcat_job',
            $sql,
            array('type' => $type),
            'id ASC',
            'id, userid, type, title, description, role, industry, state, city, rate, drugtest, backgroundcheck, 
            drivingcheck, equipment, benefits, certifications, active, timecreated, skills'
        );

        // Finally retrieve enrolment information.
        $returned = array();
        foreach ($datas as $data) {
            $details = array(
                'id' => $data->id,
                'userid' => $data->userid,
                'type' => $data->type,
                'title' => $data->title,
                'description' => $data->description,
                'role' => $data->role,
                'industry' => $data->industry,
                'state' => $data->state,
                'city' => $data->city,
                'rate' => $data->rate,
                'drugtest' => $data->drugtest,
                'backgroundcheck' => $data->backgroundcheck,
                'drivingcheck' => $data->drivingcheck,
                'equipment' => $data->equipment,
                'benefits' => $data->benefits,
                'certifications' => $data->certifications,
                'active' => $data->active,
                'skills' => $data->skills,
                'timecreated' => $data->timecreated
            );
            $returned[] = $details;
        }

        return $returned;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_jobs_returns() {
        return new \external_multiple_structure(
            new \external_single_structure(
                array(
                    'id' => new \external_value(PARAM_INT, 'ID'),
                    'userid' => new \external_value(PARAM_INT, 'userid', VALUE_REQUIRED),
                    'type' => new \external_value(PARAM_RAW, 'type', VALUE_REQUIRED),
                    'title' => new \external_value(PARAM_RAW, 'title', VALUE_REQUIRED),
                    'description' => new \external_value(PARAM_RAW, 'description', VALUE_REQUIRED),
                    'role' => new \external_value(PARAM_RAW, 'role', VALUE_REQUIRED),
                    'industry' => new \external_value(PARAM_RAW, 'industry', VALUE_OPTIONAL),
                    'state' => new \external_value(PARAM_RAW, 'state', VALUE_REQUIRED),
                    'city' => new \external_value(PARAM_RAW, 'city', VALUE_REQUIRED),
                    'rate' => new \external_value(PARAM_RAW, 'rate', VALUE_REQUIRED),
                    'drugtest' => new \external_value(PARAM_RAW, 'drugtest', VALUE_REQUIRED),
                    'backgroundcheck' => new \external_value(PARAM_RAW, 'backgroundcheck', VALUE_REQUIRED),
                    'drivingcheck' => new \external_value(PARAM_RAW, 'drivingcheck', VALUE_REQUIRED),
                    'equipment' => new \external_value(PARAM_RAW, 'equipment', VALUE_REQUIRED),
                    'benefits' => new \external_value(PARAM_RAW, 'benefits', VALUE_REQUIRED),
                    'certifications' => new \external_value(PARAM_RAW, 'certifications', VALUE_REQUIRED),
                    'active' => new \external_value(PARAM_RAW, 'active', VALUE_REQUIRED),
                    'skills' => new \external_value(PARAM_RAW, 'skills', VALUE_REQUIRED),
                    'timecreated' => new \external_value(PARAM_RAW, 'timecreated', VALUE_REQUIRED),
                )
            )
        );
    }
    
}