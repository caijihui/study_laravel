<?php
/**
 * Created by PhpStorm.
 * User: zz-med
 * Date: 2019/3/19
 * Time: 下午2:40
 */

# 抢红包算法基础版   (金额参数以分为单位)  二倍均值法
##  基本思路：剩余红包金额为M，剩余人数为N，那么有如下公式：
##          每次抢到的金额 = 随机区间 （0， M / N X 2）
### 参数：（int）$total : 红包总金额(分)    （int）$num : 所发红包个数
function getHong($total = 0 , $num = 0) {
    $bag = [];
    if ($total == 0 || $num == 0 || $total < $num) {
        return false;
    }
    if ($num == 1) {
        $bag[] = $total;
        return $bag;
    }
    for($i = 0; $i < $num ; $i++) {
        // echo '剩余人数：' . ($num - $i) . "\t\n";
        if ( ($num - $i) == 1) {
            array_push($bag, $total);
            break;
        }
        // echo "剩余总金额：" . $total . "\t\n";
        $_tmp = floor($total / ($num - $i) * 2);    //红包数
        // echo "当前红包最大限额：" . $_tmp . "\t\n";
        $_red_bag = rand(1, $_tmp - ($num - $i) - 1);
        // echo "本次预计抢到红包数：" . $_red_bag . "\t\n";
        array_push($bag, $_red_bag);
        $total = $total - $_red_bag;
    }
    echo "\n";
    return $bag;
}

// print_r($argv);
echo "方式一：\n";
print_r('您输入的红包数为：' . $argv[1] . "\t\n您输入的人数为：" . $argv[2] . "\t\n\n");
$res = getHong($argv[1]*100, $argv[2]);
// print_r($res);
foreach ($res as $_key => $_value) {
echo "红包为：" . $_value/100 . "\n";
}

# 抢红包方法二   线段切割法
##  基本思路：将金额总量 最为一个整体M   N个人来分  则分N-1次   先分开，然后依次拿走
##  可能遇到的问题：①随机分出现重复 ②如何尽可能降低时间复杂度和空间复杂度。


function getHongTwo($total = 0 , $num = 0) {
    $bag = [];
    $max = 0;
    for ($i=0; $i < $num - 1; $i++) {
        $_bag = is_repeat($bag, $total);
        if ($_bag > $max) {
            $max = $_bag;
        }
        array_push($bag, $_bag);
    }
    sort($bag);
    $money = [];
    for ($i=0; $i < count($bag); $i++) {
        if ($i == 0) {
            $_money = $bag[$i];
        }else {
            $_money = $bag[$i] - $bag[$i - 1];
        }
        array_push($money, $_money);
    }
    # 最后一个值(max可以不进行比较，在数组排序后 选择$bag[$num-2])
    $_quantity = $total - $max;
    array_push($money, $_quantity);

    return $money;
}

/**
 *  去除重复
 * @param array $array
 * @param int $max
 * @return int
 */
function is_repeat($array = [] , $max = 0) {
    $_bag = rand(1,$max - 1);
    // 控制重复，重复可能会出现0的情况
    if (in_array($_bag, $array)) {
        $_bag = is_repeat($array , $max);
    }
    return $_bag;
}

echo "方法二 \n";
print_r('您输入的红包金数为：' . $argv[1] . "\t\n您输入的人数为：" . $argv[2] . "\t\n\n");
$res = getHongTwo($argv[1]*100, $argv[2]);
// print_r( $res );
foreach ($res as $_key => $_value) {
    echo "红包为：" . $_value/100 . "\n";
}

##  运行方式 ： php hongbao.php 20 20