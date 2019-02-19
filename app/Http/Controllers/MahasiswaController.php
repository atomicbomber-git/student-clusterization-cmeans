<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use App\Angkatan;
use App\TahunAjaran;
use App\Nilai;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = DB::table('mahasiswas')
            ->select('mahasiswas.id', 'mahasiswas.NIM', 'angkatans.tahun AS angkatan', 'users.name')
            ->join('users', 'users.id', '=', 'mahasiswas.user_id')
            ->join('angkatans', 'angkatans.id', '=', 'mahasiswas.angkatan_id')
            ->orderBy('angkatans.tahun', 'DESC')
            ->orderBy('users.name')
            ->paginate(25);

        $angkatans = Angkatan::query()
            ->select('id', 'tahun')
            ->orderBy('tahun', 'DESC')
            ->get();

        return view('mahasiswa.index', compact('mahasiswas', 'angkatans', 'mahasiswa_nilai_counts'));
    }

    public function create()
    {
        $angkatan_ids = Angkatan::select('id')->pluck('id');
        
        $data = $this->validate(request(), [
            'NIM' => ['required', 'unique:mahasiswas'],
            'angkatan_id' => ['required', Rule::in($angkatan_ids)],
            'nama' => ['required', 'string']
        ]);

        $tahun_angkatan = Angkatan::find($data['angkatan_id'])->tahun;
        
        $tahun_ajaran_ids = TahunAjaran::query()
            ->select('id')
            ->where('tahun_mulai', '>=', $tahun_angkatan)
            ->pluck('id');
        
        DB::transaction(function () use ($data, $tahun_ajaran_ids) {
            $user = User::create([
                'name' => $data['nama'],
                'username' => $data['NIM'],
                'password' => bcrypt($data['NIM']),
                'type' => 'mahasiswa'
            ]);

            $mahasiswa = Mahasiswa::create([
                'user_id' => $user->id,
                'angkatan_id' => $data['angkatan_id'],
                'NIM' => $data['NIM'],
            ]);

            foreach ($tahun_ajaran_ids as $tahun_ajaran_id) {
                foreach (Nilai::ganjil_genap() as $ganjil_genap) {
                    Nilai::create([
                        'mahasiswa_id' => $mahasiswa->id,
                        'tahun_ajaran_id' => $tahun_ajaran_id,
                        'ganjil_genap' => $ganjil_genap
                    ]);
                }
            }
        });

        return redirect()
            ->back()
            ->with('message.success', __('messages.create.success'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $angkatans = Angkatan::select('id', 'tahun')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'angkatans'));
    }

    public function update(Mahasiswa $mahasiswa)
    {
        $angkatan_ids = Angkatan::select('id')->pluck('id');
        
        $data = $this->validate(request(), [
            'NIM' => ['required', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
            'angkatan_id' => ['required', Rule::in($angkatan_ids)],
            'nama' => ['required', 'string']
        ]);

        $mahasiswa->update(collect($data)->only('NIM', 'angkatan_id')->toArray());
        
        User::where('id', $mahasiswa->user_id)
            ->update(['name' => $data['nama']]);

        return redirect()
            ->back()
            ->with('message.success', __('messages.update.success'));
    }

    public function delete(Mahasiswa $mahasiswa)
    {
        DB::transaction(function () use ($mahasiswa) {
            Nilai::where('mahasiswa_id', $mahasiswa->id)
                ->delete();

            $mahasiswa->delete();
        });

        return redirect()
            ->back()
            ->with('message.success', __('messages.delete.success'));
    }
}
