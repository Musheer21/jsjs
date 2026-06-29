<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة قضية جديدة | JSJS</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1b263b;
            --secondary: #0d1b2a;
            --accent: #c19a6b;
            --white: #ffffff;
            --gray: #f4f4f4;
            --border: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Amiri', serif;
        }

        body {
            background: var(--gray);
            padding-bottom: 50px;
        }

        .navbar {
            background: var(--primary);
            padding: 10px 5%;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .form-container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .step-indicator {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            position: relative;
        }

        .step {
            background: white;
            border: 2px solid var(--border);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
            z-index: 2;
            position: relative;
        }

        .step.active {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
        }

        .step-indicator::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 10%;
            right: 10%;
            height: 2px;
            background: var(--border);
            z-index: 1;
        }

        .section-title {
            font-size: 1.3rem;
            color: var(--primary);
            border-bottom: 2px solid var(--accent);
            display: inline-block;
            margin-bottom: 20px;
            padding-bottom: 5px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .full-width {
            grid-column: span 2;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 0.85rem;
            color: #444;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            outline: none;
            font-size: 0.9rem;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--accent);
            background: rgba(193, 154, 107, 0.02);
        }

        /* Dynamic Table */
        .dynamic-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .dynamic-table th,
        .dynamic-table td {
            padding: 8px;
            border: 1px solid var(--border);
            text-align: right;
            font-size: 0.9rem;
        }

        .dynamic-table th {
            background: var(--gray);
        }

        .add-row {
            background: var(--accent);
            color: white;
            border: none;
            padding: 4px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
            font-size: 0.8rem;
        }

        /* Phases Control */
        .phase {
            display: none;
        }

        .phase.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Multi-selection styles */
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 5px;
            background: var(--gray);
            padding: 5px 12px;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.8rem;
        }

        .checkbox-item:hover {
            background: #eee;
        }

        .checkbox-item input {
            width: auto;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn-prev {
            background: #999;
            color: white;
            border: none;
            padding: 8px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-next,
        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 30px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        /* AI Floating Label */
        .ai-assist {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 8px;
            border-right: 4px solid #1976d2;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div style="display: flex; align-items: center; gap: 15px;">
            <img src="{{ asset('assets/images/picshar.jpg') }}" alt="Eagle" style="height: 35px;">
            <h2 style="margin: 0; font-size: 1.3rem;">إضافة ملف قضية رقمية</h2>
        </div>
        <a href="{{ route('dashboard') }}" class="back-link">العودة للوحة التحكم</a>
    </div>

    <div class="form-container">

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" id="s1">1</div>
            <div class="step" id="s2">2</div>
            <div class="step" id="s3">3</div>
        </div>

        <form id="caseForm">

            <!-- Phase 1: Selection & Court Info -->
            <div class="phase active" id="phase1">
                <h3 class="section-title">بيانات المحكمة والمسار</h3>
                <div class="grid">
                    <div>
                        <label>المحكمة المختصة</label>
                        <select id="courtName" required>
                            <option value="">-- اختر المحكمة --</option>
                            <option>محكمة غرب تعز الابتدائية</option>
                            <option>محكمة شرق تعز الابتدائية</option>
                            <option>محكمة صبر الموادم</option>
                            <option>محكمة جبل حبشي</option>
                            <option>محكمة المسراخ</option>
                            <option>محكمة المعافر</option>
                            <option>محكمة المواسط والشمايتين</option>
                            <option>أخرى</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>نوع القضية (التصنيف القانوني)</label>
                    <select id="caseType" onchange="toggleFormFields()">
                        <option value="">-- اختر نوع القضية --</option>
                        <option value="hate">فسخ للكراهة (المادة 50)</option>
                        <option value="desertion">فسخ للهجر والغياب (المادة 54)</option>
                        <option value="maintenance">فسخ لعدم الإنفاق (المادة 59)</option>
                        <option value="marriage_proof">إثبات زواج</option>
                        <option value="custody">حضانة ونفقة</option>
                    </select>
                </div>
                <div class="btn-group" style="justify-content: flex-end;">
                    <button type="button" class="btn-next" onclick="goToPhase(2)">المتابعة لبيانات الأطراف</button>
                </div>
            </div>

            <!-- Phase 2: Parties Details -->
            <div class="phase" id="phase2">

                <!-- 1. Plaintiff (المدعي/المدعية) -->
                <h3 class="section-title">بيانات المدعي / المدعية (مقدم الطلب)</h3>
                <div class="grid">
                    <div class="full-width">
                        <label>الاسم الكامل (وفقاً للهوية)</label>
                        <input type="text" placeholder="الاسم الرباعي واللقب">
                    </div>
                    <div>
                        <label>نوع الهوية</label>
                        <select>
                            <option>بطاقة شخصية (رقم وطني)</option>
                            <option>جواز سفر</option>
                            <option>بطاقة عائلية</option>
                        </select>
                    </div>
                    <div>
                        <label>رقم الهوية</label>
                        <input type="number" placeholder="101xxxxxxxx">
                    </div>
                    <div>
                        <label>رقم الهاتف</label>
                        <input type="tel" placeholder="77xxxxxxx">
                    </div>
                    <div>
                        <label>المهنة</label>
                        <input type="text" placeholder="المهنة الحالية">
                    </div>
                    <div class="full-width">
                        <label>محل الإقامة (العنوان بالتفصيل)</label>
                        <textarea rows="2" placeholder="المحافظة - المديرية - الحي - أقرب معلم"></textarea>
                    </div>
                </div>

                <hr style="margin: 20px 0; border: 0.5px solid #eee;">

                <!-- 2. Defendant (المدعى عليه/المدعى عليها) -->
                <h3 class="section-title">بيانات المدعى عليه / المدعى عليها</h3>
                <div class="grid">
                    <div class="full-width">
                        <label>الاسم الكامل للمدعى عليه / عليها</label>
                        <input type="text" id="main_defendant_name" placeholder="الاسم الكامل">
                    </div>
                    <div>
                        <label>محل الإقامة المعروف</label>
                        <input type="text" placeholder="العنوان المعروف">
                    </div>
                    <div>
                        <label>رقم الهاتف (إن وجد)</label>
                        <input type="tel" placeholder="7xxxxxxxx">
                    </div>
                    <div class="full-width">
                        <label>مهنة المدعى عليه / عليها ومكان العمل</label>
                        <input type="text" placeholder="جهة العمل أو المهنة">
                    </div>
                </div>

                <!-- Marriage Details Section -->
                <div id="marriageSection" style="display: none; margin-top:20px;">
                    <h3 class="section-title">أركان وتفاصيل الزواج (المطابقة للقانون اليمني)</h3>
                    <div class="grid">
                        <div class="full-width">
                            <label>اسم ولي الزوجة (عند العقد)</label>
                            <input type="text" id="marriage_guardian" placeholder="اسم الولي الرباعي">
                        </div>
                        <div>
                            <label>تاريخ عقد الزواج</label>
                            <input type="text" id="marriage_date" placeholder="dd/mm/yyyy" maxlength="10" oninput="formatDateInput(this)" style="direction: ltr; text-align: right;">
                        </div>
                        <div>
                            <label>مكان إبرام العقد</label>
                            <input type="text" id="marriage_place" placeholder="المحافظة - المديرية">
                        </div>
                        <div>
                            <label>مبلغ المهر المعجل (المدفوع)</label>
                            <input type="number" id="marriage_dowry" placeholder="بالريال اليمني">
                        </div>
                        <div>
                            <label>مبلغ المهر المؤجل (الغائب)</label>
                            <input type="number" id="marriage_deferred" placeholder="المؤخر">
                        </div>
                        <div>
                            <label>جهة صدور العقد (إن وجد)</label>
                            <input type="text" id="marriage_authority" placeholder="اسم الأمين الشرعي">
                        </div>
                        <div>
                            <label>حالة الدخول</label>
                            <select id="marriage_consummation">
                                <option>تم الدخول</option>
                                <option>لم يتم الدخول</option>
                            </select>
                        </div>
                    </div>

                    <h4 style="margin: 15px 0 10px; color: var(--primary);">بيانات شهود العقد (ركن الإثبات)</h4>
                    <table class="dynamic-table" id="witnessesTable">
                        <thead>
                            <tr>
                                <th>اسم الشاهد</th>
                                <th>رقم الهوية / الهاتف</th>
                                <th>إجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" placeholder="الشاهد الأول"></td>
                                <td><input type="text" placeholder="الرقم"></td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="add-row" onclick="addWitnessRow()">+ إضافة شاهد</button>
                </div>


                <div class="btn-group">
                    <button type="button" class="btn-prev" onclick="goToPhase(1)">السابق</button>
                    <button type="button" class="btn-next" onclick="goToPhase(3)">الحقائق والمطالب</button>
                </div>
            </div>

            <!-- Phase 3: Facts & Requests -->
            <div class="phase" id="phase3">
                <h3 class="section-title">موضوع ووقائع الدعوى</h3>
                <div class="form-group">
                    <label>موضوع الدعوى باختصار</label>
                    <input type="text" placeholder="مثال: طلب فسخ لعدم الإنفاق مع طلب الحضانة">
                </div>

                <div class="form-group">
                    <label>سرد الوقائع (شرح القضية)</label>
                    <textarea rows="6" placeholder="اكتب تفاصيل الخلاف المطالب القانونية بالتفصيل..."></textarea>
                </div>

                <div class="form-group"
                    style="padding: 15px; background: #fdf2e9; border-radius: 10px; border: 1px dashed var(--accent);">
                    <h4
                        style="color: var(--primary); margin-bottom: 15px; display: flex; align-items: center; gap: 8px;">
                        📄 مرفقات الملف القضائي (PDF)
                    </h4>
                    <div class="grid">
                        <div class="full-width">
                            <label>تحميل ملف PDF (عريضة الدعوى، عقود، وثائق)</label>
                            <input type="file" id="pdf_attachment" accept=".pdf"
                                style="padding: 10px; background: white;">
                        </div>
                        <div class="full-width">
                            <label>كتابة محتوى الـ PDF (ملخص أو تفريغ نصي للوثيقة)</label>
                            <textarea id="attachment_content" rows="4"
                                placeholder="اكتب خلاصة ما يحتوي عليه الملف المرفق هنا..."></textarea>
                        </div>
                    </div>
                </div>


                <!-- Table of Children -->
                <h3 class="section-title" style="margin-top: 30px;">بيانات الأبناء (إن وجدوا)</h3>
                <table class="dynamic-table" id="childrenTable">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>العمر</th>
                            <th>الجنس</th>
                            <th>إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" placeholder="اسم الابن"></td>
                            <td><input type="number" placeholder="السن"></td>
                            <td><select>
                                    <option>ذكر</option>
                                    <option>أنثى</option>
                                </select></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="add-row" onclick="addRow()">+ إضافة ابن جديد</button>

                <h3 class="section-title" style="margin-top: 40px;">الأسانيد القانونية (قانون الأحوال الشخصية اليمني)
                </h3>
                <div class="checkbox-group">
                    <label class="checkbox-item"><input type="checkbox"> المادة (50): حق الزوجة في طلب الفسخ
                        للكراهية</label>
                    <label class="checkbox-item"><input type="checkbox"> المادة (54): الفسخ للغيبة أو الحبس</label>
                    <label class="checkbox-item"><input type="checkbox"> المادة (59): الفسخ لعدم الإنفاق</label>
                    <label class="checkbox-item"><input type="checkbox"> المادة (152): استحقاق الأم للحضانة</label>
                    <label class="checkbox-item"><input type="checkbox"> المادة (159): تقدير النفقة بمراعاة حالة
                        الزوج</label>
                </div>

                <h3 class="section-title" style="margin-top: 40px;">الطلبات الختامية</h3>
                <div class="form-group">
                    <label>نص الطلبات المطلوبة من المحكمة</label>
                    <textarea rows="4"
                        placeholder="1. الحكم بفسخ عقد النكاح...\n2. الحكم بالحضانة...\n3. إلزام المدعى عليه / عليها بالنفقة..."></textarea>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn-prev" onclick="goToPhase(2)">السابق</button>
                    <button type="button" class="btn-submit" onclick="submitForm()">حفظ عريضة الدعوى وإرسالها</button>
                </div>
            </div>

        </form>
    </div>

    <script>
        function goToPhase(phaseNum) {
            document.querySelectorAll('.phase').forEach(p => p.classList.remove('active'));
            document.getElementById('phase' + phaseNum).classList.add('active');

            // Update indicator
            document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
            for (let i = 1; i <= phaseNum; i++) {
                document.getElementById('s' + i).classList.add('active');
            }
        }

        function toggleFormFields() {
            const type = document.getElementById('caseType').value;
            const marriageSec = document.getElementById('marriageSection');

            // Conditional Rendering Logic
            if (['hate', 'desertion', 'maintenance', 'marriage_proof'].includes(type)) {
                marriageSec.style.display = 'block';
            } else {
                marriageSec.style.display = 'none';
            }
        }

        function addRow() {
            const table = document.getElementById('childrenTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
            <td><input type="text"></td>
            <td><input type="number"></td>
            <td><select><option>ذكر</option><option>أنثى</option></select></td>
            <td><button type="button" onclick="this.parentElement.parentElement.remove()" style="color:red; background:none; border:none; cursor:pointer;">حذف</button></td>
        `;
        }

        function addWitnessRow() {
            const table = document.getElementById('witnessesTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
            <td><input type="text"></td>
            <td><input type="text"></td>
            <td><button type="button" onclick="this.parentElement.parentElement.remove()" style="color:red; background:none; border:none; cursor:pointer;">حذف</button></td>
        `;
        }

        function submitForm() {
            const witnesses = [];
            document.querySelectorAll('#witnessesTable tbody tr').forEach(tr => {
                witnesses.push({
                    name: tr.cells[0].querySelector('input').value,
                    identity_phone: tr.cells[1].querySelector('input').value
                });
            });

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('case_type', document.getElementById('caseType').value);
            formData.append('case_type_label', document.getElementById('caseType').options[document.getElementById('caseType').selectedIndex].text);
            formData.append('court_name', document.getElementById('courtName').value);
            formData.append('plaintiff_name', document.querySelectorAll('#phase2 input')[0].value);
            formData.append('plaintiff_phone', document.querySelectorAll('#phase2 input')[1].value);
            formData.append('plaintiff_address', document.querySelector('#phase2 textarea').value);

            const defName = (document.getElementById('main_defendant_name') ? document.getElementById('main_defendant_name').value : '') || (document.querySelectorAll('#phase2 input')[2] ? document.querySelectorAll('#phase2 input')[2].value : '');
            formData.append('defendant_name', defName);
            formData.append('defendant_address', document.querySelectorAll('#phase2 input')[3].value);
            formData.append('defendant_phone', document.querySelectorAll('#phase2 input')[4].value);

            const facts = (document.querySelector('#phase3 textarea') ? document.querySelector('#phase3 textarea').value : '');
            formData.append('facts', facts);

            Array.from(document.querySelectorAll('.checkbox-item input:checked')).map(c => c.parentElement.textContent.trim()).forEach(reason => {
                formData.append('legal_reasons[]', reason);
            });

            // Marriage Extras
            formData.append('marriage_details[guardian]', document.getElementById('marriage_guardian').value);
            formData.append('marriage_details[contract_date]', document.getElementById('marriage_date').value);
            formData.append('marriage_details[place]', document.getElementById('marriage_place').value);
            formData.append('marriage_details[dowry]', document.getElementById('marriage_dowry').value);
            formData.append('marriage_details[deferred_dowry]', document.getElementById('marriage_deferred').value);
            formData.append('marriage_details[authority]', document.getElementById('marriage_authority').value);
            formData.append('marriage_details[consummation_status]', document.getElementById('marriage_consummation').value);

            witnesses.forEach((w, i) => {
                formData.append(`witnesses[${i}][name]`, w.name);
                formData.append(`witnesses[${i}][identity_phone]`, w.identity_phone);
            });

            // PDF fields
            const pdfFile = document.getElementById('pdf_attachment').files[0];
            if (pdfFile) {
                formData.append('pdf_attachment', pdfFile);
            }
            formData.append('attachment_content', document.getElementById('attachment_content').value);

            const btn = document.querySelector('.btn-submit');
            btn.disabled = true;
            btn.innerText = 'جاري المعالجة...';

            fetch('{{ route("cases.store") }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })

                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '{{ route("dashboard") }}';
                    } else {
                        alert('حدث خطأ أثناء حفظ البيانات');
                        btn.disabled = false;
                        btn.innerText = 'حفظ عريضة الدعوى وإرسالها';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('فشل الاتصال بالخادم');
                    btn.disabled = false;
                    btn.innerText = 'حفظ عريضة الدعوى وإرسالها';
                });
        }

        function formatDateInput(input) {
            let value = input.value.replace(/[^\d]/g, '');
            if (value.length > 8) value = value.substring(0, 8);
            if (value.length >= 5) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4) + '/' + value.substring(4);
            } else if (value.length >= 3) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            input.value = value;
        }

    </script>

    @include('partials.footer')
</body>

</html>