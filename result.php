<?php
include("Auth.php");

$leveldata = explode("/",$_SESSION['data']->matric);
$levelcalc = date("Y")-$leveldata[0];
$level = $levelcalc."00"."  Level";

$results = json_decode($rc->getResult($_SESSION['data']->sn,"results"),true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
    <link rel="stylesheet" href="result.css">
</head>
<body>
    <div id="result">
        <div id="student-info">
            <h3>NAME: <?php echo($_SESSION['data']->fullname); ?> </h3>
            <h3>LEVEL: <?php echo($level); ?></h3>
            <h3>MATRIC NUMBER: <?php echo($_SESSION['data']->matric);?></h3>
            <h3>SEMESTER: <?php echo($_SESSION['data']->semester == 1 ? "First Semester" : "Second Semester");?></h3>
            <h3>SESSION: <?php echo($_SESSION['data']->session);?></h3>
        </div>
        <h2 class="semester">SEMESTER RESULTS</h2>
        <table id="info-table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>COURSE TITLE</th>
                    <th>COURSE CODE</th>
                    <th>COURSE UNIT</th>
                    <th>TEST</th>
                    <th>EXAM</th>
                    <th>TOTAL</th>
                    <th>GRADE POINT</th>
                   <th>GRADE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i=0; $i < count($results); $i++) { 
                    ?>
                    <tr>
                        <td> <?php echo($i+1); ?> </td>
                        <td> <?php echo($results[$i][5]); ?> </td>
                        <td> <?php echo($results[$i][6]); ?> </td>
                        <td> <?php echo($results[$i][7]); ?> </td>
                        <td> <?php echo($results[$i][9]); ?> </td>
                        <td> <?php echo($results[$i][8]); ?> </td>
                        <td> <?php echo($results[$i][9] + $results[$i][8]); ?> </td> 
                        <td> <?php 
            $totalScore = $results[$i][9] + $results[$i][8];
            $gradeData = json_decode($rc->getGrade($totalScore));
            echo $results[$i][7] * $gradeData->grade; 
        ?> </td>
        <td> <?php 
            echo $gradeData->letter; 
        ?> </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

<h2 id="gp">GPA: 
<?php 
$pin_id = $_SESSION['data']->sn;
$gpaData = json_decode($rc->getGPA($_SESSION['data']->semester, $_SESSION['data']->session, $pin_id, "results"), true);
echo round($gpaData['gpa'], 2); // Round to 2 decimal places for readability
?>   
:   CGPA: 
<?php 
        $cgpaData = json_decode($rc->getCGPA($_SESSION['data']->email, "results"), true);
        echo round($cgpaData['cgpa'], 2); // Round to 2 decimal places for readability
    ?>
</h2>
<button type="button" onclick="window.print()";>Print</button>

    
    </div>
</body>
</html>
