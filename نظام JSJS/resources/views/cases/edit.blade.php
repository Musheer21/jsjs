<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل القضية | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #1b263b; --secondary: #0d1b2a; --accent: #c19a6b; --white: #ffffff; --gray: #f4f4f4; --border: #e0e0e0; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Amiri', serif; }
        body { background: var(--gray); padding-bottom: 50px; }
        .navbar { background: var(--primary); padding: 10px 5%; color: white; display: flex; justify-content: space-between; align-items: center; }
        .form-container { max-width: 900px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
        .section-title { font-size: 1.3rem; color: var(--primary); border-bottom: 2px solid var(--accent); display: inline-block; margin-bottom: 20px; padding-bottom: 5px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px; }
        .full-width { grid-column: span 2; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 0.85rem; color: #444; }
        input, select, textarea { width: 100%; padding: 8px 12px; border: 1px solid var(--border); border-radius: 6px; outline: none; font-size: 0.9rem; }
        .btn-submit { background: var(--primary); color: white; border: none; padding: 12px 40px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 1rem; width: 100%; }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>تعديل ملف القضية رقم: {{ $case->case_number }}</h2>
        <a href="{{ route('cases.index') }}" style="color: var(--accent); text-decoration: none;">رجوع</a>
    </div>

    <div class="form-container">
        <form id="editForm">
            @csrf
            @method('PUT')
            
            <h3 class="section-title">بيانات القضية الأساسية</h3>
            <div class="grid">
                <div>
                    <label>نوع القضية</label>
                    <input type="text" id="case_type" value="{{ $case->case_type }}">
                </div>
                <div>
                    <label>حالة القضية</label>
                    <select id="status">
                        <option value="جديدة" {{ $case->status == 'جديدة' ? 'selected' : '' }}>جديدة</option>
                        <option value="قيد النظر" {{ $case->status == 'قيد النظر' ? 'selected' : '' }}>قيد النظر</option>
                        <option value="محكومة" {{ $case->status == 'محكومة' ? 'selected' : '' }}>محكومة</option>
                    </select>
                </div>
                <div class="full-width">
                    <label>الوقائع</label>
                    <textarea id="facts" rows="5">{{ $case->facts }}</textarea>
                </div>
            </div>

            <h3 class="section-title">أطراف الدعوى</h3>
            <div class="grid">
                @foreach($case->parties as $index => $party)
                <div class="full-width">
                    <label>{{ $party->type }}</label>
                    <input type="hidden" class="party-type" value="{{ $party->type }}">
                    <input type="text" class="party-name" value="{{ $party->full_name }}" placeholder="الاسم">
                    <input type="text" class="party-phone" value="{{ $party->phone }}" placeholder="الهاتف" style="margin-top:5px;">
                </div>
                @endforeach
            </div>
            <h3 class="section-title">المرفقات والوثائق القضائية</h3>
            <div class="grid" style="background: #fdf2e9; padding: 15px; border-radius: 8px;">
                <div class="full-width">
                    <label>ملف الـ PDF المرفق حالياً</label>
                    @if($case->attachment_path)
                        <div style="margin-bottom: 10px;">
                            <a href="{{ asset('storage/' . $case->attachment_path) }}" target="_blank" style="color: #1565c0; font-weight: bold; text-decoration: none;">⬇️ عرض/تحميل الملف المرفق</a>
                        </div>
                    @else
                        <p style="color: #888; font-size: 0.9rem;">لا يوجد ملف مرفق حالياً</p>
                    @endif
                    <label style="margin-top: 10px;">تحديث ملف PDF (سيستبدل القديم)</label>
                    <input type="file" id="pdf_attachment" accept=".pdf">
                </div>
                <div class="full-width">
                    <label>محتوى أو ملخص ملف الـ PDF</label>
                    <textarea id="attachment_content" rows="4" placeholder="خلاصة الوثيقة المرفقة...">{{ $case->attachment_content }}</textarea>
                </div>
            </div>

            <button type="button" class="btn-submit" onclick="submitEdit()">حفظ التعديلات</button>
        </form>
    </div>

    <script>
        function submitEdit() {
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('case_type', document.getElementById('case_type').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('facts', document.getElementById('facts').value);
            formData.append('attachment_content', document.getElementById('attachment_content').value);

            document.querySelectorAll('.party-name').forEach((input, i) => {
                formData.append(`parties[${i}][type]`, document.querySelectorAll('.party-type')[i].value);
                formData.append(`parties[${i}][full_name]`, input.value);
                formData.append(`parties[${i}][phone]`, document.querySelectorAll('.party-phone')[i].value);
            });

            const pdfFile = document.getElementById('pdf_attachment').files[0];
            if (pdfFile) {
                formData.append('pdf_attachment', pdfFile);
            }

            fetch('{{ route("cases.update", $case->id) }}', {
                method: 'POST', // Use POST with _method=PUT for file uploads
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    alert(data.message);
                    location.reload();
                }
            });
        }
    </script>
    @include('partials.footer')
</body>
</html>
