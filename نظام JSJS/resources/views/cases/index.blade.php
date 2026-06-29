<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة القضايا | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #1b263b; --accent: #c19a6b; --white: #ffffff; --gray: #f4f4f4; }
        body { font-family: 'Amiri', serif; background: var(--gray); margin: 0; padding: 0; }
        .navbar { background: var(--primary); padding: 15px 5%; color: white; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1000px; margin: 30px auto; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: right; }
        th { background: #fafafa; }
        .btn { padding: 5px 15px; border-radius: 4px; text-decoration: none; font-size: 0.8rem; font-weight: bold; cursor: pointer; }
        .btn-edit { background: #e3f2fd; color: #1565c0; border: 1px solid #1565c0; }
        .btn-delete { background: #ffebee; color: #c62828; border: 1px solid #c62828; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>إدارة القضايا الرقمية</h2>
        <a href="{{ route('dashboard') }}" style="color: var(--accent); text-decoration: none;">العودة للوحة التحكم</a>
    </div>

    <div class="container">
        @if(session('success'))
            <div style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif
        <h3>قائمة القضايا المسجلة</h3>
        <table>
            <thead>
                <tr>
                    <th>رقم القضية</th>
                    <th>نوع القضية</th>
                    <th>الحالة</th>
                    <th>تاريخ صدور القضية</th>
                    <th>تاريخ الانتهاء</th>
                    <th>تاريخ آخر تعديل</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cases as $case)
                <tr>
                    <td>{{ $case->case_number }}</td>
                    <td>{{ $case->case_type }}</td>
                    <td>{{ $case->status }}</td>
                    <td>{{ $case->created_at ? $case->created_at->format('Y-m-d') : 'غير محدد' }}</td>
                    <td>
                        @if($case->status == 'محكومة')
                            {{ $case->updated_at ? $case->updated_at->format('Y-m-d') : 'غير محدد' }}
                        @else
                            <span style="color: gray;">لم تنتهِ بعد</span>
                        @endif
                    </td>
                    <td><span dir="ltr">{{ $case->updated_at ? $case->updated_at->format('Y-m-d H:i') : 'غير محدد' }}</span></td>
                    <td>
                        <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-edit">تعديل</a>
                        <form action="{{ route('cases.destroy', $case->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @include('partials.footer')
</body>
</html>
