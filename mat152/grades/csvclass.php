<?php
// This file provides the class to handle csv files
// Not all functions are currently implemented
// Do NOT modify

/////////////////////////////////////////////////////////////////////
// Grades Web Report
// This software is distributed under GPL
// developped by Rasul Shafikov, SUNY @ Stony Brook
// all comments should be sent to shafikov@math.sunysb.edu
////////////////////////////////////////////////////////////////////

class CSV {

  var $path; // path to the file
  var $fp; // pointer to the current file
  var $delim; // delimiter of the csv file
  var $mode; // mode of the file opened
  var $state; // 0=OK, 1=file doesn't exist, 2=file is not world readable

  function CSV ($file, $delimiter=',', $mode='r') {
    $this->state=0;
    if (! file_exists ($file)) {$this->state=1;}
    if ($this->state!=1){
      if (!( fileperms($file) & 4) || (($gid == "users") && ($perms & 32))) {
	$this->state=2;
      }
    }
    if ($this->state==0){
      $this->path = $file;
      $this->mode = $mode;
      $this->fp = fopen ($this->path, $this->mode);
      $this->delim = $delimiter;
    }
  }

// this function returns the entry at a given place
  function get_entry($r,$c) {
    $fp = fopen ($this->path,'r');
    for ($i=0;$i<$r;$i++){
        fgetcsv ($fp, 1000, $this->delim);
    }
    $data = fgetcsv ($fp, 10000, $this->delim);
    fclose ($fp);
    return $data[$c];

  }

// returns the current line as an array
// pointer is then moved to the next line
  function next_line() {
    return fgetcsv ($this->fp, 10000, $this->delim);
  }

// this function should append the line at end of file
  function append_line($data){
  }

// this function resets file pointer to beginning of file
  function reopen() {
    fclose ($this->fp);
    $this->fp = fopen ($this->path, $this->mode);
  }

// this function returns the size of the csv file
// that is number of rows and columns
  function get_size() {
    error_reporting(0);
    $fp = fopen ($this->path,'r');
    $rows=0;
    while ($data=fgetcsv ($fp, 1000, $this->delim)){
	$rows++;
	if ($rows==1){$cols=sizeof($data);}
    }
    fclose ($fp);
    return array ($rows,$cols);  
    error_reporting(1);
  }
  
// this function seeks certain column for particular value
// returns the list of row numbers if found, otherwise return -1
  function seek_col($value, $col){
    $i=0;
    list ($r, $c) = $this->get_size();
    if ($col>$c || $col<0) {return $retval;}
    for ($j=0;$j<$r;$j++){
      if ($value == $this->get_entry($j,$col)){
	$retval[$i++] = $j;
      }
    }
    // nothing found
    return $retval;
  }

}//class CSV  
?>
