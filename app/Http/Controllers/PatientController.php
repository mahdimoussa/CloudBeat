<?php

namespace App\Http\Controllers;

use App\device;
use App\event;
use App\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function get()
    {
        $patients = patient::orderBy('SST', 'desc')->get();
        foreach ($patients as $patient) {
            $patient->DSN = device::where(['id' => $patient->DID])->value('SN');
            $patient->NbOfEvents = event::where(['PID' => $patient->id])->count();

            $tmp = event::select(DB::raw('avg(BPM) as avg_BPM, max(BPM) as max_BPM, min(BPM) as min_BPM'))->where(['PID' => $patient->id])->first();
            $patient->min_BPM = $tmp->min_BPM;
            $patient->avg_BPM = $tmp->avg_BPM;
            $patient->max_BPM = $tmp->max_BPM;

            $patient->min_date = event::where(['PID' => $patient->id, 'BPM' => $patient->min_BPM])->value('date');
            $patient->max_date = event::where(['PID' => $patient->id, 'BPM' => $patient->max_BPM])->value('date');
        }
        return view('welcome', ['data' => $patients]);
    }
}
