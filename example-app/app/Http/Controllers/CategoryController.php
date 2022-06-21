<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    public function getIdCategoria($id) : Category
    {
        $categoria = Category::find($id);
        if (is_null($categoria)) {
            return response()->json(['result' => 'error', 'data' => null, 'message' => 'No se encontró esa categoria'], 404);
        }
        return $categoria;
    }
    public function getCategoria()
    {
        return response()->json(['result' => 'success', 'data' => Category::all(), 'message' => 'Categorias encontradas'], 200);
    }

    public function getCategoriaId($id)
    {
        $categoria = $this->getIdCategoria($id);
        return response()->json(['result' => 'success', 'data' => $categoria, 'message' => 'Categoria encontrada'], 200);
    }

    public function insertCategoria(Request $request)
    {
        $categoria = Category::create($request->only('name', 'observation'));
        return response()->json(['result' => 'success', 'data' => $categoria, 'message' => 'Categoria insertada'], 200);
    }

    public function updateCategoria(Request $request, $id)
    {
        $categoria = $this->getIdCategoria($id);
        $categoria->update($request->only('name', 'observation'));
        return response()->json(['result' => 'success', 'data' => $categoria, 'message' => 'Categoria actualizada'], 200);
    }

    public function deleteCategoria($id)
    {
        $categoria = $this->getIdCategoria($id);
        $categoria->delete();
        return response()->json(['result' => 'success', 'data' => null, 'message' => 'Categoria eliminada'], 200);
    }


}
