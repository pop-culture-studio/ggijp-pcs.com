<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create()
                          ->add(Url::create('/'))
                          ->add(Url::create(route('material.index')))
                          ->add(Url::create(route('about')))
                          ->add(Url::create(route('faq')));

        Category::has('materials')->lazy()
                ->each(fn (Category $category) => $sitemap->add(
                    Url::create(route('category.show', $category))
                ));

        Material::latest()->lazy()
                ->each(fn (Material $material) => $sitemap->add(
                    Url::create(route('material.show', $material))
                       ->setLastModificationDate($material->updated_at)
                ));

        $sitemap->writeToDisk('s3', 'sitemap.xml');
    }
}
