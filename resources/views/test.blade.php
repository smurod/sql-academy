<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Тест конфетти</title>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at top, rgba(59, 130, 246, 0.12), transparent 30%),
                radial-gradient(circle at bottom, rgba(147, 51, 234, 0.12), transparent 30%),
                #111318;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .btn {
            padding: 18px 34px;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.35);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 34px rgba(37, 99, 235, 0.42);
        }

        .btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
<button class="btn" id="partyBtn">Праздник!</button>

<script>
    const button = document.getElementById('partyBtn');

    button.addEventListener('click', () => {
        const rect = button.getBoundingClientRect();

        const originX = (rect.left + rect.width / 2) / window.innerWidth;
        const originY = (rect.top + rect.height / 2) / window.innerHeight;

        confetti({
            particleCount: 140,
            spread: 70,
            startVelocity: 55,
            gravity: 1.15,
            ticks: 220,
            scalar: 1.05,
            drift: 0,
            origin: {
                x: originX,
                y: originY
            },
            angle: 90
        });

        confetti({
            particleCount: 70,
            spread: 55,
            startVelocity: 48,
            gravity: 1.2,
            ticks: 220,
            scalar: 0.9,
            origin: {
                x: originX,
                y: originY
            },
            angle: 75
        });

        confetti({
            particleCount: 70,
            spread: 55,
            startVelocity: 48,
            gravity: 1.2,
            ticks: 220,
            scalar: 0.9,
            origin: {
                x: originX,
                y: originY
            },
            angle: 105
        });
    });
</script>
</body>
</html>
