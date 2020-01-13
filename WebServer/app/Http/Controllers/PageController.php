<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use App\hoa_don;
use App\san_pham;
use App\thanh_vien;


class PageController extends Controller
{
    // hien thi trang admin
    public function getAdmin(){
    	return view('admin.index');
    }
    public function getIndex(){
    	return view('admin.index');
    }

}
