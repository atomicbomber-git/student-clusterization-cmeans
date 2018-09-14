<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\CMeansClusterizer;
use App\Nilai;
use App\Mahasiswa;

class CMeansClusterize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'util:clusterize
        {--iteration=1000}
        {--cluster=5}
        {--fuzziness=5}
        {--tahun_ajaran=1}
        {--ganjil_genap=GANJIL}
        {--angkatan=1}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ran clusterization against data stored in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nilais = Mahasiswa::query()
            ->select('id', 'NIM')
            ->where('angkatan_id', $this->option('angkatan'))
            ->with(['nilai' => function ($query) {
                $query
                    ->select('id', 'mahasiswa_id', 'IPK', 'IPS')
                    ->where('tahun_ajaran_id', $this->option('tahun_ajaran'))
                    ->where('ganjil_genap', $this->option('ganjil_genap'));
            }])
            ->get()
            ->pluck('nilai')
            ->mapWithKeys(function ($nilai) {
                return [$nilai->id => [
                    'IPK' => $nilai->IPK,
                    'IPS' => $nilai->IPS
                ]];
            });

        // dd($nilais->toArray());
       
        $clusterizer = new CMeansClusterizer(
            $nilais->toArray(),
            $this->option('cluster'),
            $this->option('iteration'),
            $this->option('fuzziness')
        );

        $data = $clusterizer->clusterize();
        dd($data);
    }
}
