<?php
require_once 'connect.php';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ header("location: login.php"); exit; }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_project'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    if(!empty($title)){
        $stmt = $conn->prepare("INSERT INTO projects (user_id, title, description) VALUES (:uid, :t, :d)");
        $stmt->execute([':uid' => $_SESSION["id"], ':t' => $title, ':d' => $desc]);
        header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
    <div style="display:flex; justify-content:space-between;">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
        <a href="logout.php" style="color:red;">Logout</a>
    </div>
    <hr>
    <h3>Create New Project</h3>
    <form method="post">
        <input type="text" name="title" placeholder="Project Title" required>
        <input type="text" name="description" placeholder="Description">
        <button type="submit" name="new_project">Add Project</button>
    </form>
    <h3>Your Projects</h3>
    <table>
        <tr><th>Title</th><th>Description</th><th>Link</th></tr>
        <?php
        $stmt = $conn->prepare("SELECT * FROM projects WHERE user_id = :uid");
        $stmt->execute([':uid' => $_SESSION["id"]]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr><td>".htmlspecialchars($row['title'])."</td>";
            echo "<td>".htmlspecialchars($row['description'])."</td>";
            echo "<td><a href='project_details.php?id=".$row['project_id']."'>View Tasks</a></td></tr>";
        }
        ?>
    </table>
</div>
</body></html>