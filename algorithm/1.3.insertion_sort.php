<?php
$data = [5, 2, 1, 8, 9, 3, 4, 7, 6,];

/**
 * 插入排序 - 升序
 * @param array $data
 * @return array
 */
function insertion_sort_asc($data = [])
{
    $len = count($data);
    for ($i = 1; $i < $len; $i++) {
        $prev_index = $i - 1;
        $current = $data[$i];
        //如果，前者比后者大，则，把前者后移
        while ($prev_index >= 0 && $data[$prev_index] > $current) {
            $data[$prev_index + 1] = $data[$prev_index];
            $prev_index--;
        }
        //最后，把当前值插入某个位置
        $data[$prev_index + 1] = $current;
    }
    return $data;
}

/**
 * 插入排序 - 降序
 * @param array $data
 * @return array
 */
function insertion_sort_desc($data = [])
{
    $len = count($data);
    for ($i = 1; $i < $len; $i++) {
        $prev_index = $i - 1;
        $current = $data[$i];
        //如果，前者比后者小，则，把前者后移
        while ($prev_index >= 0 && $data[$prev_index] < $current) {
            $data[$prev_index + 1] = $data[$prev_index];
            $prev_index--;
        }
        //最后，把当前值插入某个位置
        $data[$prev_index + 1] = $current;
    }
    return $data;
}

echo implode(', ', insertion_sort_asc($data)), PHP_EOL;
echo implode(', ', insertion_sort_desc($data)), PHP_EOL;