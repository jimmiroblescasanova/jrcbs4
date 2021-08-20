<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Jobs\SendMailingQueue;

class MailingController extends Controller
{
    public function index()
    {
        return view('mailing.index');
    }

    public function create()
    {
        return view('mailing.create');
    }

    public function store(Request $request)
    {
        $status = 1;
        $emails = [];

        foreach ($request->to as $id) {
            $contacts = Company::find($id)->contacts()->get();

            foreach ($contacts as $contact) {
                if (!is_null($contact)) {
                    array_push($emails, $contact->email);
                }
            }
        }

        $data = [
            'to' => $emails,
            'subject' => $request->subject,
            'content' => $request->content,
            'status' => $status,
        ];


        // send all mail in the queue.
        SendMailingQueue::dispatch($data);

        // $mail = Mailing::create($data);

        return $data;
    }

    public function storeImage(Request $request)
    {
        $path = $request->file('file')->store('mailing-images');

        return $imgInfo = [
            'url' => asset($path),
            'filename' => $request->file('file')->getClientOriginalName(),
        ];
    }
}
