<?php

namespace App\Http\Controllers\Cash;

use Exception;
use App\Models\Cash\Visa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;

class VisaController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visas = Visa::where(company())->paginate(10);
        return view('cash.visa.index', compact('visas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cash.visa.create');
    }


    public function store(Request $request)
    {
        try {
            $b             = new Visa;
            $b->amount     = $request->amount;
            $b->remarks    = $request->remarks;
            $b->created_by = currentUserId();
            $b->company_id = company()['company_id'];
            if ($b->save()) {
                return redirect()->route(currentUser() . '.visas.index')->with($this->resMessageHtml(true, null, 'Successfully created'));
            } else {
                return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
            }

        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
        }
    }

    public function show(Visa $visa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cash\Visa  $visa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visa = Visa::findOrFail(encryptor('decrypt', $id));
        return view('cash.visa.edit', compact('visa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cash\Visa  $visa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                try {
            $owner             = Visa::findOrFail(encryptor('decrypt', $id));
            $owner->amount     = $request->amount;
            $owner->remarks    = $request->remarks;
            $owner->updated_by = currentUserId();
            $owner->company_id = company()['company_id'];
            if ($owner->save()) {
                return redirect()->route(currentUser() . '.visas.index')->with($this->resMessageHtml(true, null, 'Successfully created'));
            } else {
                return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
            }

        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cash\Visa  $visa
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $cat= Visa::findOrFail(encryptor('decrypt',$id));
        $cat->delete();
        return redirect()->back();
    }
}
