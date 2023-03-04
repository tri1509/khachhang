<?php
$title = "todolist";
include 'inc/header.php';
?>
<?php include '../classes/controller.php';?>
<?php include_once '../helpers/format.php';?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<style>
#todolist {
  margin: 60px auto;
  width: 80%;
  flex-basis: 450px;
  background-color: #1e272e;
  padding: 30px;
  border-radius: 10px 10px 0px 0px;
}

#todolist .task-head {
  display: flex;
  justify-content: space-between;
}

#todolist .task-head input {
  font-size: 15px;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  flex-grow: 0.95;
  outline: none;
  border: none;
  color: #ff6f6f;
  border-bottom: 1px solid #ff6f6f;
  background: transparent;
  padding: 10px 10px 10px 0px;
}

#todolist .task-head input::placeholder {
  color: #ff6f6f;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
    Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-size: 15px;
}

#todolist .task-head button {
  border: none;
  background-color: #ff2b2b;
  color: white;
  padding: 10px 15px;
}

form#add_task {
  width: 100%;
}

form#add_task button {
  cursor: pointer;
}

ul.tasks {
  padding: 0;
  list-style: none;
}

ul.tasks li.task-item {
  display: flex;
  justify-content: space-between;
  padding: 8px 0px;
  border-bottom: 1px solid #525252;
}

.task-item[is-complete="true"] span {
  text-decoration: line-through;
  color: #676767 !important;
}

.task-item span.task {
  color: #c7c7c7;
  cursor: pointer;
}

.task-item .task-action {
  display: flex;
  flex-direction: row;
}

.task-item .task-action button {
  background: none;
  cursor: pointer;
  border: none;
}

.task-item .task-action i {
  font-size: 16px;
  color: #525252;
}

.task-item:hover .task-action i {
  color: #c7c7c7;
}

.task-item:hover span {
  color: white;
}

.task-result {
  font-size: 13px;
  font-style: italic;
  color: #989898;
}
</style>
<div id="wp-content">
  <div id="content" class="container-fluid">
    <div class="card">
      <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
        <h5 class="m-0">Kế hoạch làm việc</h5>
      </div>
      <div id="todolist">
        <form action="" id="add_task" class="task-head">
          <input type="text" name="task" id="task" placeholder="Thêm kế hoạch làm việc" />
          <button>THÊM</button>
        </form>
        <div class="task-body">
          <ul class="tasks"></ul>
          <span class="task-result"></span>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
const TODOLIST_APP = "TODOLIST_APP";
const saveData = (data) => {
  localStorage.setItem(TODOLIST_APP, JSON.stringify(data));
};

const loadData = () => {
  let data;
  data = JSON.parse(localStorage.getItem(TODOLIST_APP));
  data = data ? data : [];
  return data;
};

const addTask = (new_task) => {
  let data;
  data = loadData();
  data.push(new_task);
  saveData(data);
};

const createTaskItem = (task, is_complete, index) => {
  return `
    <li class="task-item" is-complete="${is_complete}" index="${index}">
      <span class="task" onclick="markTaskComplete(${index})">${task}</span>
      <div class="task-action">
        <button onclick="pushEditTask(${index})">
          <i class="fa-solid fa-pen"></i>
        </button>
        <button onclick="deleteTask(this,${index})">
          <i class="fa-solid fa-trash"></i>
        </button>
      </div>
    </li>
    `;
};

const renderTasks = () => {
  let data, ulTasksHtml, ulTasks, task_result, count_complete;
  task_result = document.querySelector(".task-result");
  ulTasks = document.querySelector("ul.tasks");
  data = loadData();
  count_complete = 0;
  ulTasksHtml = data.map((element, index) => {
    if (element.is_complete == true) count_complete++;
    return createTaskItem(element.task, element.is_complete, index);
  });
  task_result.innerText =
    count_complete > 0 ? `Tuyệt vời, ${count_complete} công việc đã hoàn thành !` : [];
  ulTasks.innerHTML = ulTasksHtml.join("");
};

const markTaskComplete = (index) => {
  let data;
  data = loadData();
  data[index].is_complete = data[index].is_complete == true ? false : true;
  saveData(data);
  renderTasks();
};

const deleteTask = (element, index) => {
  let data;
  let delete_confirm = confirm("Bạn có muốn xoá không ?");
  if (delete_confirm) {
    data = loadData();
    data.splice(index, 1);
    saveData(data);
    element.closest(".task-item").remove();
  }
};

const pushEditTask = (index) => {
  let data = loadData();
  const btn = document.querySelector("#add_task button");
  const task = document.querySelector("#task");
  task.value = data[index].task;
  task.setAttribute("index", index);
  btn.innerText = "SỬA";
};

const editTask = (task, index) => {
  const btn = document.querySelector("#add_task button");
  let data = loadData();
  data[index].task = task;
  saveData(data);
  btn.innerText = "THÊM";
};

const formAddTask = document.forms.add_task;
formAddTask.addEventListener("submit", (e) => {
  let new_task;
  const task = document.querySelector("#task");
  const index = task.getAttribute("index");
  if (task.value.length < 2) {
    alert("Không thể quá vắng tắc như vậy !");
    return false;
  }
  if (index) {
    editTask(task.value, index);
    task.removeAttribute("index");
  } else {
    new_task = {
      task: task.value,
      is_complete: false,
    };
    addTask(new_task);
  }

  renderTasks();
  task.value = "";
  e.preventDefault();
});

document.addEventListener("keyup", (e) => {
  const task = document.querySelector("#task");
  if (e.which == 27) {
    task.value = "";
    const btn = document.querySelector("#add_task button");
    btn.innerText = "ADD TASK";
    task.removeAttribute("index");
  }
});

renderTasks();
</script>
<?php include 'inc/footer.php';?>