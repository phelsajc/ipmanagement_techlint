<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpAddress;
use App\Models\IPAuditLog;

class IpAddressController extends Controller
{
    // Role IDs 1=Admin, 2=Regular
    const ROLE_ADMIN = 1;

    public function index()
    {
        return response()->json(IpAddress::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => 'required|ip',
            'title' => 'required|string|max:255',
            'comment' => 'nullable|string'
        ]);

        $userId = $request->get('user_id');

        $ip = IpAddress::create([
            'ip_address' => $request->ip_address,
            'title' => $request->title,
            'comment' => $request->comment,
            'created_by' => $userId
        ]);

        //$request->get('role');
        return response()->json($ip, 201);
    }

    public function update(Request $request, $id)
    {
        $ip = IpAddress::findOrFail($id);
        $userId = $request->get('user_id');
        $roleId = $request->get('role_id');

        if ($roleId != self::ROLE_ADMIN && $ip->created_by != $userId) {
            return response()->json(['error' => 'No privilege to update'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'comment' => 'nullable|string'
        ]);

        $ip->update($request->only(['title', 'comment']));


        return response()->json($ip);
    }

    public function destroy(Request $request, $id)
    {
        $ip = IpAddress::findOrFail($id);
        $roleId = $request->get('role_id');

        if ($roleId != self::ROLE_ADMIN) {
            return response()->json(['error' => 'No privilege to delete'], 403);
        }

        $ip->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function getAuditLogs(Request $request)
    {
        $roleId = $request->get('role_id');
        if ($roleId != self::ROLE_ADMIN) {
            return response()->json(['error' => 'No privilege to view audit logs'], 403);
        }

        return response()->json(IPAuditLog::latest()->get());
    }
}
