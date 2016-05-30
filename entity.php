<?php

include 'Database_Enquiry.php';
class Submission 
{
	/*
	private $remedyName = null;
	private $submitterEmail = null;
	private $submission_id = null;
	private $diseaseName = null;
	private $category = null;
	private $description = null;
	private $noOfVote = null;
	private $submissionDate = null;

	function __construct(){

	}

   
	function anotherConstructor($remedy, $disease, $descript, $cat,
						 $date, $email)
	{
		$this->remedyName = $remedy;
		$this->diseaseName = $disease;
		$this->description = $descript;
		$this->category = $cat;
		$this->submissionDate = $date ;
		$this->submitterEmail = $email;
	}//end constructor   */

   function addSubmitted($remedyName, $diseaseName, $description, $category, $submissionDate, $submitterEmail){
   	 $sqlquery = "INSERT INTO submit ('submitterEmail', 'diseaseName', 'remedyName', 'description', 'catagory', 'time') 
   	 			  VALUES ($submitterEmail, $diseaseName, $remedyName, $description, $category, $date)";
   	 $isinserted = mysqli_query($conn, $sqlquery);

   	return $isinserted;
   }//end addsubmitted   returns boolean

   function getSubmission(){
   	$sqlquery = "SELECT * FROM list WHERE diseaseName = $diseaseName or remedyName = $remedyName";
   	$result = mysqli_query($conn, $sqlquery);

   	$returnedRemedies = array();
   	if (mysqli_num_rows($result) > 0) {
   		$i = 0;
   		while ($row = mysqli_fetch_assoc($result)) {
   			$returnedRemedies[$i] =  array($row[submitterEmail], $row[diseaseName], $row[remedyName],
   			 								$row[description], $row[category], $row[time]);
   			$i ++;
   		};
   	    return $returnedRemedies;
   	} else{
   		echo "Oops we couldnt retrive the remedies please try again!";
   	}

   }// end getSubmission  returns string[][]


   function getVoteNumber($submission_id){
   	$sqlquery = "SELECT numberOfVotes 
   				 FROM list
   				 WHERE submission_id = $submission_id";
   	$result = mysqli_query($conn, $sqlquery);

   	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	    	return $row['numberOfVotes'];
	    }
	} else {
	    return 0;   // returns number of vote 0
	}


   } // end getVote()   returns integer

   function changeVoteNumber($submission_id){
   	//get the value of the vote to incremant
   	$incremented = getVoteNumber($submission_id) + 1;
   	$sqlquery = "UPDATE list
   				 SET numberOfVotes = $incremented
   				 WHERE submission_id = $submission_id";

   	$isUpdated = mysqli_query($conn, $sqlquery);
   	if($isUpdated) {
   		return $incremented;
   	} else {
   		echo "Oops we couldnt register your vote please try again!";
   	}
   
   } // end changeVoteNumber()    returns integer


} // end submission class
?>