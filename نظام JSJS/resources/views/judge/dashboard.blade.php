<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم القضاة | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-navy: #1b263b;
            --judge-purple: #4a4e69;
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

        header {
            background: var(--judge-purple);
            color: white;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-bottom: 4px solid var(--accent-gold);
        }

        .stat-card h3 {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--judge-purple);
        }

        /* Cases Table */
        .table-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .table-container h2 {
            margin-bottom: 25px;
            color: var(--judge-purple);
            border-right: 5px solid var(--accent-gold);
            padding-right: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #fdfdfd;
            font-weight: bold;
            color: #555;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .status-pending {
            background: #fff3e0;
            color: #ef6c00;
        }

        .status-active {
            background: #e3f2fd;
            color: #1565c0;
        }

        .status-closed {
            background: #e8f5e9;
            color: #2e7d32;
        }

        /* AI Insights Section */
        .ai-analysis-container {
            background: linear-gradient(135deg, #1b263b, #4a4e69);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(74, 78, 105, 0.2);
            position: relative;
            overflow: hidden;
        }

        .ai-analysis-container::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(193, 154, 107, 0.05) 0%, transparent 60%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .ai-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 15px;
        }

        .ai-pulse {
            width: 12px;
            height: 12px;
            background: #4caf50;
            border-radius: 50%;
            box-shadow: 0 0 10px #4caf50;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse { 0% { opacity: 0.5; } 50% { opacity: 1; transform: scale(1.2); } 100% { opacity: 0.5; } }

        .insight-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .insight-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 10px;
            border-right: 4px solid var(--accent-gold);
            transition: transform 0.3s ease;
        }

        .insight-item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
        }

        .insight-item h4 {
            color: var(--accent-gold);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .insight-item p {
            font-size: 0.9rem;
            line-height: 1.6;
            opacity: 0.9;
        }
        .analytics-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .chart-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .bar-chart {
            display: flex;
            align-items: flex-end;
            gap: 20px;
            height: 150px;
            margin-top: 20px;
        }

        .bar {
            width: 30px;
            background: var(--judge-purple);
            border-radius: 5px 5px 0 0;
            position: relative;
        }

        .bar::after {
            content: attr(data-label);
            position: absolute;
            bottom: -25px;
            right: 0;
            font-size: 0.75rem;
            width: 60px;
        }
    </style>
</head>

<body>
    <header>
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Logo" style="height: 40px; border-radius: 50%;">
            <h1>لوحة تحليل البيانات القضائية</h1>
        </div>
        <form action="{{ route('judge.logout') }}" method="POST">
            @csrf
            <button type="submit" style="background: none; border: 1px solid white; color: white; padding: 5px 15px; border-radius: 5px; cursor: pointer;">خروج</button>
        </form>
    </header>

    <div class="container">
        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>إجمالي القضايا</h3>
                <div class="value">{{ $totalCases }}</div>
            </div>
            <div class="stat-card">
                <h3>قضايا قيد النظر</h3>
                <div class="value">{{ $pendingCases }}</div>
            </div>
            <div class="stat-card">
                <h3>قضايا محكومة</h3>
                <div class="value">{{ $closedCases }}</div>
            </div>
            <div class="stat-card">
                <h3>متوسط مدة الفصل</h3>
                <div class="value">{{ $averageResolutionTime }}</div>
            </div>
        </div>

        <!-- Analytics charts mockup -->
        <div class="analytics-section">
            <div class="chart-box">
                <h3 style="margin-bottom: 20px;">تصنيف القضايا حسب النوع</h3>
                <div class="bar-chart">
                    @foreach($casesByType as $type)
                        <div class="bar" style="height: {{ ($type->total / max($totalCases, 1)) * 100 }}%;" data-label="{{ $type->case_type }}"></div>
                    @endforeach
                </div>
            </div>
            <div class="chart-box">
                <h3 style="margin-bottom: 20px;">توزيع القضايا على القضاة</h3>
                <table style="width: 100%; font-size: 0.9rem;">
                    @forelse($casesByJudge as $judge)
                    <tr>
                        <td>{{ $judge->judge_name }}</td>
                        <td>{{ $judge->total }} قضية</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">لا يوجد بيانات توزيع</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>

        <!-- AI Analytical Insights Section -->
        <div class="ai-analysis-container">
            <div class="ai-header">
                <div class="ai-pulse"></div>
                <h2 style="font-size: 1.5rem; margin: 0;">مركز التحليل الذكي للذكاء الاصطناعي (AI Analysis Unit)</h2>
            </div>
            <div class="insight-grid">
                @forelse($aiInsights as $insight)
                <div class="insight-item">
                    <h4>{{ $insight['title'] }}</h4>
                    <p>{{ $insight['text'] }}</p>
                </div>
                @empty
                <div class="insight-item">
                    <h4>جاري التحليل...</h4>
                    <p>قم بإضافة قضايا لتمكين المحرك الذكي من تحليل البيانات.</p>
                </div>
                @endforelse
            </div>
        </div>


        <!-- Cases View -->
        <div class="table-container">
            <h2>سجل القضايا التفصيلي</h2>
            <table>
                <thead>
                    <tr>
                        <th>رقم القضية</th>
                        <th>نوع القضية</th>
                        <th>القاضي المشرف</th>
                        <th>تاريخ القيد</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allCases as $case)
                    <tr>
                        <td>{{ $case->case_number }}</td>
                        <td>{{ $case->case_type }}</td>
                        <td>{{ $case->judge_name ?? 'غير محدد' }}</td>
                        <td>{{ $case->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($case->status == 'جديدة')
                                <span class="status-badge status-pending">جديدة</span>
                            @elseif($case->status == 'قيد النظر')
                                <span class="status-badge status-active">قيد النظر</span>
                            @else
                                <span class="status-badge status-closed">{{ $case->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('cases.edit', $case->id) }}" class="btn-action" style="background:#e3f2fd; color:#1565c0; padding:4px 10px; border-radius:4px; text-decoration:none; font-size:0.8rem;">تعديل/اطلاع</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">لا توجد قضايا مسجلة حالياً</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('partials.footer')
</body>

</html>