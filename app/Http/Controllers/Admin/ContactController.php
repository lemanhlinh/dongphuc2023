<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactDataTable;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ContactDataTable $dataTable
     * @return mixed
     */
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
        return [
            'status' => true,
            'message' => trans('message.delete_contact_success')
        ];
    }
}
