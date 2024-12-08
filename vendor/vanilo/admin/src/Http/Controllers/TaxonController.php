<?php

declare(strict_types=1);
/**
 * Contains the TaxonController class.
 *
 * @copyright   Copyright (c) 2018 Hunor Kedves
 * @author      Hunor Kedves
 * @license     MIT
 * @since       2018-10-22
 *
 */

namespace Vanilo\Admin\Http\Controllers;

use Illuminate\Support\Str;
use Konekt\AppShell\Http\Controllers\BaseController;
use Vanilo\Admin\Contracts\Requests\CreateTaxon;
use Vanilo\Admin\Contracts\Requests\CreateTaxonForm;
use Vanilo\Admin\Contracts\Requests\UpdateTaxon;
use Vanilo\Admin\Traits\CreatesMediaFromRequestImages;
use Vanilo\Category\Contracts\Taxon;
use Vanilo\Category\Contracts\Taxonomy;
use Vanilo\Category\Models\TaxonProxy;

class TaxonController extends BaseController
{
    use CreatesMediaFromRequestImages;

    public function create(CreateTaxonForm $request, Taxonomy $taxonomy)
    {
        $taxon = app(Taxon::class);

        $taxon->taxonomy_id = $taxonomy->id;

        if ($defaultParent = $request->getDefaultParent()) {
            $taxon->parent_id = $defaultParent->id;
        }

        $taxon->priority = $request->getNextPriority($taxon);

        return view('vanilo::taxon.create', [
            'taxons' => TaxonProxy::byTaxonomy($taxonomy)->get()->pluck('name', 'id'),
            'taxonomy' => $taxonomy,
            'taxon' => $taxon
        ]);
    }

    public function store(Taxonomy $taxonomy, CreateTaxon $request)
    {
        try {
            $attributes = collect($request->validated())->except('images')->toArray();
            $attributes['taxonomy_id'] = $taxonomy->id;

            $taxon = TaxonProxy::create($attributes);
            flash()->success(__(':name :taxonomy has been created', [
                'name' => $taxon->name,
                'taxonomy' => Str::singular($taxonomy->name)
            ]));
            $this->createMedia($taxon, $request);
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back()->withInput();
        }

        return redirect(route('vanilo.admin.taxonomy.show', $taxonomy));
    }

    public function edit(Taxonomy $taxonomy, Taxon $taxon)
    {
        return view('vanilo::taxon.edit', [
            'taxons' => TaxonProxy::byTaxonomy($taxonomy)->except($taxon)->get()->pluck('name', 'id'),
            'taxonomy' => $taxonomy,
            'taxon' => $taxon
        ]);
    }

    public function update(Taxonomy $taxonomy, Taxon $taxon, UpdateTaxon $request)
    {
        try {
            $taxon->update($request->validated());

            flash()->success(__(':name has been updated', ['name' => $taxon->name]));
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back()->withInput();
        }

        return redirect(route('vanilo.admin.taxonomy.show', $taxonomy));
    }

    public function destroy(Taxonomy $taxonomy, Taxon $taxon)
    {
        try {
            $name = $taxon->name;
            $taxon->delete();

            flash()->warning(__(':name has been deleted', ['name' => $name]));
        } catch (\Exception $e) {
            flash()->error(__('Error: :msg', ['msg' => $e->getMessage()]));

            return redirect()->back();
        }

        return redirect(route('vanilo.admin.taxonomy.show', $taxonomy));
    }
}
