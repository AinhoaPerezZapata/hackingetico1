<?php
include 'funciones.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE accounts SET id = ?, username = ?, email = ?  WHERE id = ?');
        $stmt->execute([$id, $username, $email, $_GET['id']]);
        $msg = 'Editado Perfectamente!';
        header('Location: read.php');
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('El contacto no existe con ese ID');
        header('Location: read.php');
    }
} else {
    exit('ID no especificada!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Editar Contacto: <?=$contact['id']?></h2>
    <form action="modificar.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="username">Nombre</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id" >
        <input type="text" name="username" placeholder="Nombre" value="<?=$contact['username']?>" id="name">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email" value="<?=$contact['email']?>" id="email">
        <input type="submit" value="Modificar">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>