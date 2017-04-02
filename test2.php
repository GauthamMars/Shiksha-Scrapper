<?php
	$servername = "localhost";
$username = "gauthamm2015";
$password = "3vXt73bGW7mEcGnI";
$dbname = "shikshaScrape1";
$sql1="DROP DATABASE shikshaScrape1";
$sql = "CREATE DATABASE shikshaScrape1";
$conn = new mysqli($servername, $username, $password);
$conn->query($sql1);
$conn->query($sql);
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "CREATE TABLE ScrapeDat (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
city VARCHAR(30) NOT NULL,
name VARCHAR(100) NOT NULL,
location VARCHAR(50),
reviews VARCHAR(6),
facilities VARCHAR(10000)
)";

if ($conn->query($sql) === TRUE)
{
    //echo "Table ScrapeDat created successfully";
}
else
{
    echo "Error creating table: " . $conn->error;
}
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
  if (empty($_GET["url"])) 
  {
    $nameErr = "url is required";
  }
  else
  {
		//echo "hai";
	    $url = $_GET["url"];
		ini_set('max_execution_time', 5000);
		$pag[1]=0;
										//$url='http://engineering.shiksha.com/be-btech-courses-in-chennai-1-ctpg';
		do{
										//from url extract city
			preg_match('/-colleges-(.+)-[0-9]/',$url,$city);
			//echo $city[1]."<br>";
			$pag[1]=$pag[1]+1;
										//echo $pag[1];
										//start from first page
			$url =preg_replace('\'[0-9]+\'', $pag[1], $url);
			$wet = file_get_contents($url);
			$tit=$wet;
         	$wet=preg_replace('/\n/',' ',$wet);
			preg_match_all('/div class="clg-tpl" id=\'instituteContainer(.+?)<\/div> <input /', $wet, $matches);
			//echo "hello";
		//	echo $matches[1];
			foreach ($matches[1] as $match)
			{
		
	        preg_match('/<h2 class="tuple-clg-heading"><a (.+?)target="_blank">(.+?)<p>\|(.+?)<\/p>/',$match,$cname);
		    //echo $cname[2]."<br>";
		    if(preg_match('/\'/',$cname[2]))
		    $cname[2]=preg_replace('/\'/',' ', $cname[2]);
			//echo $cname[3]."<br>";
			preg_match_all('/<div class="srpHoverCntnt2"> <h3>(.+?)<\/h3>/',$match,$facility);
			$stringfacility = implode(' ', $facility[1]);
			//echo $stringfacility.'<br>';
			if(preg_match('/<b>([0-9]+?)<\/b>/',$match,$review))
			{
				
			}
			else
			{
				$review="NULL";
			}
			//echo "review".$review[1];
			$sql = "INSERT INTO ScrapeDat (city, name, location,reviews,facilities)
		VALUES ('$city[1]',
		'$cname[2]',
		'$cname[3]',
		'$review[1]',
		'$stringfacility')";
		if ($conn->query($sql) === TRUE)
				{
					//echo "New record created successfully";	
				}
			else
				{
					echo "Error: " . $sql . "<br>" . $conn->error;
				}	
			
			
		}	
		
		//preg_match('/([0-9]+)/', $url, $pag);
		//preg_match('/<span><b>([0-9]+)<\/b><a target="_blank" type="reviews" /', $url, $pag);
        $tit=preg_match('/next linkpagination/',$wet);
        //echo '<br><br>'.$tit;
        sleep(5);
		}while($tit);
  }
}
		header("Content-type: application/json");
print(json_encode($tit, JSON_PRETTY_PRINT));

?>