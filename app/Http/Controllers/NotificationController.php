<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'status' => 'required|string|in:Success,Failed', // Make sure status is either 'success' or 'failed'
        ]);

        // Create the notification in the database
        Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'status' => $request->status,
        ]);

        // Determine which notify method to use based on status
        if ($request->status === 'Success') {
            notify()->success($request->message); // Assuming notify() is a globally available function
        } elseif ($request->status === 'Failed') {
            notify()->error($request->message); // Assuming notify() is a globally available function
        }

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
