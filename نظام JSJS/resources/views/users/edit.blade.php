<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل مستخدم | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            --primary: #1b263b;
            --accent: #c19a6b;
            --white: #ffffff;
            --gray: #f4f4f4;
            --success: #2e7d32;
            --danger: #c62828;
            --info: #1565c0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Amiri', serif;
            background: var(--gray);
            min-height: 100vh;
        }

        .navbar {
            background: var(--primary);
            padding: 15px 5%;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .navbar h2 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar a {
            color: var(--accent);
            text-decoration: none;
            border: 1px solid var(--accent);
            padding: 5px 15px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .navbar a:hover {
            background: var(--accent);
            color: #000;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
        }

        .form-card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            padding: 35px;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--info), var(--accent));
        }

        .form-card h3 {
            color: var(--primary);
            font-size: 1.4rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary);
            font-weight: bold;
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Amiri', serif;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.15);
        }

        .hint-text {
            color: #999;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .error-text {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            font-family: 'Amiri', serif;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-save {
            background: linear-gradient(135deg, var(--info), #1976d2);
            color: white;
            box-shadow: 0 4px 12px rgba(21,101,192,0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(21,101,192,0.4);
        }

        .btn-cancel {
            background: #f5f5f5;
            color: #666;
            border: 1px solid #ddd;
        }

        .btn-cancel:hover {
            background: #eee;
        }

        .alert-errors {
            background: #ffebee;
            color: var(--danger);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-right: 4px solid var(--danger);
        }

        .alert-errors ul {
            list-style: none;
            padding: 0;
        }

        .alert-errors li {
            padding: 3px 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>
            <span class="material-icons">edit</span>
            تعديل بيانات المستخدم
        </h2>
        <a href="{{ route('users.index') }}">العودة لقائمة المستخدمين</a>
    </div>

    <div class="container">
        <div class="form-card">
            <h3>
                <span class="material-icons" style="color: var(--info);">manage_accounts</span>
                تعديل بيانات: {{ $user->name }}
            </h3>

            @if($errors->any())
                <div class="alert-errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>⚠ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>الاسم الكامل</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="أدخل الاسم الكامل" required>
                    @error('name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>اسم المستخدم</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="أدخل اسم المستخدم" required>
                    @error('username')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>كلمة المرور الجديدة</label>
                    <input type="password" name="password" placeholder="أدخل كلمة مرور جديدة">
                    <span class="hint-text">اتركه فارغاً إذا لم ترد تغيير كلمة المرور</span>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>تأكيد كلمة المرور الجديدة</label>
                    <input type="password" name="password_confirmation" placeholder="أعد إدخال كلمة المرور الجديدة">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-save">
                        <span class="material-icons" style="font-size: 18px;">update</span>
                        تحديث البيانات
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-cancel">إلغاء</a>
                </div>
            </form>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
