<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar Stok Barang'
        ];

        $activeMenu = 'stok';

        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $stoks = StokModel::with(['barang', 'user'])
            ->select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah');

        return DataTables::of($stoks)
            ->addIndexColumn()
            ->addColumn('barang_nama', function ($stok) {
                return $stok->barang->barang_nama;
            })
            ->addColumn('user_nama', function ($stok) {
                return optional($stok->user)->nama ?? 'Tidak Ada';
            })
            ->addColumn('aksi', function ($stok) {
                return '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ' .
                    '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ' .
                    '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Stok Barang'
        ];

        $activeMenu = 'stok';
        $barangs = BarangModel::all();
        $users = UserModel::select('user_id', 'nama')->get();

        return view('stok.create', compact('breadcrumb', 'page', 'activeMenu', 'barangs', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        StokModel::create($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    public function show($id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Stok Barang'
        ];

        $stok = StokModel::with(['barang', 'user'])->findOrFail($id);
        $activeMenu = 'stok';

        return view('stok.show', compact('breadcrumb', 'page', 'stok', 'activeMenu'));
    }

    public function edit($id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Stok'
        ];

        $stok = StokModel::findOrFail($id);
        $barangs = BarangModel::all();
        $users = StokModel::select('user_id')->distinct()->get();

        $activeMenu = 'stok';

        return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'barangs', 'users', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        $stok = StokModel::findOrFail($id);
        $stok->barang_id = $request->barang_id;
        $stok->user_id = $request->user_id;
        $stok->stok_tanggal = $request->stok_tanggal;
        $stok->stok_jumlah = $request->stok_jumlah;
        $stok->save();

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }



    public function destroy($id)
    {
        StokModel::findOrFail($id)->delete();
        return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
    }
}
