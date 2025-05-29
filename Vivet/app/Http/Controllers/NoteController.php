<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', auth()->id())
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        Note::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'is_pinned' => $request->has('is_pinned'),
        ]);

        return redirect()->route('notes.index')->with('success', 'Nota creada exitosamente.');
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'is_pinned' => 'sometimes|boolean',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_pinned' => $request->has('is_pinned'),
        ]);

        return redirect()->route('notes.index')->with('success', 'Nota actualizada.');
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Nota eliminada.');
    }
}
