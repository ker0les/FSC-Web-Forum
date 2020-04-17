<?php 
require('pdocon.php');

$db = new Pdocon;

$eventNewCount = $_POST['eventNewCount'];
$event_Type = $_POST['event_Type'];
$fulldate = $_POST['fulldate'];

$db->query('SELECT * FROM events');
$row = $db->fetchMultiple();
if ($row) {
    // output data of each row
    if ($event_Type == "all") {
        $db->query('SELECT * FROM events LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "FSC") {
        $event_Type = 'FSC';
        $db->query('SELECT * FROM events WHERE event_Type =:FSC LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':FSC', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    }   else if (isset($_GET['search'])) {
		$searchItem = $_GET['searchItem'];
        
        // Selects everything from the database that is similar to what the user entered:
        $db->query('SELECT * FROM `events` WHERE `event_Title` LIKE :searchItem OR event_Type LIKE :searchItem OR description LIKE :searchItem OR date LIKE :searchItem OR time LIKE :searchItem OR location LIKE :searchItem');

        // If the user enters a date, it formats it accordingly. Ex. If they enter 4/2 instead of 4/2/2020, it will still fetch the results.
       if(date('n/j/y', strtotime($searchItem)) == ($searchItem) OR date('n/j/Y', strtotime($searchItem)) == ($searchItem) OR date('n/j', strtotime($searchItem)) == ($searchItem)  OR date('n/d', strtotime($searchItem)) == ($searchItem) OR date('m/j', strtotime($searchItem)) == ($searchItem) OR date('m/d', strtotime($searchItem)) == ($searchItem)) 
        {
           // Converts dates the user entered into a format the DB can read:
           $dbFormat = date('Y-m-d', strtotime($searchItem));
           
            $db->query('SELECT * FROM `events` WHERE `date` LIKE :dbFormat');
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $row = $db->fetchMultiple();
        } 
      
        // If user enters a time with AM or PM, searches the database:
        else if (date('g:iA', strtotime($searchItem)) == ($searchItem) OR date('g:ia', strtotime($searchItem)) == ($searchItem))
       {
            $dbFormat = date('H:i:s', strtotime($searchItem));
            $db->query('SELECT * FROM `events` WHERE `time` LIKE :dbFormat');
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $row = $db->fetchMultiple();
        }  
        
        // If the user enters a time without the AM or PM:
        else if (date('g:i', strtotime($searchItem)) == ($searchItem))
       {
            // Converts the time to the format the database can read:
            $hour = (int)date('H', strtotime($searchItem));
            $minute = (int)date('i', strtotime($searchItem));
            if ($hour < 10 AND $minute > "00")
            {
                $format = $hour + 12 . ":" . $minute . ":00";
            } else if ($hour < 10) {
                 $format = $hour + 12 . ":00" . ":00";
            } else if ($minute > "00") {
                $format = $hour . ":" . $minute . ":00";
            } else {
                 $format = $hour . ":00" . ":00";
            }
            
            $dbFormat = date($format, strtotime($searchItem));
            $db->query('SELECT * FROM `events` WHERE `time` LIKE :dbFormat');
            $db->bindValue(':dbFormat', $dbFormat, PDO::PARAM_STR);
            $row = $db->fetchMultiple();
       }
        // If the user doesn't enter a date or time, searches for everything else:
        else {
        $searchItem = "%".$searchItem."%";
        $db->bindValue(':searchItem', $searchItem, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
       }
	}
    else if ($event_Type == "Clubs") {
        $event_Type = 'Club';
        $db->query('SELECT * FROM events WHERE event_Type =:club LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':club', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Athletics") {
        $event_Type = 'Athletics';
        $db->query('SELECT * FROM events WHERE event_Type =:athletics LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':athletics', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Tutoring") {
        $event_Type = 'Tutoring';
        $db->query('SELECT * FROM events WHERE event_Type =:tutoring LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':tutoring', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Academics") {
        $event_Type = 'Academics';
        $db->query('SELECT * FROM events WHERE event_Type =:academics LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':academics', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "Admissions") {
        $event_Type = 'Admissions';
        $db->query('SELECT * FROM events WHERE event_Type =:admissions LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $db->bindValue(':admissions', $event_Type, PDO::PARAM_STR);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "newest") {
        $db->query('SELECT * FROM events WHERE date <=:fulldate ORDER BY date DESC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "oldest") {
        $db->query('SELECT * FROM events WHERE date <=:fulldate ORDER BY date ASC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "upcoming") {
        $db->query('SELECT * FROM events WHERE date >=:fulldate ORDER BY date ASC LIMIT :eventCount');
        $db->bindValue(':fulldate', $fulldate, PDO::PARAM_STR);
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "time") {
        $db->query('SELECT * FROM events ORDER BY time LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    } else if ($event_Type == "location") {
        $db->query('SELECT * FROM events ORDER BY location LIMIT :eventCount');
        $db->bindValue(':eventCount', $eventNewCount, PDO::PARAM_INT);
        $row = $db->fetchMultiple();
    }
     foreach($row as $event)
    {
        $time = $event["time"];
        $date = $event["date"];
    
        echo "<tr><td>" . $event["event_Title"] . "</td><td>" . $event["event_Type"] . "</td><td>" . $event["description"]. "</td><td>" . $event["location"]. "</td><td>" .  date('n/j/y', strtotime($date)) . "</td><td>" . date('g:iA', strtotime($time)); 
       
    // If an event row has a capacity, then allow them to sign up:
    if ($event["capacity"])
    {
    ?>  <div class="form-group"><button type="submit" action="see_events.php" name="signup" class="btn btn-link"><a href="includes/event_registry.php?event_id=<?php echo $event["event_Id"] ?>"/>Register</button>
     
     <button type="submit" action="see_events.php" name="comment" class="btn btn-link"><a href="comments.php?event_id=<?php echo $event["event_Id"] ?>"/>Leave a Comment</button><?php 
      }; 
       
       echo "</td></tr>";
    }
 
}
?>