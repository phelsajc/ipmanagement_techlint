<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    public function __construct()
    {

    }

    public function handle(Request $request, $any = null)
    {
        $path = $request->path();

        $targetUrl = '';

        if (str_starts_with($path, 'api/auth')) {
            $targetUrl = config('services.auth.url') . '/' . $path;
        } elseif (str_starts_with($path, 'api/ips') || str_starts_with($path, 'api/audit-logs')) {
            $targetUrl = config('services.ip.url') . '/' . $path;
        } else {
            return response()->json(['error' => 'Service not found'], 404);
        }

        $method = $request->method();
        $body = $request->all();

        try {
            $response = Http::withHeaders([
                        'Authorization' => $request->header('Authorization'),
                        'Accept' => 'application/json'
                    ])->$method($targetUrl, $body);

            return response($response->body(), $response->status())
                ->header('Content-Type', $response->header('Content-Type'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gateway Error: ' . $e->getMessage()], 502);
        }
    }
}
