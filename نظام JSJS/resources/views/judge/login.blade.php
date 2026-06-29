<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دخول القضاة | نظام العدالة الذكي</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1b263b;
            --judge-purple: #4a4e69;
            --accent-gold: #c19a6b;
            --white: #ffffff;
            --bg-light: #f0f2f5;
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
            background-image: linear-gradient(rgba(74, 78, 105, 0.05) 2px, transparent 2px),
                linear-gradient(90deg, rgba(74, 78, 105, 0.05) 2px, transparent 2px);
            background-size: 40px 40px;
        }

        .login-card {
            background: var(--white);
            width: 400px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-top: 6px solid var(--judge-purple);
            text-align: center;
        }

        .emblem {
            width: 100px;
            margin-bottom: 20px;
        }

        h1 {
            color: var(--judge-purple);
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .form-group {
            text-align: right;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--judge-purple);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: var(--judge-purple);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #22223b;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Emblem" class="emblem">
        <h1>مدخل القضاة</h1>
        <p class="subtitle">نظام العدالة الذكي - وحدة التحليل</p>

        @if($errors->has('password'))
            <div style="color: red; margin-bottom: 15px;">{{ $errors->first('password') }}</div>
        @endif

        <form action="{{ route('judge.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>كلمة المرور الخاصة</label>
                <input type="password" name="password" placeholder="أدخل كلمة المرور..." required autofocus>
            </div>
            <button type="submit" class="login-btn">دخول لوحة التحكم</button>
        </form>
        <a href="/" style="display: block; margin-top: 20px; color: #666; text-decoration: none; font-size: 0.9rem;">العودة للرئيسية</a>
    </div>
    @include('partials.footer')
</body>

</html>