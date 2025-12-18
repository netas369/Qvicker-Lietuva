<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon for easier date handling

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the application';

    public function handle()
    {
        // 1. Create the sitemap instance
        $sitemap = Sitemap::create();

        // 2. Add pages
        $this->addStaticPages($sitemap);
        $this->addServicePages($sitemap);

        // 3. Write to file
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
        $this->info('Base URL: ' . config('app.url'));

        return Command::SUCCESS;
    }

    private function addStaticPages($sitemap)
    {
        // Use the url() helper to ensure trailing slashes are handled correctly

        $staticRoutes = [
            // High Priority (Main Landing Pages)
            ['url' => '/', 'priority' => 1.0, 'frequency' => 'daily'],
            ['url' => '/visos-paslaugos', 'priority' => 0.9, 'frequency' => 'weekly'],

            // Medium Priority (Information)
            ['url' => '/apiemus', 'priority' => 0.6, 'frequency' => 'monthly'],
            ['url' => '/duk', 'priority' => 0.6, 'frequency' => 'monthly'],
            ['url' => '/partneriams', 'priority' => 0.7, 'frequency' => 'weekly'],
            ['url' => '/naudotojams', 'priority' => 0.7, 'frequency' => 'weekly'],

            // Low Priority (Legal)
            ['url' => '/legal/cookies-policy', 'priority' => 0.3, 'frequency' => 'yearly'],
            ['url' => '/legal/terms-of-use', 'priority' => 0.3, 'frequency' => 'yearly'],
            ['url' => '/legal/privacy-policy', 'priority' => 0.3, 'frequency' => 'yearly'],
        ];

        /* REMOVED: /prisijungti, /registruotis, /seeker/support
           REASON: These are utility pages. Indexing them wastes Google's "Crawl Budget".
                   We want Google to spend time crawling your Service pages instead.
        */

        foreach ($staticRoutes as $route) {
            $sitemap->add(
                Url::create(url($route['url'])) // url() helper is safer than string concatenation
                ->setPriority($route['priority'])
                    ->setChangeFrequency($route['frequency'])
                    // For static pages, we assume they are "current" as of the last sitemap generation
                    ->setLastModificationDate(Carbon::yesterday())
            );
        }

        $this->info("Added " . count($staticRoutes) . " static pages");
    }

    private function addServicePages($sitemap)
    {
        // Fetch categories.
        // TIP: If you have thousands of categories, use ->cursor() instead of ->get() for memory efficiency.
        $categories = DB::table('categories')
            ->select('url', 'updated_at')
            ->whereNotNull('url') // Safety check
            ->get();

        foreach ($categories as $category) {
            $urlObject = Url::create(url($category->url))
                ->setPriority(0.8)
                ->setChangeFrequency('weekly');

            // Logic to add Last Updated Date
            if ($category->updated_at) {
                // Parse the date using Carbon
                $urlObject->setLastModificationDate(Carbon::parse($category->updated_at));
            } else {
                // Fallback: If no updated_at exists, assume it was updated recently
                $urlObject->setLastModificationDate(Carbon::now());
            }

            $sitemap->add($urlObject);
        }

        $this->info("Added {$categories->count()} service pages");
    }
}
