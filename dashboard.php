<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";

if(isset($_GET['action'], $_GET['id']) &&
   in_array($_GET['action'], ['Approved','Rejected','Completed'])){

    $stmt = $conn->prepare("UPDATE appointments SET status=? WHERE id=?");
    $stmt->bind_param("si", $_GET['action'], $_GET['id']);
    $stmt->execute();
}

$q = $conn->query("
    SELECT a.*, a.faculty_name, f.department
    FROM appointments a
    LEFT JOIN faculty f ON a.faculty_name = f.name
    ORDER BY a.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
<header>
<h1>Admin Dashboard</h1>
<a href="logout.php">Logout</a>
</header>

<div class="table-wrap">
<table>
<tr>
<th>Student</th>
<th>Email</th>
<th>Faculty</th>
<th>Date</th>
<th>Time</th>
<th>Purpose</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($r=$q->fetch_assoc()): ?>
<tr>
<td><?=htmlspecialchars($r['student_name'])?></td>
<td><?=htmlspecialchars($r['student_email'])?></td>
<td><?=htmlspecialchars($r['faculty_name'])?></td>
<td><?=$r['appointment_date']?></td>
<td><?=$r['appointment_time']?></td>
<td><?=htmlspecialchars($r['reason'])?></td>
<td><?=$r['status']?></td>
<td>
<a href="?action=Approved&id=<?=$r['id']?>">Approve</a> |
<a href="?action=Rejected&id=<?=$r['id']?>">Reject</a> |
<a href="?action=Completed&id=<?=$r['id']?>">Complete</a>
</td>
</tr>
<?php endwhile; ?>

</table>
</div>
</div>

</body>
</html>