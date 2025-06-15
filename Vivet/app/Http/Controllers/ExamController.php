<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ExamSent;

class ExamController extends Controller
{
    // Mostrar vista con tabla de tutores
    public function showExams()
    {
        $users = User::where('user_type', 'Tutor')->get();
        return view('tenant.dashboard.modules.exams.index', compact('users'));
    }

    // Enviar examen, registrar en DB y mandar correo
    public function send(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'exam_file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $file = $request->file('exam_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('exams', $filename);

        // Verificar destinatario
        $recipient = User::find($request->recipient_id);
        if (!$recipient) {
            return back()->with('error', 'El destinatario seleccionado no existe.');
        }

        // Guardar en DB
        Exam::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
            'exam_file' => $path,
        ]);

        // Enviar correo
        $recipient = User::findOrFail($request->recipient_id);
        Mail::to($recipient->email)->send(new ExamSent(auth()->user(), $recipient, $path));

        return back()->with('success', 'Examen enviado exitosamente.');
    }

    // Mostrar historial de exámenes recibidos por un usuario
    public function history(User $user)
    {
        $exams = Exam::where('recipient_id', $user->id)->with('sender')->latest()->get();
        return view('tenant.dashboard.modules.exams.history', compact('exams', 'user'));
    }
}
