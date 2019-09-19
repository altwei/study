<?php
$data = [5, 2, 1, 8, 9, 3, 4, 7, 6,];

/**
 * 快速排序 - 升序
 * @param array $data
 * @return array
 */
function quick_sort_asc($data = [])
{
    $len = count($data);
    if ($len <= 1)
        return $data;
    $middle = $data[0];
    $left = [];
    $right = [];

    for ($i = 1; $i < $len; $i++) {
        if ($data[$i] < $middle)
            $left[] = $data[$i];
        else
            $right[] = $data[$i];
    }
    $left = quick_sort_asc($left);
    $right = quick_sort_asc($right);

    return array_merge($left, [$middle], $right);
}

/**
 * 快速排序 - 降序
 * @param array $data
 * @return array
 */
function quick_sort_desc($data = [])
{
    $len = count($data);
    if ($len <= 1)
        return $data;
    $middle = $data[0];
    $left = [];
    $right = [];

    for ($i = 1; $i < $len; $i++) {
        if ($data[$i] > $middle)
            $left[] = $data[$i];
        else
            $right[] = $data[$i];
    }
    $left = quick_sort_desc($left);
    $right = quick_sort_desc($right);

    return array_merge($left, [$middle], $right);
}

echo implode(', ', quick_sort_asc($data)), PHP_EOL;
echo implode(', ', quick_sort_desc($data)), PHP_EOL;