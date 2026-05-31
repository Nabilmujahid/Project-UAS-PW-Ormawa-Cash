<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::with('user')->latest()->get();
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:anggotas,nim',
            'jabatan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email|unique:anggotas,email',
            'password' => 'required|string|min:6',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pengurus',
        ]);

        Anggota::create([
            'user_id' => $user->id,
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'jabatan' => $validated['jabatan'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota dan akun login berhasil ditambahkan.');
    }

    public function edit(Anggota $anggotum)
    {
        return view('anggota.edit', ['anggota' => $anggotum]);
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:anggotas,nim,' . $anggotum->id,
            'jabatan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $anggotum->user_id . '|unique:anggotas,email,' . $anggotum->id,
            'password' => 'nullable|string|min:6',
            'alamat' => 'nullable|string',
        ]);

        if ($anggotum->user) {
            $anggotum->user->update([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => !empty($validated['password'])
                    ? Hash::make($validated['password'])
                    : $anggotum->user->password,
            ]);
        }

        $anggotum->update([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'jabatan' => $validated['jabatan'],
            'no_hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota dan akun login berhasil diperbarui.');
    }

    public function destroy(Anggota $anggotum)
    {
        if ($anggotum->user) {
            $anggotum->user->delete();
        }

        $anggotum->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota dan akun login berhasil dihapus.');
    }
}