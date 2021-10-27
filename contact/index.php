<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<div class="container">
    <h1>Форма</h1>
    <form action="contact.php" method="post">
        <input type="text" name="firstname" placeholder="Введите имя" class="form-control"><br/>
        <input type="text" name="lastname" placeholder="Введите фамилию" class="form-control"><br/>
        <input type="text" name="subject" placeholder="Введите тему сообщения" class="form-control"><br/>
        <textarea name="message" class="form-control" placeholder="Введите сообщение"></textarea><br/>
        <input type="email" name="email" placeholder="Введите E-mail" class="form-control"><br/>
        <input type="submit" value="Отправить" class="btn btn-success">

    </form>
</div>

