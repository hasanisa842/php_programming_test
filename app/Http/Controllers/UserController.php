<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->with(['provinsi', 'kabupaten', 'kecamatan', 'kelurahan']);
        $query->where('is_admin', '!=', 1);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('ktp', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);
        return view('admin.view', compact('users'));
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.edit', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'ktp' => 'required|min:16|max:16',
            'role' => 'required',
            'phone_number' => 'required',
            'location' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'ktp' => $request->ktp,
            'is_admin' => $this->getAdminRoleValue($request->role),
            'phone_number' => $request->phone_number,
            'provinsi_id' => $request->location,
            'kabupaten_id' => $request->location,
            'kecamatan_id' => $request->location,
            'kelurahan_id' => $request->location,
        ];

        User::create($data);

        return redirect('/users')->with('success', 'User created successfully.');
    }
    // in:provinsi,kabupaten,kecamatan,kelurahan
    public function update(Request $req, $id)
    {
        $user = User::findOrFail($id);

        $req->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'ktp' => 'required|min:16|max:16',
            'phone_number' => 'required',
            'role' => 'required',
            'location' => 'required',
        ]);

        $newRole = $req->input('role');
        $is_admin = match ($newRole) {
            'provinsi' => 2,
            'kabupaten' => 3,
            'kecamatan' => 4,
            'kelurahan' => 5,
            default => 0,
        };

        $data = [
            'name' => $req->name,
            'password' => Hash::make($req->password),
            'is_admin' => $is_admin,
            'ktp' => $req->ktp,
            // 'wilayah_kerja' => $req->wilayah_kerja,
            'phone_number' => $req->phone_number,
            'provinsi_id' => $req->location,
            'kabupaten_id' => $req->location,
            'kecamatan_id' => $req->location,
            'kelurahan_id' => $req->location,
        ];

        $user->update($data);

        return redirect('/users')->with('status', 'User berhasil diubah');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    private function getAdminRoleValue($role)
    {
        switch ($role) {
            case 'provinsi':
                return 1;
            case 'kabupaten':
                return 2;
            case 'kecamatan':
                return 3;
            case 'kelurahan':
                return 4;
            default:
                return 0;
        }
    }

    public function getLocationsByRole(Request $request)
    {
        $role = $request->input('role');
        $locations = [];

        switch ($role) {
            case 'provinsi':
                $locations = Provinsi::all();
                break;
            case 'kabupaten':
                $locations = Kabupaten::all();
                break;
            case 'kecamatan':
                $locations = Kecamatan::all();
                break;
            case 'kelurahan':
                $locations = Kelurahan::all();
                break;
        }

        return response()->json($locations);
    }
}