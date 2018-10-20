<aside id="left-sidebar">
    <section class="widget">
        <?php if (isset($_COOKIE['name'])) : ?>
        <p>Привет, <?=$_COOKIE['name'];?></p>
        <?php else : ?>
        <h3>Вход на сайт</h3>
        <?php endif; ?>
        <nav>
            <ul>
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="/admin">Админка</a>
                </li>
                <li>
                    <a href="/user/signup">Зарегистрироваться</a>
                </li>
                <li>
                    <a href="/user/login">Войти</a>
                </li>
                <li>
                    <a href="/user/logout">Выйти</a>
                </li>
            </ul>
        </nav>
    </section>
</aside>
    