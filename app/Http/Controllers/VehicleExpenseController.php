<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleExpenseRequest;
use App\Http\Resources\VehicleExpenseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleExpenseController extends Controller
{
    public function index(VehicleExpenseRequest $request)
    {
        $validated = $request->validated();

        //default param
        $perPage = $validated['per_page'] ?? 20;
        $sort = $validated['sort'] ?? 'created_at';
        $direction = $validated['direction'] ?? 'desc';

        //queries to get data from three tables
        $fuelQ = DB::table('fuel_entries')
            ->join('vehicles', 'fuel_entries.vehicle_id', '=', 'vehicles.id')
            ->selectRaw("
                vehicles.id AS vehicle_id,
                vehicles.name AS vehicle_name,
                vehicles.plate_number,
                'fuel' AS type,
                fuel_entries.cost AS cost,
                fuel_entries.entry_date AS created_at
            ");

        $insuranceQ = DB::table('insurance_payments')
            ->join('vehicles', 'insurance_payments.vehicle_id', '=', 'vehicles.id')
            ->selectRaw("
                vehicles.id AS vehicle_id,
                vehicles.name AS vehicle_name,
                vehicles.plate_number,
                'insurance' AS type,
                insurance_payments.amount AS cost,
                insurance_payments.contract_date AS created_at
            ");

        $serviceQ = DB::table('services')
            ->join('vehicles', 'services.vehicle_id', '=', 'vehicles.id')
            ->selectRaw("
                vehicles.id AS vehicle_id,
                vehicles.name AS vehicle_name,
                vehicles.plate_number,
                'service' AS type,
                services.total AS cost,
                services.created_at AS created_at
            ");


        $union = $fuelQ->unionAll($insuranceQ)->unionAll($serviceQ);

        $query = DB::query()->fromSub($union, 'expenses');

        //apply filter, sorting, search
        if (!empty($validated['vehicle_name'])) {
            $query->where('vehicle_name', 'like', '%' . $validated['vehicle_name'] . '%');
        }

        if (!empty($validated['type'])) {
            $query->whereIn('type', $validated['type']);
        }

        if (!empty($validated['min_cost'])) {
            $query->where('cost', '>=', $validated['min_cost']);
        }

        if (!empty($validated['max_cost'])) {
            $query->where('cost', '<=', $validated['max_cost']);
        }

        if (!empty($validated['min_date'])) {
            $query->where('created_at', '>=', $validated['min_date']);
        }

        if (!empty($validated['max_date'])) {
            $query->where('created_at', '<=', $validated['max_date']);
        }

        $query->orderBy($sort, $direction);

        $expenses = $query->paginate($perPage)->appends($request->query());

        return VehicleExpenseResource::collection($expenses);
    }
}
