<?php

namespace App\Charts;

use App\Models\Pendaftaran;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

use function Termwind\style;

class pendaftaranBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): BarChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        $dataPendaftaran = []; // Array untuk menyimpan total pendaftaran setiap bulan
        $labelsBulan = []; // Array untuk menyimpan nama bulan


        for ($i = 1; $i <= $bulan; $i++) {
            $dataPendaftaran[] = Pendaftaran::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->count();
            $namaBulan = date('F', mktime(0, 0, 0, $i, 1, $tahun));
            $labelsBulan[] = $namaBulan;

        }

        return $this->chart->barChart()
            ->setTitle('Statistik Data Pendaftaran')
            ->setSubtitle('Total Pendaftaran Siswa Setiap Bulan')
            ->addData('Total Pendaftaran', $dataPendaftaran)
            ->setXAxis($labelsBulan)
            ->setColors(['#282561'])
            ->setHeight(330);
    }
}
