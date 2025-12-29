<?php
namespace App\Http\Controllers;

use App\Surl;
use App\Product;
use App\Mcategory;
use App\Msubcategory;
use Illuminate\Http\Request;

class Marketplace extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro = Product::where('post_status', '=', 1)
            ->with('medias','mcategory', 'msubcategory')
            ->where('status', '=', 1)
            ->orderBy('package', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(52);

        $category = Mcategory::with(['msubcategory' => function ($r) {
            $r->with('products');
        }])
        ->with(['products' => function ($q) {
            $q->where('status', '=', 1);
        }])
        ->orderBy('id', 'ASC')
        ->get();

        $check = $pro->where('state', '=', isset($pro[0]) ? $pro[0]->state : 'Singapore')->pluck('city');
        $check1 = collect($check);   
        $cityunique = $check1->unique()->values()->all();
        return view('market.index', compact('pro', 'cityunique', 'category'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $input = $request->all();
        $input['city'] = isset($input['city']) ? $input['city'] : '';


        if ($request->filled('search')) 
        {
            if ($input['city'] == "All") 
            {
                $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('title', 'like', '%' . $input['search'] . '%')->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
                $category = Mcategory::with(['msubcategory' => function ($r) {$r->with(['products' => function ($q) {$q->where('status', '=', 1);}]);}])->with(['products' => function ($q) {$q->where('status', '=', 1);}])->orderBy('id', 'ASC')->get();
                setcookie('cityname', '');
            }
            else
            {
                $pro = Product::query();

                $pro->where('post_status', '=', 1)
                    ->where('status', '=', 1)
                    ->with('medias');
                
                if($input['city'])
                {
                    $pro->where('city', '=', $input['city']);
                    
                }

                $pro->where('title', 'like', '%' . $input['search'] . '%')
                    ->orderBy('package', 'DESC')
                    ->orderBy('id', 'DESC')
                    ->paginate(50);

                $category = Mcategory::with(['msubcategory' => function ($r) use ($input) {
                    $r->with(['products' => function ($q) use ($input) {
                        $q->where('status', '=', 1)
                            ->where('city', '=', $input['city']);
                    }]);
                }])
                ->with(['products' => function ($q) use ($input) {
                    $q->where('status', '=', 1)
                        ->where('city', '=', $input['city']);
                    }
                ])
                ->orderBy('id', 'ASC')
                ->get();

                setcookie('cityname', $input['city']);

                $pro = $pro->get();
            }
        }
        elseif (request()->has('price')) 
        {
            if(isset($_COOKIE['cityname']))
            {
                $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('city', '=', $_COOKIE['cityname'])->orderBy('amount', $input['price'])->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
                $category = Mcategory::with(['msubcategory' => function ($r) {$r->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_COOKIE['cityname']);}]);}])->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_COOKIE['cityname']);}])->orderBy('id', 'ASC')->get();
            }
            else
            {
                $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->orderBy('amount', $input['price'])->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
                $category = Mcategory::with(['msubcategory' => function ($r) {$r->with('products');}])->with(['products' => function ($q) {$q->where('status', '=', 1);}])->orderBy('id', 'ASC')->get();
            }
        }
        elseif (request()->has('city')) 
        {
            setcookie('cityname', $input['city']);
            $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('city', '=', $input['city'])->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
            $category = Mcategory::with(['msubcategory' => function ($r) {$r->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_REQUEST['city']);}]);}])->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_REQUEST['city']);}])->orderBy('id', 'ASC')->get();
        }
        elseif (request()->has('category_id')) 
        {
            $m    = Mcategory::findOrFail($input['category_id']);
            $cats = preg_replace("/[\s_]/", "-", $m->name);
            $u    = 'marketplace-category/'.$cats.'/'.base64_encode($input['category_id']);
            $urls = Surl::where('url', '=', $u)->count();

            if ($urls == 0) 
            {
                Surl::create(['url' => $u]);
            }

            return redirect($u);
        }
        elseif (request()->has('subcategory_id')) 
        {
            $su = Msubcategory::findOrFail($input['subcategory_id']);
            $cats = preg_replace("/[\s_]/", "-", $su->mcategory->name);
            $subcats = preg_replace("/[\s_]/", "-", $su->name);
            $u = 'marketplace/'.$cats.'/'.$subcats.'/'.base64_encode($input['subcategory_id']);
            $urls = Surl::where('url', '=', $u)->count();
            if ($urls == 0) 
            {
                Surl::create(['url' => $u]);
            }

            return redirect($u);
        }

        $check  = $pro->where('state', '=', isset($pro) && isset($pro[0]) ? $pro[0]->state : 'Singapore')->pluck('city');
        $check1 = collect($check);   
        $cityunique = $check1->unique()->values()->all();
        // dd($pro);
        return view('market.index', compact('pro', 'cityunique', 'category'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($state, $category, $subcategory, $slug)
    {
        $post = Product::where('slug', '=', $slug)->where('status', '=', 1)->with('medias')->first();
        if ($post == true) 
        {
            return view('market.show', compact('post'));
        }
        else
        {
            abort('404');
        }
    }

    public function showw(Request $request)
    {   
        $state = $request->state;
        $category = $request->category;
        $subcategory = $request->$subcategory;
        $slug = $request->slug;
        $post = Product::where('slug', '=', $slug)->where('status', '=', 1)->with('medias')->first();
        if ($post == true) 
        {
            return view('market.show', compact('post'));
        }
        else
        {
            abort('404');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function cateresult($category, $id)
    {
        if(isset($_COOKIE['cityname']))
        {
            $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('city', '=', $_COOKIE['cityname'])->where('category_id', '=', base64_decode($id))->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
            $category = Mcategory::with(['msubcategory' => function ($r) {$r->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_COOKIE['cityname']);}]);}])->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_COOKIE['cityname']);}])->orderBy('id', 'ASC')->get();
        }
        else
        {
            $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('category_id', '=', base64_decode($id))->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
            $category = Mcategory::with(['msubcategory' => function ($r) {$r->with('products');}])->with(['products' => function ($q) {$q->where('status', '=', 1);}])->orderBy('id', 'ASC')->get();
        }
        $cityunique = $this->otherstuff($pro);
        return view('market.index', compact('pro', 'cityunique', 'category'));
    }
    public function subcatresult($category, $subcategory, $id)
    {
        if(isset($_COOKIE['cityname']))
        {
            $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('city', '=', $_COOKIE['cityname'])->where('subcategory_id', '=', base64_decode($id))->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
            $category = Mcategory::with(['msubcategory' => function ($r) {$r->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_COOKIE['cityname']);}]);}])->with(['products' => function ($q) {$q->where('status', '=', 1)->where('city', '=', $_COOKIE['cityname']);}])->orderBy('id', 'ASC')->get();
        }
        else
        {
            $pro = Product::where('post_status', '=', 1)->where('status', '=', 1)->with('medias')->where('subcategory_id', '=', base64_decode($id))->orderBy('package', 'DESC')->orderBy('id', 'DESC')->paginate(50);
            $category = Mcategory::with(['msubcategory' => function ($r) {$r->with('products');}])->with(['products' => function ($q) {$q->where('status', '=', 1);}])->orderBy('id', 'ASC')->get();
        }
        $cityunique = $this->otherstuff($pro);
        $su = Msubcategory::findOrFail(base64_decode($id));
        return view('market.index', compact('pro', 'cityunique', 'category', 'su'));
    }
    public function otherstuff($pro)
    {
        $check = $pro->where('state', '=', isset($pro[0]) ? $pro[0]->state : 'Singapore')->pluck('city');
        $check1 = collect($check);   
        return $check1->unique()->values()->all();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}