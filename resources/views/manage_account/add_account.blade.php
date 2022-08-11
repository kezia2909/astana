@extends('templates/main')

@section('css')
<style>
    .upload{
        background-color:rgba(52, 25, 80, 1);
        color:white;
        width:100px;
        border: 1px solid white;
        border-radius: 5px;
        width:150px;
        height:50px;
        
    }
    .text{
        color:rgba(52, 25, 80, 1);
        float: left;
    }
    .textField{
        background-color:white;
        border-radius: 5px;
        text-align:left;
    }
</style>
@endsection

@section('content')
<div class="container justify text-center">
    <form action="/add_account" method="post" name="create_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <img src="images/manage_account/users/11.png" alt="profile-img" class="avatar-130 img-fluid img-preview"/>
                </div>
                <div class="btn-action col-3 d-flex justify-content-center align-items-center">
                    <label for="file-upload" class="custom-file-upload upload btn-primary d-flex justify-content-center align-items-center">
                        <p>Upload Foto</p>
                    </label>
                    <input class="form-control @error('image') is-invalid @enderror" id="file-upload" name="image" type="file" hidden="" onchange="previewImage()"/>
                    &nbsp;
                    &nbsp;
                    <label class="custom-file-upload upload btn-primary d-flex justify-content-center align-items-center" onchange="deleteImage()">
                        Delete Foto
                    </label>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="username" class="text">Username</label>
                </div>
                <div class="col-10">
                    <input type="text" name="username" class="form-control textField" id="username"
                        placeholder="Masukkan Username">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="firstname" class="text">Nama Depan</label>
                </div>
                <div class="col-10">
                    <input type="text" name="firstname" class="form-control textField" id="firstname"
                        placeholder="Masukkan Nama Depan">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="lastname" class="text">Nama Belakang</label>
                </div>
                <div class="col-10">
                <input type="text" name="lastname" class="form-control textField" id="lastname"
                        placeholder="Masukkan Nama Belakang">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="ktp" class="text">Nomor KTP</label>
                </div>
                <div class="col-10">
                <input type="text" name="ktp" class="form-control textField" id="ktp"
                        placeholder="Masukkan Nomor KTP">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="password" class="text">Password Baru</label>
                </div>
                <div class="col-10">
                <input type="text" name="password" class="form-control textField" id="password"
                        placeholder="Masukkan Password Baru">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="email" class="text">Email</label>
                </div>
                <div class="col-10">
                    <input type="email" name="email" class="form-control textField" id="email" placeholder="Enter your Email">
                </div>
                
            </div>
        </div>

        {{-- <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Province</label>
                </div>
                
                <div class="col-10">
                    <select class="form-control" id="province" name="province">
                        <option value="department">Choice Province</option>
                        <option value="prd">Sulawesi Tenggara</option>
                        <option value="hnd">Jawa Barat</option>
                        <option value="academic">Jawa Timur</option>
                    </select>
                </div>
                
            </div>
        </div> --}}

        {{-- <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">City</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="city" name="city" >
                        <option value="department">Choice City</option>
                        <option value="prd">Surabaya</option>
                        <option value="hnd">Malang</option>
                        <option value="academic">Makassar</option>
                    </select>
                </div>
                
            </div>
        </div> --}}

        {{-- <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="exampleInputAddress" class="text">Address</label>
                </div>
                <div class="col-10">
                    <input type="address" class="form-control" id="exampleInputAddress"
                        placeholder="Enter your Address">
                </div>
                
            </div>
        </div> --}}

        {{-- <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Zip/Postal Code</label>
                </div>
                <div class="col-10">
                    <input class="form-control" type="text" min=5 max=5 name="postcode" placeholder="Enter your Zip/Portal Code">
                </div>
                
            </div>
        </div> --}}

        {{-- <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Cluster</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="cluster" name="cluster" >
                        <option value="department">Choice Cluster</option>
                        <option value="clusterA">Cluster A</option>
                        <option value="clusterB">Cluster B</option>
                        <option value="clusterC">Cluster C</option>
                    </select>
                </div>
                
            </div>
        </div> --}}
        {{-- <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">E-commerce</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="ecommerce" name="ecommerce" >
                        <option value="department">Choice E-commerce</option>
                        <option value="tokopedia">Tokopedia</option>
                        <option value="shopee">Shopee</option>
                        <option value="lazada">Lazada</option>
                    </select>
                </div>
                
            </div>
        </div> --}}
        {{-- @can('pabrik')
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">User Type</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="user_type" name="user_type" onchange="getUserType(this.value)">
                        <option value="user_type">Choice User Type</option>
                        <option value="pabrik">Pabrik</option>
                        <option value="distributor">Distributor</option>
                    </select>
                </div>
            </div>
        </div>
        @endcan --}}
        {{-- @can('distributor')
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">User Type</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="user_type" name="user_type" onchange="getUserType(this.value)">
                        <option value="user_type">Choice User Type</option>
                        <option value="distributor">Distributor</option>
                        <option value="reseller">Reseller</option>
                    </select>
                </div>
            </div>
        </div>
        @endcan --}}

        @can('superadmin_pabrik')
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Posisi</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="user_position" name="user_position" onchange="getUserPosition(this.value)">
                        <option value="user_position">Pilih Posisi</option>
                        <option value="superadmin_pabrik">Super Admin</option>
                        <option value="accounting_pabrik">Accounting</option>
                        <option value="cashier_pabrik">Cashier</option>
                        <option value="superadmin_distributor">Distributor</option>
                    </select>
                </div>
                
            </div>
        </div>
        <div class="form-group" id="form_cluster">
            <div class="row">
                <div class="col-2">
                    <label class="text">Klaster</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="cluster" name="cluster">
                        <option value="cluster">Pilih Klaster</option>
                        <option value="klasterA">Klaster A</option>
                        <option value="klasterB">Klaster B</option>
                        <option value="klasterC">Klaster C</option>
                    </select>
                </div>
                
            </div>
        </div>
        @endcan
        @can('superadmin_distributor')
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Posisi</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="user_position" name="user_position" onchange="getUserPosition(this.value)">
                        <option value="user_position">Pilih Posisi</option>
                        <option value="accounting_distributor">Accounting</option>
                        <option value="cashier_distributor">Cashier</option>
                        <option value="reseller">Reseller</option>
                    </select>
                </div>
                
            </div>
        </div>
        @endcan

        <!-- <div class="col-12 d-flex justify-content-end">
            <button class="btn simpan-btn btn-sm" type="submit" autocomplete="off">
                <i class="mdi mdi-content-save">
                    ::before
                </i>
                Simpan
            </button>
        </div> -->

        {{-- @can('superadmin_distributor') --}}
        <div class="form-group" id="toko_online">
            <div class="row">
                <div class="col-2">
                    <label class="text">Toko Online</label>
                </div>
                <div class="col-10 text-left">
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="tokopedia" name="tokopedia" >Tokopedia</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="tokopedialink" name="tokopedialink"
                            placeholder="Masukkan Link Tokopedia">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="shopee" name="shopee">Shopee</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="shopeelink" name="shopeelink"
                            placeholder="Masukkan Link Shopee">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="lazada" name="lazada">Lazada</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="lazadalink" name="lazadalink"
                            placeholder="Masukkan Link Lazada">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="bukalapak" name="bukalapak">Buka Lapak</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="bukalapaklink" name="bukalapaklink"
                            placeholder="Masukkan Link Buka Lapak">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="blibli" name="blibli">Blibli</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="bliblilink" name="bliblilink"
                            placeholder="Masukkan Link Blibli">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endcan --}}
        
        <div class="form-group text-right">
            <input type="submit" onclick="" class="btn btn-primary submit" value="Submit">
        </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">

    $(function() {
        // alert("ready");
        // console.log("bbb");

        $("#form_cluster").hide();
        $("#toko_online").hide();
    });

    // function getUserType(user_type)
    // {
    //     if("{{ $user->user_type }}" == "pabrik")
    //     {
    //         if(user_type == "distributor")
    //         {
    //             $("#user_position option[value='cashier']").hide();
    //             $("#user_position option[value='accounting']").hide();
    //             $("#user_position option[value='reseller']").hide();
    //         }
    //         else{
    //             $("#user_position option[value='cashier']").show();
    //             $("#user_position option[value='accounting']").show();
    //             $("#user_position option[value='reseller']").show();
    //         }
    //     }
    // }

    function getUserPosition(user_position)
    {
        // alert(user_position);
        if("{{ auth()->user()->user_position }}" == "superadmin_pabrik")
        {
            if(user_position == "superadmin_distributor") {
                $("#form_cluster").show();
                $("#toko_online").show();
            }
            else {
                $("#form_cluster").hide();
                $("#toko_online").hide();
            }
        }
        else
        {
            if(user_position == "reseller") {
                $("#toko_online").show();
            }
            else {
                $("#toko_online").hide();
            }
        }

    }

    function previewImage() {
        const image = document.querySelector('#file-upload');
        const imgPreview = document.querySelector('.img-preview');
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function deleteImage() {
        // const image = document.querySelector('#file-upload');
        const imgPreview = document.querySelector('.img-preview');
        
        // const oFReader = new FileReader();
        // oFReader.readAsDataURL(image.files[0]);

        // oFReader.onload = function(oFREvent) {
        //     imgPreview.src = oFREvent.target.result;
        // }

        imgPreview.src = "images/manage_account/users/11.png";
    }

    
</script>
@endsection