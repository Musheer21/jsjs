<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دخول الإدارة | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Aref+Ruqaa:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            --primary: #1b263b;
            --accent: #c19a6b;
            --white: #ffffff;
            --danger: #c62828;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Amiri', serif; }

        body {
            background: linear-gradient(135deg, #1b263b 0%, #0d1b2a 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .bg-pattern {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: url('https://www.transparenttextures.com/patterns/p6.png');
            opacity: 0.1;
            z-index: 1;
        }

        /* Floating particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--accent);
            opacity: 0.1;
            animation: float 6s infinite ease-in-out;
        }

        .particle:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 120px; height: 120px; top: 70%; right: 10%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 30%; animation-delay: 4s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(193, 154, 107, 0.2);
            border-radius: 20px;
            padding: 45px 40px;
            width: 420px;
            max-width: 90%;
            z-index: 10;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0; left: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), #8b6914, var(--accent));
            border-radius: 20px 20px 0 0;
        }

        .admin-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--accent), #8b6914);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(193, 154, 107, 0.3);
        }

        .admin-icon .material-icons {
            font-size: 40px;
            color: white;
        }

        .login-card h2 {
            font-family: 'Aref Ruqaa', serif;
            color: var(--accent);
            font-size: 1.8rem;
            margin-bottom: 8px;
            text-align: center;
        }

        .login-card p.subtitle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            color: var(--accent);
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper .material-icons {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            font-size: 20px;
            opacity: 0.6;
        }

        .form-group input {
            width: 100%;
            padding: 14px 45px 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(193, 154, 107, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-family: 'Amiri', serif;
            outline: none;
            transition: all 0.3s;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-group input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.15);
            background: rgba(255, 255, 255, 0.12);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent), #8b6914);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            font-family: 'Amiri', serif;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(193, 154, 107, 0.3);
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(193, 154, 107, 0.4);
        }

        .error-msg {
            background: rgba(198, 40, 40, 0.15);
            border: 1px solid rgba(198, 40, 40, 0.3);
            color: #ef9a9a;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 0.9rem;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .back-link:hover {
            color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="login-card">
        <div class="admin-icon">
            <span class="material-icons">admin_panel_settings</span>
        </div>

        <h2>بوابة الإدارة</h2>
        <p class="subtitle">لوحة إدارة المستخدمين والصلاحيات</p>

        @if($errors->any())
            <div class="error-msg">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>كلمة مرور الإدارة</label>
                <div class="input-wrapper">
                    <span class="material-icons">lock</span>
                    <input type="password" name="password" placeholder="أدخل كلمة مرور الإدارة" required autofocus>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <span class="material-icons" style="font-size: 20px;">login</span>
                دخول لوحة الإدارة
            </button>
        </form>

        <a href="{{ route('welcome') }}" class="back-link">← العودة للصفحة الرئيسية</a>
    </div>

    @include('partials.footer')
</body>
</html>
