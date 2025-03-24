
<?php

// This files contains customization variables
// Modify!

/////////////////////////////////////////////////////////////////////
// Grades Web Report
// This software is distributed under GPL
// developed by Rasul Shafikov, SUNY @ Stony Brook
// all comments should be sent to shafikov@math.sunysb.edu
////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////
// The following variables MUST be modified for the program to work

// This should be absolute path to the file containing the grades.
// Make sure that this file is world readable. For security reasons
// it is a good idea to keep this file off your web accessible
// subdirectory (i.e. not in your www directory).
$roster_file="/home/zakeri/rosters/231-02f24.csv";

// Which column in $roster_file contains loginn names (username or last name)?
// Note that the first column has the ordinal 0, the second column has the
// ordinal 1, etc. The other variable describes what should be typed.
$name_col=1; 
$username_type="Last Name";

// Which column in $roster_file contains passwords (student id number or 
// social security number)?
// Note that the first column has the ordinal 0, the second column has 
// ordinal 1, etc. The other variable describes what should be typed.
$id_col=0;
$password_type="Last 4 digits of your CUNYfirst ID";

// Does the roster contain the "AVERAGE" row? (choose "yes" or "no")
$average_row="yes";
// If the answer to the previous question is "yes", what is that row?
// Choose either the actual row number, or "last", or "before last".
$average_row_number="37";

// Does the roster contain the "MAXIMAL" row? (choose "yes" or "no")
$max_row="yes";

// If the answer to the previous question is "yes", what is that row?
// Choose either the actual row number, or "last", or "before last".
$max_row_number="38";


/////////////////////////////////////////////////////////////////
// All other variables provide optional customization

// Name of your class, e.g. "MAT 101"
$class_name="MATH 231";

// Title of the page
$page_title="Welcome to $class_name grade server";

// Message that will be displayed if authorization failed
$not_found="<p>Sorry, but your name cannot be found in the roster,
or last name doesn't match student id. Retry?</p>";

// Choose "no" if you don't want to provide the time when the 
// roster was last modified (if "yes", this will be the date
// the $roster_file is last modified)
$print_roster_age="yes";

// This variable controls whether the password should be printed together 
// with the grades, either "yes" or "no"
$print_id="no";

// This  variable controls whether only the last for digits/letters should be
// printed of the password (e.g. if the password is the social security number).
// Choose either "yes" or "no". If $print_id="no", then this variable has no effect
$lastfour="yes";

// your e-mail address to report problems 
$instructor_email="saeed.zakeri@qc.cuny.edu";

//this could go at the end of the page
$problems="If you are having a problem using this grade server, please send an e-mail to ";
?>







