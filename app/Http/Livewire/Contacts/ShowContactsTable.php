<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;

class ShowContactsTable extends Component
{
    protected $listeners = [
        'deleteContact'
    ];

    public function deleteContact(Contact $contact)
    {
        $contact->delete();
    }

    public function render()
    {
        return view('livewire.contacts.show-contacts-table', [
            'contacts' => Contact::all(),
        ]);
    }
}
