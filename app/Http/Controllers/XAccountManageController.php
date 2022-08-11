<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AccountManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function viewManageAccount()
    // {
    //     if(auth()->user()->user_position === 'superadmin_distributor')
    //     {
    //         return view('manage_account.account', ['users' => User::where('id_input',auth()->user()->id)->get()]);
    //     }
    //     else
    //     {
    //         return view('manage_account.account', ['users' => User::whereIn('user_position', ['superadmin_pabrik', 'accounting_pabrik', 'cashier_pabrik', 'superadmin_distributor'])->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
    //     }
    // }


    // public function viewAddAccount()
    // {
    //     return view('manage_account.add_account', ['user' => auth()->user()]);

    // }

    public function viewEditAccount($username)
    {
        // dd(User::where('username', $username)->first());
        return view('manage_account.edit_account', ['user' => User::where('username', $username)->first()]);
        // return view('manage_account.edit_account');
    }

    

    public function index()
    {
        if(auth()->user()->user_position === 'superadmin_distributor')
        {
            return view('manage_account.index', ['users' => User::where('id_input',auth()->user()->id)->get()]);
        }
        else
        {
            return view('manage_account.index', ['users' => User::whereIn('user_position', ['superadmin_pabrik', 'accounting_pabrik', 'cashier_pabrik', 'superadmin_distributor'])->get()], ['superadmins' => User::where('user_position', 'superadmin_pabrik')->get()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage_account.create', ['user' => auth()->user()]);

        // return view('dashboard.posts.create', [
        //     'categories' => Category::all()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // return $request->file('file-upload')->store('manage_account/users');

        if(auth()->user()->user_position === "superadmin_distributor")
        {
            // dd('ddd');
            $validateData = $request->validate([
                'user_position' => 'required',
                'username' => 'required|min:3|max:255|unique:users',
                'image' => 'image|file|max:1024',
                // 'password' => 'min:3',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'ktp' => 'required',
                'email' => 'required|email:dns|unique:users',
            ]);
            // $validateData['user_type'] = "distributor";
            $validateData['id_group'] = auth()->user()->id_group;        

        }
        else
        {   
            // dd('eee');
            // dd($request);

            $validateData = $request->validate([
                // 'user_type' => 'required',
                'user_position' => 'required',
                'username' => 'required|min:3|max:255|unique:users',
                'image' => 'image|file|max:1024',
                // 'password' => 'min:3',
                'firstname' => 'required|max:255',
                'lastname' => 'required|max:255',
                'ktp' => 'required',
                'email' => 'required|email:dns|unique:users',
            ]);
            // dd('ccc');

            // gk pake user type lagi
            if($validateData['user_position'] == "superadmin_pabrik")
            {
                $validateData['id_group'] = auth()->user()->id_group;        
            }
            else
            {
                $validateData['id_group'] = $validateData['username'];        
            }
            // dd('bbb');

            if($validateData['user_position'] == "superadmin_distributor")
            {
                $validateData['cluster'] = $request->cluster;
            }
        }

        // dd('aaa');
        if($request->file('image'))
        {
            $validateData['image'] = $request->file('image')->store('manage_account/users');
        }
        // dd('ggg');

        $validateData['password'] = $request->password;
        // dd('hhh');

        $validateData['id_input'] = auth()->user()->id;

        if(!$request->password)
        {
            $validateData['password'] = Hash::make("12345");
        }

        if($request->tokopedia){
            $validateData['tokopedia'] = $request->tokopedialink;
        }
        if($request->shopee){
            $validateData['shopee'] = $request->shopeelink;
        }
        if($request->lazada){
            $validateData['lazada'] = $request->lazadalink;
        }
        if($request->bukalapak){
            $validateData['bukalapak'] = $request->bukalapaklink;
        }
        if($request->blibli){
            $validateData['blibli'] = $request->bliblilink;
        }

        User::create($validateData);
        return redirect('/manage_account')->with('success', 'Penambahan pegawai berhasil!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return view('dashboard.posts.edit', [
        //     'user' => $user,
        //     'categories' => Category::all()
        // ]);
        dd($user);
        return view('manage_account.edit', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($request);
        dd($user);
    }

    public function updateAccount(Request $req)
    {
        dd($req);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/manage_account')->with('success', 'Penghapusan pegawai berhasil!!');
    }

    public function deleteAccount($id)
    {
        // $id_account = auth()->id;
        // $check_access = Acces::where('user', $id_account)
        // ->first();
        // if($check_access->kelola_akun == 1){
        //     User::destroy($id);
        //     Acces::where('user', $id)->delete();

        //     Session::flash('delete_success', 'Akun berhasil dihapus');

        //     return back();
        // }else{
        //     return back();
        // }

        // dd($id);
        User::destroy($id);
        Session::flash('delete_success', 'Akun berhasil dihapus');
        return back();
    }
}
