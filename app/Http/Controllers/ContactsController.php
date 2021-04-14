<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\SaveContactRequest;

class ContactsController extends Controller
{
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
}
