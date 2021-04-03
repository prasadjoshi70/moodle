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

defined('MOODLE_INTERNAL') || die;

$functions = array(
    'local_skillcat_job_get_jobs' => array(
        'classname'   => 'job_get_jobs',
        'methodname'  => 'get_jobs',
        'classpath'   => 'local/skillcat/classes/webservices/job_get_jobs.php',
        'description' => 'Returns all “active” jobs or job templates created by company users from the skillcat_job table 
            based on the value of its single parameter.',
        'type'        => 'read',
        'services' => array('SkillCat')
    ),
    'local_skillcat_job_set_application' => array(
        'classname'   => 'job_set_application',
        'methodname'  => 'set_application',
        'classpath'   => 'local/skillcat/classes/webservices/job_set_application.php',
        'description' => 'Creates a new application record in skillcat_job_applicant for every job successfully applied to.',
        'type'        => 'read',
        'services' => array('SkillCat')
    ),
    'local_skillcat_job_direct_set_user' => array(
        'classname'   => 'job_direct_set_user',
        'methodname'  => 'set_user',
        'classpath'   => 'local/skillcat/classes/webservices/job_direct_set_user.php',
        'description' => 'Creates a new record in skillcat_direct_user for each user who responds to a direct assessment link.',
        'type'        => 'read',
        'services' => array('SkillCat')
    ),
    'local_skillcat_job_get_company' => array(
        'classname'   => 'job_get_company',
        'methodname'  => 'get_company',
        'classpath'   => 'local/skillcat/classes/webservices/job_get_company.php',
        'description' => 'Returns company information about the company user who posted a specific job.',
        'type'        => 'read',
        'services' => array('SkillCat')
    ),
);

$services = array(
    'SkillCat' => array(
        'functions' => array(
            'local_skillcat_job_get_jobs'
        ),
        'requiredcapability' => array('local/skillcat_webservice:use'),
        'restrictedusers' => 1,
        'enabled' => 0
    )
);