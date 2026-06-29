<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام العدالة الذكي JSJS | الجمهورية اليمنية</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Aref+Ruqaa:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1b263b;
            --secondary-navy: #0d1b2a;
            --accent-gold: #c19a6b;
            --soft-gold: #e2c29d;
            --white: #ffffff;
            --off-white: #f8f9fa;
            --black: #1a1a1a;
            --error: #d32f2f;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Amiri', serif;
        }

        body {
            background-color: var(--off-white);
            background-image:
                radial-gradient(circle at 20% 20%, rgba(27, 38, 59, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 80% 80%, rgba(27, 38, 59, 0.05) 0%, transparent 20%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        /* Top Bar - Identity */
        .identity-bar {
            position: fixed;
            top: 0;
            width: 100%;
            height: 80px;
            background: var(--white);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 50px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        .flag-strip {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            display: flex;
        }

        .f-red {
            flex: 1;
            background: #CE1126;
        }

        .f-white {
            flex: 1;
            background: #FFFFFF;
        }

        .f-black {
            flex: 1;
            background: #000000;
        }

        .gov-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .gov-title h1 {
            font-size: 1.3rem;
            color: var(--primary-navy);
            line-height: 1.2;
        }

        /* Main Container */
        .main-container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(193, 154, 107, 0.2);
            margin-top: 100px;
            margin-bottom: 50px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Right Panel: Welcome & Emblem */
        .info-panel {
            flex: 1;
            background: var(--primary-navy);
            padding: 40px;
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .info-panel::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/p6.png');
            opacity: 0.05;
            top: 0;
            left: 0;
        }

        .emblem-box {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--accent-gold);
            padding: 15px;
        }

        .emblem-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .info-panel h2 {
            font-family: 'Aref Ruqaa', serif;
            font-size: 1.8rem;
            color: var(--accent-gold);
            margin-bottom: 10px;
        }

        .info-panel p {
            font-size: 1rem;
            opacity: 0.9;
            max-width: 250px;
            margin-bottom: 20px;
        }

        .quote {
            font-style: italic;
            border-right: 3px solid var(--accent-gold);
            padding-right: 15px;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        /* Left Panel: Form */
        .form-panel {
            flex: 1.2;
            padding: 40px;
        }

        .form-panel h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
            color: var(--primary-navy);
        }

        .form-panel p.subtitle {
            margin-bottom: 25px;
            color: #666;
            font-size: 0.85rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 700;
            color: var(--black);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
            background: #fafafa;
            transition: all 0.3s;
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: var(--primary-navy);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: var(--secondary-navy);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .form-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .main-container {
                flex-direction: column;
                margin-top: 120px;
            }

            .identity-bar {
                padding: 0 20px;
                height: 100px;
            }
        }
    </style>
</head>

<body>

    <div class="identity-bar">
        <div class="flag-strip">
            <div class="f-red"></div>
            <div class="f-white"></div>
            <div class="f-black"></div>
        </div>
        <div class="gov-title">
            <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Yemen Emblem" height="50">
            <div>
                <h1>الجمهورية اليمنية</h1>
                <h2 style="font-size: 0.8rem; color: var(--accent-gold);">وزارة العدل</h2>
            </div>
        </div>
        <div class="system-id" style="text-align: left;">
            <span style="font-family: 'Aref Ruqaa'; font-size: 1.2rem; color: var(--primary-navy);">JSJS Portal</span>
        </div>
    </div>

    <div class="main-container">
        <!-- Branding -->
        <div class="info-panel">
            <div class="emblem-box">
                <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Logo">
            </div>
            <h2>العدالة الذكية</h2>
            <p>بوابتكم الرقمية لمتابعة قضايا الأحوال الشخصية في المحاكم اليمنية بكل شفافية وسرعة.</p>

            <div class="quote">
                "العدل أساس الملك ورفعة الأوطان"
            </div>
        </div>

        <!-- Registration Form -->
        <div class="form-panel">
            <svg class="justice-hand" viewBox="0 0 24 24">
                <path
                    d="M21 3h-2V1h-2v2h-4V1h-2v2H7V1H5v2H3a2 2 0 00-2 2v16a2 2 0 002 2h18a2 2 0 002-2V5a2 2 0 00-2-2zm0 18H3V8h18v13zm-9-10H5v2h7v-2zm7 4H5v2h14v-2zm-7 4H5v2h7v-2z" />
            </svg>
            <h3>إنشاء حساب نظام</h3>
            <p class="subtitle">يرجى إدخال البيانات الرسمية لضمان صحة الإجراءات القانونية.</p>

            <form>
                <div class="form-group">
                    <label>الاسم الرباعي</label>
                    <input type="text" placeholder="مثال: أحمد محمد علي صالح" required>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label>الرقم الوطني</label>
                        <input type="number" placeholder="1010XXXXXXX" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>جهة القيد</label>
                        <select required>
                            <option value="">اختر المحافظة</option>
                            <option>أمانة العاصمة</option>
                            <option>عدن</option>
                            <option>تعز</option>
                            <option>حضرموت</option>
                            <option>إب</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>نوع الخدمة المطلوبة</label>
                    <select required>
                        <option value="">اختر نوع الطلب</option>
                        <option>دعوى شخصية (طلاق/خلع)</option>
                        <option>إثبات حالة اجتماعية</option>
                        <option>حصر وراثة وقسمة تركة</option>
                        <option>طلب نفقة أو حضانة</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>رقم الهاتف للتواصل</label>
                    <input type="tel" placeholder="77XXXXXXX" required>
                </div>

                <button type="submit" class="btn-register">تفعيل الحساب والتقديم</button>
            </form>

            <div class="form-footer">
                هل لديك حساب مسجل سابقاً؟ <a href="#">تسجيل الدخول للنظام</a>
            </div>
        </div>
    </div>

    <div style="color: #999; font-size: 0.8rem; margin-bottom: 20px;">
        توفره وزارة العدل - الإدارة العامة للتقانة والمعلومات
    </div>

    @include('partials.footer')
</body>

</html>