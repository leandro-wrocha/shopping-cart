<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 2rem;
        }
        .cart {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .cart h1 {
            text-align: center;
            color: #333;
        }
        .item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding: 0.5rem 0;
        }
        .total {
            text-align: right;
            margin-top: 1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="cart">
        <h1>🛍️ Shopping Cart</h1>

        <?php for ($i = 1; $i <= 3; $i++): ?>
            <div class="item">
                <span>Produto <?php echo $i; ?></span>
                <span>R$ <?php echo number_format(rand(1000, 9999) / 100, 2, ',', '.'); ?></span>
            </div>
        <?php endfor; ?>

        <div class="total">Total: R$ 179,70</div>
    </div>
</body>
</html>
