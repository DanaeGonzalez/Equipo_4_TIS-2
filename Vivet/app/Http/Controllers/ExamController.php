<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exam;

class ExamController extends Controller
{
    public function showExams()
    {
        $users = User::where('user_type', 'Tutor')->get();
        return view('exams.index', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'exam_file' => 'required|file|mimes:pdf,docx',
            'recipient_id' => 'required|exists:users,id'
        ]);

        $path = $request->file('exam_file')->store('exams');

        Exam::create([
            'exam_file' => $path,
            'sender_id' => auth()->id(),
            'recipient_id' => $request->recipient_id,
        ]);

        return back()->with('success', 'Examen enviado correctamente.');
    }
    public function examsHistory(User $user)
    {
        $exams = Exam::with('sender_id')
            ->where('recipient_id', $user->id)
            ->latest()
            ->get();

        return view('exams.history', compact('exams', 'user'));
    }
}
