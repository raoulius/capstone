<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request, $roleId)
    {
        $search = $request->get('q');
        $members = Member::query()
            ->where('role_id', $roleId)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('nim', 'like', "%$search%");
            })
            ->select('id', 'nim', 'name', 'email')
            ->get();

        return response()->json($members);
    }
}
