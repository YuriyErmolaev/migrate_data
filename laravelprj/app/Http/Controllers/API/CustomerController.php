<?php
namespace App\Http\Controllers\API;

use App\Entities\Customer\CustomerCreateTDO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Customer\CustomerService;


class CustomerController extends Controller
{
    private CustomerService $customerService;    

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $customerTDO = new CustomerCreateTDO(
            $request->name,
            $request->email,
            $request->age,
            $request->location
        );        
        $customer = $this->customerService->create($customerTDO);
        return response()->json(['customer' => $customer], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {        
        $this->customerService->delete($id);
        return response()->json(['status' => 'deleted'], 200);
    }
}
