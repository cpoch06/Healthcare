<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

    public function login() 
    {
        return view('login');
    }

    public function home()
    {
        return view('home');
    }

    public function addDoctor() {
        return view('add-doctor');
    }



    public function appointment()
    {
        // Fetch all appointments with related patient data
        $appointments = Appointment::with('patient')->get();

        // Pass the appointments data to the view
        return view('appointments.index', compact('appointments'));
    }

    public function profile($id)
    {
        $admin = Admin::findOrFail($id);
        return view('profile', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'admin_profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        
        if ($request->hasFile('admin_profile')) {
            $image = $request->file('admin_profile');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $admin->admin_profile = $imageName;
        }
        
        $admin->save();

        return redirect()->route('profile.show', $admin->admin_id)->with('success', 'Profile updated successfully');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('login')->with('success', 'Profile deleted successfully');
    }

    public function addAdmin()
    {
        return view('add-admin');
    }


}
