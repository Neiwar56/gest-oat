<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personne;
use App\Models\AuditLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Nombre total de personnes
        $totalPersonnes = Personne::count();

        // Administrateurs - adapte si tu as un champ 'role' ou 'is_admin'
        $totalAdmins = User::where('role', 'admin')->count(); // si pas de role, dis-le moi

        // Activité du jour - basé sur AuditLog (ou Personne créée aujourd'hui si tu préfères)
        $today = Carbon::today();
        $activiteDuJour = AuditLog::whereDate('created_at', $today)->count();

        // Comparaisons pour pourcentage
        $moisPrecedent = Carbon::now()->subMonth();
        $personnesMoisPrecedent = Personne::whereMonth('created_at', $moisPrecedent->month)->count();
        $variationPersonnes = $personnesMoisPrecedent > 0
            ? round((($totalPersonnes - $personnesMoisPrecedent) / $personnesMoisPrecedent) * 100, 1)
            : 0;

        return view('dashboard', compact(
            'totalPersonnes',
            'totalAdmins',
            'activiteDuJour',
            'variationPersonnes'
        ));
    }
}
