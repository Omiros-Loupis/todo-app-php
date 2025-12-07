<?php
require_once 'connect.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ header("location: login.php"); exit; }

$project_id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM projects WHERE project_id = :pid AND user_id = :uid");
$stmt->execute([':pid' => $project_id, ':uid' => $_SESSION["id"]]);
$project = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$project) die("Project not found.");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_task'])) {
    $task = trim($_POST['task_name']);
    if(!empty($task)){
        $stmt = $conn->prepare("INSERT INTO tasks (project_id, task_name) VALUES (:pid, :tn)");
        $stmt->execute([':pid' => $project_id, ':tn' => $task]);
        header("location: project_details.php?id=".$project_id);
    }
}

if (isset($_GET['del_task'])) {
    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = :tid AND project_id = :pid");
    $stmt->execute([':tid' => $_GET['del_task'], ':pid' => $project_id]);
    header("location: project_details.php?id=".$project_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Project</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <a href="index.php" class="back-link">&larr; Back</a>
    <h2>Project: <?php echo htmlspecialchars($project['title']); ?></h2>
    <hr>
    <form method="post">
        <input type="text" name="task_name" placeholder="New Task..." required>
        <button type="submit" name="add_task">Add Task</button>
    </form>
    <ul>
        <?php
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE project_id = :pid");
        $stmt->execute([':pid' => $project_id]);
        while($task = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<li>".htmlspecialchars($task['task_name']);
            echo " <a href='?id=$project_id&del_task=".$task['task_id']."' style='color:red;'>[Delete]</a></li>";
        }
        ?>
    </ul>
</div>
</body></html>