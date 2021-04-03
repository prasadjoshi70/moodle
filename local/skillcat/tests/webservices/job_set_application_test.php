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
require_once($CFG->dirroot . '/local/skillcat/classes/webservices/job_set_application.php');
require_once($CFG->dirroot . '/local/skillcat/lib.php');
require_once($CFG->dirroot . '/local/skillcat/tests/testing_data_generator.php');

use local_skillcat\tests\testing_data_generator;

/**
 * Unit tests for skillcat.
 * @package    local_skillcat
 * @category   external
 * @copyright --
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @group skillcat
 */
class job_set_application_test extends externallib_advanced_testcase {

    /**
     * Test job_get_jobs
     * @test
     * @return void
     * @throws dml_exception
     * @throws invalid_response_exception
     */
    public function test_job_set_application() {
        global $DB;
        $data_generator = new testing_data_generator();
        $this->resetAfterTest(true);
        $user = $this->getDataGenerator()->create_user();
        $job = $data_generator->create_job($user, SKILLCAT_TYPE_JOB);

        //count results for job
        $result = local_skillcat\webservice\job_set_application::set_application($user->id, $job->id);
        $result = external_api::clean_returnvalue(local_skillcat\webservice\job_set_application::set_application_returns(), $result);
        $this->assertEquals($user->id, $result['userid']);
        $this->assertEquals($job->id, $result['jobid']);

        //count results for template
        $set_application = $DB->get_record('local_skillcat_job_applicant', array('id' => $result['id']), '*', MUST_EXIST);
        $this->assertNotNull($set_application);
    }
}