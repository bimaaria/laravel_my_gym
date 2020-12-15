<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Trainer\BulkDestroyTrainer;
use App\Http\Requests\Admin\Trainer\DestroyTrainer;
use App\Http\Requests\Admin\Trainer\IndexTrainer;
use App\Http\Requests\Admin\Trainer\StoreTrainer;
use App\Http\Requests\Admin\Trainer\UpdateTrainer;
use App\Models\Trainer;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TrainersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTrainer $request
     * @return array|Factory|View
     */
    public function index(IndexTrainer $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Trainer::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'image'],

            // set columns to searchIn
            ['id', 'name', 'image']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.trainer.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.trainer.create');

        return view('admin.trainer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTrainer $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTrainer $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Trainer
        $trainer = Trainer::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/trainers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/trainers');
    }

    /**
     * Display the specified resource.
     *
     * @param Trainer $trainer
     * @throws AuthorizationException
     * @return void
     */
    public function show(Trainer $trainer)
    {
        $this->authorize('admin.trainer.show', $trainer);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Trainer $trainer
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Trainer $trainer)
    {
        $this->authorize('admin.trainer.edit', $trainer);


        return view('admin.trainer.edit', [
            'trainer' => $trainer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTrainer $request
     * @param Trainer $trainer
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTrainer $request, Trainer $trainer)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Trainer
        $trainer->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/trainers'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/trainers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTrainer $request
     * @param Trainer $trainer
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTrainer $request, Trainer $trainer)
    {
        $trainer->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTrainer $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTrainer $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Trainer::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
