<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\SaveContactRequest;

class ContactsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('contacts.index');
    }

    public function create()
    {
        return view('contacts.create', [
            'companies' => Company::pluck('name', 'id'),
            'contact' => new Contact,
        ]);
    }

    public function store(SaveContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        session()->flash('message', "Contacto: <b>{$contact->name}</b>, creado correctamente.");

        return redirect()->route('contacts.index');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', [
            'companies' => Company::pluck('name', 'id'),
            'contact' => $contact,
        ]);
    }

    public function update(Contact $contact, SaveContactRequest $request)
    {
        $contact->update($request->validated());

        session()->flash('message', "Contacto: <b>{$contact->name}</b>, actualizado correctamente.");

        return redirect()->route('contacts.index');
    }

    public function destroy(Contact $contact)
    {
        $name = $contact->name;

        if ( $contact->tickets()->exists() )
        {
            session()->flash('error', "El contacto no se puede eliminar.");
            return redirect()->back();
        }

        $contact->delete();
        session()->flash('message', "Contacto: <b>{$name}</b>, eliminado correctamente.");

        return redirect()->route('contacts.index');
    }
}
