<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Save to database
        ContactMessage::create($validated);

        Log::info('Contact form submission saved to DB:', $validated);

        return back()->with('success', 'Thank you! Your message has been received. We will get back to you soon.');
    }
}
