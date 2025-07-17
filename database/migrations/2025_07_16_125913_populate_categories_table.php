<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $valymas = [
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Namų valymas',
                'url' => 'namu-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Generalinis valymas',
                'url' => 'generalinis-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Poremontinis valymas',
                'url' => 'poremontinis-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Biurų valymas',
                'url' => 'biuru-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Cheminis valymas',
                'url' => 'cheminis-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Langų plovimas',
                'url' => 'langu-plovimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Aukštuminis langų valymas',
                'url' => 'aukstuminis-langu-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Saulės baterijų valymas',
                'url' => 'saules-bateriju-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Dūmtraukių bei kaminų valymas',
                'url' => 'dumtraukiu-bei-kaminu-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Terasos valymas',
                'url' => 'terasos-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Minkštų baldų valymas',
                'url' => 'minkstu-baldu-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Namų priežiūra ir valymas',
                'subcategory' => 'Sniego valymas',
                'url' => 'sniego-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $kuryba = [
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Fotografija',
                'url' => 'fotografija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Fotografija dronu',
                'url' => 'fotografija-dronu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Produktų fotografija',
                'url' => 'produktu-fotografija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Videografija',
                'url' => 'videografija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Video Montuotojai',
                'url' => 'video-montuotojai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Vestuvių fotografija',
                'url' => 'vestuviu-fotografija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Nekilnojamojo turto fotografija',
                'url' => 'nekilnojamojo-turto-fotografija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Logotipų dizainas',
                'url' => 'logotipu-dizainas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Plakatų dizainas',
                'url' => 'plakatu-dizainas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Kūrybinės Paslaugos',
                'subcategory' => 'Brošiūrų dizainas',
                'url' => 'brosiuru-dizainas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $meistrai = [
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Dažymas ir dekoravimas',
                    'url' => 'dažymas-ir-dekoravimas',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Tapetavimas',
                    'url' => 'tapetavimas',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Santechnikos paslaugos',
                    'url' => 'santechnikos-paslaugos',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Elektriko paslaugos',
                    'url' => 'elektriko-paslaugos',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Baldų surinkimas',
                    'url' => 'baldu-surinkimas',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'TV pakabinimas',
                    'url' => 'tv-pakabinimas',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Buitinės technikos tvarkymas',
                    'url' => 'buitines-technikos-tvarkymas',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'category' => 'Meistrai ir remontas',
                    'subcategory' => 'Smulkūs darbai',
                    'url' => 'smulkus-darbai',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
        ];

        $perkraustymas = [
            [
                'category' => 'Perkraustymo ir pakavimo paslaugos',
                'subcategory' => 'Perkraustymas ir pakavimas',
                'url' => 'perkraustymas-ir-pakavimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Perkraustymo ir pakavimo paslaugos',
                'subcategory' => 'Pakavimas prieš kraustymą',
                'url' => 'pakavymas-pries-kraustyma',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Perkraustymo ir pakavimo paslaugos',
                'subcategory' => 'Sandėliavimo paslaugos',
                'url' => 'sandeliavimo-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Perkraustymo ir pakavimo paslaugos',
                'subcategory' => 'Šiukšlių išvežimas',
                'url' => 'siuksliu-isvezimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Perkraustymo ir pakavimo paslaugos',
                'subcategory' => 'Metalo laužo išvežimas',
                'url' => 'metalo-laužo-išvežimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Perkraustymo ir pakavimo paslaugos',
                'subcategory' => 'Baldų išrinkimas ir surinkimas',
                'url' => 'baldu-isrinkimas-surinkimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $transportas = [
            [
                'category' => 'Transporto paslaugos',
                'subcategory' => 'Pristatymo paslaugos',
                'url' => 'pristatymo-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Transporto paslaugos',
                'subcategory' => 'Vairavimo paslaugos',
                'url' => 'vairavimo-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Transporto paslaugos',
                'subcategory' => 'Tarptautiniai pervežimai',
                'url' => 'tarptautiniai-pervežimai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Transporto paslaugos',
                'subcategory' => 'Pagalbinis vairuotojas',
                'url' => 'pagalbinis-vairuotojas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $fitnesas = [
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Asmeninis treneris',
                'url' => 'asmeninis-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Jogos treneris',
                'url' => 'jogos-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Meditacija',
                'url' => 'meditacija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Masažo terapija',
                'url' => 'masažo-terapija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Sportinis masažas',
                'url' => 'sportinis-masazas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Kaitavimo treneris',
                'url' => 'kaitavimo-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Burlenčių pamokos',
                'url' => 'burlenciu-pamokos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Kovos menų mokymai',
                'url' => 'kovos-menu-mokymai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Futbolo treneris',
                'url' => 'futbolo-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Krepšinio treneris',
                'url' => 'krepsinio-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Teniso treneris',
                'url' => 'teniso-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Padelio treneris',
                'url' => 'padelio-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Fitnesas ir Sveikatingumus',
                'subcategory' => 'Šokių treneris',
                'url' => 'sokiu-treneris',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $renginiai = [
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Pagalba renginiuose',
                'url' => 'pagalba-renginiuose',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Renginiu dizainas',
                'url' => 'renginiu-dizainas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Laikinų konstrukcijų montavimas',
                'url' => 'laikinu-konstrukciju-montavimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Padavėjai renginiams',
                'url' => 'padavėjai-renginiams',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Baro asistentai',
                'url' => 'baro-asistentai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Apsaugos paslaugos',
                'url' => 'apsaugos-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Virtuvės asistentai',
                'url' => 'virtuves-asistentai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Barmenai',
                'url' => 'barmenai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Someljė paslaugos',
                'url' => 'somelje-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Arbatos Someljė',
                'url' => 'arbatos-somelje',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'DJ paslaugos',
                'url' => 'dj-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Burtininkai / Magai',
                'url' => 'burtininkai-magai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Animatoriai',
                'url' => 'animatoriai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'VR Vedėjai',
                'url' => 'vr-vedejai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Šviesų instaliacija',
                'url' => 'sviesu-instaliacija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Garso aparatūros sujungimas',
                'url' => 'garso-aparaturos-sujungimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Renginiu Pagalba',
                'subcategory' => 'Stilistas renginiams',
                'url' => 'stilistas-renginiams',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $sodininkyste = [
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Vejos priežiūra ir pjovimas',
                'url' => 'vejos-prieziura',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Tręšimas ir aeravimas',
                'url' => 'tresimas-ir-aeravimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Laistymo sistemų montavimas',
                'url' => 'laistymo-sistemu-montavimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Sodininkystė ir kraštovaizdis',
                'url' => 'sodininkyste-ir-krastovaizdis',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Tvenkinių ir fontanų įrengimas',
                'url' => 'tvenkiniu-ir-fontanu-irengimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Šiltnamių montavimas',
                'url' => 'siltnamiu-montavimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Medžių genėjimas',
                'url' => 'medziu-genejimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Kelmų šalinimas',
                'url' => 'kelmu-salinimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Sodininkystės ir lauko paslaugos',
                'subcategory' => 'Sniego nukasimas',
                'url' => 'sniego-nukasimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $turizmas = [
            [
                'category' => 'Turizmas',
                'subcategory' => 'Gidai',
                'url' => 'gidai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Turizmas',
                'subcategory' => 'Miesto turai',
                'url' => 'miesto-turai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Turizmas',
                'subcategory' => 'Maisto degustacijos gidai',
                'url' => 'maisto-degustacijos-gidai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Turizmas',
                'subcategory' => 'Ekoturizmo gidai',
                'url' => 'ekoturizmo-gidai',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $ITpagalba = [
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'IT Pagalba',
                'url' => 'IT-pagalba',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Programinės įrangos diegimas',
                'url' => 'programines-irangos-diegimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Techninė priežiūra',
                'url' => 'technine-prieziura',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Kompiuterių remontas',
                'url' => 'kompiuteriu-remontas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Tinklo diegimas',
                'url' => 'tinklo-diegimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Sistemos naujinimai',
                'url' => 'sistemos-naujinimai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Spausdintuvų remontas',
                'url' => 'spausdintuvu-remontas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'IT Pagalba',
                'subcategory' => 'Apsaugos technologijų specialistai',
                'url' => 'apsaugos-technologiju-specialistai',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $ezoterija = [
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Ezoterinės paslaugos',
                'url' => 'ezoterines-paslaugos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Gimimo diagramos analizė',
                'url' => 'gimimo-diagramos-analizė',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Manifestacijos konsultacijos',
                'url' => 'manifestacijos-konsultacijos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Vizijų lentų kūrimas',
                'url' => 'vizijų-lentų-kūrimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Santykių konsultacijos',
                'url' => 'santykiu-konsultacijos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Karjeros kelio analizė',
                'url' => 'karjeros-kelio-analize',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Energijos terapija',
                'url' => 'energijos-terapija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Čakrų valymas',
                'url' => 'cakru-valymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Ezoterija',
                'subcategory' => 'Dietos nustatymas',
                'url' => 'dietos-nustatymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $statyba = [
            [
                'category' => 'Statyba',
                'subcategory' => 'Mūro darbai',
                'url' => 'muro-darbai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Griovimo darbai',
                'url' => 'griovimo-darbai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Vidaus apdaila',
                'url' => 'vidaus-apdaila',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Gipso kartono montavimas',
                'url' => 'gipso-kartono-montavimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Glaistymas ir dažymas',
                'url' => 'glaistymas-ir-dažymas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Plytelių klojimas',
                'url' => 'plyteliu-klojimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Grindų klojimas',
                'url' => 'grindu-klojimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Išorės apdaila',
                'url' => 'isores-apdaila',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Fasadų šiltinimas',
                'url' => 'fasadu-siltinimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Statyba',
                'subcategory' => 'Tinkavimas',
                'url' => 'tinkavimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $grozis = [
            [
                'category' => 'Grozis',
                'subcategory' => 'Makiažas renginiams',
                'url' => 'makiazas-renginiams',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Grozis',
                'subcategory' => 'Permanentinis makiažas',
                'url' => 'permanentinis-makiazas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Grozis',
                'subcategory' => 'Blakstienų priauginimas',
                'url' => 'blakstienu-priauginimas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Grozis',
                'subcategory' => 'Manikiūras ir pedikiūras',
                'url' => 'manikiuras-ir-pedikiuras',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Grozis',
                'subcategory' => 'Kosmetologija',
                'url' => 'kosmetologija',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Grozis',
                'subcategory' => 'Veido procedūros',
                'url' => 'veido-proceduros',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Grozis',
                'subcategory' => 'Depiliacija',
                'url' => 'depiliacija',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('categories')->insert($valymas);
        DB::table('categories')->insert($kuryba);
        DB::table('categories')->insert($meistrai);
        DB::table('categories')->insert($perkraustymas);
        DB::table('categories')->insert($transportas);
        DB::table('categories')->insert($fitnesas);
        DB::table('categories')->insert($renginiai);
        DB::table('categories')->insert($sodininkyste);
        DB::table('categories')->insert($turizmas);
        DB::table('categories')->insert($ITpagalba);
        DB::table('categories')->insert($ezoterija);
        DB::table('categories')->insert($statyba);
        DB::table('categories')->insert($grozis);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->where('category', 'Namų priežiūra ir valymas')->delete();
        DB::table('categories')->where('category', 'Kūrybinės Paslaugos')->delete();
        DB::table('categories')->where('category', 'Meistrai ir remontas')->delete();
        DB::table('categories')->where('category', 'Perkraustymo ir pakavimo paslaugos')->delete();
        DB::table('categories')->where('category', 'Transporto paslaugos')->delete();
        DB::table('categories')->where('category', 'Fitnesas ir Sveikatingumus')->delete();
        DB::table('categories')->where('category', 'Renginiu Pagalba')->delete();
        DB::table('categories')->where('category', 'Sodininkystės ir lauko paslaugos')->delete();
        DB::table('categories')->where('category', 'Turizmas')->delete();
        DB::table('categories')->where('category', 'IT Pagalba')->delete();
        DB::table('categories')->where('category', 'Ezoterines paslaugos')->delete();
        DB::table('categories')->where('category', 'Statyba')->delete();
        DB::table('categories')->where('category', 'Grozis')->delete();


    }
};

