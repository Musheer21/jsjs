<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين | JSJS</title>
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
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-actions h3 {
            color: var(--primary);
            font-size: 1.5rem;
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
            gap: 5px;
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

        .btn-edit:hover {
            background: var(--info);
            color: white;
        }

        .btn-delete {
            background: #ffebee;
            color: var(--danger);
            border: 1px solid var(--danger);
            padding: 5px 12px;
            font-size: 0.8rem;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
        }

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

        table {
            width: 100%;
            border-collapse: collapse;
        }

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

        tr:hover td {
            background: #fafafa;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.85rem;
            margin-left: 10px;
        }

        .user-cell {
            display: flex;
            align-items: center;
        }

        .actions-cell {
            display: flex;
            gap: 8px;
            align-items: center;
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

        .badge {
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .badge-user {
            background: #e3f2fd;
            color: var(--info);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>
            <span class="material-icons">people</span>
            إدارة المستخدمين
        </h2>
        <a href="{{ route('dashboard') }}">العودة للوحة التحكم</a>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert-success">
                <span class="material-icons">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="header-actions">
            <h3>قائمة المستخدمين المسجلين</h3>
            <a href="{{ route('users.create') }}" class="btn btn-add">
                <span class="material-icons" style="font-size: 18px;">person_add</span>
                إضافة مستخدم جديد
            </a>
        </div>

        <div class="card">
            @if($users->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>اسم المستخدم</th>
                        <th>تاريخ الإنشاء</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="user-cell">
                                <span class="user-avatar">{{ mb_substr($user->name, 0, 1) }}</span>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td><span class="badge badge-user">{{ $user->username }}</span></td>
                        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : 'غير محدد' }}</td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">
                                    <span class="material-icons" style="font-size: 16px;">edit</span>
                                    تعديل
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
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
                <span class="material-icons">person_off</span>
                <p>لا يوجد مستخدمين مسجلين حالياً</p>
            </div>
            @endif
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
