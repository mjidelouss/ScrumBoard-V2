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
    if (isset($_POST['submit'])) {
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

// function initTask($id)
// {
//   global $con;
//   $inisql = "SELECT * FROM tasks WHERE id = $id";
//   $init = mysqli_query($con, $inisql);
//   $row = mysqli_fetch_assoc($init);
//   $title = $row['title'];
//   $typeInput = $row['type_id'];
//   $priority = $row['priority_id'];
//   $statusInput = $row['status_id'];
//   $dateInput = $row['task_datetime'];
//   $descInput = $row['description'];
// }

function deleteTask()
{
    //CODE HERE
    //SQL DELETE
    if(isset($_GET['delid'])) {
      $id = $_GET['delid'];

      $delsql = "DELETE FROM tasks WHERE id = $id";
      $del = mysqli_query($con, $delsql);
    }
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}
