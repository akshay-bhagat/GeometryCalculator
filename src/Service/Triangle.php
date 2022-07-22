<?php

namespace App\Service;

class Triangle
{

    public function calculateAllForTriangle($a, $b, $c): Array
    {
        $area = $this->areaOfTriangle($a, $b, $c);
        $diameter = $this->diameterOfTriangle($a, $b, $c);
        $perimeter = $this->perimeterOfTriangle($a, $b, $c);

        return [
                    "type"      => "triangle",
                    "a"         => $this->formatNumber($a),
                    "b"         => $this->formatNumber($b),
                    "c"         => $this->formatNumber($c),
                    'surface'   => $this->formatNumber($area),
                    'diameter'  => $this->formatNumber($diameter),
                    'perimeter' => $this->formatNumber($perimeter),
                ];

    }


    /**
     * Calculates the surface area of a Triangle
     * Formula: Area = √[s(s-a)(s-b)(s-c)]
     * where    s = (a+b+c)/2
     * 
     * @param float $a, $b, $c
     */
    public function areaOfTriangle(float $a, $b, $c)
    {
        $x = ($a + $b + $c) / 2;
        return sqrt($x * ($x - $a) * ($x - $b) * ($x - $c));
    }

    /**
     * Calculates the perimeter of a Triangle
     * Formula: a + b + c
     * 
     * @param float $a, $b, $c
     */
    public function perimeterOfTriangle(float $a, $b, $c)
    {
       return $a + $b + $c;
    }

    /**
     * Calculates the diameter of a Triangle
     * Formula: largest side of the triangle is the diameter
     * 
     * @param float $a, $b, $c
     */
    public function diameterOfTriangle(float $a, $b, $c)
    {
       return max($a, $b, $c);
    }

    /**
     * Formats a given number with two decimal points
     * Ex: formatNumber(99) => 99.00
     * 
     * @param float $num
     */
    public function formatNumber(float $num = 0)
    {
        return number_format((float)$num, 2, '.', '');
    }
}
