<?php
include 'scripts.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>YouCode | Scrum Board</title>
    <meta
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
      name="viewport"
    />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN core-css ================== -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
      rel="stylesheet"
    />
    <link href="assets/css/vendor.min.css" rel="stylesheet" />
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->
  </head>
  <body style="background-color: #16213e">
    <!-- BEGIN #app -->
    <div id="app" class="app-without-sidebar">
      <!-- BEGIN #content -->
      <div id="content" class="app-content main-style">
        <div class="row">
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item text-white">
                <a class="text-white" href="javascript:;">Home</a>
              </li>
              <li class="breadcrumb-item active">Scrum Board</li>
            </ol>
            <!-- BEGIN page-header -->
            <h1 class="page-header text-white">Scrum Board</h1>
            <!-- END page-header -->
          </div>

          <div class="col-6 text-end">
            <button
              class="p-2 text-white rounded-pill"
              data-bs-toggle="modal"
              data-bs-target="#modal-task"
              style="background-color: #e94560"
            >
              <i class="bi bi-plus-lg me-2"></i>Add Task
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="">
              <div
                class="col-12 text-white p-2 rounded-top"
                style="background-image: linear-gradient(#e94560, #0f3460)"
              >
                <h4 class="">To do (<span id="to-do-tasks-count"></span>)</h4>
              </div>
              <div class="taskTables" id="to-do-tasks">
                <!-- TO DO TASKS HERE -->
                <?php
//DATA FROM getTasks() FUNCTION
getTasks();
while ($row = $res->fetch_assoc()) {
    if ($row["status_id"] == 1) {
        echo '
              <button
              data-info="'. $row["title"].','.$row["priorityTitle"].','.$row["typeTitle"].','.$row["status_id"].','.$row["task_datetime"].','.$row["description"].'"
              data-bs-toggle="modal"
                data-bs-target="#delete-update-task"
                  class="col-12"
                  style="
                    background-color: #0f3460;
                    border: none;
                    border-bottom: 1px solid white;
                  "
                  id="'.$row["id"].'"
                  onclick="initializeTask('.$row["id"].')"
                >
                  <div class="">
                    <i class=""></i>
                  </div>
                  <div class="mt-2 text-start ms-1 mb-1">
                    <div class="text-white">
                      <i class="bi bi-check-circle-fill text-success me-2"></i
                      >' . $row["title"] . '
                    </div>
                    <div class="ms-4">
                      <div class="text-white">#' . $row["id"] . ' created in '.substr($row["task_datetime"], 0, 10).'
      </div>
                      <div
                        class="text-white"
                        title=""
                      >
                      ' . $row["description"] . '
                      </div>
                    </div>
                    <div class="mt-2 text-start ms-4 mb-1">
                      <span
                        class="btn rounded-3 text-white p-1"
                        style="background-color: #e94560"
                        >' . $row["priorityTitle"] . '</span
                      >
                      <span
                        class="btn rounded-3 p-1"
                        style="background-color: white; color: #e94560"
                        >' . $row["typeTitle"] . '</span
                      >
                    </div>
                  </div>
                </button>';
    }
}
?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="">
              <div
                class="col-12 text-white p-2 rounded-top"
                style="background-image: linear-gradient(#e94560, #0f3460)"
              >
                <h4 class="">
                  In Progress (<span id="in-progress-tasks-count">4</span>)
                </h4>
              </div>
              <div class="taskTables" id="in-progress-tasks">
                <!-- IN PROGRESS TASKS HERE -->
                <?php
//PHP CODE HERE
//DATA FROM getTasks() FUNCTION
getTasks();
while ($row = $res->fetch_assoc()) {
    if ($row["status_id"] == 2) {
      echo '
      <button
        data-info="'. $row["title"].','.$row["priorityTitle"].','.$row["typeTitle"].','.$row["status_id"].','.$row["task_datetime"].','.$row["description"].'"
              data-bs-toggle="modal"
              data-bs-target="#delete-update-task"
                  class="col-12"
                  style="
                    background-color: #0f3460;
                    border: none;
                    border-bottom: 1px solid white;
                  "
                  id="'. $row["id"].'"
                  onclick="initializeTask('.$row["id"].')"
                >
                        <div class="">
                          <i class=""></i>
                        </div>
                        <div class="mt-2 text-start ms-1 mb-1">
                          <div class="text-white">
                            <i
                              class="spinner-border text-success spinner-border-sm me-2"
                              role="status"
                            ></i
                            >$' . $row["title"] . '
                          </div>
                          <div class="ms-4">
                            <div class="text-white">#' . $row["id"] . ' created in '.substr($row["task_datetime"], 0, 10).'
            </div>
                            <div
                              class="text-white"
                              title=""
                            >
                            ' . $row["description"] . '
                            </div>
                          </div>
                          <div class="mt-2 text-start ms-4 mb-1">
                            <span
                              class="btn rounded-3 text-white p-1"
                              style="background-color: #e94560"
                              >' . $row["priorityTitle"] . '</span
                            >
                            <span
                              class="btn rounded-3 p-1"
                              style="background-color: white; color: #e94560"
                              >' . $row["typeTitle"] . '</span
                            >
                          </div>
                        </div>
                      </button>
           ';
    }
}
?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="">
              <div
                class="col-12 text-white p-2 rounded-top"
                style="background-image: linear-gradient(#e94560, #0f3460)"
              >
                <h4 class="">Done (<span id="done-tasks-count">4</span>)</h4>
              </div>
              <div class="taskTables" id="done-tasks">
                <!-- DONE TASKS HERE -->
                <?php
//PHP CODE HERE
//DATA FROM getTasks() FUNCTION
getTasks();
while ($row = $res->fetch_assoc()) {
    if ($row["status_id"] == 3) {
        echo '
                    <button
                      data-info="'. $row["title"].','.$row["priorityTitle"].','.$row["typeTitle"].','.$row["status_id"].','.$row["task_datetime"].','.$row["description"].'"
                            data-bs-toggle="modal"
                            data-bs-target="#delete-update-task"
                                class="col-12"
                                style="
                                  background-color: #0f3460;
                                  border: none;
                                  border-bottom: 1px solid white;
                                "
                                id="'. $row["id"].'"
                                onclick="initializeTask('.$row["id"].')"
                              >
                                <div class="">
                                  <i class=""></i>
                                </div>
                                <div class="mt-2 text-start ms-1 mb-1">
                                  <div class="text-white">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i
                                    >' . $row["title"] . '
                                  </div>
                                  <div class="ms-4">
                                    <div class="text-white">#' . $row["id"] . ' created in '.substr($row["task_datetime"], 0, 10).'
                    </div>
                                    <div
                                      class="text-white"
                                      title=""
                                    >
                                    ' . $row["description"] . '
                                    </div>
                                  </div>
                                  <div class="mt-2 text-start ms-4 mb-1">
                                    <span
                                      class="btn rounded-3 text-white p-1"
                                      style="background-color: #e94560"
                                      >' . $row["priorityTitle"] . '</span
                                    >
                                    <span
                                      class="btn rounded-3 p-1"
                                      style="background-color: white; color: #e94560"
                                      >' . $row["typeTitle"] . '</span
                                    >
                                  </div>
                                </div>
                              </button>
                              ';
    }
}
?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END #content -->

      <!-- BEGIN scroll-top-btn -->
      <a
        href="javascript:;"
        class="btn btn-icon btn-circle btn-success btn-scroll-to-top"
        data-toggle="scroll-to-top"
        ><i class="fa fa-angle-up"></i
      ></a>
      <!-- END scroll-top-btn -->
    </div>
    <!-- END #app -->

    <!-- TASK MODAL -->
    <div class="modal fade" id="modal-task">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="scripts.php" method="POST" id="form-task">
          <div
            class="modal-header"
            style="
              background-image: linear-gradient(#e94560, #0f3460);
              border: none;
            "
          >
            <h5 class="modal-title text-white">Add Task</h5>
          </div>
          <div class="modal-body" style="background-color: #0f3460">
            <div class="" id="taskForm">
              <label class="col-form-label text-white">Title</label>
              <input
               name="titleInput"
                type="text"
                class="form-control"
                style="background-color: #c8c8c8"
                id="title"
                required
              />
            </div>
            <label class="col-form-label text-white" id="typ">Type</label>
            <div class="d-flex">
              <div class="form-check ms-3">
                <input
                  name="typeInput"
                  value="2"
                  class="form-check-input"
                  type="radio"
                  required
                />
                <label class="form-check-label text-white">Bug</label>
              </div>
              <div class="form-check ms-3">
                <input
                  name="typeInput"
                  value="1"
                  class="form-check-input"
                  type="radio"
                  required
                />
                <label class="form-check-label text-white">Feature</label>
              </div>
            </div>
            <div class="">
              <label class="col-form-label text-white">Priority</label>
              <select
              name="priorityInput"
                class="form-select"
                style="background-color: #c8c8c8"
                id="priority"
                required
              >
                <option disabled selected>Please select</option>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
                <option value="4">Critical</option>
              </select>
            </div>
            <div class="">
              <label class="col-form-label text-white">Status</label>
              <select
                name="statusInput"
                class="form-select"
                style="background-color: #c8c8c8"
                id="status"
                required
              >
                <option disabled selected>Please select</option>
                <option value="1">To Do</option>
                <option value="2">In Progress</option>
                <option value="3">Done</option>
              </select>
            </div>
            <div class="">
              <label class="col-form-label text-white">Date</label>
              <input
                name="dateInput"
                type="date"
                class="form-control"
                style="background-color: #c8c8c8"
                id="dateInput"
                required
              />
            </div>
            <div class="">
              <label class="col-form-label text-white">Description</label>
              <textarea
                name="descInput"
                class="form-control"
                style="background-color: #c8c8c8"
                id="desc"
                required
              ></textarea>
            </div>
          </div>
          <div
            class="modal-footer"
            style="background-color: #0f3460; border: none"
          >
            <button
              type="button"
              style="
                background-color: #c8c8c8;
                color: #e94560;
                font-weight: bold;
              "
              class="btn btn-light border rounded-pill"
              data-bs-dismiss="modal"
            >
              Cancel
            </button>
            <button
              type="submit"
              id="save"
              name="save"
              style="background-color: #e94560; font-weight: bold"
              class="btn btn-primary rounded-pill text-white"
            >
              Save
            </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- UPDATE & DELETE TASK MODAL -->
    <div class="modal fade" id="delete-update-task">
      <div class="modal-dialog">
        <div class="modal-content">
          <div
            class="modal-header"
            style="
              background-image: linear-gradient(#e94560, #0f3460);
              border: none;
            "
          >
            <h5 class="modal-title text-white" id="modalTaskTitle">Task</h5>
          </div>
          <div class="modal-body" style="background-color: #0f3460">
            <div class="" id="taskForm">
              <label class="col-form-label text-white">Title</label>
              <input
                type="text"
                class="form-control"
                style="background-color: #c8c8c8"
                id="update_title"
              />
            </div>
            <label class="col-form-label text-white" id="typ">Type</label>
            <div class="d-flex">
              <div class="form-check ms-3">
                <input
                  name="updateType"
                  value="Bug"
                  class="form-check-input"
                  type="radio"
                  id="bug"
                />
                <label class="form-check-label text-white">Bug</label>
              </div>
              <div class="form-check ms-3">
                <input
                  name="updateType"
                  value="Feature"
                  class="form-check-input"
                  type="radio"
                  id="feature"
                />
                <label class="form-check-label text-white">Feature</label>
              </div>
            </div>
            <div class="">
              <label class="col-form-label text-white">Priority</label>
              <select
                class="form-select"
                style="background-color: #c8c8c8"
                id="update_priority"
              >
                <option disabled selected>Please select</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
                <option value="Critical">Critical</option>
              </select>
            </div>
            <div class="">
              <label class="col-form-label text-white">Status</label>
              <select
                class="form-select"
                style="background-color: #c8c8c8"
                id="update_status"
              >
                <option disabled selected>Please select</option>
                <option value="1">To Do</option>
                <option value="2">In Progress</option>
                <option value="3">Done</option>
              </select>
            </div>
            <div class="">
              <label class="col-form-label text-white">Date</label>
              <input
                type="date"
                class="form-control"
                style="background-color: #c8c8c8"
                id="update_dateInput"
              />
            </div>
            <div class="">
              <label class="col-form-label text-white">Description</label>
              <textarea
                class="form-control"
                style="background-color: #c8c8c8"
                id="update_desc"
              ></textarea>
            </div>
          </div>
          <div
            class="modal-footer"
            style="background-color: #0f3460; border: none"
            id="modalFooter"
          >
          <button
      type="button"
      style="
        background-color: #c8c8c8;
        color: #e94560;
        font-weight: bold;
      "
      class="btn btn-light border rounded-pill"
      data-bs-dismiss="modal"
    >
    Cancel
    </button>
      <button
      type="submit"
      style="
        background-color: #FF0660;
        color: white;
        font-weight: bold;
      "
      class="btn btn-light border rounded-pill"
      name="delete"
    >
    DELETE
    </button>
    <button
      type="submit"
      style="background-color: green; font-weight: bold"
      class="btn btn-primary rounded-pill text-white"
      name="update"
    >
    UPDATE
    </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ================== BEGIN core-js ================== -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="scripts.js"></script>
    <!-- ================== END core-js ================== -->

    <script>
		//reloadTasks();
	</script>

  </body>
</html>