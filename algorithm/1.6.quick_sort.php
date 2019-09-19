<?php
/**
 * 名称：快速排序
 * 时间复杂度：O(n log n) - O(n^2)
 * 空间复杂度：O(log n)
 * 排序方式：内部排序
 * 稳定性：不稳定
 */
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