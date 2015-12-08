<?php

namespace App\Http\Controllers;

use App\Page;
use App\Http\Requests\PageRequest;

class PagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
        $this->middleware('auth.moderator', ['only' => 'create']);
    }
    /**
     * Show all the pages.
     *
     * @return response
     */
    public function index()
    {
        $pages = Page::latest()->get();

        return view('pages.index', compact('pages'));
    }

    /**
     * Show a single page.
     *
     * @param string $slug
     *
     * @return response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.show', compact('page'));
    }

    /**
     * Show the page to create a new page.
     *
     * @return response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Save a new page.
     *
     * @param PageRequest $request
     *
     * @return array
     */
    public function store(PageRequest $request)
    {
        Page::create($request->all());

        return redirect('pages');
    }

    /**
     * Show the page to edit an existing page.
     *
     * @return array
     */
    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.edit', compact('page'));
    }

    /**
     * Update a page.
     *
     * @param $id, PageRequest $request
     *
     * @return array
     */
    public function update($id, PageRequest $request)
    {
        $page = Page::findOrFail($id);
        $page->update($request->all());

        return redirect('pages');
    }
}
