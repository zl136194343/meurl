<?php
// 事件定义文件
return [
    'bind'      => [
        
    ],

    'listen'    => [
        //展示活动
        /*'OrderComplete' => [
            'addon\community\event\OrderSettlement',
        ],*/
        //展示活动
        'CronOrderArrive' => [
            'addon\community\event\CronOrderArrive',
        ],
        //订单创建后执行事件
        'CommunityOrderCreate' => [
            'addon\community\event\CreateOrderLog',  //创建订单后添加订单日志
        ],
        'CronCommanderOrderClose' => [
            'addon\community\event\CronCommanderOrderClose',
        ],
        'CommanderOrderClose' => [], //订单关闭后执行事件
        'CronCommanderOrderComplete' => [
            'addon\community\event\CronCommanderOrderComplete',
        ],
        'CronCommanderOrderTakeDelivery' => [
            'addon\community\event\CronOrderTakeDelivery',
        ],
        'CommanderOrderTakeDelivery' => [], //订单收货
        'CommunityOrderRefundFinish' => [
            'addon\community\event\OrderRefundFinish',
        ],
        'CommunityOrderRefundRefuse' => [
            'addon\community\event\OrderRefundRefuse',
        ],
        'CommunityOrderPayNotify' => [
            'addon\community\event\OrderPayNotify',
        ],
        'CommunityOrderRefundConfirm' => [
            'addon\community\event\CronOrderRefundConfirm',
        ],
        'CommunityOrderComplete' => [
            'addon\community\event\OrderComplete',
        ],
        'CommunityOrderRefundApply' => [
            'addon\community\event\OrderRefundApply',
        ],
        'CommunityOrderRefundDelivery' => [
            'addon\community\event\OrderRefundDelivery',
        ],
        'MemberAccountFromType' => [
            'addon\community\event\MemberAccountFromType',
        ],

        'CommunityOrderPay' => [
            'addon\community\event\ShopOrderCalc',  //订单支付后统计
        ], 
        //核销
        
        'CommunityOrderVerify' => [
            'addon\community\event\CommunityOrderVerify',//社区自提订单核销
        ],
        'CronCommunityGoodsTimerOn' => [
            'addon\community\event\CronGoodsTimerOn',//社区自提订单核销
        ],
        'CronCommunityGoodsTimerOff' => [
            'addon\community\event\CronGoodsTimerOff',//社区自提订单核销
        ],
        
    ],

    'subscribe' => [
    ],
];
