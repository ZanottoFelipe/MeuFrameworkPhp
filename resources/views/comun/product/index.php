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
        <?php if (isset($products) && is_array($products)): ?>
            <?php foreach ($products as $product): ?>
                <li>
                    Nome: <?= $product->nome ?><br>
                    Preço: <?= $product->preco ?><br>
                    descricao: <?= $product->descricao ?><br>
                    Estoque: <?= $product->estoque ?><br>
                    Categoria: <?= $product->categoria ?><br>
                </li>
                
                <hr>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No Products found.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
