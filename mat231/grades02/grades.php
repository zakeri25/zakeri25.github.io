<?php

// This file provides script functionality
// Do NOT modify

/////////////////////////////////////////////////////////////////////
// Grades Web Report
// This software is distributed under GPL
// developed by Rasul Shafikov, SUNY @ Stony Brook
// all comments should be sent to shafikov@math.sunysb.edu
////////////////////////////////////////////////////////////////////

$username= $_POST['username'];
$pass= $_POST['pass'];
echo ("<font class=TITLE> $page_title </font>\n");	

if (!empty($username)){      
  include ('csvclass.php');
  include ('settings.php');
  $roster = new CSV ($roster_file);
  if ($roster->state==1) {$not_found="Roster file cannot be found!";}
  if ($roster->state==2) {$not_found="Roster file exists but not readable!";}
  
  //convert to lower case + capitalize
  $username = ucfirst(strtolower (trim($username)));
  //verify the student username and id
  $ret_rows = $roster->seek_col($username, $name_col);
  for ($t=0; $t<sizeof($ret_rows); $t++){
    if ($ret_rows[$t]>-1 && $pass==$roster->get_entry($ret_rows[$t],$id_col)){
      // found right username and pass
      // remember the row number that contains the info
      $row=$ret_rows[$t];
      $worked=1;
    }
  }
  
  //appropriate action
  if ($worked==1){
    echo "<p>Welcome $username! ";
    if ($print_roster_age){
      // print the date when the roster was last modified
      echo "Your current grades as of ";
      $filemod = filemtime ($roster_file);
      $filedate = date("F j Y h:i:s A", $filemod);
      echo "$filedate";
    }
    echo "<p><table border=1 cellpadding=2 cellspacing=2>";
    list($rows,$cols)=$roster->get_size();
    for ($j=0;$j<$cols;$j++){
      $item=$roster->get_entry(0,$j);
      echo "<tr><td><font class=NORMAL>$item </td>";
      $item1=$roster->get_entry($row,$j);
      if ($j==$id_col){
	//use users settings to determine the printing of password
	if ($print_id=="yes"){
	  if ($lastfour=="yes") {
	    {$item1 = "xxx-xx-" . substr($item1, -4);}
	  }
	  echo "<td align=center><font class=SPECIAL> $item1 </font></td>";
	}
	else {echo "<td align=center> *** </td>";}
      }
      else {echo "<td align=center><font class=SPECIAL> $item1 </font></td>";}
      
      //should we print average?
      if ($average_row=="yes"){
	if ($average_row_number=="before last") {
	  $average_row_number=$rows-2;
	}
	if ($average_row_number=="last") {
	  $$average_row_number=$rows-1;
	}
	$item3=$roster->get_entry($average_row_number,$j);
	echo "<td align=center><font class=NORMAL> $item3 </font></td>";
      }
      
      //should we print maximal?
      if ($max_row=="yes"){
	if ($max_row_number=="before last") {
	  $max_row_number=$rows-2;
	}
	if ($max_row_number=="last") {
	  $max_row_number=$rows-1;
	}
	$item4=$roster->get_entry($max_row_number,$j);
	echo "<td align=center><font class=NORMAL> $item4 </font></td>";
      }
      else {echo "</tr>";}
    } 
    echo "</table>";
  }
  
  else { echo "<p><font class=ERROR> $not_found </font></p>";}
}

//print the name/id form (again)
if($worked!=1){
  echo "<form action='$PHP_SELF' method=POST>";
  echo '<p>Please enter the following information to login; if you have a last name like Smith-Jones or O&#8217Brien, please enter it as Smithjones or Obrien.</p>';
  echo "<input type=text name=\"username\" size=12> $username_type <p>";
  echo "<input type=password name=\"pass\" size=12> $password_type <p>";
  echo ' <input type=submit value="submit"> ';
  echo ' <input type=reset value="clear"> ';
  echo ' <input type=hidden name="action" value="grades"></form>';
  if (!empty($instructor_email)){ 
echo '<p>Your course grade is calculated by the formula $$CG=H+0.625(M_1+M_2)+0.6F,$$ where $H \in [0,20]$ is the average homework grade (lowest dropped), $M_1,M_2 \in [0,40]$ are the two midterm grades, and $F \in [0,50]$ is the final exam grade.   
  </p>';
      echo "<hr>";
  echo "<p> $problems";
    echo "<a href=\"mailto:$instructor_email\">$instructor_email</a></p>";
  }
}

?>
