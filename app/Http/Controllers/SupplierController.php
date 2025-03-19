<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class SupplierController extends Controller
{
    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    // Menyimpan supplier baru (AJAX)
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|unique:m_supplier,supplier_kode|min:3|max:10',
                'nama' => 'required|string|min:3|max:50',
                'alamat' => 'required|string|min:5|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            Supplier::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil disimpan'
            ]);
        }

        return redirect('/supplier');
    }

    // Menampilkan modal edit supplier (AJAX)
    public function edit_ajax(string $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    // Mengupdate supplier (AJAX)
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
                'nama' => 'required|string|max:50',
                'alamat' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $supplier = Supplier::find($id);
            if ($supplier) {
                $supplier->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data supplier berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/supplier');
    }

    public function confirm_ajax(string $id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = Supplier::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data supplier berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data supplier tidak ditemukan'
                ]);
            }
        }

        return redirect('/supplier');
    }
    public function list(Request $request)
    {
        $suppliers = Supplier::select('supplier_id', 'supplier_kode', 'nama', 'alamat');

        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                $btn = '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }





























    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // public function list(Request $request)
    // {
    //     $suppliers = Supplier::select('supplier_id', 'supplier_kode', 'nama', 'alamat');

    //     return DataTables::of($suppliers)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function ($supplier) {
    //             return '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> '
    //                 . '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> '
    //                 . '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">'
    //                 . csrf_field() . method_field('DELETE')
    //                 . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        Supplier::create($request->all());

        return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
    }

    public function show($id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Supplier'
        ];

        $supplier = Supplier::findOrFail($id);
        $activeMenu = 'supplier';

        return view('supplier.show', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
    }

    public function edit($id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Supplier'
        ];

        $supplier = Supplier::findOrFail($id);
        $activeMenu = 'supplier';

        return view('supplier.edit', compact('breadcrumb', 'page', 'supplier', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
    }
}
