<!--
Carlos Munoz
final
INFO_1335_4A
Rosas
5-26-2021
-->
<?php
require('database.php');

//Get the assignments info from the database
$qry = 'SELECT name, description, pt_possible, pt_earn
        FROM class c
        JOIN assignment a ON a.class_id = c.class_id';
$stmt1 = $db->prepare($qry);
$stmt1->execute();
$assignments = $stmt1->fetchAll();
$stmt1->closeCursor();

//Get the classes names and ids from the database
$qry2 = 'SELECT name, class_id
        FROM class';
$stmt2 = $db->prepare($qry2);
$stmt2->execute();
$classes = $stmt2->fetchAll();
$stmt2->closeCursor();
?>

<!DOCTYPE html>
<head>
    <title>Grades Report</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<main>
    <h1>Grades Report</h1>
    <!-- Create a table for each class in the database--->
    <?php foreach($classes as $class): ?>
    <!-- Show the name of the class -->
    <h2><?php echo $class['name']?></h2>
	<table>
        <tr>
            <th class="column" >Assignment</th>
            <th class="column" >Points Earned</th>
            <th class="column" >Points Possible</th>
            <th class="column" >Grade</th>    
        </tr>
        <!-- Get all the assignments from the database with the same class name -->
        <?php foreach($assignments as $assignment): ?>

        <?php if($assignment['name'] == $class['name']):?> 

        <!-- Calculate the grade for each assignment of the same class -->    
        <?php 
        $pt_possible = $assignment['pt_possible'];
        $pt_earn = $assignment['pt_earn'];
        $grade = $pt_earn / $pt_possible * 100;
        $grade_f = number_format($grade, 2).'%';
        ?>
        <!-- Fill the table with the details and calculated grade for each assignment -->
        <tr>
            <td class="column"><?php echo $assignment['description']; ?></td>
            <td class="column"><?php echo $assignment['pt_earn']; ?></td>
            <td class="column"><?php echo $assignment['pt_possible']; ?></td>
            <td class="column"><?php echo $grade_f; ?></td>
           
        </tr>
        
        <?php endif; ?>

        <?php endforeach; ?>

        <?php
        //Get the points earned and possible points for each class into an array 
        $pt_earn_array = array();
        $pt_possible_array =array();

        foreach($assignments as $assignment){
            if($assignment['name'] == $class['name']) {
                $pt_earn_array[] = $assignment['pt_earn'];
                $pt_possible_array[] = $assignment['pt_possible'];

            }
        }
       
        //Calculate total grade for each class
        $total_grade = array_sum($pt_earn_array) / array_sum($pt_possible_array) * 100;
        $total_grade_f = number_format($total_grade, 2).'%';  
        ?>
        <!-- Add the final earned points, possible points, and grade at the end of eacht table  -->
        <td class="column"><b>Final Grade</b></td>
        <td class="column"><b> <?php echo array_sum($pt_earn_array); ?></b></td>
        <td class="column"><b><?php echo array_sum($pt_possible_array); ?></b></td>
        <td class="column"><b><?php echo $total_grade_f; ?></b></td>
    
    </table>

    <?php endforeach; ?>

</main>
</body>

</html>
