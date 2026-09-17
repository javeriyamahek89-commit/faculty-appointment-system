<?php
require_once "config/db.php";

$rows = [];
$email = '';

if (isset($_GET['email']) && $_GET['email'] !== '') {
    $email = trim($_GET['email']);

    $stmt = $conn->prepare("
        SELECT a.*, a.faculty_name, f.department
        FROM appointments a
        LEFT JOIN faculty f ON a.faculty_name = f.name
        WHERE a.student_email = ?
        ORDER BY a.created_at DESC
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $rows = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Appointment Status</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
<header><h1>Check Appointment Status</h1></header>

<div class="card">
<form method="GET">
<label>Enter Student Email</label>
<input type="email" name="email" value="<?=htmlspecialchars($email)?>" required>
<button>Search</button>
</form>
</div>

<?php if($email && $rows->num_rows===0): ?>
<div class="alert">No appointments found.</div>
<?php endif; ?>

<?php if($email && $rows->num_rows>0): ?>
<div class="table-wrap">
<table>
<tr>
<th>Faculty</th>
<th>Date</th>
<th>Time</th>
<th>Purpose</th>
<th>Status</th>
</tr>

<?php while($r=$rows->fetch_assoc()): ?>
<tr>
<td><?=htmlspecialchars($r['faculty_name'])?></td>
<td><?=$r['appointment_date']?></td>
<td><?=$r['appointment_time']?></td>
<td><?=htmlspecialchars($r['reason'])?></td>
<td><span class="status <?=$r['status']?>"><?=$r['status']?></span></td>
</tr>
<?php endwhile; ?>

</table>
</div>
<?php endif; ?>

<p><a href="index.php">← Back to Home</a></p>
</div>

</body>
</html>