<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;
use App\Models\CollectionUpdateRequest;

class LibrarianController extends Controller
{
    public function create()
    {
        return view('librarian.create');  // Pastikan view ini ada
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'librarian',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Librarian created successfully.');
    }

    public function destroy($id)
    {
        $librarian = User::findOrFail($id);

        if ($librarian->role !== 'librarian') {
            return redirect()->route('admin.dashboard')->with('error', 'Cannot delete this user.');
        }

        $librarian->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Librarian deleted successfully.');
    }

    public function index()
    {
        $requests = CollectionUpdateRequest::where('user_id', auth('web')->id())
                                           ->orderBy('created_at', 'desc')
                                           ->get();

        return view('librarian.dashboard', compact('requests'));
    }

    public function dashboard()
    {   
        $notifications = Notification::where('user_id', auth()->id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        return view('librarian.dashboard', compact('notifications'));
    }
}
