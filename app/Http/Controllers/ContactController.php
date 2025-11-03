<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Clients;
use App\Models\Contact;
use App\Models\Testimonys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ContactController extends Controller
{
    public function index()
    {
        $data = [
            'contacts' => Contact::orderBy('id', 'asc')->get(),
        ];
        return view('Admin.contacts.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
        ]);

        Contact::create([
            'alamat' => $request->alamat,
            'email' => $request->email,
            'phone' => $request->phone,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
        ]);

        toast('Berhasil menambahkan data!','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
        ]);

        $contacts = Contact::findOrFail($id);

        $contacts->alamat = $request->alamat;
        $contacts->email = $request->email;
        $contacts->phone = $request->phone;
        $contacts->instagram = $request->instagram;
        $contacts->linkedin = $request->linkedin;

        $contacts->save();
        toast('Berhasil mengubah data!','success');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $contacts = Contact::findOrFail($id);

        $contacts->delete();

        toast('Berhasil menghapus data!','success');
        return redirect()->back();
    }
}
