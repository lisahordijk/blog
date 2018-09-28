<?php

namespace App\Http\Controllers;

use Auth;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(5);

        return view('pages.index', ['pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.create')->with([
            'model' => new Page(),
            'orderPages' => Page::defaultOrder()->withDepth()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Een nieuwe pagina kan hiermee worden opgeslagen door de ingevoerde informatie op te vragen van de form in de view.
    public function store(Request $request)
    {
        Auth::user()->pages()->save(new Page($request->only([
            'title','url','content'])));

        return redirect()->route('pages.index')->with('status', 'The page has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
     public function edit(Page $page)
     {
         return view('pages.edit', [
             'model' => $page
         ]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Page $page)
    {
        if (Auth::user()->cant('update', $page)) {
            return redirect()->route('pages.index');
        }

        $page->fill($request->only(['title','url','content']))->save();

        if ($response = $this->updatePageOrder($page, $request)) {
            return $response;
        }

        return redirect()->route('pages.index')->with('status', 'The page was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */

    // Verwijderen van pagina
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index')->with('status', 'The page was deleted.');
    }

    protected function updatePageOrder(Page $page, Request $request)
    {
        if ($request->has('order', 'orderPage')) {

            if ($page->id == $request->orderPage) {
                return redirect()->route('pages.index')->with('status', 'Een pagina kan niet met zichzelf worden gesorteerd.');
            }

            $page->updateOrder($request->order, $request->orderPage);
        }
    }
}
