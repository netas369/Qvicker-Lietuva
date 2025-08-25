<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Check admin access in each method instead of constructor
    private function checkAdminAccess()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Access denied. Admin role required.');
        }
    }

    // Show all service pages for admin management
    public function servicePages()
    {
        $this->checkAdminAccess();

        $servicePages = DB::table('service_pages as sp')
            ->leftJoin('categories as c', 'sp.slug', '=', 'c.url')
            ->select(
                'sp.*',
                'c.category',
                'c.subcategory'
            )
            ->orderBy('c.category')
            ->orderBy('c.subcategory')
            ->get();

        $categoriesWithoutSeo = DB::table('categories as c')
            ->leftJoin('service_pages as sp', 'c.url', '=', 'sp.slug')
            ->whereNull('sp.slug')
            ->select('c.*')
            ->orderBy('c.category')
            ->orderBy('c.subcategory')
            ->get();

        return view('admin.service-pages.index', compact('servicePages', 'categoriesWithoutSeo'));
    }

    // Show edit form for a specific service page
    public function editServicePage($slug)
    {
        $this->checkAdminAccess();

        $servicePage = DB::table('service_pages')->where('slug', $slug)->first();
        $categoryData = DB::table('categories')->where('url', $slug)->first();

        if (!$categoryData) {
            abort(404, 'Service not found');
        }

        return view('admin.service-pages.edit', compact('servicePage', 'categoryData'));
    }

    // Update or create service page
    public function updateServicePage(Request $request, $slug)
    {
        $this->checkAdminAccess();

        $request->validate([
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:1000',
            'h1_heading' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'faq' => 'nullable|array',
            'faq.*.question' => 'required_with:faq|string|max:500',
            'faq.*.answer' => 'required_with:faq|string|max:1000',
        ]);

        // Prepare FAQ data
        $faqData = null;
        if ($request->faq) {
            $faqData = array_filter($request->faq, function($item) {
                return !empty($item['question']) && !empty($item['answer']);
            });
            $faqData = !empty($faqData) ? array_values($faqData) : null;
        }

        $data = [
            'slug' => $slug,
            'title' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'h1_heading' => $request->h1_heading,
            'content' => $request->content,
            'faq' => $faqData ? json_encode($faqData) : null,
            'updated_at' => now(),
        ];

        // Check if record exists
        $existing = DB::table('service_pages')->where('slug', $slug)->first();

        if ($existing) {
            DB::table('service_pages')->where('slug', $slug)->update($data);
            $message = 'Service page updated successfully!';
        } else {
            $data['created_at'] = now();
            DB::table('service_pages')->insert($data);
            $message = 'Service page created successfully!';
        }

        return redirect()->route('admin.service-pages.edit', $slug)->with('success', $message);
    }

    // Delete service page
    public function deleteServicePage($slug)
    {
        $this->checkAdminAccess();

        DB::table('service_pages')->where('slug', $slug)->delete();
        return redirect()->route('admin.service-pages.index')->with('success', 'Service page deleted successfully!');
    }

    // Bulk create SEO pages for categories without them
    public function bulkCreateSeoPages()
    {
        $this->checkAdminAccess();

        $categoriesWithoutSeo = DB::table('categories as c')
            ->leftJoin('service_pages as sp', 'c.url', '=', 'sp.slug')
            ->whereNull('sp.slug')
            ->select('c.*')
            ->get();

        $created = 0;
        foreach ($categoriesWithoutSeo as $category) {
            $data = [
                'slug' => $category->url,
                'title' => $category->subcategory . ' paslaugos Lietuvoje | Qvicker',
                'meta_title' => $category->subcategory . ' paslaugos Lietuvoje | Qvicker',
                'meta_description' => 'Raskite geriausius ' . $category->subcategory . ' specialistus. Patikimi meistrai, konkurencingos kainos, greitas aptarnavimas visoje Lietuvoje.',
                'meta_keywords' => $category->subcategory . ', ' . $category->category . ', paslaugos, meistrai, Lietuva',
                'h1_heading' => $category->subcategory . ' paslaugos',
                'content' => $this->generateDefaultContent($category),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('service_pages')->insert($data);
            $created++;
        }

        return redirect()->route('admin.service-pages.index')->with('success', "Created $created SEO pages successfully!");
    }

    private function generateDefaultContent($category)
    {
        return "
            <h2>Profesionalūs {$category->subcategory} specialistai</h2>
            <p>Ieškote patikimo {$category->subcategory} specialisto? Qvicker platformoje rasite geriausius {$category->category} sektorių meistrus visoje Lietuvoje.</p>

            <h3>Kodėl rinktis mūsų {$category->subcategory} specialistus?</h3>
            <ul>
                <li><strong>Patikrinti specialistai</strong> - visi meistrai yra patikrinti ir turi reikalingą patirtį</li>
                <li><strong>Konkurencingos kainos</strong> - gaukite geriausią kainų ir kokybės santykį</li>
                <li><strong>Greitas aptarnavimas</strong> - dauguma specialistų gali atvykti per 24-48 valandas</li>
                <li><strong>Klientų atsiliepimai</strong> - skaitykite tikrus klientų įvertinimus</li>
            </ul>

            <h3>Kaip veikia {$category->subcategory} paslaugų užsakymas?</h3>
            <ol>
                <li>Aprašykite savo poreikius</li>
                <li>Gaukite pasiūlymus nuo specialistų</li>
                <li>Pasirinkite tinkamiausią specialistą</li>
                <li>Susitarkite dėl laiko ir kainos</li>
                <li>Mėgaukitės kokybiškai atliktu darbu</li>
            </ol>

            <p>Pradėkite šiandien ir raskite geriausią {$category->subcategory} specialistą savo rajone!</p>
        ";
    }
}
