<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة قاضي جديد | لوحة الإدارة</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        :root {
            --primary: #1b263b;
            --accent: #c19a6b;
            --gray: #f4f4f4;
            --success: #2e7d32;
            --danger: #c62828;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body { font-family: 'Amiri', serif; background: var(--gray); min-height: 100vh; }

        .navbar {
            background: linear-gradient(135deg, var(--primary), #0d1b2a);
            padding: 15px 5%;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .navbar h2 { display: flex; align-items: center; gap: 10px; }

        .navbar h2 .material-icons {
            background: linear-gradient(135deg, var(--accent), #8b6914);
            padding: 6px; border-radius: 8px; font-size: 22px;
        }

        .nav-btn {
            color: white; text-decoration: none;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 6px 16px; border-radius: 8px;
            transition: 0.3s; font-size: 0.85rem;
            display: inline-flex; align-items: center; gap: 5px;
        }

        .nav-btn:hover { background: var(--accent); border-color: var(--accent); color: #000; }

        .container { max-width: 650px; margin: 40px auto; padding: 20px; }

        .form-card {
            background: white; border-radius: 14px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            padding: 35px; position: relative; overflow: hidden;
        }

        .form-card::before {
            content: ''; position: absolute;
            top: 0; right: 0; left: 0; height: 5px;
            background: linear-gradient(90deg, #5c6bc0, var(--accent));
        }

        .form-card h3 {
            color: var(--primary); font-size: 1.4rem;
            margin-bottom: 25px;
            display: flex; align-items: center; gap: 10px;
        }

        .form-group { margin-bottom: 20px; }

        .form-group label {
            display: block; margin-bottom: 8px;
            color: var(--primary); font-weight: bold; font-size: 1rem;
        }

        .form-group input, .form-group select {
            width: 100%; padding: 12px 16px;
            border: 2px solid #e8e8e8; border-radius: 10px;
            font-size: 1rem; font-family: 'Amiri', serif;
            outline: none; transition: all 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.15);
        }

        .error-text { color: var(--danger); font-size: 0.85rem; margin-top: 5px; }

        .form-actions { display: flex; gap: 12px; margin-top: 30px; }

        .btn {
            padding: 12px 30px; border-radius: 10px;
            font-size: 1rem; font-weight: bold;
            font-family: 'Amiri', serif; cursor: pointer;
            border: none; transition: all 0.3s ease;
            display: inline-flex; align-items: center;
            gap: 8px; text-decoration: none;
        }

        .btn-save {
            background: linear-gradient(135deg, #5c6bc0, #3949ab);
            color: white; box-shadow: 0 4px 12px rgba(92,107,192,0.3);
            flex: 1; justify-content: center;
        }

        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(92,107,192,0.4); }

        .btn-cancel { background: #f5f5f5; color: #666; border: 1px solid #ddd; }
        .btn-cancel:hover { background: #eee; }

        .alert-errors {
            background: #ffebee; color: var(--danger);
            padding: 15px; border-radius: 10px;
            margin-bottom: 20px; border-right: 4px solid var(--danger);
        }

        .alert-errors ul { list-style: none; padding: 0; }
        .alert-errors li { padding: 3px 0; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>
            <span class="material-icons">admin_panel_settings</span>
            إضافة قاضي جديد
        </h2>
        <a href="{{ route('admin.judges.index') }}" class="nav-btn">
            <span class="material-icons" style="font-size: 16px;">arrow_forward</span>
            العودة لقائمة القضاة
        </a>
    </div>

    <div class="container">
        <div class="form-card">
            <h3>
                <span class="material-icons" style="color: #5c6bc0;">gavel</span>
                بيانات القاضي الجديد
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

            <form action="{{ route('admin.judges.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>اسم القاضي الكامل</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="أدخل الاسم الكامل للقاضي" required>
                    @error('name') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>التخصص</label>
                    <select name="specialization">
                        <option value="">-- اختر التخصص --</option>
                        <option {{ old('specialization') == 'أحوال شخصية' ? 'selected' : '' }}>أحوال شخصية</option>
                        <option {{ old('specialization') == 'جزائي' ? 'selected' : '' }}>جزائي</option>
                        <option {{ old('specialization') == 'مدني' ? 'selected' : '' }}>مدني</option>
                        <option {{ old('specialization') == 'تجاري' ? 'selected' : '' }}>تجاري</option>
                        <option {{ old('specialization') == 'إداري' ? 'selected' : '' }}>إداري</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>المحكمة</label>
                    <select name="court">
                        <option value="">-- اختر المحكمة --</option>
                        <option {{ old('court') == 'محكمة غرب تعز الابتدائية' ? 'selected' : '' }}>محكمة غرب تعز الابتدائية</option>
                        <option {{ old('court') == 'محكمة شرق تعز الابتدائية' ? 'selected' : '' }}>محكمة شرق تعز الابتدائية</option>
                        <option {{ old('court') == 'محكمة صبر الموادم' ? 'selected' : '' }}>محكمة صبر الموادم</option>
                        <option {{ old('court') == 'محكمة جبل حبشي' ? 'selected' : '' }}>محكمة جبل حبشي</option>
                        <option {{ old('court') == 'محكمة المسراخ' ? 'selected' : '' }}>محكمة المسراخ</option>
                        <option {{ old('court') == 'محكمة المعافر' ? 'selected' : '' }}>محكمة المعافر</option>
                        <option {{ old('court') == 'محكمة المواسط والشمايتين' ? 'selected' : '' }}>محكمة المواسط والشمايتين</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="7xxxxxxxx">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-save">
                        <span class="material-icons" style="font-size: 18px;">save</span>
                        حفظ القاضي
                    </button>
                    <a href="{{ route('admin.judges.index') }}" class="btn btn-cancel">إلغاء</a>
                </div>
            </form>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
