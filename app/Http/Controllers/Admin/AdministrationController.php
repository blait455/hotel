<?php

namespace App\Http\Controllers\Admin;

use App\DailyCashRecords;
use App\DrinkPurchase;
use App\Guest;
use App\Http\Controllers\Controller;
use App\Imprest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\ReceptionistLedger;
use App\RecordItem;
use App\RequestType;
use App\Requisition;
use Carbon\Carbon;
use App\Room;
use App\StoreRecord;
use App\Supplier;
use Auth;
use Toastr;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rl_index() {
        $data = ReceptionistLedger::all();

        return view('admin.administration.RL.index', compact('data'));
    }

    public function rl_create()
    {
        $rooms = Room::all();

        return view('admin.administration.RL.create', compact('rooms'));
    }

    public function rl_cr8()
    {
        $guests = Guest::where('status', 0)->get();

        return view('admin.administration.RL.cr8', compact('guests'));
    }

    public function rl_store(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:features|max:255',
            'email'     => 'required|email',
            'phone'     => 'required',
            'nights'    => 'required',
            'status'    => 'required'
        ]);

        $image = $request->file('pop');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('pop')){
                Storage::disk('public')->makeDirectory('pop');
            }
            $pop = Image::make($image)->resize(100, 160)->save();
            Storage::disk('public')->put('pop/'.$imagename, $pop);
        }else{
            $imagename = 'default.png';
        }

        $guest = new Guest();
        $guest->room_id             =   $request->room_id;
        $guest->type                =   $request->type;
        $guest->name                =   $request->name;
        $guest->address             =   $request->address;
        $guest->profession          =   $request->profession;
        $guest->email               =   $request->email;
        $guest->phone               =   $request->phone;
        $guest->veh_reg_no          =   $request->veh_reg_no;
        $guest->from                =   $request->from;
        $guest->to                  =   $request->to;
        $guest->Purpose             =   $request->purpose;
        $guest->nights              =   $request->nights;
        $guest->no_in_room          =   $request->no_in_room;
        $guest->nationality         =   $request->nationality;
        $guest->emergency_name      =   $request->emergency_name;
        $guest->emergency_phone     =   $request->emergency_phone;
        $guest->status              =   $request->status;
        $guest->save();

        $rl = new ReceptionistLedger();
        $rl->guest_id               =   $guest->id;
        $rl->room_id                =   $guest->room_id;
        $rl->payment_method         =   $request->payment_method;
        $rl->payment_type           =   $request->payment_type;
        $rl->discount               =   $request->discount;
        $rl->discounted_amount      =   $request->discounted_amount;
        $rl->remarks                =   $request->remarks;
        $rl->balance                =   $request->balance;
        $rl->pop                    =   $imagename;
        $rl->rc                     =   $request->rc;
        $rl->save();


        Toastr::success('message', 'Ledger added successfully.');
        return redirect()->route('admin.rl');
    }

    public function rl_edit($id)
    {
        $rl = ReceptionistLedger::find($id);
        $guest = Guest::find($rl->guest_id);
        $rooms = Room::all();
        return view('admin.administration.RL.edit',compact('rl', 'guest', 'rooms'));
    }

    public function rl_update(Request $request, $id)
    {
        $image = $request->file('pop');
        $slug  = Str::slug($request->title);
        $rl = ReceptionistLedger::find($id);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('pop')){
                Storage::disk('public')->makeDirectory('pop');
            }
            if(Storage::disk('public')->exists('pop/'.$rl->pop)){
                Storage::disk('public')->delete('pop/'.$rl->pop);
            }
            $pop = Image::make($image)->resize(100, 160)->save();
            Storage::disk('public')->put('pop/'.$imagename, $pop);
        }else{
            $imagename = $rl->pop;
        }

        $rl->payment_method         =   $request->payment_method;
        $rl->payment_type           =   $request->payment_type;
        $rl->discount               =   $request->discount;
        $rl->discounted_amount      =   $request->discounted_amount;
        $rl->remarks                =   $request->remarks;
        $rl->balance                =   $request->balance;
        $rl->pop                    =   $imagename;
        $rl->rc                     =   $request->rc;
        $rl->save();

        Toastr::success('message', 'Ledger updated successfully.');
        return redirect()->route('admin.rl');
    }

    public function rl_delete($id)
    {
        $rl = ReceptionistLedger::find($id);

        if(Storage::disk('public')->exists('pop/'.$rl->pop)){
            Storage::disk('public')->delete('pop/'.$rl->pop);
        }

        $rl->delete();

        Toastr::success('message', 'Ledger deleted successfully.');
        return back();
    }

    ############################################################################
    ########################### REQUISITIONS ###################################

    public function rq_index(){
        $data = Requisition::all();

        return view('admin.administration.RQ.index', compact('data'));
    }

    public function rq_create() {
        $types = RequestType::all();

        return view('admin.administration.RQ.create', compact('types'));
    }

    public function rq_store(Request $request) {
        $rq = new Requisition;
        $rq->user_id = Auth::id();
        $rq->type_id = $request->type;
        $rq->body = $request->body;
        $rq->status = 0;
        $rq->save();

        Toastr::success('message', 'Request submitted successfully');
        return route('admin.rq');
    }

    public function rq_edit($id) {
        $rq = Requisition::find($id);
        $types = RequestType::all();

        return view('admin.administration.RQ.edit', compact('rq', 'types'));
    }

    public function rq_update(Request $request, $id) {
        $rq = Requisition::find($id);
        $rq->type_id = $request->type;
        $rq->body = $request->body;
        $rq->status = $request->status;
        $rq->save();

        Toastr::success('message', 'Request updated successfully');
        return back();
    }

    public function rq_delete($id) {
        $rq = Requisition::find($id);
        $rq->delete();

        Toastr::success('message', 'Request deleted');
        return back();
    }

    ############################################################################
    ########################### REQUEST TYPES ##################################

    public function rqt_index() {
        $types = RequestType::all();

        return view('admin.administration.RQT.index', compact('types'));
    }

    public function rqt_create() {
        return view('admin.administration.RQT.create');
    }

    public function rqt_store(Request $request) {
        $type = new RequestType();
        $type->name     = $request->name;
        $type->slug     = Str::slug($request->name);
        $type->save();

        Toastr::success('message', 'Request type created successfully');
        return back();
    }

    public function rqt_edit($id) {
        $type = RequestType::find($id);

        return view('admin.administration.RQT.edit', compact('type'));
    }

    public function rqt_update(Request $request, $id) {
        $type = RequestType::find($id);
        $type->name     = $request->name;
        $type->slug     = Str::slug($request->name);
        $type->update();

        Toastr::success('message', 'Request type updated successfully');
        return back();
    }

    public function rqt_delete($id) {
        $type = RequestType::find($id);
        $type->delete();

        Toastr::success('message', 'Request type deleted');
        return back();
    }

    ############################################################################
    ########################### STORE RECORDS ##################################

    public function sr_index() {
        $data = StoreRecord::all();

        return view('admin.administration.SR.index', compact('data'));
    }

    public function sr_create() {
        $items = RecordItem::all();

        return view('admin.administration.SR.create',compact('items'));
    }

    public function sr_store(Request $request) {
        for ($i=0; $i < count($request->record_item_id); $i++) {
            if (isset($request->opening_stock[$i]) && isset($request->supplied[$i]) && isset($request->issued[$i])) {
                StoreRecord::create([
                    'record_item_id'    =>  $request->record_item_id[$i],
                    'opening_stock'     =>  $request->opening_stock[$i],
                    'supplied'          =>  $request->supplied[$i],
                    'issued'            =>  $request->issued[$i],
                    'closing_stock'     =>  $request->closing_stock[$i],
                    'remark'            =>  $request->remark[$i],
                ]);
            }
        }

        Toastr::success('message', 'Store record added successfully');
        return back();
    }

    public function sr_edit($id) {
        $data = StoreRecord::find($id);
        $items = RecordItem::all();

        return view('admin.administration.SR.edit', compact('data', 'items'));
    }

    public function sr_update(Request $request, $id) {
        $item = StoreRecord::find($id);
        $item->record_item_id    =  $request->record_item_id;
        $item->opening_stock     =  $request->opening_stock;
        $item->supplied          =  $request->supplied;
        $item->issued            =  $request->issued;
        $item->closing_stock     =  $request->closing_stock;
        $item->remark            =  $request->remark;
        $item->update();

        Toastr::success('message', 'Store record updated successfully');
        return back();
    }

    public function sr_delete($id) {
        $type = StoreRecord::find($id);
        $type->delete();

        Toastr::success('message', 'Store record deleted');
        return back();
    }

    ############################################################################
    ############################# STORE ITEM ###################################

    public function ri_index() {
        $items = RecordItem::all();

        return view('admin.administration.RI.index', compact('items'));
    }

    public function ri_create() {
        return view('admin.administration.RI.create');
    }

    public function ri_store(Request $request) {
        $item = new RecordItem();
        $item->name     = $request->name;
        $item->slug     = Str::slug($request->name);
        $item->save();

        Toastr::success('message', 'Store item created successfully');
        return back();
    }

    public function ri_edit($id) {
        $item = RecordItem::find($id);

        return view('admin.administration.RI.edit', compact('item'));
    }

    public function ri_update(Request $request, $id) {
        $item = RecordItem::find($id);
        $item->name     = $request->name;
        $item->slug     = Str::slug($request->name);
        $item->update();

        Toastr::success('message', 'Store item updated successfully');
        return back();
    }

    public function ri_delete($id) {
        $item = RecordItem::find($id);
        $item->delete();

        Toastr::success('message', 'Store item deleted');
        return back();
    }

    ############################################################################
    ############################# IMPREST ###################################

    public function mp_index() {
        $items = Imprest::all();

        return view('admin.administration.MP.index', compact('items'));
    }

    public function mp_create() {
        return view('admin.administration.MP.create');
    }

    public function mp_store(Request $request) {
        $item = new Imprest();
        $item->description     = $request->description;
        $item->amount     = $request->amount;
        $item->balance     = $request->balance;
        $item->save();

        Toastr::success('message', 'Imprest record added successfully');
        return back();
    }

    public function mp_edit($id) {
        $item = Imprest::find($id);

        return view('admin.administration.MP.edit', compact('item'));
    }

    public function mp_update(Request $request, $id) {
        $item = Imprest::find($id);
        $item->description     = $request->description;
        $item->amount     = $request->amount;
        $item->balance     = $request->balance;
        $item->update();

        Toastr::success('message', 'Imprest record updated successfully');
        return back();
    }

    public function mp_delete($id) {
        $item = Imprest::find($id);
        $item->delete();

        Toastr::success('message', 'Imprest record deleted');
        return back();
    }

    ############################################################################
    ############################# DAILY CASH RECORD ############################

    public function dcr_index() {
        $items = DailyCashRecords::all();

        return view('admin.administration.DCR.index', compact('items'));
    }

    public function dcr_create() {
        return view('admin.administration.DCR.create');
    }

    public function dcr_store(Request $request) {
        $item = new DailyCashRecords();
        $item->description     = $request->description;
        $item->amount     = $request->amount;
        $item->indicator     = $request->indicator;
        $item->save();

        Toastr::success('message', 'Record added successfully');
        return back();
    }

    public function dcr_edit($id) {
        $item = DailyCashRecords::find($id);

        return view('admin.administration.DCR.edit', compact('item'));
    }

    public function dcr_update(Request $request, $id) {
        $item = DailyCashRecords::find($id);
        $item->description     = $request->description;
        $item->amount     = $request->amount;
        $item->indicator     = $request->indicator;
        $item->update();

        Toastr::success('message', 'Record updated successfully');
        return back();
    }

    public function dcr_delete($id) {
        $item = DailyCashRecords::find($id);
        $item->delete();

        Toastr::success('message', 'Record deleted');
        return back();
    }

    ############################################################################
    ########################### STORE RECORDS ##################################

    public function dp_index() {
        $data = DrinkPurchase::all();

        return view('admin.administration.DP.index', compact('data'));
    }

    public function dp_create() {
        $suppliers = Supplier::all();

        return view('admin.administration.DP.create',compact('suppliers'));
    }

    public function dp_store(Request $request) {
        for ($i=0; $i < count($request->supplier_id); $i++) {
            if (isset($request->brand[$i]) && isset($request->quantity[$i]) && isset($request->rate[$i])) {
                DrinkPurchase::create([
                    'supplier_id'    =>  $request->supplier_id[$i],
                    'brand'          =>  $request->brand[$i],
                    'stock_level'    =>  $request->stock_level[$i],
                    'quantity'       =>  $request->quantity[$i],
                    'rate'           =>  $request->rate[$i],
                    'amount'         =>  $request->amount[$i],
                    'remarks'        =>  $request->remarks[$i],
                ]);
            }
        }

        Toastr::success('message', 'Record added successfully');
        return back();
    }

    public function dp_edit($id) {
        $data = DrinkPurchase::find($id);
        $suppliers = Supplier::all();

        return view('admin.administration.DP.edit', compact('data', 'suppliers'));
    }

    public function dp_update(Request $request, $id) {
        $item = DrinkPurchase::find($id);
        $item->record_item_id    =  $request->record_item_id;
        $item->opening_stock     =  $request->opening_stock;
        $item->supplied          =  $request->supplied;
        $item->issued            =  $request->issued;
        $item->closing_stock     =  $request->closing_stock;
        $item->remark            =  $request->remark;
        $item->update();

        Toastr::success('message', 'Record updated successfully');
        return back();
    }

    public function dp_delete($id) {
        $type = DrinkPurchase::find($id);
        $type->delete();

        Toastr::success('message', 'Record deleted');
        return back();
    }

    ############################################################################
    ############################# SUPPLIERS ############################

    public function sp_index() {
        $suppliers = Supplier::all();

        return view('admin.administration.SP.index', compact('suppliers'));
    }

    public function sp_create() {
        return view('admin.administration.SP.create');
    }

    public function sp_store(Request $request) {
        $supplier = new Supplier();
        $supplier->name     = $request->name;
        $supplier->slug     = Str::slug($request->name);
        $supplier->phone    = $request->phone;
        $supplier->email    = $request->email;
        $supplier->address  = $request->address;
        $supplier->save();

        Toastr::success('message', 'Supplier added successfully');
        return back();
    }

    public function sp_edit($id) {
        $supplier = Supplier::find($id);

        return view('admin.administration.SP.edit', compact('supplier'));
    }

    public function sp_update(Request $request, $id) {
        $supplier = Supplier::find($id);
        $supplier->name     = $request->name;
        $supplier->slug     = Str::slug($request->name);
        $supplier->phone    = $request->phone;
        $supplier->email    = $request->email;
        $supplier->address  = $request->address;
        $supplier->update();

        Toastr::success('message', 'Supplier updated successfully');
        return back();
    }

    public function sp_delete($id) {
        $supplier = Supplier::find($id);
        $supplier->delete();

        Toastr::success('message', 'Supplier deleted successfully');
        return back();
    }

}
