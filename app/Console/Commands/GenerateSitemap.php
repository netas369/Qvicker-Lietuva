<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Category; // Your Category model

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the application';

    public function handle()
    {
        $sitemap = Sitemap::create();

        $this->addStaticPages($sitemap);
        $this->addServicePages($sitemap);

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }

    private function addStaticPages($sitemap)
    {
        $staticRoutes = [
            ['url' => '/', 'priority' => 1.0, 'frequency' => 'daily'],
            ['url' => '/search', 'priority' => 0.9, 'frequency' => 'daily'],
            ['url' => '/visos-paslaugos', 'priority' => 0.9, 'frequency' => 'weekly'],
            ['url' => '/duk', 'priority' => 0.7, 'frequency' => 'monthly'],
            ['url' => '/apiemus', 'priority' => 0.6, 'frequency' => 'monthly'],
            ['url' => '/partneriams', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/naudotojams', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/registruotis', 'priority' => 0.7, 'frequency' => 'monthly'],
            ['url' => '/registruotis/partneriui', 'priority' => 0.7, 'frequency' => 'monthly'],
            ['url' => '/registruotis/naudotojui', 'priority' => 0.7, 'frequency' => 'monthly'],
            ['url' => '/prisijungti', 'priority' => 0.6, 'frequency' => 'monthly'],
            ['url' => '/seeker/support', 'priority' => 0.5, 'frequency' => 'monthly'],
            ['url' => '/cookies/policy', 'priority' => 0.3, 'frequency' => 'yearly'],
            ['url' => '/termsofuse', 'priority' => 0.3, 'frequency' => 'yearly'],
            ['url' => '/privacy/policy', 'priority' => 0.3, 'frequency' => 'yearly'],
        ];

        foreach ($staticRoutes as $route) {
            $sitemap->add(
                Url::create($route['url'])
                    ->setPriority($route['priority'])
                    ->setChangeFrequency($route['frequency'])
            );
        }
    }

    private function addServicePages($sitemap)
    {
        $categories = Category::select('url', 'updated_at')->get();

        foreach ($categories as $category) {
            $sitemap->add(
                Url::create("/{$category->url}")
                    ->setLastModificationDate($category->updated_at)
                    ->setPriority(0.8)
                    ->setChangeFrequency('weekly')
            );
        }

        $this->info("Added {$categories->count()} service pages to sitemap");
    }
}
