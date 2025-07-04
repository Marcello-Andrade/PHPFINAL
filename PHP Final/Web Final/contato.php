<?php
include('includes/header.php'); // Esta linha deve ser a primeira
?>

<main>
    <section class="contato">
        <h2>Entre em Contato</h2>
        <form action="salvar-contato.php" method="POST">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="tel" name="telefone" placeholder="Telefone">
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="mensagem" placeholder="Mensagem" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </section>
</main>

<?php
include('includes/footer.php'); // Esta linha deve ser a última
?>