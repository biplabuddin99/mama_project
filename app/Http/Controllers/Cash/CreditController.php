<?php

namespace App\Http\Controllers\Cash;

use Exception;
use App\Models\Cash\Credit;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;

class CreditController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $credits = Credit::where(company())->paginate(10);
        return view('cash.credit.index', compact('credits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('cash.credit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                try {
            $b             = new Credit;
            $b->amount     = $request->amount;
            $b->remarks    = $request->remarks;
            $b->created_by = currentUserId();
            $b->company_id = company()['company_id'];
            if ($b->save()) {
                return redirect()->route(currentUser() . '.credits.index')->with($this->resMessageHtml(true, null, 'Successfully created'));
            } else {
                return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
            }

        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cash\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cash\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $credit = Credit::findOrFail(encryptor('decrypt', $id));
        return view('cash.credit.edit', compact('credit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cash\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
                    try {
            $owner             = Credit::findOrFail(encryptor('decrypt', $id));
            $owner->amount     = $request->amount;
            $owner->remarks    = $request->remarks;
            $owner->updated_by = currentUserId();
            $owner->company_id = company()['company_id'];
            if ($owner->save()) {
                return redirect()->route(currentUser() . '.credits.index')->with($this->resMessageHtml(true, null, 'Successfully created'));
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
     * @param  \App\Models\Cash\Credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $cat= Credit::findOrFail(encryptor('decrypt',$id));
        $cat->delete();
        return redirect()->back();
    }
}
