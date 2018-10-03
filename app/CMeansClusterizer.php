<?php

namespace App;

class CMeansClusterizer
{
    public function __construct($data, $n_clusters, $n_iterations, $fuzziness)
    {
        $this->data = $data;
        $this->n_clusters = $n_clusters;
        $this->n_iterations = $n_iterations;
        $this->fuzziness = $fuzziness;

        $this->initialize();
    }

    private function initialize()
    {
        $this->features = array_keys(reset($this->data));

        $this->membership_degrees = [];
        foreach ($this->data as $key => $value) {
            $this->membership_degrees[$key] = [];

            for ($i = 0; $i < $this->n_clusters; ++$i) {
                $this->membership_degrees[$key][$i] = rand(0, 100) / 100;
            }
        }

    }

    private function compute_centroids()
    {
        for ($i = 0; $i < $this->n_clusters; $i++) {
            foreach ($this->features as $feature) {

                $num = 0;
                $den = 0;

                foreach ($this->membership_degrees as $key => $membership_degree) {
                    $num += pow($membership_degree[$i], $this->fuzziness) * $this->data[$key][$feature];
                    $den += pow($membership_degree[$i], $this->fuzziness);
                }

                $this->centroids[$i][$feature] = $num / $den;
            }
        }
    }

    private function distance($vec_a, $vec_b, $keys)
    {
        $total = 0;

        foreach ($keys as $key) {
            $total += pow($vec_a[$key] - $vec_b[$key], 2);
        }

        return sqrt($total);
    }

    private function update_membership_degrees()
    {
        foreach ($this->membership_degrees as $key => $membership_degree) {
            for ($i = 0; $i < $this->n_clusters; $i++) {
                
                $total = 0.0;

                for ($j = 0; $j < $this->n_clusters; $j++) {
                    $total += pow(
                        $this->distance($this->data[$key], $this->centroids[$i], $this->features) /
                        $this->distance($this->data[$key], $this->centroids[$j], $this->features)
                    , 2.0 / ($this->fuzziness - 1.0));
                }

                $this->membership_degrees[$key][$i] = 1.0 / $total;
            }
        }
    }

    public function clusterize()
    {
        for ($i = 0; $i < $this->n_iterations; ++$i) {
            $this->compute_centroids();
            $this->update_membership_degrees();
        }

        $result = [];
        foreach ($this->membership_degrees as $key => $membership_degree) {
            $result[$key] = array_search(max($membership_degree), $membership_degree) + 1;
        }

        return $result;
    }
}
