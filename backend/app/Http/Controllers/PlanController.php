<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json(Plan::where('is_active', true)->get());
    }

    public function show($id)
    {
        return response()->json(Plan::findOrFail($id));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        
        $subscription = Subscription::create([
            'user_id' => $request->user()->id,
            'plan_id' => $plan->id,
            'starts_at' => now(),
            'ends_at' => now()->addDays($plan->duration_in_days),
        ]);

        return response()->json(['message' => 'Abonnement créé avec succès', 'subscription' => $subscription], 201);
    }
}