<?php
session_start();

// Inicializa o array de tarefas na sessão, se não existir
if (!isset($_SESSION['tarefas'])) {
    $_SESSION['tarefas'] = [];
}

// Adiciona uma nova tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nova_tarefa'])) {
    $nova_tarefa = trim($_POST['nova_tarefa']);
    if (!empty($nova_tarefa)) {
        $_SESSION['tarefas'][] = $nova_tarefa;
    }
}

// Remove uma tarefa
if (isset($_GET['remover'])) {
    $indice = $_GET['remover'];
    if (isset($_SESSION['tarefas'][$indice])) {
        unset($_SESSION['tarefas'][$indice]);
        $_SESSION['tarefas'] = array_values($_SESSION['tarefas']); // Reorganiza os índices
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciador de Tarefas</h1>
        <form method="POST" action="">
            <input type="text" name="nova_tarefa" placeholder="Digite uma nova tarefa">
            <button type="submit">Adicionar</button>
        </form>

        <ul>
            <?php foreach ($_SESSION['tarefas'] as $indice => $tarefa): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa); ?>
                    <a href="?remover=<?php echo $indice; ?>" class="remover">Remover</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
