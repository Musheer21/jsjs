<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judges = ['القاضي علي الشرعبي', 'القاضي عبدالخالق العماد', 'القاضي عبدالسلام المزاحم'];
        $caseTypes = [
            'فسخ للكراهة', 'فسخ للهجر', 'إثبات زواج', 'نفقة زوجية', 'حضانة', 
            'رؤية محضون', 'فسخ لعدم الإنفاق', 'إثبات طلاق', 'فسخ للعلة', 'قسمة تركة'
        ];
        $statuses = ['جديدة', 'قيد النظر', 'جلسات', 'محكومة', 'مؤجلة'];

        for ($i = 1; $i <= 15; $i++) {
            $case = \App\Models\LegalCase::create([
                'case_number' => 'TAIZ-2026-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'case_type' => $caseTypes[array_rand($caseTypes)],
                'facts' => 'تفاصيل القضية رقم ' . $i . ': نزاع قانوني يتطلب الفصل القضائي بناءً على الأدلة المقدمة.',
                'legal_reasons' => ['المادة 50', 'المادة 54'],
                'status' => $statuses[array_rand($statuses)],
                'judge_name' => $judges[array_rand($judges)],
            ]);

            // Create Plaintiff
            \App\Models\Party::create([
                'case_id' => $case->id,
                'type' => 'مدعي',
                'full_name' => 'المدعي ' . $this->getRandomName(),
                'phone' => '77' . rand(1000000, 9999999),
                'address' => 'تعز - ' . $this->getRandomDistrict(),
            ]);

            // Create Defendant
            \App\Models\Party::create([
                'case_id' => $case->id,
                'type' => 'مدعى عليه',
                'full_name' => 'المدعى عليه ' . $this->getRandomName(),
                'phone' => '73' . rand(1000000, 9999999),
                'address' => 'تعز - ' . $this->getRandomDistrict(),
            ]);

            // Randomly add marriage details for relevant cases
            if (in_array($case->case_type, ['فسخ للكراهة', 'فسخ للهجر', 'إثبات زواج', 'نفقة زوجية'])) {
                \App\Models\MarriageDetail::create([
                    'case_id' => $case->id,
                    'contract_date' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                    'document_number' => 'DOC-' . rand(1000, 9999),
                    'authority' => 'محكمة غرب تعز',
                    'dowry' => rand(500000, 2000000),
                ]);
            }
        }
    }

    private function getRandomName()
    {
        $names = ['علي', 'محمد', 'عبدالله', 'سعيد', 'فاطمة', 'عائشة', 'ليلى', 'حسن', 'حسين', 'خالد'];
        return $names[array_rand($names)] . ' ' . $names[array_rand($names)];
    }

    private function getRandomDistrict()
    {
        $districts = ['المظفر', 'القاهرة', 'صالة', 'الحوبان', 'المخاء', 'التربة'];
        return $districts[array_rand($districts)];
    }
}
