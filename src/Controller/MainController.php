<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GeometryCalculatorService;
use App\Service\Circle;
use App\Service\Triangle;

class MainController extends AbstractController
{
    /**
     * Fetch all calulations of Circle: surface, diameter, circumference
     * 
     * @param float $radius
     */
    #[Route('/circle/{radius}', name: 'app_circle', methods:'GET')]
    public function getAllCircleCalculations(float $radius, GeometryCalculatorService $geometryCalculatorService)
    {
        try {
            if (!is_numeric($radius)) {
                return $this->json([
                                    'message'   => "Hmmm! Looks like your input is not a real number!",
                                    'errorType' => "Incorrect datatype : radius",
                                ], 400); // #400 Bad Request
            }
            $data = $geometryCalculatorService->getAllCircleCalculations($radius);

            return $this->json([
                                "type"          => $data['type'],
                                "radius"        => $data['radius'],
                                'surface'       => $data['surface'],
                                'diameter'      => $data['diameter'],
                                'circumference' => $data['circumference'],
                            ], 200);

        } catch (\Throwable $th) {
            return $this->json([
                                'message'       => 'Opps! Something went wrong!',
                                'errorMessages' => $th,
                            ], 510);

        }
    }

    /**
     * Fetch all calulations of Triangle: surface, diameter, perimeter
     * 
     * @param float $a, $b, $c
     */
    #[Route('/triangle/{a}/{b}/{c}', name: 'app_triangle', methods: 'GET')]
    public function getAllTriangleCalculations(float $a, float $b, float $c, GeometryCalculatorService $geometryCalculatorService)
    {
        try {
            if (!is_numeric($a) | !is_numeric($b) | !is_numeric($c)) {
                return $this->json([
                                    'message'   => "Hmmm! Looks like your input is not a real number!",
                                    'errorType' => "Incorrect datatype : a | b | c",
                                ], 400); // #400 Bad Request
            }
            
            // Length of sides must be positive
            // and sum of any two sides must be smaller than third side.
            if ($a < 0 | $b < 0 | $c < 0 | ($a + $b <= $c) | $a + $c <= $b | $b + $c <= $a){
                return $this->json([
                    'message'   => "Hmmm! Looks like your input numbers does not make a valid triangle!",
                    'errorType' => "Incorrect value(s) : a | b | c",
                ], 400); // #400 Bad Request
            }

            $data = $geometryCalculatorService->getAllTriangleCalculations($a, $b, $c);

            return $this->json([
                                "type"      => $data['type'],
                                "a"         => $data['a'],
                                "b"         => $data['b'],
                                "c"         => $data['c'],
                                'surface'   => $data['surface'],
                                'diameter'  => $data['diameter'],
                                'perimeter' => $data['perimeter'],
                        ], 200);

        } catch (\Throwable $th) {
            return $this->json([
                                'message'       => 'Opps! Something went wrong!',
                                'errorMessages' => $th,
                            ], 510);

        }
    }

    /**
     * method for sum of areas for two given objects
     */
    #[Route('/sum-of-areas', name: 'sum_of_area', methods: 'GET')]
    public function sumOfAreas()
    {
        $circle = new Circle;
        $triangle = new Triangle;
        $c1 = new GeometryCalculatorService($circle, $triangle);
        $c2 = new GeometryCalculatorService($circle, $triangle);

        $sum = $c1->getCircleSurface(2) + $c2->getCircleSurface(2);

        return $this->json([
                            'type' => 'circle',
                            'sum-of-areas'  => number_format((float)$sum, 2, '.', ''),
                    ], 200);
    }

    /**
     * method for sum of diameters for two given objects
     */
    #[Route('/sum-of-diameters', name: 'sum_of_diameter', methods: 'GET')]
    public function sumOfDiameters()
    {
        $circle = new Circle;
        $triangle = new Triangle;
        $t1 = new GeometryCalculatorService($circle, $triangle);
        $t2 = new GeometryCalculatorService($circle, $triangle);

        $sum = $t1->getTriangleDiameter(3,4,5) + $t2->getTriangleDiameter(5,6,7);
        
        return $this->json([
                            'type' => 'triangle',
                            'sum-of-diameter'  => number_format((float)$sum, 2, '.', ''),
                    ], 200);
    }

}
