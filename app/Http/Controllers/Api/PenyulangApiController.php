<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DgMvcell;
use Illuminate\Support\Facades\DB;
use App\Models\Penyulang;

class PenyulangApiController extends Controller
{
    /**
     * Return list of penyulangs (feeder names) for a given gardu_induk
     * Accepts: ?gardu_induk=NAME
     * Returns: JSON array of { id, name } or ["name1", "name2"]
     */
    public function penyulangsByGardu(Request $request)
    {
        $gardu = $request->query('gardu_induk');
        if (!$gardu) {
            return response()->json([], 200);
        }

            // Try to find distinct UPT (penyulang name) in dg_mvcell that match the gardu_induk
            // Use a representative id (MIN(id)) for each UPT so we can pass numeric id back to the client.
            $rows = DgMvcell::where('GARDU INDUK', $gardu)
                ->select('UPT', DB::raw('MIN(id) as id'))
                ->groupBy('UPT')
                ->get();

        // Build unique list by preferred columns (feeder -> name -> mvcell)
        $list = collect();
        foreach ($rows as $r) {
            // Prefer UPT as the label (this query already grouped by UPT)
            $label = $r->UPT ?? null;
            if (!$label) continue;

            // Return UPT as both value and label so the client select uses UPT for value and display
            $list->push([
                'id' => $label,
                'name' => $label,
            ]);
        }

        // unique by name and sort
        $unique = $list->unique('name')->sortBy('name')->values()->all();

        return response()->json($unique);
    }

    /**
     * Return detail object for a selected penyulang (by name)
     * Accepts: ?name= (UPT) and optional ?gardu_induk=
     * Returns: JSON object with keys matching form names
     */
    public function penyulangDetail(Request $request)
    {
        $gardu = $request->query('gardu_induk');
        $upt = $request->query('name');

        $row = null;

        // Note: controller no longer accepts or relies on id from client payload.

        // If gardu and upt provided, try to search dg_mvcell scoped by gardu
        if (!$row && $gardu && $upt) {
            $row = DgMvcell::where('UPT', $upt)
                ->where('GARDU INDUK', $gardu)
                ->select('ULP')
                ->groupBy('ULP')
                ->get();
        }

        
        return response()->json($row, 200);
    }

    /**
     * Return trafo detail (T_NO and UP3) for given gardu_induk + UPT + ULP
     * Accepts: ?gardu_induk=&name=&ulp=
     * Returns: { T_NO: string|null, UP3: string|null }
     */
    public function trafoByUlp(Request $request)
    {
        $gardu = $request->query('gardu_induk');
        $upt = $request->query('name');
        $ulp = $request->query('ulp');

        if (!$gardu || !$upt || !$ulp) {
            return response()->json([], 200);
        }

        $row = DgMvcell::where('UPT', $upt)
            ->where('GARDU INDUK', $gardu)
            ->where('ULP', $ulp)
            ->select('NO', 'UP3')
            ->first();

        if (!$row) {
            return response()->json([], 200);
        }

        return response()->json([
            'T_NO' => $row->NO ?? null,
            'UP3' => $row->UP3 ?? null,
        ], 200);
    }
}