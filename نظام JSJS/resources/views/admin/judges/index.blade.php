<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة القضاة | لوحة الإدارة</title>
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
            background: linear-gradient(135deg, var(--primary), #0d1b2a);
            padding: 15px 5%;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar h2 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar h2 .material-icons {
            background: linear-gradient(135deg, var(--accent), #8b6914);
            padding: 6px;
            border-radius: 8px;
            font-size: 22px;
        }

        .nav-btn {
            color: white;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 6px 16px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: transparent;
            cursor: pointer;
            font-family: 'Amiri', serif;
        }

        .nav-btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #000;
        }

        .nav-btn.active-tab {
            background: var(--accent);
            border-color: var(--accent);
            color: #000;
        }

        .nav-btn-danger:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .container {
            max-width: 1050px;
            margin: 30px auto;
            padding: 20px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon .material-icons {
            font-size: 26px;
            color: white;
        }

        .stat-info h4 { color: #999; font-size: 0.85rem; font-weight: normal; }
        .stat-info h2 { color: var(--primary); font-size: 1.6rem; }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-actions h3 {
            color: var(--primary);
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Amiri', serif;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--success), #43a047);
            color: white;
            box-shadow: 0 4px 12px rgba(46,125,50,0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46,125,50,0.4);
        }

        .btn-edit {
            background: #e3f2fd;
            color: var(--info);
            border: 1px solid var(--info);
            padding: 5px 12px;
            font-size: 0.8rem;
        }

        .btn-edit:hover { background: var(--info); color: white; }

        .btn-delete {
            background: #ffebee;
            color: var(--danger);
            border: 1px solid var(--danger);
            padding: 5px 12px;
            font-size: 0.8rem;
        }

        .btn-delete:hover { background: var(--danger); color: white; }

        .alert-success {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: var(--success);
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-right: 5px solid var(--success);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            background: var(--primary);
            color: white;
            padding: 14px 16px;
            text-align: right;
            font-size: 0.95rem;
        }

        td {
            padding: 13px 16px;
            border-bottom: 1px solid #f0f0f0;
            text-align: right;
            font-size: 0.95rem;
        }

        tr:hover td { background: #fafafa; }
        tr:last-child td { border-bottom: none; }

        .judge-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5c6bc0, #3949ab);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        .judge-cell {
            display: flex;
            align-items: center;
        }

        .actions-cell {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .badge {
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: bold;
        }

        .badge-active {
            background: rgba(46,125,50,0.12);
            color: var(--success);
        }

        .badge-inactive {
            background: rgba(198,40,40,0.12);
            color: var(--danger);
        }

        .badge-court {
            background: rgba(21,101,192,0.1);
            color: var(--info);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state .material-icons {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>
            <span class="material-icons">admin_panel_settings</span>
            لوحة الإدارة
        </h2>
        <div class="navbar-right">
            <a href="{{ route('admin.users.index') }}" class="nav-btn">
                <span class="material-icons" style="font-size: 16px;">people</span>
                المستخدمين
            </a>
            <a href="{{ route('admin.judges.index') }}" class="nav-btn active-tab">
                <span class="material-icons" style="font-size: 16px;">gavel</span>
                القضاة
            </a>
            <a href="{{ route('welcome') }}" class="nav-btn">
                <span class="material-icons" style="font-size: 16px;">home</span>
                الرئيسية
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-btn nav-btn-danger">
                    <span class="material-icons" style="font-size: 16px;">logout</span>
                    خروج
                </button>
            </form>
        </div>
    </div>

    <div class="container">
        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #5c6bc0, #3949ab);">
                    <span class="material-icons">gavel</span>
                </div>
                <div class="stat-info">
                    <h4>إجمالي القضاة</h4>
                    <h2>{{ $judges->count() }}</h2>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--success), #43a047);">
                    <span class="material-icons">check_circle</span>
                </div>
                <div class="stat-info">
                    <h4>القضاة النشطين</h4>
                    <h2>{{ $judges->where('status', 'نشط')->count() }}</h2>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, var(--accent), #8b6914);">
                    <span class="material-icons">account_balance</span>
                </div>
                <div class="stat-info">
                    <h4>المحاكم المغطاة</h4>
                    <h2>{{ $judges->whereNotNull('court')->unique('court')->count() }}</h2>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <span class="material-icons">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="header-actions">
            <h3>
                <span class="material-icons" style="color: #5c6bc0;">gavel</span>
                إدارة القضاة
            </h3>
            <a href="{{ route('admin.judges.create') }}" class="btn btn-add">
                <span class="material-icons" style="font-size: 18px;">person_add</span>
                إضافة قاضي جديد
            </a>
        </div>

        <div class="card">
            @if($judges->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>التخصص</th>
                        <th>المحكمة</th>
                        <th>الهاتف</th>
                        <th>الحالة</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($judges as $index => $judge)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="judge-cell">
                                <span class="judge-avatar">{{ mb_substr($judge->name, 0, 1) }}</span>
                                {{ $judge->name }}
                            </div>
                        </td>
                        <td>{{ $judge->specialization ?? '—' }}</td>
                        <td>
                            @if($judge->court)
                                <span class="badge badge-court">{{ $judge->court }}</span>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $judge->phone ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $judge->status === 'نشط' ? 'badge-active' : 'badge-inactive' }}">
                                {{ $judge->status }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('admin.judges.edit', $judge->id) }}" class="btn btn-edit">
                                    <span class="material-icons" style="font-size: 16px;">edit</span>
                                    تعديل
                                </a>
                                <form action="{{ route('admin.judges.destroy', $judge->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('هل أنت متأكد من حذف هذا القاضي؟')">
                                        <span class="material-icons" style="font-size: 16px;">delete</span>
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <span class="material-icons">gavel</span>
                <p>لا يوجد قضاة مسجلين حالياً</p>
                <a href="{{ route('admin.judges.create') }}" style="color: var(--info); margin-top: 10px; display: inline-block;">إضافة أول قاضي</a>
            </div>
            @endif
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
