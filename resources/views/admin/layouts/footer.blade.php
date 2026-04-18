<footer class="admin-footer">
    <style>
        .admin-footer {
            border-top: 1px solid var(--border-color);
            background: var(--footer-bg);
            padding: 1.2rem 1.7rem 1.4rem;
        }

        .admin-footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .admin-footer-left,
        .admin-footer-right {
            color: var(--text-muted);
            font-size: .9rem;
        }

        .admin-footer-brand {
            color: var(--text-primary);
            font-weight: 600;
        }

        .admin-footer-brand span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (max-width: 768px) {
            .admin-footer {
                padding: 1rem;
            }

            .admin-footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="admin-footer-inner">
        <div class="admin-footer-left">
            © {{ date('Y') }} <span class="admin-footer-brand">SQL <span>Mastery</span></span>. Все права защищены.
        </div>

        <div class="admin-footer-right">
            Админ-панель платформы для изучения и практики SQL
        </div>
    </div>
</footer>
