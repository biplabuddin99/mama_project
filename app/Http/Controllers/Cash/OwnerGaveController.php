<?php
namespace App\Http\Controllers\Cash;

use App\Http\Controllers\Controller;
use App\Models\Cash\OwnerGave;
use Exception;
use Illuminate\Http\Request;

class OwnerGaveController extends Controller
{

    public function index()
    {
        $ownergaves = OwnerGave::where(company())->paginate(10);
        return view('cash.ownergaves.index', compact('ownergaves'));
    }


    public function create()
    {
        return view('cash.ownergaves.create');
    }


    public function store(Request $request)
    {
        try {
            $b             = new OwnerGave;
            $b->amount     = $request->amount;
            $b->remarks    = $request->remarks;
            $b->created_by = currentUserId();
            $b->company_id = company()['company_id'];
            if ($b->save()) {
                return redirect()->route(currentUser() . '.owner_gave.index')->with($this->resMessageHtml(true, null, 'Successfully created'));
            } else {
                return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
            }

        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
        }
    }


    public function show(OwnerGave $ownerGave)
    {
        //
    }


    public function edit($id)
    {
        $ownergave = OwnerGave::findOrFail(encryptor('decrypt', $id));
        return view('cash.ownergaves.edit', compact('ownergave'));
    }


    public function update(Request $request, $id)
    {
        try {
            $owner             = OwnerGave::findOrFail(encryptor('decrypt', $id));
            $owner->amount     = $request->amount;
            $owner->remarks    = $request->remarks;
            $owner->updated_by = currentUserId();
            $owner->company_id = company()['company_id'];
            if ($owner->save()) {
                return redirect()->route(currentUser() . '.owner_gave.index')->with($this->resMessageHtml(true, null, 'Successfully created'));
            } else {
                return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
            }

        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false, 'error', 'Please try again'));
        }
    }


    public function destroy($id)
    {
        $cat= OwnerGave::findOrFail(encryptor('decrypt',$id));
        $cat->delete();
        return redirect()->back();
    }
}
