<?php
include_once "TestClass.php";

/**
 * 二维数组查找
 * 在一个二维数组中（每个一维数组的长度相同），
 * 每一行都按照从左到右递增的顺序排序，每一列都按照从上到下递增的顺序排序。
 * 请完成一个函数，输入这样的一个二维数组和一个整数，判断数组中是否含有该整数。
 * @param $target
 * @param $array
 * @return bool
 */
function findMe($target, $array)
{
    $count_x = null;
    if ($array && is_array($array)) {
        foreach ($array as $i => $row) {
            if (!$count_x) {
                $count_x = count($row);
            }
            if ($target > $row[$count_x - 1]) {
                continue;
            }
            if ($target < $row[0]) {
                return false;
            }
            //if(in_array($target,$row)){
            //    return true;
            //}
            //对每行使用二分查找,能比in_array高率
            $l = 0;
            $r = $count_x - 1;
            while ($l <= $r) {
                $now = intval(floor(($l + $r) / 2));
                if ($row[$now] > $target) {
                    $r = $now - 1;
                    continue;
                }
                if ($row[$now] < $target) {
                    $l = $now + 1;
                    continue;
                }
                if ($row[$now] == $target) {
                    return true;
                }

            }
        }
    }
    return false;
}


/**
 * 字符串替换
 * 将一个字符串中的每个空格替换成“%20”。
 * eg. 当字符串为We Are Happy.则经过替换之后的字符串为We%20Are%20Happy.
 * @param $str
 * @return mixed
 */
function replaceSpace($str)
{
//    return str_replace(' ','%20',$str);
//    return implode("%20",explode(" ",$str));
    $tmp = '';
    $i = strlen($str) - 1;
    while ($i >= 0) {
        if ($str[$i] == ' ') {
            $tmp = '%20' . $tmp;
        } else {
            $tmp = $str[$i] . $tmp;
        }
        $i--;
    }
    return $tmp;
}



/**
 * 链表值从尾到头的顺序返回一个ArrayList。
 * @param $head ListNode
 * @return array
 */
function printListFromTailToHead($head)
{
    $ar = [];
    while ($head) {
        array_unshift($ar, $head->val);
        $head = $head->next;
    }
    return $ar;
}


/**
 * 重建二叉树
 * 输入某二叉树的前序遍历和中序遍历的结果，重建出该二叉树。
 * 假设输入的前序遍历和中序遍历的结果中都不含重复的数字。
 * 例如输入前序遍历序列{1,2,4,7,3,5,6,8}和中序遍历序列{4,7,2,1,5,3,8,6}，则重建二叉树并返回。
 * @param $pre array 前序遍历结果
 * @param $vin array 中序遍历结果
 * @return TreeNode 二叉树的根节点
 */
function reConstructBinaryTree($pre, $vin)
{
    if ($pre && $pre == $vin ) {
        $tmp = $root = new TreeNode(null);
        foreach ($pre as $one) {
            $tmp->right = new TreeNode($one);
            $tmp = $tmp->right;
        }
        return $root->right;
    }
    $root = new TreeNode($pre[0]);

    $idx = array_search($pre[0], $vin);
    if ($idx > 0) {
        $root->left = reConstructBinaryTree(array_slice($pre, 1, $idx, false), array_slice($vin, 0, $idx, false));
    }

    if ($idx < count($vin) - 1) {
        $root->right = reConstructBinaryTree(array_slice($pre, $idx + 1, null, false), array_slice($vin, $idx + 1, null, false));
    }
    return $root;
}

//print_r(reConstructBinaryTree([1, 2, 4, 7, 3, 5, 6, 8], [4, 7, 2, 1, 5, 3, 8, 6]));


/**
 * 旋转数组的最小数字
 * 把一个数组最开始的若干个元素搬到数组的末尾，我们称之为数组的旋转。
 * 输入一个非减排序的数组的一个旋转，输出旋转数组的最小元素。
 * 例如数组{3,4,5,1,2}为{1,2,3,4,5}的一个旋转，该数组的最小值为1。
 * NOTE：给出的所有元素都大于0，若数组大小为0，请返回0。
 * @param $rotateArray
 * @return integer
 */
function minNumberInRotateArray($rotateArray)
{
    if(empty($rotateArray)||!is_array($rotateArray)){
        return 0;
    }
    $high = count($rotateArray)-1;
    if($rotateArray[0]<=$rotateArray[$high]){
        return $rotateArray[0];
    }
    $low = 0;
    while ($low<=$high){
        if($low==$high){
            return $rotateArray[$low];
        }
        $mid = intval(($low+$high)/2);
        if($rotateArray[0]>$rotateArray[$mid]){
            if($rotateArray[$mid]<$rotateArray[$mid-1]){
                return $rotateArray[$mid];
            }
            $high = $mid-1;
        }else{
            $low = $mid+1;
        }

    }
}

/**
 * 斐波那契数列
 * 现在要求输入一个整数n，输出斐波那契数列的第n项（从0开始，第0项为0）
 * @param $n
 * @return integer
 */
function Fibonacci($n)
{
    if($n<2){
        return $n;
    }
    $f1 = 0;
    $f2 = $f3 = 1;
    for($i=2;$i<=$n;$i++){
        $f3 = $f1 + $f2;
        $f1 = $f2;
        $f2 = $f3;
    }
    return $f3;
}

/**
 * 跳台阶
 * 一只青蛙一次可以跳上1级台阶，也可以跳上2级。求该青蛙跳上一个n级的台阶总共有多少种跳法（先后次序不同算不同的结果）。
 * @param $number
 * @return integer
 */
function jumpFloor($number)
{
    if($number<=0){
        return 0;
    }elseif ($number<=2){
        return $number;
    }
    $f1 = $f2 = $f3 = 1;
    for($i=2;$i<=$number;$i++){
        $f3 = $f1 + $f2;
        $f1 = $f2;
        $f2 = $f3;
    }
    return $f3;
}


/**
 * 变态跳台阶
 * 一只青蛙一次可以跳上1级台阶，也可以跳上2级……它也可以跳上n级。求该青蛙跳上一个n级的台阶总共有多少种跳法。
 * @param $number
 * @return integer
 */
function jumpFloorII($number)
{
    if($number<=0){
        return 0;
    }
    return $number==1?1:1<<($number-1);
}