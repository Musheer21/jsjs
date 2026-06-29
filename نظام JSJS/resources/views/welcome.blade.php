<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة العدالة الذكية | الجمهورية اليمنية</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Aref+Ruqaa:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1b263b;
            --accent-gold: #c19a6b;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Amiri', serif;
        }

        body {
            background-color: var(--primary-navy);
            color: var(--white);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            overflow: hidden;
            background-image: linear-gradient(135deg, #1b263b 0%, #0d1b2a 100%);
            position: relative;
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/p6.png');
            opacity: 0.1;
            z-index: 1;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 700px;
            height: 700px;
            opacity: 0.08;
            z-index: 2;
            pointer-events: none;
            filter: grayscale(1) brightness(1.5);
            mix-blend-mode: overlay;
        }

        .emblem-container {
            width: 320px;
            height: 180px;
            margin: 0 auto 30px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 5px solid var(--accent-gold);
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        .emblem-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .logo {
            width: 120px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }


        .content {
            z-index: 10;
            max-width: 800px;
            padding: 20px;
            position: relative;
        }

        h1 {
            font-family: 'Aref Ruqaa', serif;
            font-size: 4rem;
            color: var(--accent-gold);
            margin-bottom: 20px;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        p {
            font-size: 1.6rem;
            margin-bottom: 40px;
            line-height: 1.8;
            opacity: 0.95;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .btn-start {
            display: inline-block;
            padding: 12px 45px;
            background: var(--accent-gold);
            color: #222;
            font-weight: bold;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 2px solid transparent;
        }

        .btn-start:hover {
            background: transparent;
            color: var(--accent-gold);
            border-color: var(--accent-gold);
            transform: scale(1.05);
        }

        footer {
            position: absolute;
            bottom: 30px;
            font-size: 0.9rem;
            opacity: 0.7;
            z-index: 10;
        }
    </style>
</head>

<body>

    <div class="bg-pattern"></div>
    <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Watermark" class="watermark">

    <div class="content">
        <div class="emblem-container">
            <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Emblem" class="logo">
        </div>

        <h1>نظام العدالة الذكي (JSJS)</h1>
        <p>بوابة الخدمات الإلكترونية للقضايا الشخصية والأسرية بوزارة العدل بالجمهورية اليمنية.</p>

        <a href="/login" class="btn-start">ابدأ الآن</a>
        
        <div style="margin-top: 20px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('judge.login') }}" style="color: var(--accent-gold); text-decoration: none; font-size: 0.9rem; opacity: 0.8; border: 1px solid var(--accent-gold); padding: 5px 15px; border-radius: 20px;">مدخل القضاة</a>
            <a href="{{ route('admin.login') }}" style="color: var(--accent-gold); text-decoration: none; font-size: 0.9rem; opacity: 0.8; border: 1px solid var(--accent-gold); padding: 5px 15px; border-radius: 20px;">لوحة الإدارة</a>
        </div>
    </div>


    @include('partials.footer', ['supervisor' => 'رعد الصلوي'])
</body>

</html>