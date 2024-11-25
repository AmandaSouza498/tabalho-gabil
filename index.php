<?php
session_start();

if (!isset($_SESSION['random_number'])) {
    $_SESSION['random_number'] = rand(0, 100);
    $_SESSION['attempts'] = 0;
}

$message = 'Vamos começar';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guess = (int)$_POST['guess'];
    $_SESSION['attempts']++;

    if ($guess === $_SESSION['random_number']) {
        $message = "Parabéns! Você acertou em {$_SESSION['attempts']} tentativas";
        unset($_SESSION['random_number']);
    } elseif (abs($guess - $_SESSION['random_number']) <= 10) {
        $message = 'Quente! Você está perto!';
    } else {
        $message = 'Frio! Você está longe.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo Quente e Frio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Jogo Quente e Frio</h1> 
        <p>Tente adivinhar o número entre 0 e 100.</p>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="number" name="guess" min="0" max="100" required placeholder="Digite seu palpite">
            <button type="submit">Enviar</button>
        </form>

        <p><a href="reset.php">Reiniciar Jogo</a></p>
    </div>      
</body>
</html>