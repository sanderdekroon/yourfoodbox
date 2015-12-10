<?php

use App\Ingredient;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rpaprika = new App\Ingredient;
        $rpaprika->name = 'Rode paprika';
        $rpaprika->unit = 'stuks';
        $rpaprika->type = 'groente';
        $rpaprika->min_amount = 1;
        $rpaprika->save();

        $grpaprika = new App\Ingredient;
        $grpaprika->name = 'Groene paprika';
        $grpaprika->unit = 'stuks';
        $grpaprika->type = 'groente';
        $grpaprika->min_amount = 1;
        $grpaprika->save();

        $gpaprika = new App\Ingredient;
        $gpaprika->name = 'Gele paprika';
        $gpaprika->unit = 'stuks';
        $gpaprika->type = 'groente';
        $gpaprika->min_amount = 1;
        $gpaprika->save();

        $aubergine = new App\Ingredient;
        $aubergine->name = 'Aubergine';
        $aubergine->unit = 'stuks';
        $aubergine->type = 'groente';
        $aubergine->min_amount = 1;
        $aubergine->save();

        $courgette = new App\Ingredient;
        $courgette->name = 'Courgette';
        $courgette->unit = 'stuks';
        $courgette->type = 'groente';
        $courgette->min_amount = 1;
        $courgette->save();

        $ui = new App\Ingredient;
        $ui->name = 'Uien';
        $ui->unit = 'stuks';
        $ui->type = 'groente';
        $ui->min_amount = 3;
        $ui->save();

        $knoflook = new App\Ingredient;
        $knoflook->name = 'Knoflook';
        $knoflook->unit = 'stuks';
        $knoflook->type = 'groente';
        $knoflook->min_amount = 1;
        $knoflook->save();
    }
}
