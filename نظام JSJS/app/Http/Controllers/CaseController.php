<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LegalCase;
use App\Models\Party;
use App\Models\JudiciaryRecord;

class CaseController extends Controller
{
    public function create()
    {
        return view('cases.create');
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $cases = LegalCase::where('case_number', 'LIKE', "%$query%")
                ->orWhereHas('parties', function($q) use ($query) {
                    $q->where('full_name', 'LIKE', "%$query%");
                })->get();
        } else {
            $cases = LegalCase::all();
        }
        return view('cases.index', compact('cases'));
    }


    public function edit($id)
    {
        $case = LegalCase::with(['parties', 'marriageDetail', 'witnesses'])->findOrFail($id);
        return view('cases.edit', compact('case'));
    }

    public function update(Request $request, $id)
    {
        $legalCase = LegalCase::findOrFail($id);
        
        $legalCase->update([
            'case_type' => $request->case_type_label ?? $request->case_type,
            'facts' => $request->facts,
            'status' => $request->status ?? $legalCase->status
        ]);

        // Update Parties
        if ($request->has('parties')) {
            foreach ($request->parties as $partyData) {
                Party::updateOrCreate(
                    ['case_id' => $id, 'type' => $partyData['type']],
                    ['full_name' => $partyData['full_name'], 'phone' => $partyData['phone']]
                );
            }
        }

        // Update Marriage Details
        if ($request->has('marriage_details')) {
            \App\Models\MarriageDetail::updateOrCreate(
                ['case_id' => $id],
                $request->marriage_details
            );
        }

        // Update PDF Attachment
        if ($request->hasFile('pdf_attachment')) {
            $path = $request->file('pdf_attachment')->store('attachments', 'public');
            $legalCase->update(['attachment_path' => $path]);
        }
        
        if ($request->has('attachment_content')) {
            $legalCase->update(['attachment_content' => $request->attachment_content]);
        }

        return response()->json(['success' => true, 'message' => 'تم تحديث بيانات القضية بنجاح']);

    }


    public function destroy($id)
    {
        $case = LegalCase::find($id);
        if ($case) {
            $case->delete();
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'تم حذف القضية بنجاح']);
            }
            return back()->with('success', 'تم حذف القضية بنجاح');
        }
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'لم يتم العثور على القضية'], 404);
        }
        return back()->with('error', 'لم يتم العثور على القضية');
    }



    public function store(Request $request)

    {
        // 1. Check for judiciary matching if marriage or maintenance
        $isRegistered = false;
        $defendantMatch = null;
        
        if (in_array($request->case_type, ['marriage_proof', 'maintenance'])) {
            $defendantName = $request->defendant_name;
            $defendantMatch = JudiciaryRecord::where('full_name', 'LIKE', "%$defendantName%")->first();
            
            if ($defendantMatch) {
                $isRegistered = true;
            }
        }

        // 2. Handle PDF Attachment
        $attachmentPath = null;
        if ($request->hasFile('pdf_attachment')) {
            $attachmentPath = $request->file('pdf_attachment')->store('attachments', 'public');
        }

        // 3. Create the case
        $legalCase = LegalCase::create([
            'case_number' => 'TAIZ-' . time(),
            'case_type' => $request->case_type_label ?? $request->case_type,
            'facts' => $request->facts,
            'legal_reasons' => $request->legal_reasons,
            'status' => 'جديدة',
            'attachment_path' => $attachmentPath,
            'attachment_content' => $request->attachment_content
        ]);


        // 3. Create Plaintiff
        Party::create([
            'case_id' => $legalCase->id,
            'type' => 'مدعي',
            'full_name' => $request->plaintiff_name,
            'phone' => $request->plaintiff_phone,
            'address' => $request->plaintiff_address
        ]);

        // 4. Create Defendant
        Party::create([
            'case_id' => $legalCase->id,
            'type' => 'مدعى عليه',
            'full_name' => $request->defendant_name,
            'phone' => $request->defendant_phone,
            'address' => $request->defendant_address
        ]);

        // 5. Marriage Details (If provided)
        if ($request->marriage_details) {
            \App\Models\MarriageDetail::updateOrCreate(
                ['case_id' => $legalCase->id],
                $request->marriage_details
            );
        }

        // 6. Witnesses
        if ($request->witnesses) {
            foreach ($request->witnesses as $witness) {
                if (!empty($witness['name'])) {
                    \App\Models\Witness::create(array_merge(
                        ['case_id' => $legalCase->id],
                        $witness
                    ));
                }
            }
        }

        $message = "تمت إضافة القضية بنجاح.";
        if ($isRegistered) {
            $message .= " تم مطابقة بيانات المدعى عليه في السجل القضائي اليمني: " . $defendantMatch->status;
        } else {
            $message .= " ملاحظة: لم يتم العثور على المدعى عليه في السجل القضائي الحالي.";
        }

        return response()->json([
            'success' => true, 
            'message' => $message,
            'case_id' => $legalCase->id,
            'registered' => $isRegistered
        ]);
    }
}


