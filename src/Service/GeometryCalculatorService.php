<?php

namespace App\Service;

use App\Service\Circle;
use App\Service\Triangle;

/**
 * GeometryCalculatorService use Circle and Triangle class services
 */
class GeometryCalculatorService
{
    /**
     * Circle $circle
     */
    protected $circle;

    /**
     * Triangle $triangle
     */
    protected $triangle;


    /**
     * Class constructor.
     */
    public function __construct(Circle $circle, Triangle $triangle)
    {
        $this->circle = $circle;
        $this->triangle = $triangle;
    }

    public function getCircleSurface(float $radius)
    {
        return $this->circle->areaOfCircle($radius);
    }

    public function getCircleDiameter(float $radius)
    {
        return $this->circle->diameterOfCircle($radius);
    }

    public function getAllCircleCalculations(float $radius)
    {
        return $this->circle->calculateAllForCircle($radius);
    }

    public function getTriangleSurface(float $a, $b, $c)
    {
        return $this->triangle->areaOfTriangle($a, $b, $c);
    }

    public function getTriangleDiameter(float $a, $b, $c)
    {
        return $this->triangle->diameterOfTriangle($a, $b, $c);
    }

    public function getAllTriangleCalculations(float $a, $b, $c)
    {
        return $this->triangle->calculateAllForTriangle($a, $b, $c);
    }


}