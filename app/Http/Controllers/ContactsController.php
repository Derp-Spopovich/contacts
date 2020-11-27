<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->simplePaginate(7);
        return view('contacts.index')->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'company' => 'required',
            'phone' => ['required', 'numeric'],
            'email' => ['required','email'],
        ]);

        $contacts = New Contact;
        $contacts->user_id = auth()->user()->id;
        $contacts->name = request()->input('name');
        $contacts->company = request()->input('company');
        $contacts->phone = request()->input('phone');
        $contacts->email = request()->input('email');
        $contacts->save();

        return redirect('/contacts')->with('success', 'Contact Successfully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $this->authorize('edit', $contact);
        return view('contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'company' => 'required',
            'phone' => ['required', 'numeric'],
            'email' => ['required','email'],
        ]);

        $contacts = Contact::findOrFail($id);
        $contacts->name = request()->input('name');
        $contacts->company = request()->input('company');
        $contacts->phone = request()->input('phone');
        $contacts->email = request()->input('email');
        $contacts->save();

        return redirect('/contacts')->with('success', 'Contact Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        if (Auth()->user()->id !== $contact->user_id) {
            \abort(403);
        }
        $contact->delete();
        return redirect('/contacts')->with('success', 'Contact Successfully Deleted');
    }

    public function search(Request $request)
    {
        if($request->ajax()){
   
            $output="";
            $contacts = Contact::where('name','LIKE','%'.$request->search."%")->get();
            
            if($contacts){
         
               foreach ($contacts as  $contact) {
               
                $output.='<tr>'.
                
                '<td>'.$contact->name.'</td>'.
                
                '<td>'.$contact->company.'</td>'.
                
                '<td>'.$contact->company.'</td>'.
                
                '<td>'.$contact->email.'</td>'.
                
                '</tr>';
            
               }
               return $output;  
    
            }
      
          }
    
    }
}
