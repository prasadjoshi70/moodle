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

global $CFG;

require_once($CFG->dirroot . '/webservice/tests/helpers.php');
require_once($CFG->dirroot . '/local/skillcat/classes/webservices/job_get_jobs.php');
require_once($CFG->dirroot . '/local/skillcat/lib.php');

/**
 * Unit tests for skillcat.
 * @package    local_skillcat
 * @category   external
 * @copyright --
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @group skillcat
 */
class job_get_jobs_test extends externallib_advanced_testcase {

    /**
     * Test job_get_jobs
     * @test
     * @return void
     */
    public function test_job_get_jobs() {
        global $DB;

        $this->resetAfterTest(true);
        $user = $this->getDataGenerator()->create_user();
        $skillcat_job_record = [
            'userid'    => $user->id,
            'type'      => SKILLCAT_TYPE_JOB,
            'title'     => 'title job',
            'description' => 'Description job',
            'role'      => 'role job',
            'industry'  => 'industry job',
            'state'     => 'state job',
            'city'      => 'City job',
            'rate'      => 'Rate job',
            'drugtest'  => SKILLCAT_ACTIVE,
            'backgroundcheck' => SKILLCAT_ACTIVE,
            'drivingcheck' => SKILLCAT_ACTIVE,
            'equipment' => 'equipment job',
            'benefits'  => 'benefits job',
            'certifications' => 'certifications jobs',
            'active'    => SKILLCAT_ACTIVE,
            'skills'    => 'skills job',
            'timecreated' => time()
        ];
        $DB->insert_record('local_skillcat_job', $skillcat_job_record);

        //count results for job
        $result = local_skillcat\webservice\job_get_jobs::get_jobs(SKILLCAT_TYPE_JOB);
        $result = external_api::clean_returnvalue(local_skillcat\webservice\job_get_jobs::get_jobs_returns(), $result);
        $this->assertCount(1, $result);

        //count results for template
        $result = local_skillcat\webservice\job_get_jobs::get_jobs(SKILLCAT_TYPE_TEMPLATE);
        $result = external_api::clean_returnvalue(local_skillcat\webservice\job_get_jobs::get_jobs_returns(), $result);
        $this->assertCount(0, $result);
    }
}