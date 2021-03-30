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
 * Rates form
 *
 * @package    local_staffmanager
 * @copyright  2020 Ricoshae Pty Ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class company_form extends moodleform
{
    //Add elements to form
    public function definition()
    {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('html', '<strong>Sign Up</strong><br><br>');
		$mform->addElement('html', '<p>Gain access to our database of pre-screened HVAC </br> technicians - all of them looking for work</p>');

		/*
		$mform->addElement('html', '<div class="row"><div class="form-group col-md-6"><label for="inputEmail4">First Name</label>
         <input type="text" class="form-control" id="firstname" name="firstname" required >');
		$mform->addElement('html', '</div><div class="form-group col-md-6"><label for="inputEmail4">Last Name</label>
         <input type="text" class="form-control" id="lastname" name="lastname" required >');
		$mform->addElement('html', '</div></div>');
		*/
		
		$options = array(
        'Residential' => 'Residential',
        'Commercial' => 'Commercial',
        'Residential&Commercial' => 'Residential & Commercial',
        );
		
		$country = array(
        'Alabama' => 'Alabama',
        'Alaska' => 'Alaska',
        'Arizona' => 'Arizona',
		'Arkansas' => 'Arkansas',
        'California' => 'California',
        'Colorado' => 'Colorado',
		'Connecticut' => 'Connecticut',
        'Delaware' => 'Delaware',
        'Florida' => 'Florida',
		'Georgia' => 'Georgia',
        'Hawaii' => 'Hawaii',
        'Idaho' => 'Idaho',
		'Illinois' => 'Illinois',
        'Indiana' => 'Indiana',
        'Iowa' => 'Iowa',
		'Kansas' => 'Kansas',
        'Kentucky' => 'Kentucky',
        'Louisiana' => 'Louisiana',
		'Maine' => 'Maine',
        'Maryland' => 'Maryland',
        'Massachusetts' => 'Massachusetts',
		'Michigan' => 'Michigan',
		'Minnesota' => 'Minnesota',
        'Mississippi' => 'Mississippi',
        'Missouri' => 'Missouri',
		'Montana' => 'Montana',
		'Nebraska' => 'Nebraska',
        'Nevada' => 'Nevada',
        'New Hampshire' => 'New Hampshire',
		'New Jersey' => 'New Jersey',
		'New Mexico' => 'New Mexico',
        'New York' => 'New York',
        'North Carolina' => 'North Carolina',
		'North Dakota' => 'North Dakota',
		'Ohio' => 'Ohio',
        'Oklahoma' => 'Oklahoma',
        'Oregon' => 'Oregon',
		'Pennsylvania' => 'Pennsylvania',
		'Rhode Island' => 'Rhode Island',
        'South Carolina' => 'South Carolina',
        'South Dakota' => 'South Dakota',
		'Tennessee' => 'Tennessee',
        'Texas' => 'Texas',
        'Utah' => 'Utah',
		'Vermont' => 'Vermont',
        'Virginia' => 'Virginia',
		'Washington' => 'Washington',
        'West Virginia' => 'West Virginia',
		'Wisconsin' => 'Wisconsin',
        'Wyoming' => 'Wyoming',
        );
		
		$total = array(
        '0-10' => '0-10',
        '10-50' => '10-50',
        '50-100' => '50-100',
		'200+' => '200+',
        );
		
		$expectedtotal = array(
        '0-5' => '0-5',
        '5-10' => '5-10',
        '10-25' => '10-25',
		'25-50' => '25-50',
		'50+' => '50+',
        );

		$mform->addElement('text', 'firstname', 'First Name' , ' size="100%" '); // Add elements to your form
        $mform->setType('firstname', PARAM_TEXT);                   //Set type of element
		$mform->addRule('firstname', 'First Name is required', 'required', null, 'client');
        $mform->setDefault('firstname', '');        //Default value
		
        $mform->addElement('text', 'lastname', 'Last Name' , ' size="100%" '); // Add elements to your form
        $mform->setType('lastname', PARAM_TEXT);                   //Set type of element
		$mform->addRule('lastname', 'Last Name is required', 'required', null, 'client');
        $mform->setDefault('lastname', '');        //Default value
		
		
        $mform->addElement('text', 'email', 'Email', ' size="100%" '); // Add elements to your form
        $mform->setType('email', PARAM_TEXT); 
	    $mform->addRule('email', 'Email is required', 'required', null, 'client');		//Set type of element
        $mform->setDefault('email', '');        //Default value
		
		$mform->addElement('passwordunmask', 'password1', 'Password', ' size="100%" '); // Add elements to your form
        $mform->setType('password1', PARAM_TEXT);                   //Set type of element
		$mform->addRule('password1', 'Password is required', 'required', null, 'client');
        $mform->setDefault('password1', '');        //Default value
		
		$mform->addElement('text', 'contact', 'Phone Number', ' size="100%" '); // Add elements to your form
        $mform->setType('contact', PARAM_TEXT);                   //Set type of element
		$mform->addRule('contact', 'Contact is required', 'required', null, 'client');
        $mform->setDefault('contact', '');        //Default value
		
		$mform->addElement('text', 'companyname', 'Company Name', ' size="100%" '); // Add elements to your form
        $mform->setType('companyname', PARAM_TEXT);                   //Set type of element
		$mform->addRule('companyname', 'Company Name is required', 'required', null, 'client');
        $mform->setDefault('companyname', '');        //Default value
		
		$mform->addElement('select', 'state', 'State', $country); // Add elements to your form
        $mform->setType('state', PARAM_TEXT);                   //Set type of element
		$mform->addRule('state', 'State is required', 'required', null, 'client');
        $mform->setDefault('state', 'Active');        //Default value
		
		$mform->addElement('text', 'city', 'City', ' size="100%" '); // Add elements to your form
        $mform->setType('city', PARAM_TEXT);                   //Set type of element
		$mform->addRule('city', 'City is required', 'required', null, 'client');
        $mform->setDefault('city', '');        //Default value
		
		$mform->addElement('select', 'industry', 'Industry' , $options); // Add elements to your form
        $mform->setType('industry', PARAM_TEXT);                   //Set type of element
		$mform->addRule('industry', 'Country is required', 'required', null, 'client');
        $mform->setDefault('industry', 'Active');        //Default value
		
		$mform->addElement('html', '<strong>Company Profile - </strong>Complete to be seen by 30% more technicians <br><br>');
		
		$mform->addElement('select', 'position', '# number of technician employed' , $total); // Add elements to your form
        $mform->setType('position', PARAM_TEXT);                   //Set type of element
        $mform->setDefault('position', 'Active');        //Default value
		
		$mform->addElement('select', 'willhire', '# of technician to hire in the next 90 days' , $expectedtotal); // Add elements to your form
        $mform->setType('willhire', PARAM_TEXT);                   //Set type of element
        $mform->setDefault('willhire', 'Active');        //Default value
		
		$mform->addElement('textarea', 'description', 'Company Description' , ' size="100%" '); // Add elements to your form
        $mform->setType('description', PARAM_TEXT);                   //Set type of element
        $mform->setDefault('description', '');        //Default value
		
		$mform->addElement('filemanager', 'image', 'Company Logo');
		
		$mform->addElement('text', 'facebook', 'Link to company facebook', ' size="100%" '); // Add elements to your form
        $mform->setType('facebook', PARAM_TEXT);                   //Set type of element
        $mform->setDefault('facebook', '');        //Default value
		
		$mform->addElement('text', 'linkedin', 'Link to company linkedin', ' size="100%" '); // Add elements to your form
        $mform->setType('linkedin', PARAM_TEXT);                   //Set type of element
        $mform->setDefault('linkedin', '');        //Default value
		
		$mform->addElement('text', 'calendly', 'Link to your Calendly interview event', ' size="100%" '); // Add elements to your form
        $mform->setType('calendly', PARAM_TEXT);                   //Set type of element
        $mform->setDefault('calendly', '');        //Default value
		

        $buttonarray=array();
        $buttonarray[] = $mform->createElement('submit', 'Submit', 'Save');
        $buttonarray[] = $mform->createElement('cancel');
        $mform->addgroup($buttonarray, 'buttonar', '', ' ', false);

    }
    //Custom validation should be added here
    public function validation($data, $files)
    {
		global $CFG, $DB;
/*
        $errors = parent::validation($data, $files);


        if ( !is_numeric ($data['contact'])) {
            $errors['contact']= 'should only be numbers';
        }

        return $errors;
		*/
    }
}
