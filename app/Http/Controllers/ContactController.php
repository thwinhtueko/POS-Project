<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //redirect user contact page
    public function page()
    {
        return view('user.contact.list');
    }

    //Validation Check
    public function sendMessage(Request $request, $id)
    {
        $this->contactValidationCheck($request);
        $data = $this->ContactMessage($request, $id);

        Contact::where('id', $id)->create($data);

        return back()->with('success', 'Send your message successful..');
    }

    //user send message
    private function ContactMessage($request, $id)
    {
        return [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'message' => $request->message
        ];
    }

    //contact Validation check
    private function contactValidationCheck($request)
    {
        Validator::make($request->all(), [
            'userName' => 'required',
            'userEmail' => 'required',
            'message' => 'required|min:15',
        ], [
            'userName.required' => 'please Enter your name',
            'userEmail.required' => 'please Enter your email',
            'message.required' => 'Write your message....'
        ])->validate();
    }

    //admin contact page
    public function list()
    {
        $data = Contact::orderBy('created_at', 'desc')->get();
        return view('admin.contact.list', compact('data'));
    }

    //delete message
    public function delete($id)
    {
        Contact::where('id', $id)->delete();

        return back();
    }

    //read message
    public function message($id)
    {
        $read = Contact::where('id', $id)->first();
        return view('admin.contact.read', compact('read'));
    }
}
