<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Especie;
use DB;

class StatsController extends Controller
{
    public function index(){
        //Creamos la lista de años en orden descendente
        $years = Entrada::selectRaw("strftime('%Y', fecha) as year")
              ->groupBy('year')
              ->orderBy('year', 'desc')
              ->pluck('year');

        //Establecemos el más reciente como el seleccionado
        $selectedYear = $years->first();

        //Obtenemos las entradas del año más reciente
        $entradas = $this->entriesOfYear($selectedYear);

        //Obtenemos los ejemplares encontrados por mes
        $ejemplaresPorMes = $this->specimensFoundInYearByMonth($selectedYear);
        $numEjemplares = $this->totalSpecimens($ejemplaresPorMes);

        //Obtenemos las entradas registradas por mes
        $entradasPorMes = $this->entriesInYearByMonth($selectedYear);

        //Obtenemos el top de especies
        $topEspecies = $this->specimensTopInYear($selectedYear);
        $labelsTop = $topEspecies->pluck('nombre');
        $valoresTop = $topEspecies->pluck('total');

        //Llamamos a la vista con los datos obtenidos
        return view('stats', ['years'=>$years, 'selectedYear'=>$selectedYear, 'entradas'=>$entradas, 'ejemplaresPorMes'=>$ejemplaresPorMes, 'numEjemplares'=>$numEjemplares, 'entradasPorMes'=>$entradasPorMes, 'labelsTop'=>$labelsTop, 'valoresTop'=>$valoresTop]);
    }

    public function show($selectedYear){
        //Creamos la lista de años en orden descendente
        $years = Entrada::selectRaw("strftime('%Y', fecha) as year")
              ->groupBy('year')
              ->orderBy('year', 'desc')
              ->pluck('year');

        //Obtenemos las entradas del año más reciente
        $entradas = $this->entriesOfYear($selectedYear);

        //Obtenemos los ejemplares encontrados por mes
        $ejemplaresPorMes = $this->specimensFoundInYearByMonth($selectedYear);
        $numEjemplares = $this->totalSpecimens($ejemplaresPorMes);

        //Obtenemos las entradas registradas por mes
        $entradasPorMes = $this->entriesInYearByMonth($selectedYear);

        //Obtenemos el top de especies
        $topEspecies = $this->specimensTopInYear($selectedYear);
        $labelsTop = $topEspecies->pluck('nombre');
        $valoresTop = $topEspecies->pluck('total');

        //Llamamos a la vista con los datos obtenidos
        return view('stats', ['years'=>$years, 'selectedYear'=>$selectedYear, 'entradas'=>$entradas, 'ejemplaresPorMes'=>$ejemplaresPorMes, 'numEjemplares'=>$numEjemplares, 'entradasPorMes'=>$entradasPorMes, 'labelsTop'=>$labelsTop, 'valoresTop'=>$valoresTop]);
    }

    public function entriesOfYear($year){
        return Entrada::where('id_usuario', auth()->id())
            ->whereRaw("strftime('%Y', fecha) = ?", [$year])->get();
    }

    public function speciesFoundInYear($year){
        return Entrada::with('especies')
                    ->where('id_usuario', auth()->id());
    }

    public function specimensFoundInYearByMonth($year){
        $consulta = DB::table('entrada_especie')
        ->join('entradas', 'entrada_especie.entrada_id', '=', 'entradas.id')
        ->where('entradas.id_usuario', auth()->id())
        ->whereRaw("strftime('%Y', entradas.fecha) = ?", [$year])
        ->selectRaw("strftime('%m', entradas.fecha) as mes, SUM(entrada_especie.cantidad) as total")
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');
        $valores = [];
            for ($i = 1; $i <= 12; $i++) {
                $mes = str_pad($i, 2, '0', STR_PAD_LEFT);
                $valores[] = $consulta[$mes] ?? 0;
            }
        return $valores;
    }

    public function entriesInYearByMonth($year){
        $consulta = DB::table('entradas')
        ->where('id_usuario', auth()->id())
        ->whereRaw("strftime('%Y', fecha) = ?", [$year])
        ->selectRaw("strftime('%m', fecha) as mes, COUNT(*) as total")
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');
        $valores = [];
        for ($i = 1; $i <= 12; $i++) {
            $mes = str_pad($i, 2, '0', STR_PAD_LEFT);
            $valores[] = $consulta[$mes] ?? 0;
        }
        return $valores;
    }

    public function totalSpecimens($data){
        $total = 0;
        foreach ($data as $key => $value) {
            $total += intval($value);
        }
        return $total;
    }

    public function specimensTopInYear($year){
        return DB::table('entrada_especie')
        ->join('entradas', 'entrada_especie.entrada_id', '=', 'entradas.id')
        ->join('especies', 'entrada_especie.especie_id', '=', 'especies.id')
        ->where('entradas.id_usuario', auth()->id())
        ->whereRaw("strftime('%Y', entradas.fecha) = ?", [$year])
        ->selectRaw("especies.genero || substr(especies.especie, 3) AS nombre, SUM(entrada_especie.cantidad) AS total")
        ->groupBy('nombre')
        ->orderByDesc('total')
        ->limit(10)
        ->get();
    }
}
