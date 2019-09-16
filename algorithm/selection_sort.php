<?php
$data = [5, 2, 1, 8, 9, 3, 4, 7, 6,];

/**
 * 选择排序 - 升序
 * @param array $data
 * @return array
 */
function selection_sort_asc($data = [])
{
    $len = count($data);
    for ($i = 0; $i < $len - 1; $i++) {
        $min = $i; //初始化：最小值的key
        for ($j = $i + 1; $j < $len; $j++)
            if ($data[$min] > $data[$j])
                $min = $j; //重新定位：最小值的key
        //把最小值放到前面
        if ($min != $i) {
            list($small, $big) = [$data[$min], $data[$i]];
            $data[$i] = $small;
            $data[$min] = $big;
        }
    }
    return $data;
}

/**
 * 选择排序 - 降序
 * @param array $data
 * @return array
 */
function selection_sort_desc($data = [])
{
    $len = count($data);
    for ($i = 0; $i < $len - 1; $i++) {
        $max = $i; //初始化：最大值的key
        for ($j = $i + 1; $j < $len; $j++)
            if ($data[$max] < $data[$j])
                $max = $j; //重新定位：最大值的key
        //把最大值放到前面
        if ($max != $i) {
            list($small, $big) = [$data[$i], $data[$max]];
            $data[$i] = $big;
            $data[$max] = $small;
        }
    }
    return $data;
}

echo implode(', ', selection_sort_asc($data)) . PHP_EOL;
echo implode(', ', selection_sort_desc($data)) . PHP_EOL;