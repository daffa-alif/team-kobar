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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil parameter 'search' dari query string
        $search = $request->query('search');

        // Jika ada kata kunci pencarian, filter jurnal berdasarkan judul atau konten
        if ($search) {
            $journals = Journal::where('user_id', auth()->id())
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                          ->orWhere('content', 'like', '%' . $search . '%');
                })
                ->paginate(9);  // Gunakan paginate, bukan get()
        } else {
            // Jika tidak ada pencarian, paginate semua jurnal
            $journals = Journal::where('user_id', auth()->id())->paginate(9);
        }

        return view('journal.index', compact('journals'));
    }

    /**
     * Menampilkan halaman detail jurnal.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journal.show', compact('journal'));
    }

    /**
     * Menampilkan form untuk membuat jurnal baru.
     *
     * @return \Illuminate\View\View
     */
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
            'cropped_image' => 'nullable|string',  // Validasi untuk gambar yang dipotong
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

        // Handle gambar yang dipotong (jika ada)
        if ($request->cropped_image) {
            // Decode data gambar base64
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->cropped_image));
            
            // Generate nama file yang unik
            $fileName = 'journal_' . time() . '.jpg';
            
            // Simpan file ke dalam direktori 'journal_images'
            Storage::disk('public')->put('journal_images/' . $fileName, $imageData);
            
            // Simpan nama file dalam database
            $journalData['image_url'] = 'journal_images/' . $fileName;
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
            'cropped_image' => 'nullable|string',  // Validasi untuk gambar yang dipotong
        ]);

        // Mencari jurnal yang akan diupdate
        $journal = Journal::findOrFail($id);

        // Update data jurnal
        $journal->title = $request->title;
        $journal->content = $request->content;

        // Jika ada gambar yang dipotong, proses dan update
        if ($request->cropped_image) {
            // Hapus gambar lama jika ada
            if ($journal->image_url && Storage::exists('public/' . $journal->image_url)) {
                Storage::delete('public/' . $journal->image_url);
            }

            // Decode data gambar base64
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->cropped_image));
            
            // Generate nama file yang unik
            $fileName = 'journal_' . time() . '.jpg';
            
            // Simpan file ke dalam direktori 'journal_images'
            Storage::disk('public')->put('journal_images/' . $fileName, $imageData);
            
            // Update URL gambar dalam database
            $journal->image_url = 'journal_images/' . $fileName;
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
