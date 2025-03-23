<?php

namespace App\Controllers;
use App\Models\WeaponsModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $title = "Dashboard";
        $weaponModel = new WeaponsModel();
        $userRole = session()->get('role');
        $policeStationId = session()->get('police_station_id');

        if ($userRole === 'admin') {
            $totalWeapons = $weaponModel->countAllResults();
            $issuedWeapons = $weaponModel->where('status', 'Issued')->countAllResults();
            $availableWeapons = $weaponModel->where('status', 'Available')->countAllResults();
        } else {
            $totalWeapons = $weaponModel->where('police_station_id', $policeStationId)->countAllResults();
            $issuedWeapons = $weaponModel->where(['police_station_id' => $policeStationId, 'status' => 'Issued'])->countAllResults();
            $availableWeapons = $weaponModel->where(['police_station_id' => $policeStationId, 'status' => 'Available'])->countAllResults();
        }

        return view('dashboard', [
            'totalWeapons' => $totalWeapons,
            'issuedWeapons' => $issuedWeapons,
            'availableWeapons' => $availableWeapons,
            'title' => $title,
            'userRole' => $userRole
        ]);
    }
}