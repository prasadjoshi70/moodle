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

require_once '../../config.php';
global $USER, $DB, $CFG;

require_once("forms/companyuser.php");

$PAGE->set_url('/local/companyuser/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->requires->js('/local/companyuser/assets/companyuser.js');

$strpagetitle = get_string('forgot', 'local_companyuser');

$PAGE->set_title($strpagetitle);
$PAGE->set_heading($strpagetitle);

$mform = new company_form();
$toform = [];
//$mform = new company_form("?id=$id");
$toform = [];
if ($mform->is_cancelled()) {
      redirect("/moodle/local/companyuser/", '', 10);
  }
  elseif ($fromform = $mform->get_data()) {
		$success = $mform->save_file('image', 'assets/'.$mform->get_new_filename('image'), false);
      //In this case you process validated data. $mform->get_data() returns data posted in form.
      // Save form data
       $obj = new stdClass();
          $obj->firstname = $fromform->firstname;
          $obj->lastname = $fromform->lastname;
          $obj->email = $fromform->email;
		  $obj->password = $fromform->password1;
		  $obj->contact = $fromform->contact;
          $obj->companyname = $fromform->companyname;
		  $obj->state = $fromform->state;
          $obj->city = $fromform->city;
		  $obj->industry = $fromform->industry;
		  $obj->hiring = $fromform->position;
		  $obj->totalhiring = $fromform->willhire;
		  $obj->description = $fromform->description;
		  $obj->image = $mform->get_new_filename('image');
		  $obj->facebook = $fromform->facebook;
		  $obj->linkedin = $fromform->linkedin;
		  $obj->calendly = $fromform->calendly;
          $orgid = $DB->insert_record('local_companyuser_rates', $obj, true, false);
      // redirect to units page with qual id
      redirect("/moodle/local/companyuser/index.php", 'New Company Added', 10,  \core\output\notification::NOTIFY_SUCCESS);
  }
  
  
  
  
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_companyuser/forgotpassword', array());
echo $OUTPUT->footer();
