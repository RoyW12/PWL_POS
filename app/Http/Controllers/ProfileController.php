<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;



class ProfileController extends Controller
{
    //
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profile',
            'list' => ['Home', 'profile']
        ];

        $page = (object) [
            'title' => 'Profile'
        ];

        $activeMenu = 'profile';


        return view('profile.index', compact('breadcrumb', 'page', 'activeMenu'));
    }


    public function create_ajax()
    {
        $user = UserModel::find(Auth::id());
        return view('profile.create_ajax', compact('user'));
    }
    public function updateAjax(Request $request)
    {
        $user = UserModel::find(Auth::id());

        $request->validate([
            'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        if ($request->hasFile('photo_profile')) {
            $file = $request->file('photo_profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/photo', $filename);

            $user->photo_profile = $filename;
        }

        $user->save();

        return response()->json(['message' => 'Profil berhasil diperbarui.']);
    }
}
