<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    // Bersihkan kurawal dari konten
    $cleanedContent = str_replace(['{', '}'], '', $request->content);

    // Menyiapkan data untuk disimpan
    $journalData = [
        'user_id' => Auth::id(),
        'title' => $request->title,
        'content' => $cleanedContent, // Simpan konten yang sudah dibersihkan
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

    /**
     * Menampilkan form untuk mengedit jurnal yang ada.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journal.edit', compact('journal'));
    }

    /**
     * Mengupdate jurnal yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Mencari jurnal yang akan diupdate
        $journal = Journal::findOrFail($id);

        // Update data jurnal
        $journal->title = $request->title;
        $journal->content = $request->content;

        // Jika ada gambar yang diupload, proses dan update
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($journal->image_url && Storage::exists('public/' . $journal->image_url)) {
                Storage::delete('public/' . $journal->image_url);
            }

            // Upload gambar baru
            $journal->image_url = $request->file('image')->store('journal_images', 'public');
        }

        // Simpan perubahan
        $journal->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('journal.index')->with('success', 'Journal updated successfully!');
    }

    /**
     * Menghapus jurnal dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);

        // Hapus gambar jika ada
        if ($journal->image_url && Storage::exists('public/' . $journal->image_url)) {
            Storage::delete('public/' . $journal->image_url);
        }

        // Hapus jurnal dari database
        $journal->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('journal.index')->with('success', 'Journal deleted successfully!');
    }
}
