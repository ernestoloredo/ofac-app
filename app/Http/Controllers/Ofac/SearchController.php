<?php

namespace App\Http\Controllers\Ofac;

use App\Http\Controllers\Controller;
use App\Models\SdnEntry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $r)
    {
        $q        = trim($r->get('q',''));
        $list     = $r->get('list','sdn');
        $country  = $r->get('country');
        $program  = $r->get('program');

        $entries = SdnEntry::query()
            ->with(['akas','addresses','programs'])
            ->where('list_type', $list)
            ->when($q, fn($qq) => $qq->where(function($w) use ($q) {
                $w->where('name','like',"%$q%")
                  ->orWhereHas('akas', fn($a)=>$a->where('alias','like',"%$q%"))
                  ->orWhereHas('ids', fn($i)=>$i->where('number','like',"%$q%"));
            }))
            ->when($country, fn($qq)=>$qq->whereHas('addresses', fn($a)=>$a->where('country','like',"%$country%")))
            ->when($program, fn($qq)=>$qq->whereHas('programs', fn($p)=>$p->where('program_code',$program)))
            ->where('active', true)
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Ofac/Search', compact('q','list','country','program','entries'));
    }

    public function show($id)
    {
        $entry = SdnEntry::with(['akas','addresses','ids','citizenships','programs'])->findOrFail($id);
        return Inertia::render('Ofac/Show', compact('entry'));
    }
}
