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
        global $DB;
		$COMPANY_UPLOAD = 'assets/';
		require_once '../../config.php';
		
		if($_FILES["image"]["name"]!="") 
							{
								$dot = strpos($_FILES["image"]["name"],".");
								$fname = substr($_FILES["image"]["name"],0,$dot);
								$ext = substr($_FILES["image"]["name"],$dot);
				
								$image = $fname.date("d-m-Y-h-i-s").$ext;
					
								if (file_exists($COMPANY_UPLOAD . $image)) 
								{
									$msg =  $image . " already exists. ";
								} 
								else 
								{
									
									move_uploaded_file($_FILES["image"]["tmp_name"], $COMPANY_UPLOAD.$image);
									chmod($COMPANY_UPLOAD. $image, 0766);
                                }
							}
        
        $record = new \stdClass();
        $record->firstname = $_POST['firstname'];
        $record->lastname   = $_POST['lastname'];
		$record->email   = $_POST['email'];
		$record->password = $_POST['password'];
        $record->contact   = $_POST['contact'];
		$record->companyname   = $_POST['companyname'];
		$record->state = $_POST['state'];
        $record->city   = $_POST['city'];
		$record->industry   = $_POST['industry'];
		$record->hiring = $_POST['position'];
        $record->totalhiring   = $_POST['willhire'];
		$record->description   = $_POST['description'];
		$record->image   = $image;
		$record->facebook = $_POST['facebook'];
        $record->linkedin   = $_POST['linkedin'];
		$record->calendly   = $_POST['calendly'];
		
        $orgid = $DB->insert_record('local_companyuser_rates', $record, true, false);
        redirect("/moodle/local/companyuser/index.php", 'New Company Added', 10,  \core\output\notification::NOTIFY_SUCCESS);
