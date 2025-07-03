<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Page;
use App\Models\Faq;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Log query (for logs endpoint)
        // if ($query) {
        //     Cache::increment('search_log:' . strtolower($query));
        // }

        if ($query) {
            $key = 'search_log:' . strtolower($query);
            Cache::increment($key);

            // Track the key for listing later
            $tracked = Cache::get('search_keys', []);
            if (!in_array($key, $tracked)) {
                $tracked[] = $key;
                Cache::put('search_keys', $tracked);
            }
        }

        $results = collect();

        $results = $results->merge(
            BlogPost::search($query)->get()->map(fn($item) => [
                'type' => 'BlogPost',
                'title' => $item->title,
                'snippet' => Str::limit($item->body, 100),
                'link' => '/blog/' . $item->id,
            ])
        );

        $results = $results->merge(
            Product::search($query)->get()->map(fn($item) => [
                'type' => 'Product',
                'title' => $item->name,
                'snippet' => Str::limit($item->description, 100),
                'link' => '/product/' . $item->id,
            ])
        );

        $results = $results->merge(
            Page::search($query)->get()->map(fn($item) => [
                'type' => 'Page',
                'title' => $item->title,
                'snippet' => Str::limit($item->content, 100),
                'link' => '/page/' . $item->id,
            ])
        );

        $results = $results->merge(
            Faq::search($query)->get()->map(fn($item) => [
                'type' => 'Faq',
                'title' => $item->question,
                'snippet' => Str::limit($item->answer, 100),
                'link' => '/faq/' . $item->id,
            ])
        );

        return response()->json([
            'results' => $results->values()->all(),
        ]);
    }

    public function suggestions(Request $request)
    {
        $query = $request->input('q');
        $results = collect();

        foreach ([BlogPost::class, Product::class, Page::class, Faq::class] as $model) {
            $results = $results->merge(
                $model::search($query)->take(5)->get()->pluck('title')->filter()
            );
        }

        return response()->json($results->unique()->values());
    }

    //Logs (admin-only suggested)
    public function logs()
    {
        $keys = Cache::get('search_keys', []);
        $results = [];

        foreach ($keys as $key) {
            $count = Cache::get($key, 0);
            $term = str_replace('search_log:', '', $key);
            $results[$term] = $count;
        }

        arsort($results); // Sort by count desc

        return response()->json($results);
    }

    //Rebuild Index (admin-only suggested)
    // public function rebuildIndex()
    // {
    //     foreach ([BlogPost::class, Product::class, Page::class, Faq::class] as $model) {
    //         Artisan::call('scout:flush', ['model' => $model]);
    //         Artisan::call('scout:import', ['model' => $model]);
    //     }

    //     return response()->json(['message' => 'Search indexes rebuilt successfully.']);
    // }

    public function rebuildIndex()
    {
        foreach ([BlogPost::class, Product::class, Page::class, Faq::class] as $model) {
            $model::removeAllFromSearch();      // clears Meilisearch index
            $model::makeAllSearchable();        // re-imports all records
        }

        return response()->json(['message' => 'Search indexes rebuilt successfully.']);
    }

}
