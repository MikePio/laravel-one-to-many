<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// importo il modello dei progetti
use App\Models\Project;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    public function dashboard(){
      $n_projects = Project::all()->count();
      // dd($n_projects);
      return view('admin.dashboard', compact('n_projects'));
    }
}
