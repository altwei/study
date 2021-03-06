<?php
/**
 * 名称：冒泡排序
 * 时间复杂度：O(n) - O(n^2)
 * 空间复杂度：O(1)
 * 排序方式：内部排序
 * 稳定性：稳定
 */
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
            //将最大值，放到末尾
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
            //将最小值，放到末尾
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
