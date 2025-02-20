<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
         // Aqui você pode adicionar as estatísticas que deseja mostrar
         $data = [
            'total_users' => User::count(),
            'recent_users' => User::latest()->take(5)->get(),
            // Exemplo de outras estatísticas que você pode adicionar:
            // 'open_tickets' => Ticket::where('status', 'open')->count(),
            // 'total_equipment' => Equipment::count(),
            // 'active_projects' => Project::where('status', 'active')->count(),
        ];

        return view('dashboard.index', $data);
       
    }
}
