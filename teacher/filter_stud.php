

<?php

include '../includes/conn.php';
$department_Id = $_POST["department_Id"];

$program_Id = $_POST["program_Id"];

$semester = $_POST["semester"];

// Filtering based on the above selection
// Filter Query(Based on the columns the values are set,the search query will work)

// single if condition to check value is empty or not.for non-empty then mysql query is two between 'AND' operation.
$query = 'SELECT student_Id,roll_No,department.name,program_Name,semester FROM student,department,program';
$where = ' Where';
$and = ' student.program_Id=program.program_Id AND program.department_Id=department.department_Id';

if (($_POST['department_Id']) != 'All') {
    $and .= ' AND department.department_Id="' . $department_Id . '"';
}

if (($_POST['program_Id']) != 'All') {
    $and .= ' AND program.program_Id="' . $program_Id . '"';
}


if ($_POST['semester'] != 'All') {
    $and .= ' AND student.semester="' . $semester . '"';
}

//The above query will look like..

// $filter_stud_det="SELECT student_Id,roll_No,department.name,program_Name,semester FROM student,department,program where student.program_Id=program.program_Id 
// AND program.department_Id=department.department_Id
// AND student.program_Id=$program_Id
// AND program.department_Id=$department_Id
// AND student.semester=$semester";

$filter_query = $query . '' . $where . '' . $and;

$result = $conn->query($filter_query);
//Data is coming
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $student_Id = $row["student_Id"];
        $roll_No = $row["roll_No"];
        $department = $row["name"];
        $program_Name = $row["program_Name"];
        $semester = $row["semester"];

        $r="";
        // Filter the Student based on Selected filter
        if (isset($_POST['filter_stud'])) {

            $r = $r . '<tr>
                <td>' . $roll_No . '</td>
                <td>' . ucwords($department) . '</td>
                <td>' . ucwords($program_Name) . '</td>
                <td>' . ucwords($semester) . '</td>
                <td><input type="checkbox" name="student_Ids[]" value="' . $student_Id . '" ></td></tr>';
        }
    }
    echo $r;
}


?>
