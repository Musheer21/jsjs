<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول الإداري | نظام العدالة الذكي</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1b263b;
            --accent-gold: #c19a6b;
            --white: #ffffff;
            --bg-light: #f4f7f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Amiri', serif;
        }

        body {
            background-color: var(--bg-light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(27, 38, 59, 0.02) 2px, transparent 2px),
                linear-gradient(90deg, rgba(27, 38, 59, 0.02) 2px, transparent 2px);
            background-size: 50px 50px;
        }

        .login-card {
            background: var(--white);
            width: 450px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-top: 5px solid var(--accent-gold);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .yemen-eagle {
            width: 120px;
            margin-bottom: 20px;
        }

        h1 {
            color: var(--primary-navy);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        p.subtitle {
            color: #666;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .form-group {
            text-align: right;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--primary-navy);
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 8px 15px;
            background: var(--primary-navy);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #0d1b2a;
            transform: translateY(-2px);
        }

        .justice-scales {
            margin-top: 30px;
            width: 50px;
            fill: var(--accent-gold);
            opacity: 0.6;
        }

        .error-msg {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Eagle" class="yemen-eagle">

        <h1>بوابة الإدارة القضائية</h1>
        <p class="subtitle">نظام العدالة الذكي (JSJS)</p>

        @if ($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="username" placeholder="مثال: musheer" required autofocus>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" placeholder="12345" required>
            </div>

            <button type="submit" class="login-btn">دخول النظام</button>
        </form>
        @include('partials.footer')
</body>

</html>