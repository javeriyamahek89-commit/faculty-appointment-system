<?php
require_once "config/db.php";
$faculty = $conn->query("SELECT * FROM faculty ORDER BY name");
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
<title>Faculty Appointment Request System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
<header><h1>Faculty Appointment Request System</h1><p>Request an appointment with your faculty member</p></header>
<?php if($msg): ?><div class="alert"><?=htmlspecialchars($msg)?></div><?php endif; ?>
<div class="card">
<h2>Book an Appointment</h2>
<form action="request.php" method="POST">
<label>Student Name</label><input type="text" name="student_name" required>
<label>Student Email</label><input type="email" name="student_email" required>
<label>Select Faculty</label>
<select name="faculty_id" required><option value="">-- Select Faculty --</option>
<?php while($f=$faculty->fetch_assoc()): ?>
<option value="<?=$f['id']?>"><?=htmlspecialchars($f['name'])?> - <?=htmlspecialchars($f['department'])?></option>
<?php endwhile; ?></select>
<label>Appointment Date</label><input type="date" name="appointment_date" min="<?=date('Y-m-d')?>" required>
<label>Appointment Time</label><input type="time" name="appointment_time" required>
<label>Purpose</label><textarea name="purpose" rows="4" required></textarea>
<button type="submit">Submit Request</button>
</form>
</div>
<div class="links"><a href="status.php">Check Appointment Status</a> | <a href="admin/login.php">Faculty/Admin Login</a></div>
</div>
</body>
</html>