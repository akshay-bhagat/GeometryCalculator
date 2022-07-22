<?php

namespace App\Service;

class Circle
{
    // π ≈ 3.14159265
    CONST PI = 3.14159265;

    public function calculateAllForCircle($radius): Array
    {
        $area = $this->areaOfCircle($radius);
        $diameter = $this->diameterOfCircle($radius);
        $circumference = $this->circumferenceOfCircle($radius);

        return [
                    "type"          => "circle",
                    "radius"        => $this->formatNumber($radius),
                    'surface'       => $this->formatNumber($area),
                    'diameter'      => $this->formatNumber($diameter),
                    'circumference' => $this->formatNumber($circumference),
                ];

    }


    /**
     * Calculates the surface area of a Circle
     * Formula: π * r * r
     * 
     * @param float $radius
     */
    public function areaOfCircle(float $radius)
    {
       return self::PI * pow($radius, 2);
    }

    /**
     * Calculates the circumference of a Circle
     * Formula: 2 * π * r
     * 
     * @param float $radius
     */
    public function circumferenceOfCircle(float $radius)
    {
       return 2 * self::PI * $radius;
    }

    /**
     * Calculates the diameter of a Circle
     * Formula: 2 * r
     * 
     * @param float $radius
     */
    public function diameterOfCircle(float $radius)
    {
       return 2 * $radius;
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