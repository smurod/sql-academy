<footer class="footer">
    <div class="section-inner">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ url('/') }}" class="nav-logo">
                    <div class="nav-logo-icon" style="width: 40px; height: 40px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <ellipse cx="12" cy="5" rx="9" ry="3"/>
                            <path d="M3 5v14c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/>
                            <path d="M3 12c0 1.66 4.03 3 9 3s9-1.34 9-3"/>
                        </svg>
                    </div>
                    <span class="nav-logo-text">SQL <span>Academy</span></span>
                </a>
                <p>Онлайн платформа для изучения и практики SQL. Бесплатный интерактивный курс с сертификатом.</p>

            </div>
            <div class="footer-col">
                <h4>Обучение</h4>
                <ul>
                    <li><a href="{{ route('public.courses.index') }}">Курс SQL</a></li>
                    <li><a href="{{ route('public.tasks.index') }}">SQL Тренажёр</a></li>
                    <li><a href="{{ route('sandbox.form') }}">Песочница</a></li>
                    <li><a href="#">Справочник SQL</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Платформа</h4>
                <ul>
                    <li><a href="#">Рейтинг</a></li>
                    <li><a href="#">Сертификаты</a></li>
                    <li><a href="#">Блог</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Компания</h4>
                <ul>
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Политика конфиденциальности</a></li>
                    <li><a href="#">Условия использования</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} SQL Academy. Все права защищены.</p>
            <p>Сделано с <i class="bi bi-heart-fill heart"></i> для сообщества разработчиков</p>
        </div>
    </div>
</footer>
