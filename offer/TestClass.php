<?php

class ListNode {
    /**
     * @var mixed
     */
    public $val;

    /**
     * @var ListNode
     */
    public $next = NULL;

    public function __construct($x) {
        $this->val = $x;
    }
}

class TreeNode {
    /**
     * @var mixed
     */
    public $val;

    /**
     * @var TreeNode
     */
    public $left = NULL;

    /**
     * @var TreeNode
     */
    public $right = NULL;

    public function __construct($val) {
        $this->val = $val;
    }

    /**
     * 测试用例
     * @return TreeNode
     */
    public static function createTestTree(){
        //创建二叉树，
        $n3 = new TreeNode(3);
        $n4 = new TreeNode(4);
        $n5 = new TreeNode(5);
        $n6 = new TreeNode(6);
        $n7 = new TreeNode(7);
        $n8 = new TreeNode(8);
//$n9 = new TreeNode(9);
//$n10 = new TreeNode(-1);
        $n5->left   = $n3;
        $n5->right   = $n7;
        $n3->right  = $n4;
        $n7->left   = $n6;
        $n7->right   = $n8;
//$n5->right  = $n8;
//$n8->left = $n10;
        return $n5;
    }
}

class RandomListNode{
    /**
     * @var mixed
     */
    var $label;

    /**
     * @var RandomListNode
     */
    var $next = NULL;

    /**
     * @var RandomListNode
     */
    var $random = NULL;

    function __construct($x){
        $this->label = $x;
    }

    /**
     * 测试用例
     * @return RandomListNode
     */
    public static function createTestRandomList(){

        $random_node1 = new RandomListNode(1);
        $random_node2 = new RandomListNode(2);
        $random_node3 = new RandomListNode(3);
        $random_node4 = new RandomListNode(4);
        $random_node5 = new RandomListNode(5);
        $random_node1->next=$random_node2;
        $random_node2->next=$random_node3;
        $random_node3->next=$random_node4;
        $random_node4->next=$random_node5;
        $random_node1->random=$random_node3;
        $random_node2->random=$random_node5;
        $random_node4->random=$random_node2;

        return $random_node1;
    }
}