<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Jobs\SendMailingQueue;
use Illuminate\Support\Facades\DB;

class MailingController extends Controller
{
    public function index()
    {
        return view('mailing.index', [
            'jobs' => DB::table('jobs')->where('queue', '=', 'mailings')->get(),
            'failed_jobs' => DB::table('failed_jobs')->where('queue', '=', 'mailings')->get(),
        ]);
    }

    public function create()
    {
        return view('mailing.create');
    }

    public function store(Request $request)
    {
        $status = 1;
        $emails = array();

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

        SendMailingQueue::dispatch($data)->onQueue('mailings');

        return redirect()
            ->route('mailing.index')
            ->with('message', 'La campaña se ha creado y agregado a la cola para su envío.');
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
