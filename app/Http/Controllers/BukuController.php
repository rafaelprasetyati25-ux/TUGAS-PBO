<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BukuController extends Controller
{
    private const SESSION_KEY = 'daftar_buku';

    private const KONDISI = ['Baik', 'Rusak Ringan', 'Rusak Berat'];

    public function index(Request $request): View
    {
        $daftarBuku = array_values($request->session()->get(self::SESSION_KEY, []));

        usort(
            $daftarBuku,
            static fn (array $bukuPertama, array $bukuKedua): int => strcasecmp(
                $bukuPertama['judul'],
                $bukuKedua['judul'],
            ),
        );

        $jumlahJudul = count($daftarBuku);
        $jumlahStok = array_sum(array_column($daftarBuku, 'jumlah'));
        $stokMenipis = count(array_filter(
            $daftarBuku,
            static fn (array $buku): bool => $buku['jumlah'] <= 2,
        ));

        return view('buku.index', compact(
            'daftarBuku',
            'jumlahJudul',
            'jumlahStok',
            'stokMenipis',
        ));
    }

    public function create(): View
    {
        $pilihanKondisi = self::KONDISI;

        return view('buku.create', compact('pilihanKondisi'));
    }

    public function store(Request $request): RedirectResponse
    {
        $dataBuku = $request->validate(
            $this->aturanValidasi(),
            $this->pesanValidasi(),
            $this->namaAtribut(),
        );
        $daftarBuku = $request->session()->get(self::SESSION_KEY, []);
        $kode = $this->buatKodeBuku($daftarBuku);

        $daftarBuku[$kode] = [
            'kode' => $kode,
            ...$dataBuku,
            'jumlah' => (int) $dataBuku['jumlah'],
        ];

        $request->session()->put(self::SESSION_KEY, $daftarBuku);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Request $request, string $kode): View
    {
        $buku = $this->cariBuku($request, $kode);

        return view('buku.show', compact('buku'));
    }

    public function edit(Request $request, string $kode): View
    {
        $buku = $this->cariBuku($request, $kode);
        $pilihanKondisi = self::KONDISI;

        return view('buku.edit', compact('buku', 'pilihanKondisi'));
    }

    public function update(Request $request, string $kode): RedirectResponse
    {
        $this->cariBuku($request, $kode);

        $dataBuku = $request->validate(
            $this->aturanValidasi(),
            $this->pesanValidasi(),
            $this->namaAtribut(),
        );
        $daftarBuku = $request->session()->get(self::SESSION_KEY, []);
        $daftarBuku[$kode] = [
            'kode' => $kode,
            ...$dataBuku,
            'jumlah' => (int) $dataBuku['jumlah'],
        ];

        $request->session()->put(self::SESSION_KEY, $daftarBuku);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Request $request, string $kode): RedirectResponse
    {
        $this->cariBuku($request, $kode);

        $daftarBuku = $request->session()->get(self::SESSION_KEY, []);
        unset($daftarBuku[$kode]);
        $request->session()->put(self::SESSION_KEY, $daftarBuku);

        return redirect()
            ->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }

    /**
     * @return array<string, array<int, string>>
     */
    private function aturanValidasi(): array
    {
        return [
            'judul' => ['required', 'string', 'max:150'],
            'penulis' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'max:60'],
            'lokasi' => ['required', 'string', 'max:40'],
            'jumlah' => ['required', 'integer', 'min:0', 'max:9999'],
            'kondisi' => ['required', 'in:'.implode(',', self::KONDISI)],
        ];
    }

    /**
     * @return array<string, string>
     */
    private function pesanValidasi(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'max.jumlah' => ':attribute maksimal :max.',
            'integer' => ':attribute harus berupa bilangan bulat.',
            'min' => ':attribute minimal :min.',
            'in' => 'Pilih kondisi buku yang tersedia.',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function namaAtribut(): array
    {
        return [
            'judul' => 'nama buku',
            'penulis' => 'penulis',
            'kategori' => 'kategori',
            'lokasi' => 'lokasi rak',
            'jumlah' => 'jumlah eksemplar',
            'kondisi' => 'kondisi buku',
        ];
    }

    /**
     * @param  array<string, array<string, string|int>>  $daftarBuku
     */
    private function buatKodeBuku(array $daftarBuku): string
    {
        do {
            $kode = 'BK-'.Str::upper(Str::random(6));
        } while (array_key_exists($kode, $daftarBuku));

        return $kode;
    }

    /**
     * @return array{kode: string, judul: string, penulis: string, kategori: string, lokasi: string, jumlah: int, kondisi: string}
     */
    private function cariBuku(Request $request, string $kode): array
    {
        $buku = $request->session()->get(self::SESSION_KEY, [])[$kode] ?? null;

        abort_unless(is_array($buku), 404, 'Buku tidak ditemukan.');

        return $buku;
    }
}
