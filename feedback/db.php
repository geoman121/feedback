<?php
	
		$message =$_POST['message'];
	    $ques1 = $_POST['radio'];	   
	    $ques2 = $_POST['radio2'];	  
	    $ques3 = $_POST['radio3'];   
	    $ques4 = $_POST['radio4'];	   	

	    $slider1 = $_POST['hid_quest1'];
	    $slider2 = $_POST['hid_quest2'];
	    $slider3 = $_POST['hid_quest3'];
	    $slider4 = $_POST['hid_quest4']; 


//Getting rating values

       $rate_one_value = ratingAnswers($slider1);
       $rate_two_value = ratingAnswers($slider2);
       $rate_three_value = ratingAnswers($slider3);
       $rate_four_value = ratingAnswers($slider4);

function ratingAnswers($qavalue)
{

      if($qavalue=="")
      { 
      $rate_value=3;  
       }
       else
       {
      $rate_value=getratevalue($qavalue);
       }

       return $rate_value;

}


function getratevalue($rdvalue)
{ 
  $rate;
    if($rdvalue<=20)
      $rate=1;
    else if ($rdvalue<=40)
      $rate=2;
    else if ($rdvalue<=60)
      $rate=3;
    else if ($rdvalue<=80)
      $rate=4;
    else if ($rdvalue<=100)
      $rate=5;


  
  return $rate;

}

// getting answers for the questions

	    $answer_one=$_POST["radio"];  
	$answer_one_string=getratestring($answer_one);

	$answer_two=$_POST["radio2"];  
	$answer_two_string=getratestring($answer_two);

	 $answer_three=$_POST["radio3"];  
	$answer_three_string=getratestring($answer_three);

	$answer_four=$_POST["radio4"];  
	$answer_four_string=getratestring($answer_four);




	function getratestring($rdvalue)
{
    $emoticon_string="";
	switch($rdvalue)
	{
        case 1 :
        $emoticon_string="Strongly_Agree";
        break;

        case 2 :
        $emoticon_string="Agree";
        break;

        case 3 :
        $emoticon_string="Neutral";
        break;

        case 4 :
        $emoticon_string="Disagree";
        break;

        case 5 :
        $emoticon_string="Strongly_Disagree";
        break;


	}

	return $emoticon_string;

}



// connection to mysql database.


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO result (Question_1, Question_1_Rating, Question_2, Question_2_Rating, Question_3, Question_3_Rating, Question_4, Question_4_Rating, Comments) VALUES ('$answer_one_string', '$rate_one_value','$answer_two_string', '$rate_two_value','$answer_three_string', '$rate_three_value','$answer_four_string', '$rate_four_value','$message')";

if ($conn->query($sql) === TRUE) {
	echo '<body style="background-color:black">';
    echo '<span style="color:#ffffff; font-size: 50px; ">Thank You for your feedback..!</span>';;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

