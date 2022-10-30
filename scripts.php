<?php
//INCLUDE DATABASE FILE
include 'database.php';
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save'])) {
    saveTask();
}

if (isset($_POST['update'])) {
    updateTask();
}

if (isset($_POST['delete'])) {
    deleteTask();
}

function getTasks()
{
    global $con;
    global $res;
    // SQL SELECT
    $query = "SELECT tasks.id, tasks.title, tasks.status_id, types.name AS typeTitle ,priorities.name AS priorityTitle, tasks.task_datetime,
    tasks.description FROM  tasks  INNER JOIN types  ON tasks.type_id = types.id
    INNER JOIN priorities ON tasks.priority_id = priorities.id";
    $res = $con->query($query);
}

function saveTask()
{
        global $con;
        // Declaring Task Variables
        $title = $_POST['titleInput'];
        $typeInput = $_POST['typeInput'];
        $priority = $_POST['priorityInput'];
        $statusInput = $_POST['statusInput'];
        $dateInput = $_POST['dateInput'];
        $descInput = $_POST['descInput'];
        if (!empty($title) || !empty($typeInput) || !empty($priority) || !empty($statusInput) ||
            !empty($dateInput) || !empty($descInput)) {
            $sql = "INSERT INTO tasks (title, type_id, priority_id, status_id, task_datetime, description) values ('$title', '$typeInput', '$priority', '$statusInput', '$dateInput', '$descInput')";
            $con->query($sql);
        } else {
            echo "ALL Fields Are Required";
            die();
        }
    $_SESSION['message'] = "Task has been added successfully !";
    header('location: index.php');
}

function updateTask()
{
    //CODE HERE
    //SQL UPDATE
    global $con;
    $id = $_POST['taskId'];
    $title = $_POST['newTitle'];
    $type = $_POST['updateType'];
    $priority = $_POST['newPriority'];
    $status = $_POST['newStatus'];
    $date = $_POST['newDate'];
    $desc = $_POST['newDesc'];
    $typeId;
    $priorityId;
    if ($type == "Feature"){
        $typeId = 1;
    }
    else {
        $typeId = 2;
    }
    if ($priority == "Low"){
        $priorityId = 1;
    }
    if ($priority == "Medium"){
        $priorityId = 2;
    }
    if ($priority == "High"){
        $priorityId = 3;
    }
    if ($priority == "Critical"){
        $priorityId = 4;
    }
    $sql = "UPDATE tasks SET id = $id, title = '$title', type_id = '$typeId', priority_id = '$priorityId', status_id = '$status', task_datetime = '$date', description = '$desc' WHERE id = $id";
    $con->query($sql);
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
}

function deleteTask()
{
    global $con;
    $id = $_POST['taskId'];
    $sql = "DELETE FROM tasks WHERE id = $id";
    $con->query($sql);
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}
