<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Partner;
use Illuminate\Http\Request;

class AdminContactUsController extends Controller
{
    
    
     public function index_partner()
    {
        $partners = Partner::all(); // Fetch all contact requests
        return view('admin.partner.index', compact('partners')); // Return view with contact data
    }
      public function create_partner()
    {
        return view('admin.partner.create'); // Return the form view
    }
    
public function store_partner(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Check if the file was uploaded
    if (!$request->hasFile('logo')) {
        return back()->withErrors(['logo' => 'Logo file is required.']);
    }

    try {
        // Handle the file upload
        $logoFile = $request->file('logo');
        
        // Define the upload path (directly in the public/uploads folder)
        $destinationPath = ('uploads');
        
        // Ensure the directory exists, if not, create it
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Create a unique name for the file
        $logoName = time() . '_' . $logoFile->getClientOriginalName();

        // Move the file to the 'public/uploads' directory
        $logoFile->move($destinationPath, $logoName);


        // Create the partner with the logo path
        Partner::create([
            'logo' => $logoName,
        ]);

        // Fetch all partners
        $partners = Partner::all();
        return view('admin.partner.index', compact('partners'));
    } catch (\Exception $e) {
        \Log::error('Error saving partner: ' . $e->getMessage());
        return back()->withErrors(['error' => 'An error occurred while saving the partner: ' . $e->getMessage()]);
    }
}


    
     public function destroy_partner($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete(); // Delete the contact request
        return redirect()->route('admin_partner_index')->with('success', 'partber request deleted successfully.');
    }
    
    //***********************************************************************//
    
    // Display a listing of the resource.
    public function index()
    {
        $contacts = ContactUs::all(); // Fetch all contact requests
        return view('admin.contactus.index', compact('contacts')); // Return view with contact data
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('admin.contactus.create'); // Return the form view
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create($request->all()); // Store the contact request
        return redirect()->route('admin.contact_us.index')->with('success', 'Contact request created successfully.');
    }

    // Display the specified resource.
    public function show($id)
    {
        $contact = ContactUs::findOrFail($id); // Find contact request by ID
        return view('admin.contactus.show', compact('contact')); // Return view with contact data
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id); // Find contact request by ID
        return view('admin.contactus.edit', compact('contact')); // Return the form view
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = ContactUs::findOrFail($id);
        $contact->update($request->all()); // Update the contact request
        return redirect()->route('admin.contact_us.index')->with('success', 'Contact request updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete(); // Delete the contact request
        return redirect()->route('admin_contact_us_index')->with('success', 'Contact request deleted successfully.');
    }
}
