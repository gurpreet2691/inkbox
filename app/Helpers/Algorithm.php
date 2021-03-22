<?php

class Algorithm {

    public function bestFitAlgo(array $bin, array $rectangle)
    {
        $bin_list = [];
        $counter = 0;
        $bin_area = $bin['area'];
        foreach ($rectangle as $rect) {
            if (empty($bin_list)) {
                // add the first element to the bin
                $bin_area -= $rect->size;
                $bin_list['bin ' . $counter]['rect'][] = $rect;
                $bin_list['bin ' . $counter]['remaining_area'] = $bin_area;
            } elseif (!empty($bin_list) && $rect->size <= $bin_area) {
                // check if the bin still has the space to add more boxes
                foreach ($bin_list as $key => $list) {
                    // check if the bin_list is full
                    if ($list['remaining_area'] < $rect->size) {
                        continue;
                    }

                    $bin_list[$key]['rect'][] = $rect;
                    $bin_list[$key]['remaining_area'] = $list['remaining_area'] - $rect->size;

                    if (count($bin_list) == explode(' ', $key)[1] + 1) {
                        $bin_area -= $rect->size;
                    }

                    break;
                }
            } else {
                // create a new bin if the rectangle cannot fit the existing bin_list
                ++$counter;
                $bin_area = $bin['area'];
                $bin_list['bin ' . $counter]['rect'][] = $rect;
                $bin_list['bin ' . $counter]['remaining_area'] = $bin_area - $rect->size;
                $bin_area -= $rect->size;
            }
        }

        return $bin_list;
    }
}



