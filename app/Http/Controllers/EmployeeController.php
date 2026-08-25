<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            // VULNERABLE: SQL Injection
            $employees = DB::select("SELECT * FROM employees WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR department LIKE '%$search%' OR position LIKE '%$search%'");
            return view('employees.index', ['employees' => $employees]);
        }

        $employees = Employee::where('created_by', auth()->id())->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['created_by'] = auth()->id();
        $employee = Employee::create($validated);

        return redirect()->route('employees.show', $employee)->with('success', 'Employee added.');
    }

    public function show(Employee $employee)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $employee->update($request->all());
        return redirect()->route('employees.show', $employee)->with('success', 'Employee updated.');
    }

    public function destroy(Employee $employee)
    {
        // IDOR: TIDAK ADA pengecekan kepemilikan
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted.');
    }
}