<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    if (isset($_POST['title'])) {
    // Declaring Task Variables
    $title = $_POST['title'];
    $typeInput = $_POST['task-type'];
    $priority = $_POST['priority'];
    $statusInput = $_POST['statusInput'];
    $dateInput = $_POST['dateInput'];
    $descInput = $_POST['desc'];

    if (!empty($title) || !empty($typeInput) || !empty($priority) || !empty($statusInput) || 
    !empty($dateInput) || !empty($descInput)){
        $INSERT = "INSERT INTO tasks (title, type_id, priority_id, status_id, task_datetime, description) values (?, ?, ?, ?, ?, ?)";
        // Prepare Statement
        $stat = $con->prepare($INSERT);
        $stat->bind_param("siiiss", $title, $typeInput, $priority, $statusInput, $dateInput, $descInput);
        $stat->execute();
        echo "New Task Registerd Successfully";
        $stat->close();
        // $con->close();
    } else {
        echo "ALL Fields Are Required";
        die();
    }
    }

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    

    function getTasks()
    {
        //SQL SELECT
        // $sql = "SELECT * FROM tasks";
        // $query = mysqli_query($con, $sql);
        // $arr = mysqli_fetch_assoc($query);
        // $num = mysqli_num_rows($query);
        // if ($num > 0){
        //     while($arr = mysqli_fetch_assoc($query)){
        //         echo "";
        //     }
        // }
        // echo "Fetch all tasks";
    }

    function saveTask()
    {
        //CODE HERE
        //SQL INSERT
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

?>