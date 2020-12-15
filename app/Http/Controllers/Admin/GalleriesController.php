<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\BulkDestroyGallery;
use App\Http\Requests\Admin\Gallery\DestroyGallery;
use App\Http\Requests\Admin\Gallery\IndexGallery;
use App\Http\Requests\Admin\Gallery\StoreGallery;
use App\Http\Requests\Admin\Gallery\UpdateGallery;
use App\Models\Gallery;
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

class GalleriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexGallery $request
     * @return array|Factory|View
     */
    public function index(IndexGallery $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Gallery::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'desc', 'image'],

            // set columns to searchIn
            ['id', 'name', 'slug', 'desc', 'image']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.gallery.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.gallery.create');

        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGallery $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreGallery $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Gallery
        $gallery = Gallery::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/galleries'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/galleries');
    }

    /**
     * Display the specified resource.
     *
     * @param Gallery $gallery
     * @throws AuthorizationException
     * @return void
     */
    public function show(Gallery $gallery)
    {
        $this->authorize('admin.gallery.show', $gallery);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Gallery $gallery
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Gallery $gallery)
    {
        $this->authorize('admin.gallery.edit', $gallery);


        return view('admin.gallery.edit', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGallery $request
     * @param Gallery $gallery
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateGallery $request, Gallery $gallery)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Gallery
        $gallery->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/galleries'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/galleries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyGallery $request
     * @param Gallery $gallery
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyGallery $request, Gallery $gallery)
    {
        $gallery->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyGallery $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyGallery $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Gallery::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
