<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kecamatan;
use App\Models\Edukasi;
use App\Models\Pemerintah;
use App\Models\PetaniTembakau;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function melihatDataAkun(Request $request)
    {
        $id_admin = $request->session()->get('id', null);
        if (isset($id_admin)) {
            $admin = Admin::find($id_admin);
            return view('admin.akun.akun', [
                'title' => 'Admin | Profil',
                'admin' => $admin
            ]);
        } else {
            return redirect('/login')->with('failed', 'Silahkan login terlebih dahulu!');
        }
    }
    public function mengubahDataAkun(Request $request)
    {
        $id_admin = $request->session()->get('id', null);
        if (isset($id_admin)) {
            $admin = Admin::find($id_admin);
            return view('admin.akun.ubahAkun', [
                'title' => 'Admin | Ubah Profil',
                'admin' => $admin //put id in hidden input on view
            ]);
        } else {
            return redirect('/login')->with('failed', 'Silahkan login terlebih dahulu!');
        }
    }
    public function postMengubahDataAkun(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $id_admin = $request->session()->get('id', null);
        if (isset($id_admin)) {
            $row_affected = Admin::query()->where('id_admin', $id_admin)->update([
                'username' => $validated['username'],
                'password' => $validated['password']
            ]);
            if ($row_affected) {
                return redirect('/admin/akun')->with('success', 'Data akun berhasil diperbarui!');
            } else {
                return redirect('/admin/ubah')->withErrors(['db' => 'Data akun tidak berubah!']);
            }
        }
        return redirect('/admin/ubah')->with('failed', 'Data akun gagal diperbarui!');
    }
    public function melihatEdukasi()
    {
        return view('admin.edukasi.edukasi', [
            'title' => 'Edukasi Petani'
        ]);
    }
    public function melihatDataUser()
    {
        return view('admin.user.user', [
            'title' => 'Data User'
        ]);
    }
    public function melihatDataPemerintah()
    {
        $pemerintahs = Pemerintah::all();
        return view('admin.user.pemerintah', [
            'pemerintahs' => $pemerintahs,
            'title' => 'Data Pemerintah'
        ]);
    }
    public function melihatDataPetani()
    {
        $petanis = PetaniTembakau::all();
        return view('admin.user.petani', [
            'petanis' => $petanis,
            'title' => 'Data Petani'
        ]);
    }
    public function melihatTanamTembakau()
    {
        $edukasi = Edukasi::where('id_topik', 1)->get();
        return view('admin.edukasi.tanamtembakau', [
            'edukasis' => $edukasi,
            'title' => 'Data Edukasi'
        ]);
    }
    public function melihatPageTanam($id_edukasi)
    {
        $edukasi = Edukasi::find($id_edukasi);
        return view('admin.edukasi.pagetanam', ['edukasi' => $edukasi]);
    }
    public function melihatEksporTembakau()
    {
        // Mengambil data dari tabel Edukasi yang memiliki id_topik = 2
        $edukasi = Edukasi::where('id_topik', 2)->get();

        return view('admin.edukasi.eksportembakau', [
            'edukasis' => $edukasi,
            'title' => 'Data Edukasi'
        ]);
    }
}
