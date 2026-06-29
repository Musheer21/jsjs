<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InheritanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judges = ['القاضي علي الشرعبي', 'القاضي عبدالخالق العماد', 'القاضي عبدالسلام المزاحم'];
        $statuses = ['جديدة', 'قيد النظر', 'جلسات', 'مؤجلة', 'محكومة'];

        for ($i = 1; $i <= 20; $i++) {
            $case = \App\Models\LegalCase::create([
                'case_number' => 'TAIZ-INHERIT-2026-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'case_type' => 'قسمة تركة',
                'facts' => 'تفاصيل القضية رقم ' . $i . ' (قسمة تركة): نزاع حول حصر وتقسيم المواريث الشرعية للورثة وتوزيع الأملاك والمنافع حسب الأنصبة المحددة.',
                'legal_reasons' => ['قانون الأحوال الشخصية ج2', 'المادة (300)'],
                'status' => $statuses[array_rand($statuses)],
                'judge_name' => $judges[array_rand($judges)],
            ]);

            // Create Plaintiff 
            \App\Models\Party::create([
                'case_id' => $case->id,
                'type' => 'مدعي',
                'full_name' => 'ورثة ' . $this->getRandomName(),
                'phone' => '77' . rand(1000000, 9999999),
                'address' => 'تعز - ' . $this->getRandomDistrict(),
            ]);

            // Create Defendant 
            \App\Models\Party::create([
                'case_id' => $case->id,
                'type' => 'مدعى عليه',
                'full_name' => 'بقية الورثة (' . $this->getRandomName() . ')',
                'phone' => '73' . rand(1000000, 9999999),
                'address' => 'تعز - ' . $this->getRandomDistrict(),
            ]);
        }
    }

    private function getRandomName()
    {
        $names = ['سعيد المقطري', 'حمود الصالحي', 'عبدالجبار النهمي', 'فؤاد اليوسفي', 'عمران القدسي', 'فارس المخلافي', 'زيدان الشيباني', 'حاتم المعمري', 'ياسين الأصبحي'];
        return $names[array_rand($names)];
    }

    private function getRandomDistrict()
    {
        $districts = ['المظفر', 'القاهرة', 'صالة', 'الحوبان', 'المخاء', 'التربة', 'المواسط', 'الشمايتين'];
        return $districts[array_rand($districts)];
    }
}
