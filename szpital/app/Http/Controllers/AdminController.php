<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminPanel(Request $request)
    {
        $view = $request->get('view');
        $availableViews = ['accounts', 'doctorsTreatments', 'medicineAssignment', 'nurseAssignment', 'nurseTreatments'];

        // Check if the requested view is in the list of available views
        if (!in_array($view, $availableViews)) {
            $view = null; // Default to null if the view is not valid
        }

        return view('admin', compact('view'));
    }
}
