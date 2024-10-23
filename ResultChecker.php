<?php
class ResultChecker
{
    public $link;
    public function __construct($dbname, $host = "127.0.0.1", $username = "root", $password = "")
    {
        $this->link = mysqli_connect($host, $username, $password); // we're using $this->link bcoz we've already declared link as public
        $this->createDb($dbname);
        $this->link = mysqli_connect($host, $username, $password, $dbname);
        return $this->link;
    }

    private function createDb($dbname)
    {
        mysqli_query($this->link, "CREATE DATABASE IF NOT EXISTS $dbname");
    }

    public function createTable($sql)
    {
        mysqli_query($this->link, $sql) or die(mysqli_error($this->link));
    }

    // To save data to the database ,,,, for displaying a successful message if the user has been added to the database
    public function postData($sql)
    {
        $query = mysqli_query($this->link, $sql);
        if (mysqli_affected_rows($this->link)) {
            $res = array('message' => "User Record Successfully Added");
            return (json_encode($res));
        } else {
            $res = array('message' => "Server Busy");
            return (json_encode($res));
        }
    }

    // To verify record in the database(ensuring that it's 1 user = 1 email&username)
    public function verifyRecord($username, $email, $table)
    {
        $sql = "SELECT * FROM $table WHERE (email='$email' OR username='$username')";
        $query = mysqli_query($this->link, $sql);
        $data = mysqli_fetch_array($query);

        if ($data) {
            $res = array('message' => "User Record Exists, try another email or username");
            return json_encode($res);
        } else {
            return null;
        }
    }

    // After registering
    public function login($usernameOrEmail, $password, $table)
    {
        $encr_pword = sha1($password);
        $sql = "SELECT * FROM $table WHERE (email='$usernameOrEmail' OR username='$usernameOrEmail') AND password='$encr_pword'";
        $query = mysqli_query($this->link, $sql);
        $data = mysqli_fetch_array($query);

        if ($data) {
            $res = array('message' => "Login Successful");
            return json_encode($res);
        } else {
            $res = array('message' => "Invalid Username/Email or Password");
            return json_encode($res);
        }
    }

    // to check result
    public function checkResult($pin, $table)
    {
        $sql = "SELECT * FROM $table WHERE pin = '$pin'";
        $query = mysqli_query($this->link, $sql);
        $data = mysqli_fetch_array($query);

        if (!empty($data)) {
            $res = array('data' => $data);
            return json_encode($res);
        } else {
            return null;
        }
    }

    // to get result
    public function getResult($pin_id, $table)
    {
        $sql = "SELECT * FROM $table WHERE pin_id = '$pin_id'";
        $query = mysqli_query($this->link, $sql);
        $result = array();

        while ($row = mysqli_fetch_array($query)) {
            array_push($result, $row);
        }

        if (!empty($result)) {
            return json_encode($result);
        } else {
            return null;
        }
    }



    // to get grade
    public function getGrade($score)
    {
        $grade = 0;
        $gradeLetter = "F";
        if ($score >= 70) {
            $grade = 5;
            $gradeLetter = "A";
        } else if ($score >= 60) {
            $grade = 4;
            $gradeLetter = "B";
        } else if ($score >= 50) {
            $grade = 3;
            $gradeLetter = "C";
        } else if ($score >= 45) {
            $grade = 2;
            $gradeLetter = "D";
        } else if ($score >= 40) {
            $grade = 1;
            $gradeLetter = "E";
        }

        return json_encode(array('grade' => $grade, 'letter' => $gradeLetter));
    }

    // to calculate semester gpa
    public function getGPA($semester, $session, $pin_id, $table)
    {
        // Fetch total units for the semester
        $sql = "SELECT SUM(unit) as total_units FROM $table WHERE semester = '$semester' and session = '$session' and pin_id = '$pin_id'";
        $query = mysqli_query($this->link, $sql);
        $unitData = mysqli_fetch_assoc($query);
        $totalUnits = $unitData['total_units'];

        // Fetch results for the semester
        $results = json_decode($this->getResult($pin_id, $table), true);
        $totalgp = 0;

        foreach ($results as $result) {
            if ($result['semester'] == $semester && $result['session'] == $session) {
                $totalScore = $result[8] + $result[9]; // Assuming these indexes correctly represent scores
                $gradeData = json_decode($this->getGrade($totalScore));
                $totalgp += $result[7] * $gradeData->grade; // Assuming $result[7] is the unit
            }
        }
        $gpa = $totalgp / $totalUnits;
        return json_encode(array('gpa' => $gpa, 'total_units' => $totalUnits, 'total_gp' => $totalgp));
    }

    // to calculate cummulative gpa (CGPA)
    public function getCGPA($email, $table)
    {
        // Fetch all results for the student by email
        $sql = "SELECT * FROM $table WHERE email = '$email'";
        $query = mysqli_query($this->link, $sql);
        $results = array();
        while ($row = mysqli_fetch_array($query)) {
            array_push($results, $row);
        }

        $totalUnits = 0;
        $totalgp = 0;

        foreach ($results as $result) {
            $totalScore = $result[8] + $result[9]; // Assuming these indexes correctly represent scores
            $gradeData = json_decode($this->getGrade($totalScore));
            $totalUnits += $result[7]; // Assuming $result[7] is the unit
            $totalgp += $result[7] * $gradeData->grade; // Grade points calculation
        }
        $cgpa = $totalgp / $totalUnits;

        return json_encode(array('cgpa' => $cgpa, 'total_units' => $totalUnits, 'total_gp' => $totalgp));
    }
}
