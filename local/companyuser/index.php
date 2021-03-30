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

require_login();
/*
if(!has_capability('local/staffmanager:admin', context_system::instance()))
{
  echo $OUTPUT->header();
  echo "<h3>You do not have permission to view this page.</h3>";
  echo $OUTPUT->footer();
  exit;
}
*/
/*
$month = optional_param('month', '', PARAM_TEXT);
$year = optional_param('year', '', PARAM_TEXT);

$obj = new stdClass();
$obj->month = (int)$month;
$obj->year = (int)$year;

$results = new stdClass();
*/
$strpagetitle = get_string('companyusers', 'local_companyuser');
//$strpageheading = get_string('searchstaff', 'local_staffmanager');

$PAGE->set_title($strpagetitle);
$PAGE->set_heading($strpagetitle);
/*
if(is_int($obj->month) && is_int($obj->year))
{
$start = mktime(0,0,0,$obj->month,1,$obj->year);
$end  = mktime(23,59,00,$obj->month+1,0,$obj->year);


$sql = "SELECT DISTINCT(gg.usermodified) as graderid
FROM {grade_grades} AS gg
LEFT JOIN {user} AS grader ON grader.id = gg.usermodified
WHERE gg.usermodified <> '' AND gg.finalgrade > 0 AND gg.timemodified >= ". $start." AND gg.timemodified <=".$end ;
$graders = $DB->get_records_sql($sql);
// get grades marked by each grader
$data = [];
$rate = $DB->get_record('local_staffmanager_rates',['year'=>$year,'month'=>$month]);
foreach($graders AS $grader)
{
  // graders details
  $grader = $DB->get_record('user', ['id' => $grader->graderid],'firstname,lastname,id,email');

  // assignemnts graded
  $sql = "SELECT gg.id as gradeid, c.fullname as coursename, u.firstname AS studentfirstname,u.lastname AS studentlastname, gi.itemname AS gradeitemname,
  gi.itemmodule AS modulename, gg.finalgrade AS finalgrade, gg.feedback AS gradefeedback, gg.timemodified AS tmodified
  FROM {grade_grades} AS gg
  JOIN {user} AS u ON u.id = gg.userid
  JOIN {grade_items} AS gi ON gi.id = gg.itemid
  JOIN {course} AS c ON gi.courseid = c.id
  WHERE gg.usermodified = ". $grader->id." AND gg.finalgrade > 0 AND gg.timemodified >= ". $start." AND gg.timemodified <=".$end ;
  $grades = $DB->get_records_sql($sql);
  $totalvalue = 0;
  foreach ($grades as $key => $value)
  {
      $grades[$key]->value = 0;
      if($grades[$key]->modulename == 'assign')
      {
        $grades[$key]->value = $rate->assignmentrate;
      }
      if($grades[$key]->modulename == 'quiz')
      {
        $grades[$key]->value = $rate->quizrate;
      }
    $totalvalue  += $grades[$key]->value;
    $grades[$key]->datetimemodified = date('d-M-Y H:m',$grades[$key]->tmodified);
  }
  $grader->gradescounts = count($grades);
  $grader->totalvalue = $totalvalue;
  $data[] = $grader;
}

$results->data = array_values($data);
$results->month = $month;
$results->year = $year;
}
*/

$mform = new company_form();
$toform = [];
//$mform = new company_form("?id=$id");
$toform = [];
if ($mform->is_cancelled()) {
      redirect("/moodle/local/companyuser/", '', 10);
  }
  elseif ($fromform = $mform->get_data()) {
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
		  $obj->image = $fromform->image;
		  $obj->facebook = $fromform->facebook;
		  $obj->linkedin = $fromform->linkedin;
		  $obj->calendly = $fromform->calendly;
			
          $orgid = $DB->insert_record('local_companyuser_rates', $obj, true, false);
      // redirect to units page with qual id
      redirect("/moodle/local/companyuser/index.php", 'New Company Added', 10,  \core\output\notification::NOTIFY_SUCCESS);
  }
  
  
  
  
echo $OUTPUT->header();
$mform->display();
//echo $OUTPUT->render_from_template('local_staffmanager/searchbar', $obj);
//echo $OUTPUT->render_from_template('local_staffmanager/searchresults', $results);
//echo $OUTPUT->download_dataformat_selector('Download', 'download.php', 'dataformat', array('year' => $year,'month'=>$month));

echo $OUTPUT->footer();
