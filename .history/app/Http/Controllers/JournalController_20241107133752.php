<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
 // pastikan model Journal ada

class JournalController extends Controller
{
    /**
     * Menampilkan halaman index dengan daftar jurnal dalam bentuk card.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil jurnal yang dibuat oleh user yang sedang login
        $journals = Journal::where('user_id', auth()->id())->get();

        return view('journal.index', compact('journals'));
    }

    public function show($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journal.show', compact('journal'));
    }


    public function create()
    {
        return view('journal.create');
    }

    /**
     * Menyimpan jurnal baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([f
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Menyiapkan data untuk disimpan
        $journalData = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ];

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $journalData['image_url'] = $request->file('image')->store('journal_images', 'public');
        }

        // Simpan data jurnal ke database
        Journal::create($journalData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('journal.index')->with('success', 'Journal created successfully!');
    }

    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return redirect()->route('journal.index')->with('success', 'Journal deleted successfully!');
    }


}
