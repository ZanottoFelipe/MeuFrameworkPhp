<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <h1>Users List</h1>
    <ul>
        <?php if (isset($users) && is_array($users)): ?>
            <?php foreach ($users as $user): ?>
                <li>
                    Nome: <?= $user->nome ?><br>
                    Sobrenome: <?= $user->sobrenome ?><br>
                    Email: <?= $user->email ?><br>
                    Token: <?= $user->token ?>
                    
                </li>
                <br>
                    <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No users found.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
