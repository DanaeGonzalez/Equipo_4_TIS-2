<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Para el gráfico de mascotas por día (últimos 7 días)
        $dates = collect(range(6, 0))->map(fn($i) => Carbon::now()->subDays($i)->format('Y-m-d'));

        $petCounts = DB::table('pets')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('date')
            ->pluck('count', 'date');

        $data = $dates->map(fn($date) => $petCounts[$date] ?? 0);

        return view('tenant.dashboard.index', [
            'chartLabels' => $dates->map(fn($d) => Carbon::parse($d)->format('d M')),
            'chartData' => $data,
            'totalPets' => Pet::count(),
            'weeklyGrowth' => round(($data->sum() / max(1, Pet::count())) * 100, 1),
        ]);
    }
}
