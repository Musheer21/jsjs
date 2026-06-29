<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم الإدارية | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1b263b;
            --accent-gold: #c19a6b;
            --white: #ffffff;
            --light-bg: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Amiri', serif;
        }

        body {
            background: var(--light-bg);
            color: #333;
        }

        /* Header */
        header {
            background: var(--primary-navy);
            color: white;
            padding: 10px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header-identity {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-identity img {
            height: 40px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-btn {
            color: white;
            text-decoration: none;
            border: 1px solid var(--accent-gold);
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            transition: 0.3s;
            background: transparent;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: var(--accent-gold);
            color: #000;
        }

        /* Main Content */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        /* Search Box */
        .search-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            text-align: center;
        }

        .search-container h2 {
            color: var(--primary-navy);
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .search-box {
            display: flex;
            gap: 10px;
            max-width: 500px;
            margin: 0 auto;
        }

        .search-box input {
            flex: 1;
            padding: 8px 15px;
            border: 2px solid #eee;
            border-radius: 30px;
            font-size: 1rem;
            outline: none;
            transition: 0.3s;
        }

        .search-box input:focus {
            border-color: var(--accent-gold);
        }

        .search-btn {
            background: var(--accent-gold);
            border: none;
            padding: 0 20px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Action Buttons */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .action-card {
            background: white;
            padding: 20px 10px;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            color: var(--primary-navy);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            border: 1px solid transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .action-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .action-card svg {
            width: 40px;
            height: 40px;
            fill: var(--accent-gold);
        }

        .action-card span {
            font-size: 1.1rem;
            font-weight: bold;
        }

        /* Icons specifically */
        .icon-add {
            fill: #2e7d32;
        }

        .icon-edit {
            fill: #1976d2;
        }

        .icon-delete {
            fill: #d32f2f;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-identity">
            <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Logo">
            <div>
                <h1 style="font-size: 1.4rem;">الجمهورية اليمنية</h1>
                <p style="font-size: 0.8rem; color: var(--accent-gold);">وزارة العدل - نظام JSJS</p>
            </div>
        </div>

        <div class="user-info">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">تسجيل الخروج</button>
            </form>
        </div>
    </header>

    <div class="container">
        <!-- Inquiry Section -->
        <div class="search-container">
            <h2>الاستعلام عن القضايا</h2>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="أدخل رقم القضية أو اسم الخصم...">
                <button class="search-btn" onclick="searchCases()">بحث</button>
            </div>
        </div>

        <script>
            function searchCases() {
                const query = document.getElementById('searchInput').value;
                window.location.href = '{{ route("cases.index") }}?query=' + query;
            }
        </script>


        <!-- Main Actions -->
        <div class="actions-grid">
            <!-- Add -->
            <a href="{{ route('cases.create') }}" class="action-card">
                <svg viewBox="0 0 24 24">
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
                <span>إضافة قضية</span>
            </a>

            <!-- Edit -->
            <a href="{{ route('cases.index') }}" class="action-card">
                <svg viewBox="0 0 24 24">
                    <path
                        d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                </svg>
                <span>تعديل قضية</span>
            </a>

            <!-- Delete -->
            <a href="{{ route('cases.index') }}" class="action-card" style="border-bottom: 4px solid #d32f2f;">
                <svg viewBox="0 0 24 24" style="fill: #d32f2f;">
                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                </svg>
                <span>حذف قضية</span>
            </a>

        </div>
    </div>

    @include('partials.footer')
</body>

</html>