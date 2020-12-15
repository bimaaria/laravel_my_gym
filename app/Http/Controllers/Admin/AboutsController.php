<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\About\BulkDestroyAbout;
use App\Http\Requests\Admin\About\DestroyAbout;
use App\Http\Requests\Admin\About\IndexAbout;
use App\Http\Requests\Admin\About\StoreAbout;
use App\Http\Requests\Admin\About\UpdateAbout;
use App\Models\About;
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

class AboutsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexAbout $request
     * @return array|Factory|View
     */
    public function index(IndexAbout $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(About::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'body', 'image'],

            // set columns to searchIn
            ['id', 'body', 'image']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.about.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.about.create');

        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAbout $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAbout $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the About
        $about = About::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/abouts'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/abouts');
    }

    /**
     * Display the specified resource.
     *
     * @param About $about
     * @throws AuthorizationException
     * @return void
     */
    public function show(About $about)
    {
        $this->authorize('admin.about.show', $about);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param About $about
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(About $about)
    {
        $this->authorize('admin.about.edit', $about);


        return view('admin.about.edit', [
            'about' => $about,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAbout $request
     * @param About $about
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAbout $request, About $about)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values About
        $about->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/abouts'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/abouts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAbout $request
     * @param About $about
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAbout $request, About $about)
    {
        $about->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyAbout $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyAbout $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    About::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
