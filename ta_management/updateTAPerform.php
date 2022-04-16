<?php
    error_reporting(E_ALL); 
    ini_set('display_errors', 'On');
       
    //connect to database
    $db = new SQLite3("../STARboard.db", SQLITE3_OPEN_READWRITE);
    //Define feilds from post
    $TA_name = $_POST['TA_name'];
    $course_num = $_POST['course_num'];
    $prof_name = $_POST['prof_name'];
    $term_month_year = $_POST['term_month_year'];
    //Sanitize user inputer for security
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);
   
    // store message in 'messages' table
    $statement = 'INSERT INTO "TAPerformance" ("term_month_year", "course_num", "TA_name", "comment", "prof_name")
    VALUES (:term_month_year, :course_num, :TA_name, :comment, :prof_name)';
    
    $query = $db->prepare($statement);
    
    $query->bindValue(':TA_name', $TA_name);
    $query->bindValue(':term_month_year', $term_month_year);
    $query->bindValue(':course_num', $course_num);
    $query->bindValue(':comment', $comment);
    $query->bindValue(':prof_name', $prof_name);

    $query->execute();
    $db->close();
?>