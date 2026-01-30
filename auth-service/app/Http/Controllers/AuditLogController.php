<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        // role 1 is Admin
        if ($request->get('role') != 1) {
            return response()->json(['error' => 'No privilege to view audit logs'], 403);
        }

        return response()->json(AuditLog::with('user')->latest()->get());
    }
}
