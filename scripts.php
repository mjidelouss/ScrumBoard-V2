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
    $query = "SELECT tasks.id, tasks.title, tasks.status_id, types.name as typeTitle ,priorities.name as priorityTitle, tasks.task_datetime,
    tasks.description FROM  tasks  inner join types  on tasks.type_id = types.id
    inner join priorities on tasks.priority_id = priorities.id";
    $res = $con->query($query);
}

function saveTask()
{
    if (isset($_POST['titleInput'])) {
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
            $INSERT = "INSERT INTO tasks (title, type_id, priority_id, status_id, task_datetime, description) values (?, ?, ?, ?, ?, ?)";
            // Prepare Statement
            $stat = $con->prepare($INSERT);
            $stat->bind_param("siiiss", $title, $typeInput, $priority, $statusInput, $dateInput, $descInput);
            $stat->execute();
            $stat->close();
            $con->close();
        } else {
            echo "ALL Fields Are Required";
            die();
        }
    }
    $_SESSION['message'] = "Task has been added successfully !";
    header('location: index.php');
}

function updateTask()
{
    //CODE HERE
    //SQL UPDATE
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
}

function deleteTask()
{
    //CODE HERE
    //SQL DELETE
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}
