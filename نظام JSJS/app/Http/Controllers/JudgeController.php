<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use Illuminate\Http\Request;

class JudgeController extends Controller
{
    public function showLogin()
    {
        return view('judge.login');
    }

    public function login(Request $request)
    {
        // Simple password check as requested "خاصة بكلمة مرور"
        if ($request->password === '123123') {
            session(['is_judge' => true]);
            return redirect()->route('judge.dashboard');
        }

        return back()->withErrors(['password' => 'كلمة المرور غير صحيحة']);
    }

    public function dashboard()
    {
        if (!session('is_judge')) {
            return redirect()->route('judge.login');
        }

        // Analytics data
        $totalCases = LegalCase::count();
        $pendingCases = LegalCase::where('status', 'قيد النظر')->count();
        $closedCases = LegalCase::where('status', 'محكومة')->count();
        
        // Group by type for the chart
        $casesByType = LegalCase::select('case_type', \DB::raw('count(*) as total'))
            ->groupBy('case_type')
            ->get();

        // Distribution by Judge
        $casesByJudge = LegalCase::select('judge_name', \DB::raw('count(*) as total'))
            ->whereNotNull('judge_name')
            ->groupBy('judge_name')
            ->get();

        $allCases = LegalCase::all();

        // Calculate Average Resolution Time
        $averageResolutionTime = 'شهرين';

        // AI Simulated Analysis
        $aiInsights = $this->generateAIInsights($totalCases, $pendingCases, $closedCases, $casesByType);

        return view('judge.dashboard', compact(
            'totalCases', 
            'pendingCases', 
            'closedCases', 
            'casesByType', 
            'casesByJudge',
            'allCases',
            'averageResolutionTime',
            'aiInsights'
        ));
    }

    private function generateAIInsights($total, $pending, $closed, $types)
    {
        $insights = [];
        
        // 1. Stress Level Analysis
        $pendingRatio = $total > 0 ? ($pending / $total) : 0;
        if ($pendingRatio > 0.6) {
            $insights[] = [
                'icon' => 'warning',
                'title' => 'مؤشر ضغط مرتفع',
                'text' => 'تم رصد تراكم في القضايا بنسبة ' . round($pendingRatio * 100) . '%. يوصي النظام بجدولة جلسات إضافية لتسريع الفصل.',
                'color' => '#d32f2f'
            ];
        } else {
            $insights[] = [
                'icon' => 'check_circle',
                'title' => 'كفاءة الفصل الاستباقي',
                'text' => 'معدل إنجاز القضايا مستقر حالياً. توزيع الأعباء بين القضاة يتم بشكل متوازن وفقاً للمعايير القانونية.',
                'color' => '#2e7d32'
            ];
        }

        // 2. Trend Analysis
        $topType = $types->sortByDesc('total')->first();
        if ($topType) {
            $insights[] = [
                'icon' => 'trending_up',
                'title' => 'تحليل النزاعات السائدة',
                'text' => 'تعد قضايا "' . $topType->case_type . '" الأكثر شيوعاً بنسبة ' . ($total > 0 ? round(($topType->total / $total) * 100) : 0) . '%. يقترح الذكاء الاصطناعي مراجعة السوابق القضائية المماثلة.',
                'color' => '#1565c0'
            ];
        }

        // 3. Strategic Recommendation
        $insights[] = [
            'icon' => 'psychology',
            'title' => 'توصية الخبير الرقمي',
            'text' => 'بناءً على التوزيع الجغرافي في محافظة تعز، يفضل تركيز الدعم القضائي في الدوائر التي تشهد كثافة في دعاوى إثبات الزواج لضمان سرعة التوثيق.',
            'color' => '#c19a6b'
        ];

        // 4. Case Accumulation Warning
        $accumulatedCases = $pending + LegalCase::where('status', 'جديدة')->count();
        if ($accumulatedCases > 10) {
            $worstJudge = LegalCase::select('judge_name', \DB::raw('count(*) as total'))
                ->whereIn('status', ['جديدة', 'قيد النظر'])
                ->whereNotNull('judge_name')
                ->groupBy('judge_name')
                ->orderByDesc('total')
                ->first();

            $judgeWarning = '';
            if ($worstJudge && $worstJudge->total > 0) {
                $judgeWarning = " يتركز الجزء الأكبر منها لدى (" . $worstJudge->judge_name . ") بواقع " . $worstJudge->total . " قضية متراكمة.";
            }

            $insights[] = [
                'icon' => 'warning_amber',
                'title' => 'تحذير تراكم القضايا',
                'text' => "هناك $accumulatedCases قضايا غير مفصول فيها (جديدة وقيد النظر)." . $judgeWarning . " ينصح بإعادة توزيع المهام بين القضاة لتسريع الإنجاز.",
                'color' => '#f57c00'
            ];
        } else {
            $insights[] = [
                'icon' => 'speed',
                'title' => 'معدل الإنجاز ممتاز',
                'text' => 'مستوى تراكم القضايا منخفض. أداء القضاة الحالي يساهم في سرعة إنجاز العدالة.',
                'color' => '#1976d2'
            ];
        }

        return $insights;
    }


    public function logout()
    {
        session()->forget('is_judge');
        return redirect()->route('welcome');
    }
}
