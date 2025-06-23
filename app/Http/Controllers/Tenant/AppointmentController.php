<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Appointment;
use App\Models\Tenant\Service;
use App\Models\Tenant\Staff;
use App\Models\Tenant\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'staff.user', 'service'])
            ->latest()
            ->paginate(15);

        $stats = [
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'confirmed_appointments' => Appointment::where('status', 'confirmed')->count(),
            'cancelled_appointments' => Appointment::where('status', 'cancelled')->count(),
        ];

        // Data for modals
        $customers = User::where('role', 'customer')->get();
        $staff = Staff::where('is_active', true)->with('user')->get();
        $services = Service::where('is_active', true)->get();

        return view('tenant.pages.appointments', compact('appointments', 'stats', 'customers', 'staff', 'services'));
    }

    public function create()
    {
        $customers = User::where('role', 'customer')->get();
        $staff = Staff::where('is_active', true)->with('user')->get();
        $services = Service::where('is_active', true)->get();

        return view('tenant.pages.appointments', compact('customers', 'staff', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'staff_id' => 'required|exists:staff,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);
        $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);

        $appointment = Appointment::create([
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'service_id' => $request->service_id,
            'appointment_date' => $appointmentDateTime->toDateString(),
            'appointment_time' => $request->appointment_time,
            'notes' => $request->notes,
            'total_price' => $service->price,
            'status' => $request->status ?? 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ]);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['customer', 'staff.user', 'service']);
        return view('tenant.pages.appointments', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $customers = User::where('role', 'customer')->get();
        $staff = Staff::where('is_active', true)->with('user')->get();
        $services = Service::where('is_active', true)->get();

        return view('tenant.pages.appointments', compact('appointment', 'customers', 'staff', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'staff_id' => 'required|exists:staff,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $service = Service::findOrFail($request->service_id);
        $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $request->appointment_time);

        $appointment->update([
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'service_id' => $request->service_id,
            'appointment_date' => $appointmentDateTime->toDateString(),
            'appointment_time' => $request->appointment_time,
            'notes' => $request->notes,
            'total_price' => $service->price,
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appointment deleted successfully'
        ]);
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully'
        ]);
    }
} 