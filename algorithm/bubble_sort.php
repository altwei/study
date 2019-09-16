<?php
$data = [5, 2, 1, 8, 9, 3, 4, 7, 6,];
/**
 * 冒泡排序 - 升序
 * @param array $data
 * @return array
 */
function bubble_sort_asc($data = [])
{
    $len = count($data);
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = 0; $j < $len - $i - 1; $j++) {
            if ($data[$j] > $data[$j + 1]) {
                list($small, $big) = [$data[$j + 1], $data[$j]];
                $data[$j] = $small;
                $data[$j + 1] = $big;
            }
        }
    }
    return $data;
}

/**
 * 冒泡排序 - 降序
 * @param array $data
 * @return array
 */
function bubble_sort_desc($data = [])
{
    $len = count($data);
    for ($i = 0; $i < $len - 1; $i++) {
        for ($j = 0; $j < $len - $i - 1; $j++) {
            if ($data[$j] < $data[$j + 1]) {
                list($small, $big) = [$data[$j], $data[$j + 1]];
                $data[$j] = $big;
                $data[$j + 1] = $small;
            }
        }
    }
    return $data;
}

echo implode(', ', bubble_sort_asc($data)), PHP_EOL;
echo implode(', ', bubble_sort_desc($data)), PHP_EOL;
