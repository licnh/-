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
            //对每行使用二分查找
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
    if ($pre && $pre == $vin) {
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
 * @return int
 */
function minNumberInRotateArray($rotateArray)
{
    if (empty($rotateArray) || !is_array($rotateArray)) {
        return 0;
    }
    $high = count($rotateArray) - 1;
    if ($rotateArray[0] <= $rotateArray[$high]) {
        return $rotateArray[0];
    }
    $low = 0;
    while ($low <= $high) {
        if ($low == $high) {
            return $rotateArray[$low];
        }
        $mid = intval(($low + $high) / 2);
        if ($rotateArray[0] > $rotateArray[$mid]) {
            if ($rotateArray[$mid] < $rotateArray[$mid - 1]) {
                return $rotateArray[$mid];
            }
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }

    }
}

/**
 * 斐波那契数列
 * 现在要求输入一个整数n，输出斐波那契数列的第n项（从0开始，第0项为0）
 * @param $n
 * @return int
 */
function Fibonacci($n)
{
    if ($n < 2) {
        return $n;
    }
    $f1 = 0;
    $f2 = $f3 = 1;
    for ($i = 2; $i <= $n; $i++) {
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
 * @return int
 */
function jumpFloor($number)
{
    if ($number <= 0) {
        return 0;
    } elseif ($number <= 2) {
        return $number;
    }
    $f1 = $f2 = $f3 = 1;
    for ($i = 2; $i <= $number; $i++) {
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
 * @return int
 */
function jumpFloorII($number)
{
    if ($number <= 0) {
        return 0;
    }
    return $number == 1 ? 1 : 1 << ($number - 1);
}

/**
 * 矩形覆盖
 * 我们可以用2*1的小矩形横着或者竖着去覆盖更大的矩形。请问用n个2*1的小矩形无重叠地覆盖一个2*n的大矩形，总共有多少种方法？
 * @param $number int
 * @return int
 */
function rectCover($number)
{
    //f(n) = f(n-1)+f(n-2)

    if ($number <= 0) {
        return 0;
    } elseif ($number == 1 || $number == 2) {
        return $number;
    } else {
        $f1 = 1;
        $f2 = 2;
        $result = 0;
        for ($i = 3; $i <= $number; $i++) {
            $result = $f1 + $f2;
            $f1 = $f2;
            $f2 = $result;
        }
        return $result;
    }
}

/**
 * 二进制中1的个数
 * 输入一个整数，输出该数二进制表示中1的个数。其中负数用补码表示
 * @param $n
 * @return int
 */
function NumberOf1($n)
{
    $count = 0;
    $n = $n & 0xffffffff;
    while ($n) {
        $count++;
        $n = ($n - 1) & $n;
    }
    return $count;
}

/**
 * 数值的整数次方
 * 给定一个double类型的浮点数base和int类型的整数exponent。求base的exponent次方。
 * @param $base double
 * @param $exponent int
 * @return double
 */
function Power($base, $exponent)
{
    if (!$base) return 0;
    if ($base == 1 || $exponent == 1) return $base;
    $result = 1;//0直接返回1
    $is_f = false;
    if ($exponent < 0) {
        $is_f = true;//负数求倒数
        $exponent = -$exponent;
    }
    while ($exponent) {
        if ($exponent & 1) {//&1 判断最后一位是否为1
            $result *= $base;
        }
        $base *= $base;
        $exponent >>= 1;
    }
    return $is_f ? 1 / $result : $result;
}

/**
 * 调整数组顺序使奇数位于偶数前面
 * 输入一个整数数组，实现一个函数来调整该数组中数字的顺序，
 * 使得所有的奇数位于数组的前半部分，所有的偶数位于数组的后半部分，并保证奇数和奇数，偶数和偶数之间的相对位置不变。
 * @param $array
 * @return array
 */
function reOrderArray($array)
{

    $res = [[], []];
    foreach ($array as $one) {
        if ($one & 1) {
            //奇数
            $res[0][] = $one;
        } else {
            $res[1][] = $one;
        }
    }
    return array_merge($res[0], $res[1]);
}


/**
 * 链表中倒数第k个结点
 * @param $head ListNode
 * @param $k int
 * @return ListNode|false
 */
function FindKthToTail($head, $k)
{
    if ($k <= 0) {
        return false;
    }
    $end = $head;
    $kNode = null;
    while ($end) {
        if ($k > 0) {
            $k--;
        }
        if ($k == 0) {
            $kNode = $kNode ? $kNode->next : $head;
        }
        $end = $end->next;
    }
    if ($k > 0) {
        return false;
    }
    return $kNode;
}

/**
 * 反转链表
 * 输入一个链表，反转链表后，输出新链表的表头。
 * @param $pHead ListNode
 * @return ListNode
 */
function ReverseList($pHead)
{
    $last = null;
    while ($pHead) {
        $tmp = $pHead->next;
        $pHead->next = $last;
        $last = $pHead;

        if ($tmp) {
            $pHead = $tmp;
        } else {
            break;
        }
    }
    return $pHead;
}

/**
 * 合并两个排序的链表
 * 输入两个单调递增的链表，输出两个链表合成后的链表，合成后的链表满足单调不减规则。
 * @param $pHead1 ListNode
 * @param $pHead2 ListNode
 * @return ListNode
 */
function Merge($pHead1, $pHead2)
{
    if (!$pHead1) {
        return $pHead2 ?: null;
    }
    if (!$pHead2) {
        return $pHead1 ?: null;
    }

    if ($pHead1->val <= $pHead2->val) {
        $head = $bef = $pHead1;
        $pHead1 = $pHead1->next;
    } else {
        $head = $bef = $pHead2;
        $pHead2 = $pHead2->next;
    }
    while ($pHead1 && $pHead2) {
        if ($pHead1->val <= $pHead2->val) {
            $bef->next = $pHead1;
            $bef = $pHead1;
            $pHead1 = $pHead1->next;
        } else {
            $bef->next = $pHead2;
            $bef = $pHead2;
            $pHead2 = $pHead2->next;
        }
    }
    if ($pHead1) {
        $bef->next = $pHead1;
    } elseif ($pHead2) {
        $bef->next = $pHead2;
    }
    return $head;
}


/**
 * 树的子结构
 * 输入两棵二叉树A，B，判断B是不是A的子结构。空树不是任意一个树的子结构。
 * @param $root1 TreeNode
 * @param $root2 TreeNode
 * @return bool
 */
function HasSubtree($root1, $root2)
{
    if (!$root1 || !$root2) {
        return false;
    }
    $find = [];
    $is_find = findValFromTree($root1, $root2->val, $find);
    if ($is_find && count($find) > 0) {
        foreach ($find as $node) {
            if (checkSubTree($node, $root2)) {
                return true;
            }
        }
    }
    return false;
}

/**
 * 二叉树查找
 * @param $root TreeNode 待查找的树
 * @param $val mixed 要查找的值
 * @param $find array 查找到的结果
 * @return bool
 */
function findValFromTree($root, $val, &$find)
{
    if (!$root) {
        return false;
    }
    if ($root->val == $val) {
        $find[] = $root;
    }
    if ($root->left) {
        findValFromTree($root->left, $val, $find);
    }
    if ($root->right) {
        findValFromTree($root->right, $val, $find);
    }
    return true;
}

/**
 * 检查树1包含树2
 * @param $root1 TreeNode
 * @param $root2 TreeNode
 * @return bool
 */
function checkSubTree($root1, $root2)
{
    $flag = true;
    if (!$root1 && !$root2) {
        return true;
    }
    if ((!$root1 && $root2) || ($root1 && !$root2)) {
        return false;
    }
    if ($root1->val != $root2->val) {
        return false;
    }
    if ($root2->left) {
        $flag = checkSubTree($root1->left, $root2->left);
    }
    if ($flag && $root2->right) {
        $flag = checkSubTree($root1->right, $root2->right);
    }
    return $flag;
}

/**
 * 二叉树的镜像
 * @param $root TreeNode
 */
function Mirror(&$root)
{
    if (!$root) {
        return;
    }
    if ($root->left || $root->right) {
        $tmp = $root->left;
        $root->left = $root->right;
        $root->right = $tmp;
        unset($tmp);
    }
    if ($root->left) {
        Mirror($root->left);
    }
    if ($root->right) {
        Mirror($root->right);
    }
}

/**
 * 打印矩阵， 按顺时针打印二维数组
 * @param $matrix array
 * @return array
 */
function printMatrix($matrix)
{
    if (!$matrix) {
        return null;
    }
    if (!is_array($matrix) || !is_array($matrix[0])) {
        return null;
    }
    $x = $y = 0;
    $printed_y = [-1, count($matrix)];
    $printed_x = [-1, count($matrix[0])];
    $count_all = count($matrix) * count($matrix[0]);
    $new_arr = [$matrix[0][0]];
    $direction = 0;
    while (count($new_arr) < $count_all) {
        switch ($direction % 4) {
            case 0://往右
                if (count($matrix[0]) == 1) {//单列的时候 直接往下走
                    $printed_y[0]++;
                    $direction++;
                    break;
                }
                $x++;
                if ($x == $printed_x[1] - 1) {
                    $printed_y[0]++;
                    $direction++;
                }
                $new_arr[] = $matrix[$y][$x];
                break;
            case 1://往下
                $y++;
                if ($y == $printed_y[1] - 1) {
                    $printed_x[1]--;
                    $direction++;
                }
                $new_arr[] = $matrix[$y][$x];
                break;
            case 2://往左
                $x--;
                if ($x == $printed_x[0] + 1) {
                    $printed_y[1]--;
                    $direction++;
                }
                $new_arr[] = $matrix[$y][$x];
                break;
            case 3://往上
                $y--;
                if ($y == $printed_y[0] + 1) {
                    $printed_x[0]++;
                    $direction++;
                }
                $new_arr[] = $matrix[$y][$x];
                break;
        }
    }
    return $new_arr;
}


/**
 * 栈的压入、弹出序列
 * 输入两个整数序列，第一个序列表示栈的压入顺序，请判断第二个序列是否可能为该栈的弹出顺序。
 * 假设压入栈的所有数字均不相等。
 * 例如序列1,2,3,4,5是某栈的压入顺序，序列4,5,3,2,1是该压栈序列对应的一个弹出序列，但4,3,5,1,2就不可能是该压栈序列的弹出序列。
 * （注意：这两个序列的长度是相等的）
 * @param $push_arr array
 * @param $pop_arr  array
 * @return bool
 */
function IsPopOrder($push_arr, $pop_arr)
{
    if (!is_array($push_arr) || !is_array($pop_arr) || (count($push_arr) != count($pop_arr))) {
        return false;
    }
    $stack = [];
    while ($push_arr) {
        $one = array_shift($push_arr);
        if ($one == $pop_arr[0]) {
            array_shift($pop_arr);
        } else {
            $stack[] = $one;
        }
    }
    unset($one);
    foreach ($stack as $one) {
        if ($one != array_pop($pop_arr)) {
            return false;
        }
    }
    return true;
}


/**
 * 从上往下打印二叉树
 * 从上往下打印出二叉树的每个节点，同层节点从左至右打印。
 * @param $root TreeNode
 * @return array
 */
function PrintFromTopToBottom($root)
{
    if (empty($root)) {
        return [];
    }
    $tree = $current_queue = [];
    $current_queue[] = $root;//当前层级的队列，第一层只有root
    while ($current_queue) {
        $next_queue = [];
        foreach ($current_queue as $one) {
            if (!$one) continue;
            $tree[] = $one->val;
            if ($one->left) {
                $next_queue[] = $one->left;
            }
            if ($one->right) {
                $next_queue[] = $one->right;
            }
        }
        unset($one);
        $current_queue = $next_queue;
    }
    return $tree;
}

/**
 * 二叉搜索树的后序遍历序列
 * 输入一个整数数组，判断该数组是不是某二叉搜索树的后序遍历的结果。假设输入的数组的任意两个数字都互不相同。
 *
 * 二叉搜索树（Binary Search Tree），也称二叉搜索树，是指一棵空树或者具有下列性质的二叉树：（此题空值要求返回false）
 *  1.任意节点的左子树不空，则左子树上所有结点的值均小于它的根结点的值；
 *  2.任意节点的右子树不空，则右子树上所有结点的值均大于它的根结点的值；
 *  3.任意节点的左、右子树也分别为二叉查找树；
 *  4.没有键值相等的节点。
 * @param $sequence array
 * @return bool
 */
function VerifySquenceOfBST($sequence)
{
    if (!$sequence) return false;
    while (count($sequence) > 2) {
        $root = array_pop($sequence);
        $idx = count($sequence) - 1;
        while ($idx >= 0 && $sequence[$idx] > $root) $idx--;
        while ($idx >= 0 && $sequence[$idx] < $root) $idx--;
        if ($idx != -1) return false;
    }
    return true;
}

/**
 * 二叉树中和为某一值的路径
 * 输入一颗二叉树的跟节点和一个整数，打印出二叉树中结点值的和为输入整数的所有路径。
 * 路径定义为从树的根结点开始往下一直到叶结点所经过的结点形成一条路径。
 * (注意: 在返回值的list中，数组长度大的数组靠前)
 * @param $root TreeNode
 * @param $sum_val int
 * @return array
 */
function FindPath($root, $sum_val)
{
    if (!$root) return [];
    if (!is_int($sum_val) && !is_float($sum_val)) return [];
    $path_all = [];//所有路径
    getAllPath($root, $path_all, $path_all_val);

    $path_yes = [];
    foreach ($path_all as $path) {
        if (array_sum($path) == $sum_val) $path_yes[] = $path;
    }
    uasort($path_yes, function ($a, $b) {
        return count($a) > count($b) ? -1 : 1;
    });
    return $path_yes;
}

/**
 * 获取二叉树的所有路径
 * @param $root TreeNode
 * @param $path_val
 * @param $path_all_val
 */
function getAllPath($root, &$path_all_val, &$path_val = [])
{
    $path_val[] = $root->val;
    if ($root->left || $root->right) {
        if ($root->left) getAllPath($root->left, $path_all_val, $path_val);
        if ($root->right) getAllPath($root->right, $path_all_val, $path_val);
    } else {
        $path_all_val[] = $path_val;
    }
    //移除已通过的节点
    array_pop($path_val);
}

/**
 * 复杂链表的复制
 * 输入一个复杂链表（每个节点中有节点值，以及两个指针，一个指向下一个节点，另一个特殊指针指向任意一个节点），
 * 返回结果为复制后复杂链表的头。（注意，输出结果中请不要返回参数中的节点引用）
 * @param $list_head RandomListNode
 * @return RandomListNode
 */
function MyClone($list_head)
{
    if (!$list_head) return null;
    $old_arr = $cloned_arr = [];
    $new_list = cloneList($list_head, $old_arr, $cloned_arr);
    foreach ($old_arr as $idx => $old) {
        if ($old->random) {
            $random_idx = array_search($old->random, $old_arr);
            if ($random_idx !== false) {
                $cloned_arr[$idx]->random = $cloned_arr[$random_idx];
            }
        }

    }
    return $new_list;
}

/**
 * @param $list_head
 * @param $old
 * @param $cloned
 * @return RandomListNode|null
 */
function cloneList($list_head, &$old, &$cloned)
{
    if (!$list_head) return null;
    $new_node = new RandomListNode($list_head->label);
    $old[] = $list_head;
    $cloned[] = $new_node;
    if ($list_head->next) {
        $new_node->next = cloneList($list_head->next, $old, $cloned);
    }
    return $new_node;
}

/**
 * 二叉搜索树转有序双向链表
 * 输入一棵二叉搜索树(BST)，将该二叉搜索树转换成一个排序的双向链表。要求不能创建任何新的结点，只能调整树中结点指针的指向。
 * @param $root TreeNode
 * @param $start TreeNode
 * @param $end TreeNode
 * @return TreeNode
 */
function Convert($root, &$start = null, &$end = null)
{
    if (!$root) return null;
    $tmp_start = null;
    $tmp_end = null;
    if ($root->left) {
        Convert($root->left, $tmp_start, $tmp_end);
        $start = $tmp_start;
        $root->left = $tmp_end;
        $tmp_end->right = $root;
    } else {
        $start = $root;
    }
    if ($root->right) {
        $right_start = null;
        $right_end = null;
        Convert($root->right, $tmp_start, $tmp_end);
        $end = $tmp_end;
        $root->right = $tmp_start;
        $tmp_start->left = $root;
    } else {
        $end = $root;
    }
    return $start;
}

/**
 * 字符串的排列
 * 输入一个字符串,长度不超过9,按字典序打印出该字符串中字符的所有排列。
 * 例如输入字符串abc,则打印出由字符a,b,c所能排列出来的所有字符串abc,acb,bac,bca,cab和cba。
 * @param $str string
 * @return array
 */
function Permutation($str)
{
    if (strlen($str) > 9 || (empty($str) && $str != '0')) return [];
    //只有一个字符 直接返回
    if (strlen($str) == 1) return [$str];

    $str_arr = str_split($str);
    $result = [];
    for ($i = count($str_arr) - 1; $i >= 0; $i--) {
        getStrArray($str_arr[$i], $result);
    }
    foreach ($result as &$one) {
        $one = implode("", $one);
    }
    $result = array_keys(array_flip($result));
    sort($result);
    return $result;
}

/**
 * 思路:
 * F(1): 一个字符 只有一种组合
 * F(2): 两个字符 第二个字符可以放在第一个的前、后 两种
 * F(3): 三个字符 第三个字符可以放在前两个字符的前、后或中间 3*F(2)
 * F(4): 四个字符 第四个字符可以放在前三个字符的前、后或任意一个两个字符中间 4*F(3 )
 * F(n): (2+(n-1))*F(n)
 *
 * @param $char
 * @param $result array
 * @return void
 */
function getStrArray($char, &$result)
{

    if (empty($result)) {
        $result = [[$char]];
        return;
    }
    $tmp = [];
    foreach ($result as $row) {
        for ($i = 0; $i < count($row); $i++) {
            if ($char == $row[$i]) continue;
            $row_copy = $row;
            array_splice($row_copy, $i, 0, $char);
            $tmp[] = $row_copy;
        }
        $row[] = $char;
        $tmp[] = $row;
    }
    $result = $tmp;
    return;
}

/**
 * 数组中出现次数超过一半的数字
 * 找出数组中出现的次数超过数组长度的一半的数字。
 * 例如输入一个长度为9的数组{1,2,3,2,2,2,5,4,2}。由于数字2在数组中出现了5次，超过数组长度的一半，因此输出2。
 * 如果不存在则输出0
 * @param $numbers array
 * @return int
 */
function MoreThanHalfNum_Solution($numbers)
{
    if (!$numbers || !is_array($numbers)) return 0;
    if (count($numbers) == 1) return $numbers[0];
    $all_count = [];
    foreach ($numbers as $num) {
        if (isset($all_count[$num])) {
            $all_count[$num]++;
        } else {
            $all_count[$num] = 1;
        }
    }
    arsort($all_count);

    if (current($all_count) > count($numbers) / 2) return key($all_count);
    return 0;
}

/**
 * 最小的K个数
 * 输入n个整数，找出其中最小的K个数。
 * 例如输入4,5,1,6,2,7,3,8这8个数字，则最小的4个数字是1,2,3,4,。
 * @param $input array
 * @param $k int
 * @return array
 */
function GetLeastNumbers_Solution($input, $k)
{
    if (empty($input) || !is_array($input) || !$k) return [];
    //构建容量为 K 的最小堆
    $heap = [];
    foreach ($input as $value) {
        heapInsert($heap, $value);
    }
    $res = [];
    for ($i = 0; $i < $k && $heap; $i++) {
        $res[] = heapShift($heap);
    }
    return $res;
}

/**
 * 小顶堆插入
 * @param $heap array
 * @param $val int
 */
function heapInsert(&$heap, $val)
{
    if (empty($heap)) {//空堆初始化
        $heap = [$val];
        return;
    }
    //要插入的值放在堆最后一位
    $heap[] = $val;
    //和父节点比较 更小则交换 完成条件：成为跟节点或比父节点大
    $i = count($heap) - 1;//下标从0开始 i做为待插入节点的下标 其父节点下标是 (i-1)>>1
    while ($i > 0) {
        $father = ($i - 1) >> 1;
        if ($heap[$father] > $heap[$i]) {
            $heap[$father] ^= $heap[$i] ^= $heap[$father] ^= $heap[$i];
            $i = $father;
        } else {
            break;
        }
    }
}

/**
 * 小顶堆删除
 * @param $heap array
 * @return int
 */
function heapShift(&$heap)
{
    if (empty($heap)) return null;
    if (count($heap) == 1) return array_pop($heap);
    $min = $heap[0];
    $heap[0] = array_pop($heap);
    //和子节点中小的那个比较, 大于则互换，直到小于子节点或不存在子节点
    $i = 0;//下标从0开始 i做为待插入节点的下标 其子节点下标是 (i+1)<<1-1,(i+1)<<1
    while ($i < count($heap)) {
        $son = ($i + 1) << 1 - 1;
        if (isset($heap[$son])) {
            if (isset($heap[$son + 1]) && $heap[$son + 1] < $heap[$son]) $son += 1;
            if ($heap[$son] < $heap[$i]) {
                $heap[$son] ^= $heap[$i] ^= $heap[$son] ^= $heap[$i];
                $i = $son;
            } else break;
        } else break;
    }
    return $min;
}

/**
 * 连续子数组的最大和 暴力解法
 *
 * {6,-3,-2,7,-15,1,2,2},连续子向量的最大和为8(从第0个开始,到第3个为止)。
 * 给一个数组，返回它的最大连续子序列的和(子向量的长度至少是1)
 * @param array $arr
 * @return int
 */
function FindGreatestSumOfSubArray($arr)
{
    if (!$arr) return false;
    $max = $arr[0];

    for ($i = 0; $i < count($arr); $i++) {
        $cur = $arr[$i];
        if ($cur > $max || $max === null) {
            $max = $cur;
        }
        for ($j = $i + 1; $j < count($arr); $j++) {
            $cur += $arr[$j];
            if ($cur > $max || $max === null) {
                $max = $cur;
            }
        }
    }
    return $max;
}

/**
 * 连续子数组的最大和
 * 给一个数组，返回它的最大连续子序列的和(子向量的长度至少是1)
 *
 * 使用动态规划
 * 以i为结尾的子数组的和的最大值可能为0-i项相加或第i项
 *  即： f(i) = max( f(i-1) + $arr[$i], $arr[$i])
 * 最大子向量为 max(f(0),...,f(count($arr)))
 * {6,-3,-2,7,-15,1,2,2},连续子向量的最大和为8(从第0个开始,到第3个为止)。
 *
 * @param array $arr
 * @return int
 */
function FindGreatestSumOfSubArray2($arr)
{
    if (!$arr) return false;
    $max = $i_max = $arr[0];
    for ($i = 1; $i < count($arr); $i++) {
        $i_max = $arr[$i] + $i_max > $arr[$i] ? $arr[$i] + $i_max : $arr[$i];
        if ($max < $i_max) $max = $i_max;
    }
    return $max;
}

/**
 * 求任意非负整数区间中1出现的次数（从1 到 n 中1出现的次数）
 * 如 n=13 包含1的数字有1、10、11、12、13
 *
 * @param $n int
 * @return false|int
 */
function NumberOf1Between1AndN_Solution($n)
{
    /**
     * 简单粗暴一行搞定  完全没效率数字太大生成的字符串还会占用超大内存  崩沙卡拉卡
     */
    return (int)$n < 1 ? 0 : substr_count(implode('', range(1, (int)$n)), 1);
}

/**
 * 把数组排成最小的数
 *
 * 输入一个正整数数组，把数组里所有数字拼接起来排成一个数，打印能拼接出的所有数字中最小的一个
 * 例如输入数组[3，32，321]，则打印出这三个数字能排成的最小数字为321323。
 *
 * 解 将数组排序再拼接
 * 若ab > ba 则 a > b，
 * 若ab < ba 则 a < b，
 * 若ab = ba 则 a = b；
 * @param $numbers array
 * @return int
 */
function PrintMinNumber($numbers)
{
    if (count($numbers) <= 1) return current($numbers);

    usort($numbers, function ($a, $b) {
        $a_str = '' . $a;
        $b_str = '' . $b;
        return $a_str . $b_str > $b_str . $a_str;
    });
    return implode("", $numbers);
}

/**
 * 第N个丑数
 * 只包含质因子2、3和5的数称作丑数（Ugly Number）。例如6、8都是丑数，但14不是
 * @param $n int
 * @return int
 */
function GetUglyNumber_Solution($n)
{
    if ($n < 1) return 0;
    $num_list = [1];
    $i2 = $i3 = $i5 = 0;
    while ((count($num_list)) < $n) {
        $num2 = $num_list[$i2] * 2;
        $num3 = $num_list[$i3] * 3;
        $num5 = $num_list[$i5] * 5;
        $num = min($num2, $num3, $num5);
        if ($num == $num2) $i2++;
        if ($num == $num3) $i3++;
        if ($num == $num5) $i5++;
        $num_list[] = $num;
    }
    return array_pop($num_list);
}

/**
 * 第一个只出现一次的字符
 * 在一个字符串(0<=字符串长度<=10000，全部由字母组成)中找到第一个只出现一次的字符,并返回它的位置, 如果没有则返回 -1,需要区分大小写
 * @param $str string
 * @return string|int
 */
function FirstNotRepeatingChar($str)
{
    $arr = [];
    for ($i = 0; $i < strlen($str); $i++) {
        if (isset($arr[$str[$i]])) {
            $arr[$str[$i]]['count']++;
        } else {
            $arr[$str[$i]] = ['idx' => $i, 'count' => 1];
        }
    }
    foreach ($arr as $item) {
        if ($item['count'] === 1) return $item['idx'];
    }
    return -1;
}

/**
 * 数组中的逆序对
 * 在数组中的两个数字，如果前面一个数字大于后面的数字，则这两个数字组成一个逆序对。
 * 输入一个数组,求出这个数组中的逆序对的总数P。并将P对1000000007取模的结果输出。 即输出P%1000000007
 * @param $data array
 * @return int
 */
function InversePairs($data)
{
    $count = 0;
    //这种排序不行
    //todo: 换成归并排序
    usort($data,function ($a,$b) use(&$count){
        if($a>$b){
            $count++;
            return 1;
        }
        return -1;
    });
    return $count%1000000007;
}