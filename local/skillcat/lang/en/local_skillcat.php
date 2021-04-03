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
$string['pluginname'] = 'Skill Cat Plugin';
$string['privacy:metadata'] = 'Skillcat plugins do not store user data.';
$string['workerdatabase'] = 'Worker Database';
$string['setting_schedule_interview'] = 'Interview request';
$string['setting_schedule_interview_desc'] = 'The text message for interview request
Placeholder List:
{worker_user_first_name}
{company_user_company_name}
{company_user_industry}
{company_user_city}
{company_user_calendly_link}
{company_profile_link}
';
$string['setting_schedule_interview_default'] = 'Hey {worker_user_first_name},
    {company_user_company_name}, a {company_user_industry} HVAC company, in
    {company_user_city} wants to set up a phone interview with you!
    You can pick a time that is convenient for you here: {company_user_calendly_link}.
    You can find out more information about the company here: {company_profile_link}.';
