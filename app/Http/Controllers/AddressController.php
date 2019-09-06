<?php

namespace App\Http\Controllers;

use App\Address;
use App\Student;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Requests\AddressFormRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();

        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get all values from student_id column
        $addresses = Address::all()->pluck('student_id')->toArray();

        //get a list of all student which doesnt address
        $names = Student::whereNotIn('id',$addresses)->get();

        return view('addresses.create',compact('names'));
    }

    /**
     * This method shows a new addres create form with the given id
     * Show the form for creating a new resource.
     * The param id = user id
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function addNewAddress()
    {
        $id = $_GET['id'];
        return view('addresses.addnewaddress',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressFormRequest $request)
    {
        $input = $request->all();

        Address::create($input);

        return redirect('addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return view('addresses.show',compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('addresses.edit',compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddressFormRequest $request
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressFormRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect('addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address $address
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect('addresses');
    }
}
