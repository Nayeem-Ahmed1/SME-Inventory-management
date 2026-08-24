<!DOCTYPE html>
<html>

<head>
    <title>Emergency Admin</title>
</head>

<?php

include __DIR__ . '/config/db.config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $role_id = 1;

    $sql = "INSERT INTO users(role_id, full_name, email, user_password) VALUES (
                        {$role_id},
                        '{$name}',
                        '{$email}',
                        '{$hashedPassword}'
                    )";

    dbQuery($sql);
}

?>

<body>

    <h2>Create Emergency Admin</h2>

    <form method="POST">

        <label>Full Name</label>
        <input
            type="text"
            name="full_name"
            required>

        <br><br>

        <label>Email</label>
        <input
            type="email"
            name="email"
            required>

        <br><br>

        <label>Password</label>
        <input
            type="password"
            name="password"
            required>

        <br><br>

        <button type="submit">
            Create Admin
        </button>

    </form>

</body>

</html>