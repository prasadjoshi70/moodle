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
require_once($CFG->dirroot . '/local/skillcat/classes/webservices/job_get_company.php');
require_once($CFG->dirroot . '/local/skillcat/lib.php');

/**
 * Unit tests for skillcat.
 * @package    local_skillcat
 * @category   external
 * @copyright --
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @group skillcat
 */
class job_get_company_test extends externallib_advanced_testcase {

    /**
     * Test job_get_jobs
     * @test
     * @return void
     */
    public function test_job_get_jobs() {
        global $DB;
        $this->setAdminUser();
        $this->resetAfterTest(true);
        $user = $this->getDataGenerator()->create_user();
        
        //count results for job
        $result = local_skillcat\webservice\job_get_company::get_company($user->id);
        $result = external_api::clean_returnvalue(local_skillcat\webservice\job_get_company::get_company_returns(), $result);
        $this->assertEquals($user->id, $result['id']);
        $this->assertEquals($user->username, $result['username']);

    }
}